<?php

namespace App\Transformers;

use Modules\Posts\Models\Post;
use League\Fractal\TransformerAbstract;
use App\Helpers\Tanggal;


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
			'post_ex'			=> substr($post->content, 0, 120),
			'published_at' 		=> $post->published_at,
			'format_date'		=> Tanggal::TanggalBulan($post->published_at),
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