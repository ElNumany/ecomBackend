<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

Paginator::useBootstrap();

class CityController extends Controller
{
    public function index(){
        $cities = City::with(['state' , 'country'])->paginate(env('PAGINATION_COUNT'));
        return view('Admin.Cities.cities')->with([
            'cities' => $cities,
        ]);
    }
}
