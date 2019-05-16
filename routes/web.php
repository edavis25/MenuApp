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

Route::get('/', function () {
//    return view('welcome');
});

Auth::routes();

Route::group([
    'as'     => 'admin.',
    'prefix' => 'admin'
], function() {
    /** Dashboard */
    Route::get('/', ['as' => 'dashboard', 'uses' => 'Admin\AdminDashboardController@index']);
    /** Menu Items */
    Route::resource('menu-item', 'Admin\MenuItemController')->except(['show']);
    /** Addon groups */
    Route::post('addon-group/{menu_item_id}/store', ['as' => 'addon-group.store', 'uses' => 'Admin\AddonGroupController@store']);
    Route::put('addon-group/{id}/update', ['as' => 'addon-group.update', 'uses' => 'Admin\AddonGroupController@update']);
    Route::delete('addon-group/{id}', ['as' => 'addon-group.destroy', 'uses' => 'Admin\AddonGroupController@destroy']);
    /** Addons */
    Route::post('addon/{addon_group_id}/store', ['as' => 'addon.store', 'uses' => 'Admin\AddonController@store']);
    Route::put('addon/{id}/update', ['as' => 'addon.update', 'uses' => 'Admin\AddonController@update']);
    Route::delete('addon/{id}', ['as' => 'addon.destroy', 'uses' => 'Admin\AddonController@destroy']);
    /** Categories */
    Route::resource('category', 'Admin\CategoryController')->except(['show']);
});

Route::group([
    'as'     => 'web.',
    'prefix' => 'web'
], function() {
    /** Shopping Cart */
    Route::get('cart', ['as' => 'cart.show', 'uses' => 'Web\ShoppingCartController@show']);
    Route::post('cart/add/{menu_item_id}', ['as' => 'cart.add', 'uses' => 'Web\ShoppingCartController@addToCart']);
    Route::post('cart/remove', ['as' => 'cart.remove', 'uses' => 'Web\ShoppingCartController@removeFromCart']);
    Route::post('cart/update', ['as' => 'cart.update', 'uses' => 'Web\ShoppingCartController@updateCart']);
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
