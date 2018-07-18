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
// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home',function(){
// 	return view('home.index');	
// });
Route::get('user/login', 'Auth\LoginController@showLoginForm')->name('user.login');
 Route::post('user/login', 'Auth\LoginController@login');
        Route::post('user/logout', 'Auth\LoginController@logout')->name('user.logout');

        // Registration Routes...
        Route::get('user/register', 'Auth\RegisterController@showRegistrationForm')->name('user.register');
        Route::post('user/register', 'Auth\RegisterController@register');

        // Password Reset Routes...
        // Route::get('user/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        // Route::post('user/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        // Route::get('user/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        // Route::post('user/password/reset', 'Auth\ResetPasswordController@reset');
        //
        Route::middleware('admin.auth')->group(function(){
        	
        });
        Route::get('admin/login', 'AuthAdmin\LoginController@showLoginForm')->name('admin.login');
 		Route::post('admin/login', 'AuthAdmin\LoginController@login');
        Route::post('admin/logout', 'AuthAdmin\LoginController@logout')->name('admin.logout');

        // Registration Routes...
        Route::get('admin/register', 'AuthAdmin\RegisterController@showRegistrationForm')->name('admin.register');
        Route::post('admin/register', 'AuthAdmin\RegisterController@register')->name('singin');
 
Route::prefix('admin')->group(function () {
	Route::get('/',function(){
        		return view('home.index');
    })->name('admin.home');
	Route::get('/product','product\ProductController@index');
	Route::get('/listproduct','product\ProductController@datatableListProduct')->name('listproduct');
	Route::prefix('color')->group(function () {
		Route::get('/','Color\ColorController@index');
		Route::get('/listcolor','Color\ColorController@datatableListColor')->name('listcolor');	
		Route::post('/post','Color\ColorController@store')->name('post.color');
		Route::delete('/delete/{id}','Color\ColorController@delete')->name('color.delete');
	});
	Route::prefix('size')->group(function () {
		Route::get('/','Size\SizeController@index');
		Route::get('/listsize','Size\SizeController@datatableListSize')->name('listsize');	
		Route::post('/post','Size\SizeController@store')->name('post.size');
		Route::delete('/delete/{id}','Size\SizeController@delete')->name('size.delete');
	});
	Route::prefix('provider')->group(function () {
		Route::get('/','Provider\ProviderController@index');
		Route::get('/listprovider','Provider\ProviderController@datatableListProvider')->name('listprovider');	
		Route::post('/post','Provider\ProviderController@store')->name('post.provider');
		Route::delete('/delete/{id}','Provider\ProviderController@delete')->name('provider.delete');
	});
	Route::prefix('kind')->group(function () {
		Route::get('/','Kind\KindController@index');
		Route::get('/listkind','Kind\KindController@datatableListKind')->name('listkind');	
		Route::post('/post','Kind\KindController@store')->name('post.kind');
		Route::delete('/delete/{id}','Kind\KindController@delete')->name('kind.delete');
	});
	Route::prefix('product')->group(function () {
		Route::get('/','Product\ProductController@index')->name('product.index');
		Route::get('/listproduct','Product\ProductController@datatableListProduct')->name('listproduct');	
		Route::post('/post','Product\ProductController@store')->name('post.product');
		Route::delete('/delete/{id}','Product\ProductController@delete')->name('product.delete');
	});
	Route::get('abc',function(){
		return view('auth.index');
	});
 });
Route::get('cart',function(){
		return view('shop.cart');
	});

Route::get('/','Shop\HomeController@index');
Route::get('{slug}', 'Shop\HomeController@detail');
Route::post('/cart/{id}','Shop\ShoppingCart@cart')->name('cart');
// Route::get('/home', 'HomeController@index')->name('home');

