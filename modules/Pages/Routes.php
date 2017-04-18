<?php

Route::group(['middleware'=>['web', 'auth'],'prefix' => 'dashboard'], function() {


	Route::group(['prefix' => 'pages'], function(){

		Route::get('/', [
				'as' => 'dashboard.pages',
				'uses' => 'Modules\Pages\Controllers\PageController@index'
			]);

		Route::get('/add', [
				'as' => 'dashboard.pages.add',
				'uses' => 'Modules\Pages\Controllers\PageController@add'
			]);

		Route::post('/add', [
				'as' => 'dashboard.pages.add',
				'uses' => 'Modules\Pages\Controllers\PageController@store'
			]);

		Route::get('/{post}/edit', [
				'as' => 'dashboard.pages.add',
				'uses' => 'Modules\Pages\Controllers\PageController@getData'
			]);

		Route::post('/{post}/edit', [
				'as' => 'dashboard.pages.add',
				'uses' => 'Modules\Pages\Controllers\PageController@update'
			]);

		Route::delete('/delete', [
				'as' => 'dashboard.pages.delete',
				'uses' => 'Modules\Pages\Controllers\PageController@delete'
			]);

		Route::get('/{post}/trash', [
				'as' => 'dashboard.pages.change.trash',
				'uses' => 'Modules\Pages\Controllers\PageController@changeTrash'
			]);

		Route::get('/published', [
				'as' => 'dashboard.pages.published',
				'uses' => 'Modules\Pages\Controllers\PageController@status'
			]);

		Route::get('/draft', [
				'as' => 'dashboard.pages.draft',
				'uses' => 'Modules\Pages\Controllers\PageController@status'
			]);

		Route::get('/trash', [
				'as' => 'dashboard.pages.trash',
				'uses' => 'Modules\Pages\Controllers\PageController@status'
			]);

		Route::get('/search', [
				'as' => 'dashboard.pages.search',
				'uses' => 'Modules\Pages\Controllers\PageController@search'
			]);

		Route::get('/filter', [
				'as' => 'dashboard.pages.filter',
				'uses' => 'Modules\Pages\Controllers\PageController@filter'
			]);

		Route::post('/move', [
				'as' => 'dashboard.pages.move.trash',
				'uses' => 'Modules\Pages\Controllers\PageController@moveTrash'
			]);

		Route::post('/delete_trash', [
				'as' => 'dashboard.pages.move.trash',
				'uses' => 'Modules\Pages\Controllers\PageController@delete_trash'
			]);

		Route::get('/{post}/detail', [
				'as' => 'dashboard.pages.detail',
				'uses' => 'Modules\Pages\Controllers\PageController@detail'
			]);

	});


});