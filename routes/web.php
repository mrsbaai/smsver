<?php

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

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('/','pagesController@home');

Route::get('/api','pagesController@api');

Route::get('/payment/{plan?}','userController@showPayment');

Route::get('/plan','pagesController@plan');

Route::get('/terms','pagesController@terms');

Route::get('/privacy','pagesController@privacy');

Route::get('/login','pagesController@login');

Route::get('/account','pagesController@login');

Route::get('/test','userController@test');
Route::post('/login','userController@login');

Route::get('/forgot','pagesController@forgot');
Route::post('/forgot','userController@forgot');

Route::get('/logout','pagesController@logout');


Route::get('/getstarted/{plan?}','pagesController@register');


Route::get('/register/{plan?}','pagesController@register');

Route::post('/register','userController@create');
Route::post('/getstarted','userController@create');

Route::get('/pricing','pagesController@pricing');

Route::get('/contact','pagesController@contact');
Route::post('/contact','userController@contact');



Route::get('/newmessages/{id}','messagesController@newMessages');

Route::get('/log/{from}/{to}/{text}','messagesController@logMessage');