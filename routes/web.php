<?php

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

Route::get('/', 'ShoppingListController@index');

Route::get('/my_list', 'ShoppingListController@showList');

Route::resource('lists', 'CRUDController');
//Route::get('/lists/{user}','CRUDController@index');

Route::get('/lists/{list}/add_item', 'CRUDController@addItem');

Route::post('/lists/{list}', 'CRUDController@storeItem');

Route::get('/lists/{list}/edit_item/{item}', 'CRUDController@editItem');

Route::put('/lists/{list}/{item}', 'CRUDController@updateItem');

Route::delete('lists/{list}/{item}','CRUDController@destroyItem');

// Route::get('/add', function () {
//     return view('test2');
// });
// Route::post('/add/product',array('uses'=>'ShoppingListController@postProducts'));


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
