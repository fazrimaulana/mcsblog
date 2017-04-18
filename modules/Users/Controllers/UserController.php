<?php

namespace Modules\Users\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\User;
use Modules\Users\Models\Usermeta;
use Modules\Role\Models\Role;

use Illuminate\Validation\Rule;
use File;
use Hash;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$method_permission = "can_see_users";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$users = User::withCount(['posts' => function($query){
				$query->where('type', 'post');
			}])->paginate(10);
			$roles = Role::all();
			$userCount = User::count();

			return view('Users::index', [
					"users" => $users,
					"roles" => $roles,
					"userCount" => $userCount
				]);

        }else{
            return view('404');
        }
	}

	public function add()
	{
		$roles = Role::all();
		return view('Users::add',[
				"roles" => $roles
			]);
	}

	public function store(Request $request)
	{
		$method_permission = "can_add_users";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$this->validate($request, [
					"name" => "required",
					"display_name" => "required",
					"email" => "required|unique:users,email",
					"password" => "required",
					"role" => "required"
				]);

			$user = new User;
			$user->name = $request->name;
			$user->email = $request->email;
			$user->password = bcrypt($request->password);
			$user->api_token = md5($request->name.$request->email.date('Y-m-d H:i:s'));

			$user->save();

			if ($request->file('image')!= null):
            	$upload_dir = "uploads";
            	$namafile   = date("YmdHis")."-".str_slug(pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME), '-');
            	$MimeType   = $request->file('image')->getMimeType();
            	/*$file       = $request->file('image');*/
            	$extension  = explode("/", $MimeType)['1'];
            	$fullname   = $upload_dir . "/" . $namafile . "." . $extension;
            	File::makeDirectory($upload_dir, $mode = 0777, true, true);
            	$request->file('image')->move($upload_dir, $fullname);
        	else:
	            $fullname   = null;
        	endif;

			$usermeta = new Usermeta;
			$usermeta->user_id = $user->id;
			$usermeta->display_name = $request->display_name;
			$usermeta->description = $request->description;
			$usermeta->image = $fullname;

			$usermeta->save();

			$user->roles()->attach($request->role);

			return redirect('/dashboard/users');


        }else{
            return view('404');
        }
	}

	public function getData(User $user, Request $request)
	{
		$method_permission = "can_edit_users";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) || Auth::user()->id==$user->id ){

			$roles = Role::all();

			return view('Users::edit', [
					"user" => $user,
					"roles" => $roles
				]);

        }else{
            return view('404');
        }
	}

	public function update(Request $request, User $user)
	{
		$method_permission = "can_edit_users";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) || Auth::user()->id==$user->id ){

			$this->validate($request, [
					"name" => "required",
					"display_name" => "required",
					"role" => "required"
				]);

			User::find($request->id)->update([
					"name" => $request->name
				]);

			$usermeta = Usermeta::where('user_id', $request->id)->first();

			if ($request->file('image')!= null):

				File::delete($usermeta->image);				

            	$upload_dir = "uploads";
            	$namafile   = date("YmdHis")."-".str_slug(pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME), '-');
            	$MimeType   = $request->file('image')->getMimeType();
            	/*$file       = $request->file('image');*/
            	$extension  = explode("/", $MimeType)['1'];
            	$fullname   = $upload_dir . "/" . $namafile . "." . $extension;
            	File::makeDirectory($upload_dir, $mode = 0777, true, true);
            	$request->file('image')->move($upload_dir, $fullname);

        	else:
	            $fullname   = $usermeta->image;
        	endif;

			$usermeta->update([
					"display_name" => $request->display_name,
					"description" => $request->description,
					"image" => $fullname
				]);

			User::find($request->id)->roles()->sync($request->role);

			return redirect()->back();

        }else{
            return view('404');
        }
	}

	public function getChangePassword(Request $request, User $user)
	{
		$method_permission = "can_edit_users_password";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) || Auth::user()->id==$user->id ){

			return view('Users::change_password',[
					"user" => $user
				]);

        }else{
            return view('404');
        }
	}

	public function changePassword(Request $request, User $user)
	{
		$method_permission = "can_edit_users_password";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) || Auth::user()->id==$user->id ){

			$this->validate($request, [
					"new_password" => "required",
					"old_password" => "required"
				]);

			if (Hash::check($request->old_password, $user->password)) {
				$user->update([
						"password" => bcrypt($request->new_password)
					]);

				return redirect('/dashboard/users')->with('status', 'Change Password Success');

			}
			else
			{
				return redirect()->back()->with('status', 'Change Password Failed');
			}

        }else{
            return view('404');
        }
	}

	public function delete(Request $request)
	{
		$method_permission = "can_delete_users";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission)){

			$user = User::find($request->id);

			File::delete($user->usermeta->image);

			$user->delete();

			return redirect()->back();


        }else{
            return view('404');
        }
	}

	public function search(Request $request)
	{
		$method_permission = "can_see_users";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$users = User::withCount('posts')->where('name', 'like', '%'.$request->search.'%')->paginate(10);
			$roles = Role::all();
			$userCount = User::count();

			return view('Users::index', [
					"users" => $users,
					"roles" => $roles,
					"userCount" => $userCount
				]);

        }else{
            return view('404');
        }
	}

	public function deleteUsers(Request $request)
	{
		$method_permission = "can_delete_users";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

				if ($request->ajax()) {
					if($request->iduser!=null)
					{
						foreach ($request->iduser as $key => $value) {
							$user = User::find($value);

							foreach ($user->roles as $userRole) {

								if ($userRole->name!="root" && $userRole->name!="administrator" ) 
								{
									File::delete($user->usermeta->image);

									$user->delete();		
								}

							}

						}	
						return $request->all();
					}
					else
					{
						return null;
					}
				}
				else
				{
					return view('404');
				}

        }else{
            return view('404');
        }
	}

	public function status(Request $request)
	{		
		$method_permission = "can_see_users";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$roleId = Role::where('name', $request->segment(3))->first();

			$users = User::whereHas('roles', function($query) use ($request, $roleId){
				$query->where('role_id', $roleId->id);
			})->withCount('posts')->paginate(10);
			$roles = Role::all();
			$userCount = User::count();

			return view('Users::index', [
					"users" => $users,
					"roles" => $roles,
					"userCount" => $userCount
				]);

        }else{
            return view('404');
        }
	}

	public function changeRole(Request $request)
	{
		$method_permission = "can_edit_users";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

				if ($request->ajax()) {

					$root = Role::where('name', 'root')->first();
					$administrator = Role::where('name', 'administrator')->first();

					if($request->idusers!=null)
					{
						foreach ($request->idusers as $key => $value) {

							$user = User::find($value);

							foreach ($user->roles as $userRole) {
								$datas[] = $userRole->name;	
							}

							if (array_search("root", $datas)!=null) {
								if ($root!=null) {
									$user->roles()->sync([$root->id]);	
								}
							}
							elseif (array_search("administrator", $datas)!=null) {
								if ($administrator!=null) {
									$user->roles()->sync([$administrator->id]);
								}
							}
							else
							{	
								foreach ($user->roles as $userRole) {
									if ($userRole->name!="root" && $userRole->name!="administrator" ) 
									{
										$user->roles()->sync([$request->action]);
									}
								}
							}
								
							

						}	
						return $request->all();

					}
					else
					{
						return null;
					}
				}
				else
				{
					return view('404');
				}

        }else{
            return view('404');
        }
	}

	public function profile()
	{
		$method_permission = "can_see_users";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$user = User::find(Auth::user()->id);
			$roles = Role::all();

			return view('Users::profile',[
					"user" => $user,
					"roles" => $roles
				]);

        }else{
            return view('404');
        }
	}

	public function detail(User $user)
	{
		$method_permission = "can_see_users";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) || Auth::user()->id==$user->id ){

			$roles = Role::all();
			return view('Users::profile',[
					"user" => $user,
					"roles" => $roles
				]);

        }else{
            return view('404');
        }
	}

	public function apitoken(Request $request)
	{
		$method_permission = "can_edit_users_apitoken";
		$user = User::find($request->id);
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) || Auth::user()->id==$user->id ){

			$user->update([
					"api_token" => md5($user->name.$user->email.date('Y-m-d H:i:s'))
				]);

			return redirect()->back();

        }else{
            return view('404');
        }
	}
	
}