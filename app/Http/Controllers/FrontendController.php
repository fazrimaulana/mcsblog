<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Modules\Posts\Models\Post;
use Modules\Settings\Models\Setting;

class FrontendController extends Controller
{
    public function index()
    {
		$posts 		= Post::where('type', 'post')->where('visible', 'public')->orderBy('id', 'DESC')->withCount('comments')->paginate(3);
        $tagline  = Setting::where('setting_name', 'tagline')->first();
    	
    	return view('welcome', [
    		"posts"      => $posts,
            "tagline"    => $tagline
    	]);
    }

    public function single(Request $request)
    {
        $post = Post::where('slug', $request->slug)->withCount('comments')->first();
        return view('single', [
                "post" => $post
            ]);
    }

}
