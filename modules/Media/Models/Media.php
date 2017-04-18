<?php

namespace Modules\Media\Models;

use Illuminate\Database\Eloquent\Model;


class Media extends Model
{
	protected $table = "media";
	protected $primarykey = "id";

	protected $fillable = [
		"user_id", "url", "title", "caption", "alt", "description"
	];

	public function mediameta()
	{
		return $this->hasOne('Modules\Media\Models\Mediameta', 'media_id', 'id');
	}

	public function user()
	{
		return $this->belongsTo('App\User', 'user_id', 'id');
	}

}