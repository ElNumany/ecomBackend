<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

Paginator::useBootstrap();

class TagController extends Controller
{
    public function index(){
        $tags = Tag::paginate(env("PAGINATION_COUNT"));
        return view('Admin.Tags.tags')->with([
            'tags' => $tags,
            'showLinks' => true,
        ]);
    }
    public function store(Request $request){
        $request->validate([
            'tag_name' =>'required',
            ]);
        $tagName = $request->input('tag_name');
        if(! $this->TagNameExist($tagName)){
            $request->session()->flash('message','Tag Name Already Exist!');
            return redirect()->back();
        }
        $tag = Tag::where('tag' , '=' , $tagName)->get();
        if(count($tag) > 0){
            $request->session()->flash('message' , 'Tag ' . $tagName. ' Already Exist!');
            return redirect()->back();
        }
        $newTag = new Tag();
        $newTag->tag =$tagName;
        $newTag->save();
        $request->session()->flash('message' , 'Tag ' . $tagName . ' Has Been Added');
        return redirect()->back();
    }

    public function delete(Request $request){
        $request->validate([
            'tag_id' => 'required',
        ]);
        $tagID = $request->input('tag_id');
        $tag = Tag::destroy($tagID);
        $request->session()->flash('message' , 'Tag Had been Deleted!');
        return redirect()->back();
    }
    public function update(Request $request){
        $request->validate([
            'tag_name'=> 'required',
            'tag_id' => 'required'
        ]);
        $tagName= $request->input('tag_name');
        $tagID = $request->input('tag_id');



        $tag = Tag::find($tagID);
        $tag->tag = $tagName;
        $tag->save();
        $request->session()->flash('message' , 'Tag Had been Updated!');
        return redirect()->back();


    }



    private function TagNameExist($tagName ){
        $tag = Tag::where(
            'tag' , '=', $tagName
        )->first();
        if(!is_null($tag)){
            session()->flash('message', 'Tag Name ('.$tagName.') Already Exist .. Nothing Changed!');
                return false;
        }
        return true;
    }
    public function search(Request $request){
        $request->validate([
            'tag_search'=>'required',
        ]);
        $searchTerm = $request->input('tag_search');
        $tags = Tag::where(
            'tag' , 'LIKE' ,'%'. $searchTerm . '%'
        )->get();
        if(count($tags) > 0 ){
            return view('Admin.Tags.tags')->with([
                'tags' => $tags ,
                'showLinks' => false,
            ]);
        }$request->session()->flash('message', 'Nothing Founded!!!');
        return redirect()->back();
        }

}
