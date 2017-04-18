<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;


class Usermeta extends Model
{
	protected $table = "usermeta";
	protected $primarykey = "id";

	protected $fillable = [
		"user_id", "display_name", "description", "role_id", "image"
	];

	public function user()
	{
		return $this->belongsTo('App\User', 'user_id', 'id');
	}

	public function role()
	{
		return $this->belongsTo('Modules\Role\Models\Role', 'role_id', 'id');
	}

}