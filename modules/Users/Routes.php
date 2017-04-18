<?php

Route::group(['middleware'=>['web', 'auth'],'prefix' => 'dashboard'], function() {


	Route::group(['prefix' => 'users'], function(){

		Route::get('/', [
				'as' => 'dashboard.users',
				'uses' => 'Modules\Users\Controllers\UserController@index'
			]);

		Route::get('/add', [
				'as' => 'dashboard.users.add',
				'uses' => 'Modules\Users\Controllers\UserController@add'
			]);

		Route::post('/add', [
				'as' => 'dashboard.users.add',
				'uses' => 'Modules\Users\Controllers\UserController@store'
			]);

		Route::get('/{user}/edit', [
				'as' => 'dashboard.users.edit',
				'uses' => 'Modules\Users\Controllers\UserController@getData'
			]);

		Route::post('/{user}/edit', [
				'as' => 'dashboard.users.edit',
				'uses' => 'Modules\Users\Controllers\UserController@update'
			]);

		Route::get('/{user}/change-password', [
				'as' => 'dashboard.users.change.password',
				'uses' => 'Modules\Users\Controllers\UserController@getChangePassword'
			]);

		Route::post('/{user}/change-password', [
				'as' => 'dashboard.users.change.password',
				'uses' => 'Modules\Users\Controllers\UserController@changePassword'
			]);

		Route::delete('/delete', [
				'as' => 'dashboard.users.delete',
				'uses' => 'Modules\Users\Controllers\UserController@delete'
			]);

		Route::get('/search', [
				'as' => 'dashboard.users.search',
				'uses' => 'Modules\Users\Controllers\UserController@search'
			]);

		Route::post('/delete-users', [
				'as' => 'dashboard.users.change.password',
				'uses' => 'Modules\Users\Controllers\UserController@deleteUsers'
			]);

		Route::get('/root', [
				'as' => 'dashboard.users.root',
				'uses' => 'Modules\Users\Controllers\UserController@status'
			]);

		Route::get('/subscriber', [
				'as' => 'dashboard.users.subscriber',
				'uses' => 'Modules\Users\Controllers\UserController@status'
			]);

		Route::get('/contributor', [
				'as' => 'dashboard.users.contributor',
				'uses' => 'Modules\Users\Controllers\UserController@status'
			]);

		Route::get('/author', [
				'as' => 'dashboard.users.author',
				'uses' => 'Modules\Users\Controllers\UserController@status'
			]);

		Route::get('/editor', [
				'as' => 'dashboard.users.editor',
				'uses' => 'Modules\Users\Controllers\UserController@status'
			]);

		Route::get('/administrator', [
				'as' => 'dashboard.users.administrator',
				'uses' => 'Modules\Users\Controllers\UserController@status'
			]);

		Route::post('/change-role', [
				'as' => 'dashboard.users.change.role',
				'uses' => 'Modules\Users\Controllers\UserController@changeRole'
			]);

		Route::get('/profile', [
				'as' => 'dashboard.users.profile',
				'uses' => 'Modules\Users\Controllers\UserController@profile'
			]);

		Route::get('/{user}/profile', [
				'as' => 'dashboard.users.detail',
				'uses' => 'Modules\Users\Controllers\UserController@detail'
			]);

		Route::post('/refresh/apitoken', [
				'as' => 'dashboard.users.change.apikey',
				'uses' => 'Modules\Users\Controllers\UserController@apitoken'
			]);

	});


});