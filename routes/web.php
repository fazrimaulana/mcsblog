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

use Modules\Settings\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Route::get('/', ['as' => 'frontend.index', 'uses'=>'FrontendController@index']);

Route::get(Setting::getUrlHome('site_url'), ['as' => 'frontend.index', 'uses'=>'FrontendController@index']);

Route::get(Setting::getUrlHome('site_url').'/read/{slug}', ['as' => 'frontend.read', 'uses' => 'FrontendController@single']);

Route::post(Setting::getUrlHome('site_url').'/read/{slug}', ['as' => 'frontend.read', 'uses' => 'FrontendController@comment'])->middleware('auth');

Route::get(Setting::getUrlHome('site_url').'/profile', ['as' => 'frontend.user', 'uses' => 'FrontendController@profile'])->middleware('auth');

Route::get(Setting::getUrlHome('site_url').'/account-setting', ['as' => 'frontend.user', 'uses' => 'FrontendController@accountSetting'])->middleware('auth');

Route::get(Setting::getUrlHome('site_url').'/about', ['as' => 'frontend.about', 'uses' => 'FrontendController@about']);

Route::get(Setting::getUrlHome('site_url').'/gallery', ['as' => 'frontend.gallery', 'uses' => 'FrontendController@gallery']);

Route::get(Setting::getUrlHome('site_url').'/gallery/download/{media}', ['as' => 'frontend.gallery.download', 'uses' => 'FrontendController@downloadGallery']);

Route::get(Setting::getUrlHome('site_url').'/contact', ['as' => 'frontend.contact', 'uses' => 'FrontendController@contact']);

Route::get(Setting::getUrlHome('site_url').'/category/{category}', ['as' => 'frontend.category', 'uses' => 'FrontendController@category']);

Route::get(Setting::getUrlHome('site_url').'/tag/{tag}', ['as' => 'frontend.tag', 'uses' => 'FrontendController@tag']);

Route::post(Setting::getUrlHome('site_url').'/newsletter', ['as' => 'frontend.newsletter', 'uses' => 'FrontendController@newsletter']);

Auth::routes();

Route::get(Setting::getUrlHome('home_url'), [ 'as' => 'dashboard.home', 'uses' => 'HomeController@index']);

Route::post('/logoutUser', function(Request $request){

		Auth::guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect(Setting::getUrlHome('site_url'));

});
