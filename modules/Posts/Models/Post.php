<?php

namespace Modules\Posts\Models;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
	protected $table = "posts";
	protected $primarykey = "id";

	protected $fillable = [
		"author", "title", "slug", "content", "published_at", "type", "status", "visible", "status_comment", "image"
	];

	public function user()
	{
		return $this->belongsTo('App\User', 'author', 'id');
	}

	public function categories()
	{
		return $this->belongsToMany('Modules\Posts\Models\Category', 'posts_has_categories', 'post_id', 'category_id')->withTimestamps();
	}

	public function tags()
	{
		return $this->belongsToMany('Modules\Posts\Models\Tag', 'posts_has_tags', 'post_id', 'tag_id')->withTimestamps();
	}

	public function comments()
	{
		return $this->hasMany('Modules\Comments\Models\Comment', 'post_id', 'id');
	}

}