<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Contracts\Session\Session;
// use Carbon\Traits\Units;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

Paginator::useBootstrap();

class UnitController extends Controller
{
    public function showAdd()
    {
        return view('Admin.Units.add_edit');
    }
    public function index()
    {
        $units = Unit::paginate(env("PAGINATION_COUNT"));
        return view('Admin.Units.units' ,[
            'units' => $units,
            'showLinks' =>true,
            ] );
    }
    public function update(Request $request){
    $request->validate([
        'unit_name' => 'required',
        'unit_id'=>'required',
        'unit_code' => 'required',
    ]);
    $unitName = $request->input('unit_name');
    $unitCode = $request->input('unit_code');
    if( ! $this->unitNameExist($unitName)){
        return redirect()->back();
    }
    if( ! $this->unitCodeExist($unitCode)){
    return redirect()->back();
    }
    $unit_id =intval( $request->input("unit_id"));
    $unit = Unit::find($unit_id);
    $unit->unit_name =  $request->input("unit_name");
    $unit->unit_code =  $request->input("unit_code");
    $unit->save();
    $request->session()->flash('message', "Unit " . $unit->unit_name . 'Has been updated');
    return redirect()->back();
    }
    public function store(Request $request){
        $request -> validate([
                'unit_name' => 'required',
                'unit_code' => 'required',
            ]);
            $unitName = $request->input('unit_name');
            $unitCode = $request->input('unit_code');
            if( ! $this->unitNameExist($unitName)){
                return redirect()->back();
            }
            if( ! $this->unitCodeExist($unitCode)){
            return redirect()->back();
            }
            $unit = new Unit();
            $unit->unit_name = $request->input('unit_name');
            $unit->unit_code = $request->input('unit_code');
            $unit->save();
            $request->session()->flash('message' , 'Unit ' . $unit->unit_name . " has been Added");
            return redirect()->back();
    }
    public function delete(Request $request){
        if(is_null($request -> input('unit_id'))|| empty ($request -> input('unit_id'))){
        $request->session()->flash('message' , " Unit id is Required! Error In Deleted!");
        return redirect()->back();
        }
        $id = $request->input('unit_id');
        Unit::destroy($id);
        $request->session()->flash('message' , " Unit has been Deleted");
        return redirect()->back();
    }
    private function unitNameExist($unitName ){
        $unit = Unit::where(
            'unit_name' , '=', $unitName
        )->first();
        if(!is_null($unit)){
            session()->flash('message', 'Unit Name ('.$unitName.') Already Exist .. Nothing Changed!');
                return false;
        }
        return true;
    }
    private function unitCodeExist($unitCode ){
        $unit = Unit::where(
            'unit_Code' , '=', $unitCode
        )->first();
        if(!is_null($unit)){
        session()->flash('message', 'Unit Code ('.$unitCode.') Already Exist .. Nothing Changed!');
        return false;
        }
        return true;
    }
    public function search(Request $request){
        $request->validate([
            'unit_search'=>'required',
        ]);
        $searchTerm = $request->input('unit_search');
        $units = Unit::where(
            'unit_name' , 'LIKE' ,'%'. $searchTerm . '%'
        )->orWhere(
            'unit_code' , 'LIKE' , '%'.$searchTerm.'%'
        )->get();
        if(count($units) > 0 ){
            return view('Admin.Units.units')->with([
                'units' => $units ,
                'showLinks' =>false,
            ]);
        }$request->session()->flash('message', 'Nothing Founded!!!');
        return redirect()->back();
        }
}
