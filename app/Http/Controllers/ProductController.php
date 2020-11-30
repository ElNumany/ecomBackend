<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

Paginator::useBootstrap();

class ProductController extends Controller
{
    public function index(){
        $products = Product::with(['category' , 'image'])->paginate(env("PAGINATION_COUNT"));
        $currencyCode = env("CURRENCY_CODE" ,'$');
        return view('Admin.Products.products') ->with([
            'products' => $products,
            'currency_code' => $currencyCode,
        ]);
        // return $products;
    }
    public function store(Request $request){}
    public function update(Request $request , $id){}
    public function delete($id){}
    public function newProduct($id= null){
        $product = null;
        if(! is_null($id)){
            $product = Product::find($id);
        }
        return view('Admin.Products.newproduct')->with([
            'product' => $product ,
        ]);
    }
}
