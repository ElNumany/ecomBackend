<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

Paginator::useBootstrap();
class CountryController extends Controller
{
    public function index(){
        $countries = Country::paginate(env('PAGINATION_COUNT'));
        return view('Admin.Countries.countires')->with([
            'countries' => $countries,
            'showLinks' => true,
        ]);
    }
    public function store(Request $request){}
    public function update(Request $request){}
    public function delete(Request $request){
        $request->validate([
            'country_id' => 'required'
        ]);
        $countryID = $request->input('country_id');
        Country::destroy($countryID);
        $request->session()->flash('message', 'Category Had been Deleted!');
        return redirect()->back();
    }
    public function search(Request $request){

        $request->validate([
            'country_search' => 'required',
        ]);
        $searchTerm = $request->input('country_search');
        $countries = Country::where(
            'name',
            'LIKE',
            '%' . $searchTerm . '%'
        )->get();
        if (count($countries) > 0) {
            return view('Admin.Countries.countires')->with([
                'countries' => $countries,
                'showLinks' => false,
            ]);
        }
        $request->session()->flash('message', 'Nothing Founded!!!');
        return redirect()->back();

    }



    private function CategoryNameExist($countryName)
    {
        $country = Country::where(
            'name',
            '=',
            $countryName
        )->first();
        if (!is_null($country)) {
            session()->flash('message', 'There is one  (' . $country . ') in The World :D!');
            return false;
        }
        return true;
    }
}


