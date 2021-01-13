<?php

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
Auth::routes();

//Route for managing user
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user', 'UserController@index')->name('user');
Route::get('/getusers',['as' => 'getusers', 'uses' => 'UserController@getAllUsers']);
Route::get('/user/edit/{id}',['as' => 'edituser', 'uses' => 'UserController@getAllUsers']);
Route::post('/updateuser',['as' => 'updateuser', 'uses' => 'UserController@updateUserData']);
Route::post('/deleteuser/{id}',['as' => 'deleteuser', 'uses' => 'UserController@deleteUser']);
Route::post('/adduser',['as' => 'adduser', 'uses' => 'UserController@addUser']);

//Route for managing category
Route::get('/category', 'CategoryController@index')->name('category');
Route::get('/getcategory',['as' => 'getcategory', 'uses' => 'CategoryController@getAllCategories']);
Route::post('/addCategory',['as' => 'addcategory', 'uses' => 'CategoryController@addCategories']);
Route::get('/category/edit/{id}',['as' => 'editcategory', 'uses' => 'CategoryController@getAllCategories']);
Route::post('/updatecategory',['as' => 'updatecategory', 'uses' => 'CategoryController@updateCategory']);
Route::post('/deletecategory/{id}',['as' => 'deletecategory', 'uses' => 'CategoryController@deleteCategory']);

//Route for managing product
Route::get('/products', 'ProductController@index')->name('products');
Route::get('/getproducts',['as' => 'getproduct', 'uses' => 'ProductController@getAllProducts']);
Route::post('/addProduct',['as' => 'addproduct', 'uses' => 'ProductController@addProducts']);
Route::get('/product/edit/{id}',['as' => 'editproduct', 'uses' => 'ProductController@getAllProducts']);
Route::post('/updateproduct',['as' => 'updateproduct', 'uses' => 'ProductController@updateProduct']);
Route::post('/deleteproduct/{id}',['as' => 'deleteproduct', 'uses' => 'ProductController@deleteProduct']);
