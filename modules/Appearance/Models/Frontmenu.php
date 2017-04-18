<?php

namespace Modules\Appearance\Models;

use Illuminate\Database\Eloquent\Model;

/**
* 
*/
class Frontmenu extends Model
{
	protected $table = "frontmenus";
	protected $primarykey = "id";

	protected $fillable = [
		"menu_id", "parent_id", "page_id", "name", "href", "target", "title", "icon", "module", "permission", "sequence"
	];

	public function page()
	{
		return $this->belongsTo('Modules\Posts\Models\Post', 'page_id', 'id');
	}

}