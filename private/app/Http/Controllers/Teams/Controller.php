<?php

declare(strict_types=1);

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Resources\Teams\TeamCollection;
use App\Models\Team;

class Controller extends BaseController
{
    /**
     * @return void
     */
    public function list()
    {
        return new TeamCollection(Team::with('owner')->paginate(10));
    }
}
