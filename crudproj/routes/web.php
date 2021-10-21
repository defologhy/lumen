<?php
/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

// informasi route group
$router->group(['prefix' => 'api'], function () use ($router) {

    // crud mongodb
    Route::get('/crudmongo','CrudController@index');
    Route::post('/crudmongo/add','CrudController@add');
    Route::get('/crudmongo/{id}','CrudController@by_id');
    Route::put('/crudmongo/update/{id}','CrudController@update');
    // Route::post('/info/update','InfoController@update');
    Route::delete('/crudmongo/delete/{id}','CrudController@delete');

    // login & logout with JWT Token
    Route::post('/login','CrudController@login');
    Route::get('/logout','CrudController@logout');
    
    // firebase crud
    Route::get('/firebase','CrudController@firebase_read');
    Route::post('/firebase/add','CrudController@firebase_add');
    Route::get('/firebase/by_id/{id}','CrudController@firebase_by_id');
    Route::put('/firebase/update/{id}','CrudController@firebase_update');
    Route::delete('/firebase/delete/{id}','CrudController@firebase_delete');

    // jawaban no 7
    Route::get('/filter_object','CrudController@filter_object');

    // jawaban no 6
    Route::get('/response_client_register','CrudController@response_client_register');
    Route::get('/response_client_login','CrudController@response_client_login');
    
});
