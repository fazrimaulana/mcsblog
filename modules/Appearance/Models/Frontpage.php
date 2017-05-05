<?php

namespace Modules\Appearance\Models;

use Illuminate\Database\Eloquent\Model;

/**
* 
*/
class Frontpage extends Model
{
	protected $table = "frontpage";
	protected $primarykey = "id";

	protected $fillable = [
		"name", "content"
	];

}