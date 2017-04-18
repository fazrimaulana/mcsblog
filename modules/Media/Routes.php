<?php

Route::group(['middleware'=>['web', 'auth'],'prefix' => 'dashboard'], function() {


	Route::group(['prefix' => 'media'], function(){

		Route::get('/', [
			'as' => 'dashboard.media', 
			'uses' => 'Modules\Media\Controllers\MediaController@index'
		]);

		Route::get('/add', [
			'as' => 'dashboard.media.add', 
			'uses' => 'Modules\Media\Controllers\MediaController@add'
		]);

		Route::post('/add', [
			'as' => 'dashboard.media.add', 
			'uses' => 'Modules\Media\Controllers\MediaController@store'
		]);

		Route::get('/{media}/edit', [
			'as' => 'dashboard.media.edit', 
			'uses' => 'Modules\Media\Controllers\MediaController@getData'
		]);

		Route::post('/{media}/edit', [
			'as' => 'dashboard.media.edit', 
			'uses' => 'Modules\Media\Controllers\MediaController@update'
		]);

		Route::post('/{media}/delete', [
			'as' => 'dashboard.media.delete', 
			'uses' => 'Modules\Media\Controllers\MediaController@delete'
		]);

	});

});