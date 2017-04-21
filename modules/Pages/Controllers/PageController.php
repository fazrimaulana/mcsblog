<?php

namespace Modules\Pages\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use File;

use Modules\Pages\Models\Category;
use Modules\Pages\Models\Tag;
use Modules\Pages\Models\Post;
use App\User;
use Modules\Media\Models\Media;

use Illuminate\Validation\Rule;

class PageController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$method_permission = "can_see_pages";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$posts = Post::where('type', 'page')->withCount('comments')->paginate(15);
			$postCount = Post::where('type', 'page')->get();
			$categories = Category::all();
			$users = User::all();

            return view('Pages::index',[
            		"posts" => $posts,
            		"postCount" => $postCount,
            		"categories" => $categories,
            		"users" => $users
            	]);

        }else{
            return view('404');
        }
	}

	public function add()
	{
		$method_permission = "can_add_pages";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$categories = Category::all();
			$tags = Tag::pluck('name');
			$parentCategories = Category::where('parent', 0)->get();
			$medias = Media::all();
            return view('Pages::add',[
            		"categories" => $categories,
            		"tags" => $tags,
            		"parentCategories" => $parentCategories,
            		"medias" => $medias
            	]);

        }else{
            return view('404');
        }
	}

	public function store(Request $request)
	{
		$method_permission = "can_add_posts";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$this->validate($request,[
					"title" => "required|unique:posts,title",
					"content" => "required",
					"published_at" => "required|date:date_format(YYYY-MM-DD hh:mm:ss)",
					"status" => "required",
					"visible" => "required",
					"status_comment" => "required"
				]);

			if ($request->file('image')!= null):
            	$upload_dir = "uploads";
            	$namafile   = date("YmdHis")."-".str_slug(pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME), '-');
            	$MimeType   = $request->file('image')->getMimeType();
            	/*$file       = $request->file('image');*/
            	$extension  = explode("/", $MimeType)['1'];
            	$fullname   = $upload_dir . "/" . $namafile . "." . $extension;
            	File::makeDirectory($upload_dir, $mode = 0777, true, true);
            	$request->file('image')->move($upload_dir, $fullname);
        	else:
	            $fullname   = null;
        	endif;

        	$post = new Post;
        	$post->author = Auth::user()->id;
        	$post->title  = $request->title;
        	$post->slug   = str_slug($request->title, '-');
        	$post->content = $request->content;
        	$post->published_at = $request->published_at;
        	$post->type = "page";
        	$post->status = $request->status;
        	$post->visible = $request->visible;
        	$post->status_comment = $request->status_comment;
        	$post->image = $fullname;

        	$post->save(); 

			if ($request->categories!="") {
				$post->categories()->attach($request->categories);
			}
			else
			{
				$post->categories()->attach(["1"]);
			}

			if ($request->tags!="") {

				foreach ($request->tags as $key => $value) {
					$dataTag = Tag::where('name', $value)->first();
					if ($dataTag==null) {

						$tag = new Tag;
						$tag->name = $value;
						$tag->slug = str_slug($value, '-');
						$tag->description = null;

						$tag->save();

						$tagId[] = $tag->id;
					}
					else
					{
						$tagId[] = $dataTag->id;
					}
				}

				$post->tags()->attach($tagId);

			}
			else
			{
				$post->tags()->attach(["1"]);
			}

			return redirect('/dashboard/pages');


        }else{
            return view('404');
        }
	}

	public function getData(Request $request, Post $post)
	{
		$method_permission = "can_edit_pages";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$categories = Category::all();
			$tags = Tag::all();
			$parentCategories = Category::where('parent', 0)->get();
			$medias = Media::all();
			return view('Pages::edit',[
					"post" => $post,
					"categories" => $categories,
					"tags" => $tags,
					"parentCategories" => $parentCategories,
					"medias" => $medias
				]);

        }else{
            return view('404');
        }
	}

	public function update(Post $post, Request $request)
	{
		$method_permission = "can_edit_pages";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$this->validate($request,[
					"title" => ["required", Rule::unique('posts')->ignore($post->id)],
					"content" => "required",
					"published_at" => "required|date:date_format(YYYY-MM-DD hh:mm:ss)",
					"status" => "required",
					"visible" => "required",
					"status_comment" => "required"
				]);

			if ($request->file('image')!= null):

				File::delete($post->image);				

            	$upload_dir = "uploads";
            	$namafile   = date("YmdHis")."-".str_slug(pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME), '-');
            	$MimeType   = $request->file('image')->getMimeType();
            	/*$file       = $request->file('image');*/
            	$extension  = explode("/", $MimeType)['1'];
            	$fullname   = $upload_dir . "/" . $namafile . "." . $extension;
            	File::makeDirectory($upload_dir, $mode = 0777, true, true);
            	$request->file('image')->move($upload_dir, $fullname);

        	else:
	            $fullname   = $post->image;
        	endif;

        	$post->author = Auth::user()->id;
        	$post->title  = $request->title;
        	$post->slug   = str_slug($request->title, '-');
        	$post->content = $request->content;
        	$post->published_at = $request->published_at;
        	$post->type = "page";
        	$post->status = $request->status;
        	$post->visible = $request->visible;
        	$post->status_comment = $request->status_comment;
        	$post->image = $fullname;

        	$post->save(); 

			if ($request->categories!="") {
				$post->categories()->sync($request->categories);
			}
			else
			{
				$post->categories()->sync(["1"]);
			}

			if ($request->tags!="") {

				foreach ($request->tags as $key => $value) {
					$dataTag = Tag::where('name', $value)->first();
					if ($dataTag==null) {

						$tag = new Tag;
						$tag->name = $value;
						$tag->slug = str_slug($value, '-');
						$tag->description = null;

						$tag->save();

						$tagId[] = $tag->id;
					}
					else
					{
						$tagId[] = $dataTag->id;
					}
				}

				$post->tags()->sync($tagId);

			}
			else
			{
				$post->tags()->sync(["1"]);
			}

			return redirect('/dashboard/pages');

        }else{
            return view('404');
        }
	}

	public function delete(Request $request)
	{

		$method_permission = "can_delete_pages";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$post = Post::find($request->id);

			File::delete($post->image);

			$post->delete();

			return redirect('/dashboard/pages');


        }else{
            return view('404');
        }

	}

	public function changeTrash(Request $request, Post $post)
	{
		$method_permission = "can_edit_pages";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$post->update([
					"status" => "trash"
				]);

			return redirect('/dashboard/pages');

        }else{
            return view('404');
        }
	}

	public function status(Request $request)
	{
		$method_permission = "can_see_pages";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$posts = Post::where('status', $request->segment(3))->where('type', 'page')->paginate(15);
			$postCount = Post::where('type', 'page')->get();
			$categories = Category::all();
			$users = User::all();
            return view('Pages::index',[
            		"posts" => $posts,
            		"postCount" => $postCount,
            		"categories" =>$categories,
            		"users" => $users
            	]);

        }else{
            return view('404');
        }
	}

	public function search(Request $request)
	{
		$method_permission = "can_see_pages";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

				$posts = Post::where('title', 'like', '%'. $request->search .'%')->where('type', 'page')->paginate(15);
				$postCount = Post::where('type', 'page')->get();
				$categories = Category::all();
				$users = User::all();
            	return view('Pages::index',[
            		"posts" => $posts,
            		"postCount" => $postCount,
            		"categories" =>$categories,
            		"users" => $users
            	]);

        }else{
            return view('404');
        }
	}

	public function filter(Request $request)
	{
		$method_permission = "can_see_pages";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			if ($request->month!=null && $request->category!=null && $request->user!=null) {

				$posts = Post::whereHas('categories', function($query) use ($request){
					$query->where('category_id', $request->category);
				})->has('user', $request->user)->whereMonth('created_at', '=', $request->month)->where('type', 'page')->paginate(15);

			}
			elseif ($request->month==null && $request->category!=null && $request->user!=null) {

				$posts = Post::whereHas('categories', function($query) use ($request){
					$query->where('category_id', $request->category);
				})->has('user', $request->user)->where('type', 'page')->paginate(15);

			}
			elseif ($request->month!=null && $request->category==null && $request->user!=null) {

				$posts = Post::has('user', $request->user)->whereMonth('created_at', '=', $request->month)->where('type', 'page')->paginate(15);

			}
			elseif ($request->month!=null && $request->category!=null && $request->user==null) {

				$posts = Post::whereHas('categories', function($query) use ($request){
					$query->where('category_id', $request->category);
				})->whereMonth('created_at', '=', $request->month)->where('type', 'page')->paginate(15);

			}
			elseif($request->month!=null && $request->category==null && $request->user==null){

				$posts = Post::whereMonth('created_at', '=', $request->month)->where('type', 'page')->paginate(15);

			}
			elseif ($request->month==null && $request->category!=null && $request->user==null) {
				
				$posts = Post::whereHas('categories', function($query) use ($request){
					$query->where('category_id', $request->category);
				})->where('type', 'page')->paginate(15);

			}
			elseif ($request->month==null && $request->category==null && $request->user!=null) {
				
				$posts = Post::has('user', $request->user)->where('type', 'page')->paginate(15);

			}
			else
			{

				$posts = Post::where('type', 'page')->paginate(15);

			}

			$postCount = Post::where('type', 'page')->get();
			$categories = Category::all();
			$users = User::all();
            return view('Pages::index',[
            	"posts" => $posts,
            	"postCount" => $postCount,
            	"categories" =>$categories,
            	"users" => $users
            ]);


        }else{
            return view('404');
        }
	}

	public function moveTrash(Request $request)
	{

		$method_permission = "can_edit_pages";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

				if ($request->ajax()) {
					if($request->idpost!=null)
					{
						foreach ($request->idpost as $key => $value) {
						Post::find($value)->update([
							"status" => "trash"
						]);
					}	
					return $request->all();
					}
					else
					{
						return null;
					}
				}
				else
				{
					return view('404');
				}
        }else{
            return view('404');
        }

	}

	public function delete_trash(Request $request)
	{
		$method_permission = "can_edit_pages";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

				if ($request->ajax()) {
					if($request->idpost!=null)
					{
						foreach ($request->idpost as $key => $value) {
						Post::find($value)->delete();
					}	
					return $request->all();
					}
					else
					{
						return null;
					}
				}
				else
				{
					return view('404');
				}
        }else{
            return view('404');
        }
	}

	public function detail(Post $post)
	{
		$method_permission = "can_see_pages";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$categories = Category::all();
			$tags = Tag::pluck('name');
			return view('Pages::detail',[
					"post" => $post,
					"categories" => $categories,
					"tags" => $tags
				]);

        }else{
            return view('404');
        }
	}

}