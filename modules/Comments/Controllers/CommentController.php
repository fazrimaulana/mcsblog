<?php

namespace Modules\Comments\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Comments\Models\Comment;

use Auth;

class CommentController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$method_permission = "can_see_comments";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$comments = Comment::all();
			$commentCount = Comment::all();
			return view('Comments::index',[
				"comments" => $comments,
				"commentCount" => $commentCount
			]);

        }else{
            return view('404');
        }
	}

	public function status(Request $request)
	{
		$method_permission = "can_see_comments";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$comments = Comment::where('status', $request->segment(3))->get();
			$commentCount = Comment::all();
			return view('Comments::index',[
				"comments" => $comments,
				"commentCount" => $commentCount
			]);

        }else{
            return view('404');
        }
	}

	public function search(Request $request)
	{
		$method_permission = "can_see_comments";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$comments = Comment::whereHas('user', function($query) use ($request){
				$query->where('name', 'like', '%'. $request->search .'%');
			})->orWhere('content', 'like', '%'.$request->search.'%')->get();
			$commentCount = Comment::all();
			return view('Comments::index',[
				"comments" => $comments,
				"commentCount" => $commentCount
			]);

        }else{
            return view('404');
        }
	}

	public function apply(Request $request)
	{
		$method_permission = "can_edit_comments";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			if ($request->ajax()) {
				
				if ($request->idcomments!=null) {
					
					Comment::whereIn('id', $request->idcomments)->update([
							"status" => $request->command
						]);

				}

			}

        }else{
            return view('404');
        }
	}

	public function changeStatus(Request $request, Comment $comment)
	{
		$method_permission = "can_edit_comments";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$comment->update([
					"status" => $request->segment(5)
				]);

			return redirect()->back();

        }else{
            return view('404');
        }
	}

	public function reply(Request $request)
	{
		$method_permission = "can_reply_comments";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$this->validate($request, [
					"content" => "required"
				]);

			$commentParent = Comment::find($request->id);

			Comment::create([	
					"post_id" => $commentParent->post_id,
					"author"  => Auth::user()->id,
					"ip_address" => null,
					"parent_id" => $request->id,
					"content" => $request->content,
					"status" => "pending"
				]);

			return redirect()->back();

        }else{
            return view('404');
        }
	}

	public function update(Request $request)
	{
		$method_permission = "can_edit_comments";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$this->validate($request, [
					"content" => "required"
				]);

			Comment::find($request->id)->update([
					"content" => $request->content
				]);

			return redirect()->back();

        }else{
            return view('404');
        }
	}

}