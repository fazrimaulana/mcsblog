<?php

Route::group(['middleware'=>['web', 'auth'],'prefix' => 'dashboard'], function() {


	Route::group(['prefix' => 'posts'], function(){

		Route::get('/', [
				'as' => 'dashboard.posts',
				'uses' => 'Modules\Posts\Controllers\PostController@index'
			]);

		Route::get('/add', [
				'as' => 'dashboard.posts.add',
				'uses' => 'Modules\Posts\Controllers\PostController@add'
			]);	

		Route::post('/add', [
				'as' => 'dashboard.posts.add',
				'uses' => 'Modules\Posts\Controllers\PostController@store'
			]);

		Route::get('/{post}/edit', [
				'as' => 'dashboard.posts.edit',
				'uses' => 'Modules\Posts\Controllers\PostController@getData'
			]);

		Route::post('/{post}/edit', [
				'as' => 'dashboard.posts.edit',
				'uses' => 'Modules\Posts\Controllers\PostController@update'
			]);

		Route::delete('/delete', [
				'as' => 'dashboard.posts.delete',
				'uses' => 'Modules\Posts\Controllers\PostController@delete'
			]);

		Route::get('/{post}/change/trash', [
				'as' => 'dashboard.posts.changetrash',
				'uses' => 'Modules\Posts\Controllers\PostController@changeTrash'
			]);

		Route::get('/published', [
				'as' => 'dashboard.posts.published',
				'uses' => 'Modules\Posts\Controllers\PostController@published'
			]);

		Route::get('/draft', [
				'as' => 'dashboard.posts.draft',
				'uses' => 'Modules\Posts\Controllers\PostController@draft'
			]);

		Route::get('/trash', [
				'as' => 'dashboard.posts.trash',
				'uses' => 'Modules\Posts\Controllers\PostController@trash'
			]);

		Route::get('/search', [
				'as' => 'dashboard.posts.search',
				'uses' => 'Modules\Posts\Controllers\PostController@search'
			]);

		Route::get('/filter', [
				'as' => 'dashboard.posts.filter',
				'uses' => 'Modules\Posts\Controllers\PostController@filter'
			]);

		Route::post('/move', [
				'as' => 'dashboard.posts.move.trash',
				'uses' => 'Modules\Posts\Controllers\PostController@moveTrash'
			]);

		Route::post('/delete_trash', [
				'as' => 'dashboard.posts.move.trash',
				'uses' => 'Modules\Posts\Controllers\PostController@delete_trash'
			]);

		Route::get('/{post}/detail', [
				'as' => 'dashboard.posts.detail',
				'uses' => 'Modules\Posts\Controllers\PostController@detail'
			]);

	});

	Route::group(['prefix' => 'categories'], function(){

		Route::get('/', [
				'as' => 'dashboard.posts.categories',
				'uses' => 'Modules\Posts\Controllers\CategoryController@index'
			]);

		Route::post('/add', [
				'as' => 'dashboard.posts.categories.add',
				'uses' => 'Modules\Posts\Controllers\CategoryController@store'
			]);

		Route::get('/{category}/getData', [
				'as' => 'dashboard.posts.categories.edit',
				'uses' => 'Modules\Posts\Controllers\CategoryController@getData'
			]);

		Route::post('/edit', [
				'as' => 'dashboard.posts.categories.edit',
				'uses' => 'Modules\Posts\Controllers\CategoryController@update'
			]);

		Route::delete('/delete', [
				'as' => 'dashboard.posts.categories.delete',
				'uses' => 'Modules\Posts\Controllers\CategoryController@delete'
			]);

		Route::post('/delete_check', [
				'as' => 'dashboard.posts.categories.delete',
				'uses' => 'Modules\Posts\Controllers\CategoryController@delete_check'
			]);

		Route::get('/{category}/detail', [
				'as' => 'dashboard.posts.categories.detail',
				'uses' => 'Modules\Posts\Controllers\CategoryController@detail'
			]);

	});

	Route::group(['prefix' => 'tags'], function(){

		Route::get('/', [
				'as' => 'dashboard.posts.tags',
				'uses' => 'Modules\Posts\Controllers\TagController@index'
			]);

		Route::post('/add', [
				'as' => 'dashboard.posts.tags.add',
				'uses' => 'Modules\Posts\Controllers\TagController@store'
			]);

		Route::get('/{tag}/getData', [
				'as' => 'dashboard.posts.tags.edit',
				'uses' => 'Modules\Posts\Controllers\TagController@getData'
			]);

		Route::post('/edit', [
				'as' => 'dashboard.posts.tags.edit',
				'uses' => 'Modules\Posts\Controllers\TagController@update'
			]);

		Route::delete('/delete',[
				'as' => 'dashboard.posts.tags.delete',
				'uses' => 'Modules\Posts\Controllers\TagController@delete'
			]);

		Route::post('/delete_check', [
				'as' => 'dashboard.posts.tags.delete',
				'uses' => 'Modules\Posts\Controllers\TagController@delete_check'
			]);

		Route::get('/{tag}/detail', [
				'as' => 'dashboard.posts.tags.detail',
				'uses' => 'Modules\Posts\Controllers\TagController@detail'
			]);

	});

});