<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;

use DB;
use Modules\Settings\Models\Theme;

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
		$nameTheme = Theme::find($setting);
		return title_case(str_slug($nameTheme->name, '-'));
	}

	public static function getThemeId($theme)
	{
		$setting = Self::getData($theme);
		$idTheme = Theme::find($setting);
		return $idTheme->id;
	}

}