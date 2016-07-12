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
    
});


Route::pattern('citizen_id', '[0-9]+');

Route::get('/', 'HomeController@index');

Route::get('home', 'HomeController@index');

Route::get('form', 'FormController@index');

Route::post('form_add', [
    'as' => 'form_add', 'uses' => 'FormController@store'
]);
Route::get('get_tree_api/{citizen_id}', 'ApiController@show_tree');
Route::post('add_person_api','ApiController@add_person');
Route::post('edit_person_api','ApiController@edit_person');
Route::get('clear_relationship_api/{person_id}', 'PersonController@clear_relationship');
Route::post('upload_image', 'PersonController@upload_image');
Route::get('get_tree/{citizen_id}', 'TreeController@show_tree');
Route::post('add_person','TreeController@add_person');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('persons_index','PersonController@index');
Route::post('show_person','PersonController@show');
Route::post('drop_person','ApiController@delete_person');
Route::get('show_report_by_type/{id}/{person_id}','PersonController@show_report_by_type');

Route::get('duc_report','DuchenneController@index');

Route::get('show_patient_duchenne','DuchenneController@show_patient_duchenne');


Route::get('tree_constuct/{id}', [
    'as' => 'lists.items.create', 
    'uses' => 'TreeController@index'
]);

Route::get('gettoken','DuchenneController@getToken');

Route::get('view_pdf/{id}/type/{type}', [
    'as' => 'view_pdf.type', 
    'uses' => 'PrintController@view_pdf'
]);  

Route::get('underconstruct', function () { 
	return view('errors.503');
	
} );


Route::post('save_state','ApiController@saveState');
Route::post('undo_state','ApiController@undoState');


