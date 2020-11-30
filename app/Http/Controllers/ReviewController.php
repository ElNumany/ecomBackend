<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

Paginator::useBootstrap();

class ReviewController extends Controller
{
    public function index(){
        $reviews=Review::with(['product' , 'customer'])->paginate(env('PAGINATION_COUNT'));
        return view('Admin.Reviews.reviews')->with([
        "reviews" => $reviews]);
        // return $reviews;

}


public function delete(Request $request)
{
    $request->validate([
        'review_id' => 'required'
    ]);
    $revID = $request->input('review_id');
    Review::destroy($revID);
    $request->session()->flash('message', 'Review Had been Deleted!');
    return redirect()->back();
}



}

