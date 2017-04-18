<?php

namespace Modules\Role\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Role\Models\Role;
use App\User;
use Modules\Role\Models\Permission;

use Auth;

use DB;

class RoleController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$method_permission = "can_see_role";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

            $roles = Role::all();
			return view('Role::role.index',[
				"roles" => $roles
			]);

        }else{
            return view('404');
        }
	}

	public function store(Request $request)
	{
		$method_permission = "can_add_role";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$this->validate($request,[
					"name" 			=> "required",
					"display_name"	=> "required"
				]);

			$role = new Role;
			$role->name = $request->name;
			$role->display_name = $request->display_name;
			$role->description = $request->description;

			$role->save();

            return redirect()->back();

        }else{
            return view('404');
        }
	}

	public function getData(Role $role, Request $request)
	{
		if($request->ajax())
		{
			return response()->json($role);
		}
		else
		{
			return view('404');
		}
	}

	public function update(Request $request)
	{
		$method_permission = "can_edit_role";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$this->validate($request,[
					"name" 			=> "required",
					"display_name"	=> "required"
				]);

			$role = Role::where('id', $request->id)->first();
			$role->name = $request->name;
			$role->display_name = $request->display_name;
			$role->description = $request->description;

			$role->save();

            return redirect()->back();

        }else{
            return view('404');
        }
	}

	public function delete(Request $request)
	{
		$method_permission = "can_delete_role";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			Role::where('id', $request->id)->delete();

            return redirect()->back();

        }else{
            return view('404');
        }
	}

	public function detail(Role $role)
	{
		$method_permission = "can_see_role";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){
			$users = User::whereNotIn('id', $role->users()->pluck('user_id'))->get();
			$permissions = Permission::whereNotIn('id', $role->perms()->pluck('permission_id'))->get();

			return view('Role::role.detail',[
				"role"			=> $role,
				"users"			=> $users,
				"permissions"	=> $permissions
			]);

        }else{
            return view('404');
        }
	}

	public function addUsers(Request $request)
	{
		$method_permission = "can_add_role_users";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){
			$role = Role::where('id', $request->id)->first();
			$role->users()->attach($request->users);
			return redirect()->back();
        }else{
            return view('404');
        }
	}

	public function addPermissions(Request $request)
	{
		$method_permission = "can_add_role_permissions";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){
			$role = Role::where('id', $request->id)->first();
			$role->perms()->attach($request->permissions);
			return redirect()->back();
        }else{
            return view('404');
        }
	}

	public function deletePermission(Request $request)
	{
		$method_permission = "can_edit_role";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			DB::table('permission_role')->where('role_id', $request->id)->where('permission_id', $request->id_permission)->delete();

			return redirect()->back();

        }else{
            return view('404');
        }
	}

	public function deleteUser(Request $request)
	{
		$method_permission = "can_edit_role";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			DB::table('role_user')->where('role_id', $request->id)->where('user_id', $request->id_user)->delete();

			return redirect()->back();

        }else{
            return view('404');
        }
	}

}