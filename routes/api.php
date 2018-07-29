<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('questions', 'QuestionController@index')->name('questions.index');
Route::post('questions', 'QuestionController@store')->name('questions.store');
Route::get('questions/{id}', 'QuestionController@show')->name('questions.show');
Route::put('questions/{id}', 'QuestionController@update')->name('questions.update');
Route::delete('questions/{id}', 'QuestionController@destroy')->name('questions.destroy');
Route::post('questions/{id}/vote', 'QuestionController@voteUpdate')->name('questions.voteUpdate');