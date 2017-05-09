<?php

namespace Modules;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
	public function boot()
	{
		$moduleController = new Module\Controllers\ModuleController;
		$moduleModel = Module\Models\Module::all();

		foreach ($moduleModel as $mM) 
		{
			$moduleController->IsDirExist($mM->module);
		}

		$moduleDir = base_path('modules');

		foreach ( glob($moduleDir.'/*', GLOB_ONLYDIR) as $dir ) 
		{
			$dirname = basename($dir);
			$moduleController->store($dirname);
			$moduleController->InstallMenu($dirname);
			$moduleController->InstallPermissions($dirname);

			if ($moduleController->is_active($dirname)) 
			{
				
				if (file_exists($moduleDir.'/'.$dirname.'/Helpers')) 
				{
					foreach ( glob($moduleDir.'/'.$dirname.'/Helpers/*.php') as $filename ) 
					{
						include $filename;
					}
				}

				if (file_exists($moduleDir.'/'.$dirname.'/Routes.php')) 
				{
					// include $moduleDir.'/'.$dirname.'/Routes.php';
					$this->loadRoutesFrom($moduleDir.'/'.$dirname.'/Routes.php');

				}

				if (is_dir($moduleDir.'/'.$dirname.'/Views')) 
				{
					$this->loadViewsFrom($moduleDir.'/'.$dirname.'/Views', $dirname);
				}

			}

		}

	}
}