<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

Paginator::useBootstrap();

class StateController extends Controller
{
    public function index( ){
        $states= State::with(['country'])->paginate(env("PAGINATION_COUNT"));
        return view('Admin.States.state') -> with([
            "states" => $states,
        ]);
    }
}
