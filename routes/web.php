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
use App\Http\Middleware\CheckPaid;


Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('/','pagesController@home')->middleware(CheckPaid::class);


Route::get('/success', function () {
	Session::flash('Success', 'Thank you for your payment! you will receive an email when your account is ready.'); 
	return redirect('/');
});
Route::get('/success', function () {
	Session::flash('Fail!', 'Payment canceled!'); 
	return redirect('/');
});
Route::get('/fail','pagesController@home')->middleware(CheckPaid::class);
Route::get('/payeer','pagesController@home')->middleware(CheckPaid::class);


Route::get('/ref/{ref}','pagesController@home')->middleware(CheckPaid::class);

Route::get('/dashboard','pagesController@dashboard');
Route::get('/api','pagesController@api')->middleware(CheckPaid::class);

Route::get('/payment/{plan?}/','userController@showPayment')->middleware(CheckPaid::class);

Route::get('/plan','pagesController@plan')->middleware(CheckPaid::class);

Route::get('/type','userController@showChooseType')->middleware(CheckPaid::class);
Route::post('/type','userController@redeem')->middleware(CheckPaid::class);

Route::get('/paypal','userController@redirectToPayPal')->middleware(CheckPaid::class);
Route::get('/bitcoin','userController@redirectToBitcoin')->middleware(CheckPaid::class);

Route::get('/terms','pagesController@terms')->middleware(CheckPaid::class);
Route::get('/thankyou','userController@thankyou')->middleware(CheckPaid::class);

Route::get('/privacy','pagesController@privacy')->middleware(CheckPaid::class);

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