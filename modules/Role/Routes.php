<?php

Route::group(['middleware'=>['web', 'auth'],'prefix' => 'dashboard'], function() {


	Route::group(['prefix' => 'settings'], function(){

		Route::group(['prefix' => 'role'], function(){

			Route::get('/', [
					'as' => 'dashboard.setting.role', 
					'uses' => 'Modules\Role\Controllers\RoleController@index'
				]);

			Route::post('/add',[
					'as' => 'dashboard.setting.role.add',
					'uses' => 'Modules\Role\Controllers\RoleController@store'
				]);

			Route::get('/{role}/getData', [
					'as' => 'dashboard.setting.role.edit',
					'uses' => 'Modules\Role\Controllers\RoleController@getData'
				]);

			Route::post('/edit', [
					'as' => 'dashboard.setting.role.edit',
					'uses' => 'Modules\Role\Controllers\RoleController@update'
				]);

			Route::delete('/delete', [
					'as' => 'dashboard.setting.role.delete',
					'uses' => 'Modules\Role\Controllers\RoleController@delete'
				]);

			Route::get('/{role}/detail', [
					'as' => 'dashboard.setting.role.detail',
					'uses' => 'Modules\Role\Controllers\RoleController@detail'
				]);

			Route::post('/addUsers', [
					'as' => 'dashboard.setting.role.addUsers',
					'uses' => 'Modules\Role\Controllers\RoleController@addUsers'
				]);

			Route::post('/addPermissions', [
					'as' => 'dashboard.setting.role.addPermissions',
					'uses' => 'Modules\Role\Controllers\RoleController@addPermissions'
				]);

			Route::delete('/permission/delete', [
					'as' => 'dashboard.setting.role.permission.delete',
					'uses' => 'Modules\Role\Controllers\RoleController@deletePermission'
				]);

			Route::delete('/user/delete', [
					'as' => 'dashboard.setting.role.user.delete',
					'uses' => 'Modules\Role\Controllers\RoleController@deleteUser'
				]);			

		});

		Route::group(['prefix' => 'permission'], function(){

			Route::get('/', [
					'as' => 'dashboard.setting.role.permission', 
					'uses' => 'Modules\Role\Controllers\PermissionController@index'
				]);

			Route::post('/add', [
					'as' => 'dashboard.setting.role.permission.add',
					'uses' => 'Modules\Role\Controllers\PermissionController@store'
				]);

		});

	});

});