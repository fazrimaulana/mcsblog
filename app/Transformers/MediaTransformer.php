<?php

namespace App\Transformers;

use Modules\Media\Models\Media;
use League\Fractal\TransformerAbstract;

class MediaTransformer extends TransformerAbstract
{
	public function transform(Media $media)
	{
		return [
			'id'				=> $media->id,
			'author'			=>	[
										"id"	=> $media->user->id,
										"name" 	=> $media->user->name
									],
			'url'				=> url($media->url),
			'title'				=> $media->title,
			'caption'			=> $media->caption,
			'alt' 				=> $media->alt,
			'description' 		=> $media->description,
			'name'				=> $media->mediameta->name,
			'type' 				=> $media->mediameta->type,
			'size'				=> $media->mediameta->size,
			'dimension'			=> $media->mediameta->dimension,
			'created_at' 		=> $media->created_at->diffForHumans(),
			'updated_at' 		=> $media->updated_at->diffForHumans()
		];
	}
}