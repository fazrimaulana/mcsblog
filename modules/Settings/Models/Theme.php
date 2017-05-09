<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
	protected $table = "themes";
	protected $primarykey = "id";
	public $timestamps = false;

	protected $fillable = [
		"name", "image"
	];
}