<?php

namespace Modules\Role\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Role\Models\Permission;

use Auth;

class PermissionController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$method_permission = "can_see_permission";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

            $permissions = Permission::paginate(20);
			return view('Role::permission.index',[
				"permissions" => $permissions
			]);

        }else{
            return view('404');
        }
	}

	public function store(Request $request)
	{
		$method_permission = "can_add_permission";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$this->validate($request,[
					"name" 			=> "required",
					"display_name"	=> "required"
				]);

			$permission = new Permission;
			$permission->name = $request->name;
			$permission->display_name = $request->display_name;
			$permission->description = $request->description;

			$permission->save();

            return redirect()->back();

        }else{
            return view('404');
        }
	}

}