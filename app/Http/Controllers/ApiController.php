<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Modules\Posts\Models\Post;
use App\Transformers\PostTransformer;
use App\Transformers\MediaTransformer;
use App\Transformers\CommentTransformer;

use Auth;
use App\User;
use App\Transformers\UserTransformer;
use Modules\Media\Models\Media;
use Modules\Comments\Models\Comment;

class ApiController extends Controller
{

	public function login(Request $request, User $user)
	{
		if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

			return response()->json(['error' => 'Your credential is wrong'], 401);

		}

		$data = $user->find(Auth::user()->id);

		return fractal()->item($data)->transformWith(new UserTransformer)->addMeta(['api_token' => $data->api_token])->toArray();

	}

    public function posts(User $user, Request $request)
    {	
    	$user = User::find(Auth::user()->id);

    	if ($user) {
            if ($request->id) {
                $posts = Post::where('id', $request->id)->where('type', 'post')->get();
            }
            else
            {
                $posts = Post::where('type', 'post')->get();
            }
    		return fractal()->collection($posts)->transformWith(new PostTransformer)->toArray();
    	}
    	else
    	{
    		return response()->json(['error' => 'Your credential is wrong'], 401);
    	}
    }

    public function medias(User $user, Request $request)
    {   
        $user = User::find(Auth::user()->id);

        if ($user) {
            if ($request->id) {
                $medias = Media::where('id', $request->id)->get();
            }
            else
            {
                $medias = Media::all();
            }
            return fractal()->collection($medias)->transformWith(new MediaTransformer)->toArray();    
        }
        else
        {
            return response()->json(['error' => 'Your credential is wrong'], 401);
        }
    }

    public function comments(User $user, Request $request)
    {   
        $user = User::find(Auth::user()->id);

        if ($user) {
            if ($request->id) {
                $comments = Comment::where('id', $request->id)->get();
            }
            else
            {
                $comments = Comment::all();
            }
            return fractal()->collection($comments)->transformWith(new CommentTransformer)->toArray();    
        }
        else
        {
            return response()->json(['error' => 'Your credential is wrong'], 401);
        }
    }

}
