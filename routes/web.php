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

Route::get(Setting::getUrlHome('site_url'), 'FrontendController@index');

Auth::routes();

Route::get(Setting::getUrlHome('home_url'), [ 'as' => 'dashboard.home', 'uses' => 'HomeController@index']);

Route::post('/logoutUser', function(Request $request){

		Auth::guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect(Setting::getUrlHome('site_url'));

});
