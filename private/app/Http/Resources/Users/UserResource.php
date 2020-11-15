<?php

declare(strict_types=1);

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * @inheritDoc
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'name' => $this->name,
            'created_at' => is_null($this->created_at) ? null : $this->created_at->toISOString(),
        ];
    }
}
