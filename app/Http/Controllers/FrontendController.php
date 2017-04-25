<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Modules\Settings\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Modules\Posts\Models\Post;
use Modules\Posts\Models\Category;
use Modules\Posts\Models\Tag;

class FrontendController extends Controller
{
    public function index()
    {
    	$tagline 	= Setting::where('setting_name', 'tagline')->first();
		$posts 		= Post::where('type', 'post')->orderBy('id', 'DESC')->withCount('comments')->paginate(3);
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
    }
}
