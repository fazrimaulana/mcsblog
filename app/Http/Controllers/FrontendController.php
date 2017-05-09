<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Modules\Posts\Models\Post;
use Modules\Settings\Models\Setting;
use Modules\Comments\Models\Comment;
use Modules\Media\Models\Media;
use Modules\Role\Models\Role;
use Auth;
use Modules\Appearance\Models\Frontpage;
use Modules\Posts\Models\Category;
use Modules\Posts\Models\Tag;
use App\Newsletter;

class FrontendController extends Controller
{
    public function index()
    {
		$posts 		= Post::where('type', 'post')->where('visible', 'public')->orderBy('id', 'DESC')->withCount('comments')->paginate(3);
        $tagline  = Setting::where('setting_name', 'tagline')->first();
    	return view('Frontend.'.Setting::getTheme('theme').'.welcome', [
    		"posts"      => $posts,
            "tagline"    => $tagline
    	]);
    }

    public function single(Request $request)
    {
        $post = Post::where('slug', $request->slug)->withCount('comments')->first();
        $post->update([
                "view_count" => $post->view_count+1
            ]);
        $comments = $post->comments()->where('parent_id', null)->get();

        return view('Frontend.'.Setting::getTheme('theme').'.single', [
                "post" => $post,
                "comments" => $comments
            ]);
    }

    public function comment(Request $request)
    {
        $this->validate($request, [
                "content" => "required"
            ]);

        if ($request->id) {
            Comment::create([
                "post_id" => $request->id,
                "author"  => Auth::user()->id,
                "content" => $request->content
            ]);   
        }
        else
        {
            $comment = Comment::find($request->id_comment);

            if ($comment->parent_id==null) {
                $parent = $comment->id;
            }
            else
            {
                $parent = $comment->parent_id;
            }

            Comment::create([
                "post_id" => $comment->post_id,
                "author"  => Auth::user()->id,
                "parent_id" => $parent,
                "content" => $request->content
            ]);
        }

        return redirect()->back();
    }

    public function profile()
    {
        return view('Frontend.'.Setting::getTheme('theme').'.profile',[
                "user" => Auth::user()
            ]);
    }

    public function about()
    {
        $about = Frontpage::where('name', 'about')->first();
        return view('Frontend.'.Setting::getTheme('theme').'.about', [
                "about" => $about
            ]);
    }

    public function gallery()
    {
        $medias = Media::where('status', 'public')->get();
        return view('Frontend.'.Setting::getTheme('theme').'.gallery',[
                "medias" => $medias
            ]);
    }

    public function downloadGallery(Media $media)
    {
        return response()->download($media->url);
    }

    public function contact()
    {
        $contact = Frontpage::where('name', 'contact')->first();
        return view('Frontend.'.Setting::getTheme('theme').'.contact', [
                "contact" => $contact
            ]);
    }

    public function accountSetting()
    {
        $roles = Role::all();
        return view('Frontend.'.Setting::getTheme('theme').'.account-setting',[
                "roles" => $roles
            ]);
    }

    public function category(Request $request)
    {
        $category   = Category::where('slug', $request->category)->first();  
        $posts      = $category->posts()->where('type', 'post')->where('visible', 'public')->orderBy('id', 'DESC')->withCount('comments')->paginate(3);
        $tagline    = Setting::where('setting_name', 'tagline')->first();
        
        return view('Frontend.'.Setting::getTheme('theme').'.filter', [
            "posts"      => $posts,
            "tagline"    => $tagline,
            "filter"     => $request->category
        ]);
    }

    public function tag(Request $request)
    {
        $tag   = Tag::where('slug', $request->tag)->first();  
        $posts      = $tag->posts()->where('type', 'post')->where('visible', 'public')->orderBy('id', 'DESC')->withCount('comments')->paginate(3);
        $tagline  = Setting::where('setting_name', 'tagline')->first();
        
        return view('Frontend.'.Setting::getTheme('theme').'.filter', [
            "posts"      => $posts,
            "tagline"    => $tagline,
            "filter"     => $request->tag
        ]);
    }

    public function newsletter(Request $request)
    {
        Newsletter::create([
                "email" => $request->email
            ]);
        return redirect()->back();
    }

}
