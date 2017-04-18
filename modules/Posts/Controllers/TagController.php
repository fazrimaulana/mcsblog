<?php

namespace Modules\Posts\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use Modules\Posts\Models\Tag;
use Modules\Posts\Models\Post;

class TagController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$method_permission = "can_see_tags";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$tags = Tag::withCount('posts')->get();
            return view('Posts::tags.index',[
            		"tags" => $tags
            	]);

        }else{
            return view('404');
        }
	}

	public function store(Request $request)
	{
		$method_permission = "can_add_tags";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$this->validate($request,[
					"name" => "required"
				]);

			Tag::create([
					"name" => $request->name,
					"slug" => str_slug($request->name, '-'),
					"description" => $request->description
				]);

			return redirect()->back();

        }else{
            return view('404');
        }
	}

	public function getData(Request $request, Tag $tag)
	{
		$method_permission = "can_edit_tags";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			if ($request->ajax()) {
				return response()->json($tag);
			}
			else
			{
				return view('404');
			}

        }else{
            return view('404');
        }
	}

	public function update(Request $request)
	{
		$method_permission = "can_edit_tags";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$this->validate($request, [
					"name" => "required"
				]);

			Tag::find($request->id)->update([
					"name" => $request->name,
					"slug" => str_slug($request->name, '-'),
					"description" => $request->description
				]);

			return redirect()->back();

        }else{
            return view('404');
        }
	}

	public function delete(Request $request)
	{
		$method_permission = "can_delete_tags";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$none = Tag::where('name', 'none')->first();

			$posts = Post::whereHas('tags', function($query) use ($request){
					$query->where('tag_id', $request->id);
				})->withCount('tags')->get();

			foreach ($posts as $key => $value) {
				if ($value->tags_count-1 <= 0) {
					if ($none!=null) {
						Post::find($value->id)->tags()->sync([$none->id]);
					}
				}
			}

			Tag::find($request->id)->delete();

			return redirect()->back();

        }else{
            return view('404');
        }
	}

	public function delete_check(Request $request)
	{
		$method_permission = "can_delete_tags";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			if ($request->ajax()) {
					
				$none = Tag::where('name', 'none')->first();

				if($request->idtag!=null)
				{	
					
					$posts = Post::whereHas('tags', function($query) use ($request){
							$query->whereIn('tag_id', $request->idtag);
						})->withCount('tags')->get();

					foreach ($posts as $key => $value) {
						$min = $value->tags_count - count($request->idtag);
						if ( $min <= 0) {
							if ($none!=null) {
								Post::find($value->id)->tags()->sync([$none->id]);	
							}
						}
					}

					foreach ($request->idtag as $key => $value) {

						Tag::find($value)->delete();
					
					}

				}
			}

        }else{
            return view('404');
        }
	}

	public function detail(Tag $tag)
	{
		$method_permission = "can_see_tags";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			return view('Posts::tags.detail', [
					"tag" => $tag
				]);

        }else{
            return view('404');
        }
	}

}