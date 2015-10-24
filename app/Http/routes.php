<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::filter('csrf', function()
{
    if (Request::ajax())
    {
        if (Session::token() !== Request::header('csrftoken'))
        {
            // Change this to return something your JavaScript can read...
            throw new Illuminate\Session\TokenMismatchException;
        }
    }
    elseif (Session::token() !== Input::get('_token'))
    {
        throw new Illuminate\Session\TokenMismatchException;
    }
});


Route::pattern('citizen_id', '[0-9]+');

Route::get('/', 'HomeController@index');

Route::get('home', 'HomeController@index');

Route::get('form', 'FormController@index');

Route::post('form_add', [
    'as' => 'form_add', 'uses' => 'FormController@store'
]);
Route::get('get_tree/{citizen_id}', 'ApiController@show_tree');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('persons_index','PersonController@index');
Route::post('show_person','PersonController@show');
