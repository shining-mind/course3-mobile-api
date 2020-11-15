<?php

declare(strict_types=1);

namespace App\Http\Resources\Teams;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TeamCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($item) use ($request) {
                return (new TeamResource($item))->toArray($request);
            })->toArray(),
        ];
    }

    /**
     * Add the pagination information to the response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function paginationInformation($request)
    {
        return [];
    }
}
