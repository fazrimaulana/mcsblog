<?php

Route::group(['middleware'=>['web', 'auth'],'prefix' => 'dashboard'], function() {


	Route::group(['prefix' => 'settings'], function(){

		Route::get('/general', [
				'as' => 'dashboard.settings',
				'uses' => 'Modules\Settings\Controllers\SettingController@index'
			]);

		Route::post('/general', [
				'as' => 'dashboard.settings.change',
				'uses' => 'Modules\Settings\Controllers\SettingController@change_general'
			]);		

	});


});