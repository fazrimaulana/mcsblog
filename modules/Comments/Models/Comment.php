<?php

namespace Modules\Comments\Models;

use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
	protected $table = "comments";
	protected $primarykey = "id";

	protected $fillable = [
		"post_id", "author", "ip_address", "parent_id", "content", "status"
	];

	public function post()
	{
		return $this->belongsTo('Modules\Posts\Models\Post', 'post_id', 'id');
	}

	public function user()
	{
		return $this->belongsTo('App\User', 'author', 'id');
	}

}