<?php

declare(strict_types=1);

namespace App\Http\Resources\Teams;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Users\UserResource;

class TeamResource extends JsonResource
{
    /**
     * @inheritDoc
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'owner' => is_null($this->owner) ? null : (new UserResource($this->owner))->toArray($request),
            'created_at' => is_null($this->created_at) ? null : $this->created_at->toISOString(),
        ];
    }
}
