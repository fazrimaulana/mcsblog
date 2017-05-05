<?php

Route::group(['middleware'=>['web', 'auth'],'prefix' => 'dashboard'], function() {


	Route::group(['prefix' => 'comments'], function(){

		Route::get('/', [
				'as' => 'dashboard.comments',
				'uses' => 'Modules\Comments\Controllers\CommentController@index'
			]);

		Route::get('/search', [
				'as' => 'dashboard.comments.search',
				'uses' => 'Modules\Comments\Controllers\CommentController@search'
			]);

		Route::get('/pending', [
				'as' => 'dashboard.comments.pending',
				'uses' => 'Modules\Comments\Controllers\CommentController@pending'
			]);

		Route::get('/approved', [
				'as' => 'dashboard.comments.approved',
				'uses' => 'Modules\Comments\Controllers\CommentController@approved'
			]);

		Route::get('/spam', [
				'as' => 'dashboard.comments.spam',
				'uses' => 'Modules\Comments\Controllers\CommentController@spam'
			]);

		Route::get('/bin', [
				'as' => 'dashboard.comments.bin',
				'uses' => 'Modules\Comments\Controllers\CommentController@bin'
			]);

		Route::post('/apply', [
				'as' => 'dashboard.comments.apply',
				'uses' => 'Modules\Comments\Controllers\CommentController@apply'
			]);

		Route::get('/change/{comment}/approved', [
				'as' => 'dashboard.comments.change.approved',
				'uses' => 'Modules\Comments\Controllers\CommentController@changeStatus'
			]);

		Route::get('/change/{comment}/pending', [
				'as' => 'dashboard.comments.change.pending',
				'uses' => 'Modules\Comments\Controllers\CommentController@changeStatus'
			]);

		Route::get('/change/{comment}/spam', [
				'as' => 'dashboard.comments.change.spam',
				'uses' => 'Modules\Comments\Controllers\CommentController@changeStatus'
			]);

		Route::get('/change/{comment}/bin', [
				'as' => 'dashboard.comments.change.bin',
				'uses' => 'Modules\Comments\Controllers\CommentController@changeStatus'
			]);

		Route::post('/reply', [
				'as' => 'dashboard.comments.reply',
				'uses' => 'Modules\Comments\Controllers\CommentController@reply'
			]);

		Route::post('/edit', [
				'as' => 'dashboard.comments.edit',
				'uses' => 'Modules\Comments\Controllers\CommentController@update'
			]);

	});


});