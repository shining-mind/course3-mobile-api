<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Resources\Error;
use App\Http\Resources\Info;
use App\Http\Resources\Users\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTGuard;

class Controller extends BaseController
{

    protected JWTGuard $auth;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['login']]);
        $this->auth = auth('api');
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request): object
    {
        $grant_type = $request->get('grant_type');
        $token = null;
        if ($grant_type === 'password') {
            $credentials = request(['username', 'password']);
            $token = $this->loginUsingCredentials($credentials);
            $refresh_token = $this->createRefreshTokenUsingCredentials($credentials);
        } elseif ($grant_type === 'refresh_token') {
            $refresh_token = $request->get('refresh_token');
            $token = $this->loginUsingRefreshToken($refresh_token);
        }
        if (!$token) {
            return response()->json(new Error(trans('error.wrong_credentials')), 401);
        }
        return $this->respondWithToken($token, $refresh_token);
    }

    /**
     * @param array $credentials
     * @return string|null
     */
    protected function loginUsingCredentials(array $credentials): ?string
    {
        $token = $this->auth->attempt($credentials);
        if (!is_string($token)) {
            return null;
        }
        return $token;
    }

    /**
     * @param string $refresh_token
     * @return string|null
     */
    protected function loginUsingRefreshToken(string $refresh_token): ?string
    {
        $user = User::where('refresh_token', $refresh_token)->first();
        if (is_null($user)) {
            return null;
        }
        return $this->auth->login($user);
    }

    /**
     * @param array $credentials
     * @return string|null
     */
    protected function createRefreshTokenUsingCredentials(array $credentials): ?string
    {
        $user = $this->auth->getProvider()->retrieveByCredentials($credentials);
        $user_id = $user->getAuthIdentifier();
        $refresh_token = bin2hex(random_bytes(32));
        if (User::whereId($user_id)->update(['refresh_token' => $refresh_token])) {
            return $refresh_token;
        }
        return null;
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(
            new UserResource($this->auth->user())
        );
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->auth->logout();

        return response()->json(new Info(trans('messages.logout_successful')));
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken(string $token, string $refresh_token)
    {
        return response()->json([
            'access_token' => $token,
            'refresh_token' => $refresh_token,
            'token_type' => 'bearer',
            'expires_in' => $this->auth->factory()->getTTL() * 60,
        ]);
    }
}
