<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

// Route::get('/', function () {
//     return view('welcome');
// })->middleware(['verify.shopify'])->name('home');
Route::get('/','App\Http\Controllers\ShopifyController@customerList')->middleware(['verify.shopify'])->name('home');
//Route::get('/graph','App\Http\Controllers\GraphController@index')->middleware(['verify.shopify'])->name('graph');;

Route::post('/123','App\Http\Controllers\ShopifyController@customerget')->middleware(['verify.shopify'])->name('paginate');

Route::post('/search-ajax','App\Http\Controllers\ShopifyController@search_ajax')->middleware(['verify.shopify'])->name('search');
Route::post('/search-collection','App\Http\Controllers\ShopifyController@serachbycollect')->middleware(['verify.shopify'])->name('collec123');

// Route::post('/search-collection','App\Http\Controllers\ShopifyController@serachbycollect')->middleware(['verify.shopify'])->name('serachcollect');






Route::get('/graph', function () {
    return view('graph');
})->middleware(['verify.shopify'])->name('graph');
Route::middleware(['verify.shopify'])->group(function(){
    Route::post('/search-graphql','App\Http\Controllers\GraphController@search_graph')->name('search_graphql');
    Route::post('/search-collectons','App\Http\Controllers\GraphController@search_collections')->name('search_collections');
    Route::post('/search-vendor','App\Http\Controllers\GraphController@search_vendor')->name('search_vendor');
    Route::post('/search-tags','App\Http\Controllers\GraphController@search_tags')->name('search_tags');
    Route::get('/graph123','App\Http\Controllers\GraphController@view_graphql');
  
    Route::post('/productget','App\Http\Controllers\GraphController@Productget')->name('paginate123');
    Route::post('/123123','App\Http\Controllers\GraphController@Productget123')->name('paginate1233');



});

