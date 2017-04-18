<?php

namespace Modules\Pages\Models;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
	protected $table = "categories";
	protected $primarykey = "id";

	protected $fillable = [
		"name", "slug", "parent", "description"
	];

	public function posts()
	{
		return $this->belongsToMany('Modules\Pages\Models\Post', 'posts_has_categories', 'category_id', 'post_id')->withTimestamps();
	}

}