<?php

namespace Modules\Settings\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use Modules\Role\Models\Role;
use Modules\Settings\Models\Setting;

class SettingController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$method_permission = "can_see_settings";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$roles = Role::all();
			return view('Settings::general.index', [
					"roles" => $roles
				]);

        }else{
            return view('404');
        }
	}

	public function change_general(Request $request)
	{
		$method_permission = "can_chenge_settings_general";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$this->validate($request, [
					"site_url" => "url",
					"home_url" => "url"
				]);

			if ($request->membership) {
				Setting::where('setting_name', 'membership')->first()->update([
					"setting_value" => "true"
				]);	
			}
			else
			{
				Setting::where('setting_name', 'membership')->first()->update([
					"setting_value" => "false"
				]);	
			}

			foreach ($request->all() as $key => $value) {
				$sett = Setting::where('setting_name', $key)->first();
				if ($sett) {
						if ($key!='membership') {
							Setting::where('setting_name', $key)->first()->update([
								"setting_value" => $request->$key
							]);	
						}						
				}
			}

			return redirect()->back();
			

        }else{
            return view('404');
        }
	}

}