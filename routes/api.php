<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace'=>'Authntication'],function()
 {
 	
Route::post('register', 'rigisterController@register');
Route::post('login','loginController@login');
Route::middleware('auth:api')->post('logout','loginController@logout');

   });
Route::group(['namespace'=>'dashboard'],function()
 {
// blog category dashboard 
Route::get('dashboard/index/blogcategory', 'blogcategoryController@index');
Route::post('dashboard/create/blogcategory','blogcategoryController@store');
Route::post('dashboard/update/blogcategory/{id}','blogcategoryController@update');
Route::get('dashboard/delete/blogcategory/{id}','blogcategoryController@destroy');
//blog dashboard
Route::resource('dashboard/blog', 'blogController');
// food category dashboar
Route::get('dashboard/index/foodcategory', 'foodcategoryController@index');
Route::post('dashboard/create/foodcategory','foodcategoryController@store');
Route::post('dashboard/update/foodcategory/{id}','foodcategoryController@update');
Route::get('dashboard/delete/foodcategory/{id}','foodcategoryController@destroy');

//food dashboard
Route::resource('dashboard/food', 'foodController');
// user dashboard
Route::get('dashboard/index/user', 'userController@index');
Route::post('dashboard/create/user', 'userController@store');
Route::post('dashboard/update/user/{id}', 'userController@update');
Route::get('dashboard/delete/user/{id}','userController@destroy');

// doctor dashboard
Route::get('dashboard/index/doctor', 'doctorController@index');
Route::post('dashboard/create/doctor', 'doctorController@store');
Route::post('dashboard/update/doctor/{id}', 'doctorController@update');
Route::get('dashboard/delete/doctor/{id}','doctorController@destroy');



   });



Route::group(['namespace'=>'blog'],function()
 {

Route::get('category/blog', 'categortController@index');
Route::get('blog', 'blogController@index');

  });

Route::group(['namespace'=>'food'],function()
 {

Route::get('category/food', 'categoryController@index');
 Route::get('food', 'foodController@index');
  });

Route::group(['namespace'=>'community'],function()
 {

Route::get('post', 'postController@index');
Route::post('post', 'postController@create');
Route::get('post/{id}', 'postController@destroy');
Route::get('comment', 'commentController@index');
Route::post('comment/{post_id}', 'commentController@create');
Route::get('comment/{id}', 'commentController@destroy');
  });


Route::get('profile', 'profileController@index');
Route::post('profile', 'profileController@create');

Route::group(['namespace'=>'doctors'],function()
 {

Route::get('doctor/profile/{id}', 'doctorController@show');
Route::get('doctors', 'doctorController@index');
  });

Route::get('chat', 'chatController@index');
Route::post('chat/{doctor_id}', 'chatController@create');