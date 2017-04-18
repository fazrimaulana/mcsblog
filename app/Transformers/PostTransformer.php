<?php

namespace App\Transformers;

use Modules\Posts\Models\Post;
use League\Fractal\TransformerAbstract;


/**
* 
*/
class PostTransformer extends TransformerAbstract
{
	public function transform(Post $post)
	{
		return [
			'id'				=> $post->id,
			'author' 			=>	[	
										"id"	=> $post->user->id,
										"name"	=> $post->user->name
									],
			'title'  			=> $post->title,
			'slug'   			=> $post->slug,
			'content' 			=> $post->content,
			'published_at' 		=> $post->published_at,
			'type' 				=> $post->type,
			'status' 			=> $post->status,
			'visible' 			=> $post->visible,
			'status_comment'	=> $post->status_comment,
			'image' 			=> $post->image,
			'created_at' 		=> $post->created_at->diffForHumans(),
			'updated_at' 		=> $post->updated_at->diffForHumans()
		];
	}
}