<?php

namespace App\Transformers;

use Modules\Comments\Models\Comment;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{
	public function transform(Comment $comment)
	{
		return [
			'id'				=> $comment->id,
			'post'				=> 	[
										"id"	=> $comment->post->id,
										"title"	=> $comment->post->title
									],
			'author'			=>	[
										"id" 	=> $comment->user->id,
										"name" 	=> $comment->user->name
									],
			'ip_address'		=> $comment->ip_address,
			'parent_id'			=> $comment->parent_id,
			'content'			=> $comment->content,
			'status'			=> $comment->status,
			'created_at' 		=> $comment->created_at->diffForHumans(),
			'updated_at' 		=> $comment->updated_at->diffForHumans()
		];
	}
}