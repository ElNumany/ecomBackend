<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

Paginator::useBootstrap();

class RoleController extends Controller
{
    public function index(){
        // $roles  = Role::with('users');
        return view('Admin.Roles.roles')->with([
            'roles'  => Role::all(),
        ]);
    //    return    Role::all();
    }
}
