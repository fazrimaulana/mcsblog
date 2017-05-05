<?php

namespace Modules\Module\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Module\Models\Module;
use Modules\Module\Models\Menu;
use Modules\Module\Models\Permission;

use Auth;

class ModuleController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$method_permission = "can_see_module";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$modules = Module::where('name', '!=', 'Module Management')->get();
			return view('Module::index',[
				"modules" => $modules
			]);

        }
        else
        {
            return view('404');
        }
	}

	public function set_active(Module $module)
	{	

		$method_permission = "can_active_module";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$module->update([
				'status' => "active"
			]);

			return redirect()->back();

        }
        else
        {
            return view('404');
        }

	}

	public function set_inactive(Module $module)
	{
		$method_permission = "can_inactive_module";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$module->update([
				'status' => "inactive"
			]);

			return redirect()->back();

        }
        else
        {
            return view('404');
        }
	}

	public function IsDirExist($dir)
	{
		$data = Module::where('module', $dir)->first();
		$moduleDir = base_path('modules');
		$path = $moduleDir.'/'.$dir;
		if ($data && !file_exists($path)) 
		{
			$this->remove($dir);
		}
	}

	public function remove($dir)
	{
		Module::where('module', $dir)->delete();
	}

	public function store($dir)
	{
		$moduleDir = base_path('modules');
		$data = Module::where('module', $dir)->first();
		$path = $moduleDir.'/'.$dir.'/mcsblog.json';
		$json = json_decode(file_get_contents($path));

		if (!$data) 
		{

			if ($json->name=="Module Management") {
				$status = "active";
			}
			else{
				$status = "inactive";
			}

			$datas = [
				'name' => $json->name,
				'description' => $json->description,
				'keyword' => json_encode($json->keyword),
				'version' => $json->version,
				'author' => $json->author,
				'web' => $json->web,
				'repository' => $json->repository,
				'sequence' => $json->sequence,
				'license' => $json->license,
				'module' => $dir,
				'status' => $status
			];

			Module::create($datas);

		}

	}

	public function InstallMenu($dir)
	{
		$moduleDir = base_path('modules');
		$data = Module::where('module', $dir)->first();
		$path = $moduleDir.'/'.$dir.'/mcsblog.json';
		$json = json_decode(file_get_contents($path));

		if (!empty($json->menu)) 
		{
			foreach ( $json->menu as $menu ) 
			{
				
				$datas = [
					"menu_id" => $menu->menu_id,
					"parent_id" => $menu->parent_id,
					"name" => $menu->name,
					"href" => $menu->href,
					"target" => $menu->target,
					"title" => $menu->title,
					"icon" => $menu->icon,
					"permission" => $menu->permission,
					"module" => $dir,
					"sequence" => $menu->sequence
				];

				$cek = Menu::where('menu_id', $menu->menu_id)->first();

				if (!$cek) 
				{
					Menu::create($datas);
				}
				else
				{
					Menu::where('menu_id', $menu->menu_id)->update($datas);
				}

			}
		}

	}

	public function InstallPermissions($dir)
	{
		$moduleDir = base_path('modules');
		$data = Module::where('module', $dir)->first();
		$path = $moduleDir.'/'.$dir.'/mcsblog.json';
		$json = json_decode(file_get_contents($path));

		if (!empty($json->permission)) 
		{
			
			foreach ($json->permission as $perm) 
			{
				$find = Permission::where('name', $perm)->first();
				if (!$find) 
				{
					$permission = new Permission;
					$permission->name = strtolower($perm);
					$permission->display_name = strtolower($perm);
					$permission->description = strtolower($perm);
					$permission->save(); 
				}
			}

		}

	}

	public function is_active($dir)
	{
		$data = Module::where('module', $dir)->where('status', 'active')->first();
		if ($data)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

}