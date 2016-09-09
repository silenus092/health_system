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

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

// Home Controller
Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
// Form Controller
Route::get('form', 'FormController@index');
Route::post('form_add', [
    'as' => 'form_add', 'uses' => 'FormController@store'
]);

Route::post('form_update','PersonController@update');

// API Controller
Route::get('get_tree_api/{citizen_id}', 'ApiController@show_tree');
Route::post('add_person_api','ApiController@add_person');
Route::post('edit_person_api','ApiController@edit_person');
Route::get('check_undo_state', 'ApiController@checkUndoState');
Route::get('undo_state', 'ApiController@undoState');
Route::post('drop_person_api', 'ApiController@delete_person');

// Person Controller
Route::get('clear_relationship_api/{person_id}', 'PersonController@clear_relationship');
Route::post('upload_image', 'PersonController@upload_image');
Route::get('persons_index','PersonController@index');
Route::post('show_person','PersonController@show');
Route::get('show_report_by_type/{id}/{person_id}','PersonController@show_report_by_type');
Route::post('update_age', 'PersonController@update_age');
Route::post('update_address', 'PersonController@update_Address');
Route::post('update_CitizenID', 'PersonController@update_CitizenID');
Route::post('update_Gender', 'PersonController@update_Gender');
Route::post('update_Landline', 'PersonController@update_Landline');
Route::post('update_Mobile', 'PersonController@update_Mobile');
// Tree Controller
Route::get('get_tree/{citizen_id}', 'TreeController@show_tree');
Route::post('add_person', 'TreeController@add_person');
Route::post('drop_person', 'TreeController@delete_person');
Route::post('edit_person', 'TreeController@edit_person');
Route::get('check_undo_state_tree', 'TreeController@checkUndoState');
Route::get('undo_state_tree', 'TreeController@undoState');
Route::get('tree_constuct/{id}', [
    'as' => 'lists.items.create',
    'uses' => 'TreeController@index'
]);

// Duchenne Controller
Route::get('duc_report', 'DuchenneController@index');
Route::get('show_patient_duchenne', 'DuchenneController@show_patient_duchenne');
Route::get('gettoken','DuchenneController@getToken');

Route::get('underconstruct', function () { 
	return view('errors.503');
	
} );

// Utils
Route::get('get_images/{filename}', function ($filename)
{
    return Image::make('uploads/' . $filename)->response();
});

Route::get('view_pdf/{id}/type/{type}', [
    'as' => 'view_pdf.type',
    'uses' => 'PrintController@view_pdf'
]);
