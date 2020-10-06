<?php

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Team;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    /**
     * @return void
     */
    public function list()
    {
        // TODO: return data and meta
        return Team::paginate(10);
    }
}
