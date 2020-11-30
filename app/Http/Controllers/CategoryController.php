<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

Paginator::useBootstrap();

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(env("PAGINATION_COUNT"));
        return view('Admin.Categories.categories')->with([
            'categories' => $categories,
            'showLinks' => true,
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);
        $categoryName = $request->input('category_name');
        if (!$this->CategoryNameExist($categoryName)) {
            return redirect()->back();
        }
        $category = new Category();
        $category->category_name = $categoryName;
        $category->save();
        $request->session()->flash('message', 'New Category Had Been Added!');
        return back();
    }



    public function delete(Request $request)
    {
        $request->validate([
            'category_id' => 'required'
        ]);
        $catID = $request->input('category_id');
        Category::destroy($catID);
        $request->session()->flash('message', 'Category Had been Deleted!');
        return redirect()->back();
    }




    public function update(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);
        $catName = $request->input('category_name');
        $catID = $request->input('category_id');
        if( !$this->CategoryNameExist($catName)) {
            return back();
        }
        $cat = Category::find($catID);
        $cat->category_name = $catName;
        $cat->save();
        $request->session()->flash('message', 'Category Had been Updated!');
        return redirect()->back();
    }




    public function search(Request $request)
    {
        $request->validate([
            'category_search' => 'required',
        ]);
        $searchTerm = $request->input('category_search');
        $categories = Category::where(
            'category_name',
            'LIKE',
            '%' . $searchTerm . '%'
        )->get();
        if (count($categories) > 0) {
            return view('Admin.Categories.categories')->with([
                'categories' => $categories,
                'showLinks' => false,
            ]);
        }
        $request->session()->flash('message', 'Nothing Founded!!!');
        return redirect()->back();
    }



    private function CategoryNameExist($categoryName)
    {
        $category = Category::where(
            'category_name',
            '=',
            $categoryName
        )->first();
        if (!is_null($category)) {
            session()->flash('message', 'Category Name (' . $categoryName . ') Already Exist .. Nothing Changed!');
            return false;
        }
        return true;
    }
}
