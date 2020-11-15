<?php

declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Resources\Users\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    /**
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        $data = $this->validate($request, [
            'username' => 'required|string|between:2,32|unique:user',
            'name' => 'required|string|max:255',
            'password' => 'required|string|regex:/^(?=.*\d)(?=.*[a-z]).{8,}$/i'
        ]);
        $user = User::create($data);
        return response()->json(new UserResource($user), 201);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function search(Request $request)
    {
        $data = $this->validate($request, [
            'query' => 'required|string|min:3'
        ]);
        $search_query = $data['query'];
        $collection = UserResource::collection(User::query()->where('username', 'like', "$search_query%")
            ->orWhere('name', 'like', "$search_query%")
            ->limit(10)
            ->get());
        $collection->withoutWrapping();
        return $collection;
    }
}
