<?php

namespace Modules\Pages\Models;

use Illuminate\Database\Eloquent\Model;


class Tag extends Model
{
	protected $table = "tags";
	protected $primarykey = "id";

	protected $fillable = [
		"name", "slug", "description"
	];

	public function posts()
	{
		return $this->belongsToMany('Modules\Pages\Models\Post', 'posts_has_tags', 'tag_id', 'post_id')->withTimestamps();
	}

}