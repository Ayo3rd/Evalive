<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/about', function () {
    return view('about');
})->name('about');


Route::get('/signup', 'RegisterController@showRegistrationForm');
Route::post('/signup', 'RegisterController@register');
Route::get('/logout', 'LogoutController');


Route::get('/login', 'LoginController@showLoginForm')->name('login');
Route::post('/login', 'LoginController@login');


Route::middleware(['auth'])->group(function () {

    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::get('/profile/{id}', 'ProfileController@show')->name('course');

    Route::get('/NewEvaluation/create','NewEvalController@create');
    Route::post('/NewEvaluation','NewEvalController@store');


    Route::get('/myEvaluations', 'EvalController@index')->name('mEval');

    Route::get('/myEvaluations/{id}/delete', 'EvalController@deleteConfirmation');
    Route::post('/myEvaluations/{id}/delete', 'EvalController@destroy');

    Route::get('/myEvaluations/{id}/edit', 'EvalController@edit');
    Route::post('/myEvaluations/{id}/edit', 'EvalController@update');





});

