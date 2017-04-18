<?php

namespace Modules\Media\Models;

use Illuminate\Database\Eloquent\Model;


class Mediameta extends Model
{
	protected $table = "mediameta";
	protected $primarykey = "id";

	protected $fillable = [
		"media_id", "name", "type", "size", "dimension"
	];

}