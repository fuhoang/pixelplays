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
Route::auth();

Route::get('/', function () {
    return view('master');
});

Route::group(['middleware' => ['web']], function () {
    Route::resource('videos', 'VideosController');
});

Route::group(array('prefix'=>'/templates/'), function(){
    Route::get('{template}', array( function($template){
        $template = str_replace(".html", "", $template);
        View::addExtension('html', 'php');
        return View::make('templates.'.$template);

    }));
});




