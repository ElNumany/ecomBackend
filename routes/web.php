<?php

use App\Models\City;
use App\Models\Country;
use App\Models\Image;
use App\Models\Product;
use App\Models\Role;
use App\Models\State;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Route::get('users', function () {
//     return User::paginate(3);
// });
// Route::get('products', function () {
//     return Product::with(["image"])->paginate(5) ;
// });
// Route::get('images', function () {
//     return Image::with(['product'])->paginate(3);
// });
// Route::get('units-test', "App\Models\dataimportController@importUnits" );
// Route::get('states', function () {
//     return State::with(['country' , 'cities'])->paginate(1);
// });
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Route::get('role', function () {
//     $user = Role::find(1);
//     return $user->users;

// });

Route::group(['middleware'=>'auth' , 'user_is_admin'], function () {

    //Units
    Route::get('units', "App\Http\Controllers\UnitController@index") -> name('units');
    Route::get('add_unit', "App\Http\Controllers\UnitController@showAdd" ) ->name('new-unit');
    Route::post('units',"App\Http\Controllers\UnitController@store" );
    Route::get('search-units' , 'App\Http\Controllers\UnitController@search')->name('search-units');
    Route::put('units',"App\Http\Controllers\UnitController@update" );
    Route::delete('units',"App\Http\Controllers\UnitController@delete" );


    //Categories
    Route::get('categories', "App\Http\Controllers\CategoryController@index" )->name('categories');
    Route::post('categories', "App\Http\Controllers\CategoryController@store" )->name('categories');
    Route::delete('categories', "App\Http\Controllers\CategoryController@delete" )->name('categories');
    Route::get('search-categories', "App\Http\Controllers\CategoryController@search" )->name('search-categories');
    Route::put('categories', "App\Http\Controllers\CategoryController@update" )->name('categories');



    //Proudcts
    Route::get('products}', "App\Http\Controllers\ProductController@index" )->name('products');

    //for new Products
    Route::get('new-product','App\Http\Controllers\ProductController@newProduct')->name('new-product');
    Route::get('update-product/{id}','App\Http\Controllers\ProductController@newProduct')->name('update-product');
    Route::put('new-product/{id}','App\Http\Controllers\ProductController@update');

    Route::post('products', "App\Http\Controllers\ProductController@store" );
    Route::delete('products/{id}', "App\Http\Controllers\ProductController@delete" );


    //Tags
    Route::get('tags', "App\Http\Controllers\TagController@index" )->name('tags');
    Route::post('tags', "App\Http\Controllers\TagController@store" )->name('tags');
    Route::get('search-tags', "App\Http\Controllers\TagController@search" )->name('search-tags');
    Route::delete('tags', "App\Http\Controllers\TagController@delete" )->name('tags');
    Route::put('tags', "App\Http\Controllers\TagController@update" );



    //Payments



    //Orders



    //Shipments



    //Countries
    Route::get('countries', "App\Http\Controllers\CountryController@index" )->name('countries');
    Route::post('countries', "App\Http\Controllers\CountryController@store" )->name('countries');
    Route::delete('countries', "App\Http\Controllers\CountryController@delete" )->name('countries');
    Route::get('search-countries', "App\Http\Controllers\CountryController@search" )->name('search-countries');
    Route::put('countries', "App\Http\Controllers\CountryController@update" )->name('countries');




    //Ceties
    Route::get('cities','App\Http\Controllers\CityController@index')->name('cities');



    //States
    Route::get('states','App\Http\Controllers\StateController@index' )->name('states');



    //Reviews
    Route::get('reviews','App\Http\Controllers\ReviewController@index' )->name('reviews');
    // Route::post('reviews', "App\Http\Controllers\ReviewController@store" )->name('reviews');
    Route::delete('reviews', "App\Http\Controllers\ReviewController@delete" )->name('reviews');
    // Route::get('search-reviews', "App\Http\Controllers\ReviewController@search" )->name('search-reviews');
    // Route::put('reviews', "App\Http\Controllers\ReviewController@update" )->name('reviews');



    //Tickets
    Route::get('tickets', 'App\Http\Controllers\TicketController@index')->name('tickets');



    //Roles
    Route::get('roles', 'App\Http\Controllers\RoleController@index' )->name('roles');
});
