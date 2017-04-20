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

                    

Route::get(Modules\Settings\Models\Setting::getUrlHome('site_url'), function () {
    return view('welcome');
});

Auth::routes();

Route::get(Modules\Settings\Models\Setting::getUrlHome('home_url'), [ 'as' => 'home.dashboard', 'uses' => 'HomeController@index']);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::post('/logoutUser', function(Request $request){

		Auth::guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect(\Modules\Settings\Models\Setting::getUrlHome('site_url'));

});
