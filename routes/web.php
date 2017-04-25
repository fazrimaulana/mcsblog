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
use Modules\Posts\Models\Post;
use Modules\Posts\Models\Category;
use Modules\Posts\Models\Tag;

Route::get(Setting::getUrlHome('site_url'), function () {
	$tagline 	= Setting::where('setting_name', 'tagline')->first();
	$posts 		= Post::where('type', 'post')->orderBy('id', 'DESC')->withCount('comments')->get();
    $categories = Category::all();
    $tags       = Tag::all();
    $popular_posts = Post::where('type', 'post')->orderBy('view_count', 'desc')->paginate(3);
    $recent_posts = Post::where('type', 'post')->orderBy('published_at', 'desc')->paginate(3);
    return view('welcome', [
    		"tagline"    => $tagline,
    		"posts"      => $posts,
            "categories" => $categories,
            "tags"       => $tags,
            "popular_posts" => $popular_posts,
            "recent_posts" => $recent_posts
    	]);
});

Auth::routes();

Route::get(Setting::getUrlHome('home_url'), [ 'as' => 'dashboard.home', 'uses' => 'HomeController@index']);

Route::post('/logoutUser', function(Request $request){

		Auth::guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect(Setting::getUrlHome('site_url'));

});
