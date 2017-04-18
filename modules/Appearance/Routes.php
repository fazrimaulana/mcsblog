<?php

Route::group(['middleware'=>['web', 'auth'],'prefix' => 'dashboard'], function() {


	Route::group(['prefix' => 'themes'], function(){

		Route::get('/', [
			'as' => 'dashboard.appearance.themes', 
			'uses' => 'Modules\Appearance\Controllers\ThemeController@index'
		]);

	});

	Route::group(['prefix' => 'menus'], function(){

		Route::get('/', [
			'as' => 'dashboard.appearance.menus', 
			'uses' => 'Modules\Appearance\Controllers\MenuController@index'
		]);

		Route::post('/', [
			'as' => 'dashboard.appearance.menus.add', 
			'uses' => 'Modules\Appearance\Controllers\MenuController@store'
		]);

		Route::get('/{frontmenu}/edit', [
			'as' => 'dashboard.appearance.menus.edit', 
			'uses' => 'Modules\Appearance\Controllers\MenuController@getData'
		]);

		Route::post('/{frontmenu}/edit', [
			'as' => 'dashboard.appearance.menus.edit', 
			'uses' => 'Modules\Appearance\Controllers\MenuController@update'
		]);

		Route::delete('/delete', [
			'as' => 'dashboard.appearance.menus.delete', 
			'uses' => 'Modules\Appearance\Controllers\MenuController@delete'
		]);


	});

});