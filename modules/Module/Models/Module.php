<?php

namespace Modules\Module\Models;

use Illuminate\Database\Eloquent\Model;


class Module extends Model
{
	protected $table = "modules";
	protected $primarykey = "id";

	protected $fillable = [
		"name", "description", "keyword", "version", "author", "web", "repository", "sequence", "license", "module", "status"
	];

}