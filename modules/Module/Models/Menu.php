<?php

namespace Modules\Module\Models;

use Illuminate\Database\Eloquent\Model;


class Menu extends Model
{
	protected $table = "menus";
	protected $primarykey = "id";

	protected $fillable = [
		"menu_id", "parent_id", "name", "href", "target", "title", "icon", "module", "permission", "sequence"
	];

}