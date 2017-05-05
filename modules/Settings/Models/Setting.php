<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class Setting extends Model
{
	protected $table = "settings";
	protected $primarykey = "id";
	public $timestamps = false;

	protected $fillable = [
		"setting_name", "setting_value"
	];

	public static function getData($record)
	{
		$value = DB::table('settings')->where('setting_name', $record)->first();
		return $value->setting_value;
	}

	public static function getUrlHome($record)
	{
		$setting = Self::getData($record);
		$url = url('/');
		$home = str_replace($url,"",$setting);

		return $home;
	}

	public static function getTheme($theme)
	{
		$setting = Self::getData($theme);
		return str_slug(title_case($setting), '-');
	}

}