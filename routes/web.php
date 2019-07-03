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
use App\Http\Middleware\CheckCountry;



Route::get('/seized', function () {
return "<html><head><title>Domain Name Seized</title><META NAME='ROBOTS' CONTENT='NOINDEX, NOFOLLOW'></head><body style='background-color:black;'><center><img src='https://i.imgur.com/9CpNIej.jpg'/></center>";
});
Route::get('/t', function () {
		return "iNSIDE";

})->middleware(CheckCountry::class);

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('/','pagesController@home')->middleware(CheckPaid::class)->middleware(CheckPaid::class);


Route::get('/success', function () {

	return redirect('/')->with('message', 'Thank you for your payment! you will receive an email when your account is ready.');
});

Route::get('/fail', function () {
return redirect('/')->with('message', 'Payment canceled!');

});

Route::get('/payeer','pagesController@home')->middleware(CheckPaid::class)->middleware(CheckPaid::class);


Route::get('/ref/{ref}','pagesController@home')->middleware(CheckPaid::class)->middleware(CheckPaid::class);

Route::get('/dashboard','pagesController@dashboard')->middleware(CheckPaid::class);
Route::get('/validatetest','pagesController@validateTest')->middleware(CheckPaid::class);
Route::get('/api','pagesController@api')->middleware(CheckPaid::class)->middleware(CheckPaid::class);

Route::get('/payment/{plan?}/','userController@showPayment')->middleware(CheckPaid::class)->middleware(CheckPaid::class);

Route::get('/plan','pagesController@plan')->middleware(CheckPaid::class)->middleware(CheckPaid::class);

Route::get('/type','userController@showChooseType')->middleware(CheckPaid::class)->middleware(CheckPaid::class);
Route::post('/type','userController@redeem')->middleware(CheckPaid::class)->middleware(CheckPaid::class);

Route::get('/paypal','userController@redirectToPayPal')->middleware(CheckPaid::class)->middleware(CheckPaid::class);
Route::get('/bitcoin','userController@redirectToBitcoin')->middleware(CheckPaid::class)->middleware(CheckPaid::class);

Route::get('/terms','pagesController@terms')->middleware(CheckPaid::class)->middleware(CheckPaid::class);
Route::get('/thankyou','userController@thankyou')->middleware(CheckPaid::class)->middleware(CheckPaid::class);

Route::get('/privacy','pagesController@privacy')->middleware(CheckPaid::class)->middleware(CheckPaid::class);

Route::get('/login','pagesController@login')->middleware(CheckPaid::class);

Route::get('/account','pagesController@login'->middleware(CheckPaid::class));

Route::get('/test','userController@test')->middleware(CheckPaid::class);
Route::post('/login','userController@login')->middleware(CheckPaid::class);

Route::get('/forgot','pagesController@forgot')->middleware(CheckPaid::class);
Route::post('/forgot','userController@forgot')->middleware(CheckPaid::class);

Route::get('/logout','pagesController@logout')->middleware(CheckPaid::class);


Route::get('/getstarted/{plan?}','pagesController@register')->middleware(CheckPaid::class);


Route::get('/register/{plan?}','pagesController@register')->middleware(CheckPaid::class);

Route::post('/register','userController@create')->middleware(CheckPaid::class);
Route::post('/getstarted','userController@create')->middleware(CheckPaid::class);

Route::get('/pricing','pagesController@pricing')->middleware(CheckPaid::class);

Route::get('/contact','pagesController@contact')->middleware(CheckPaid::class);
Route::post('/contact','userController@contact')->middleware(CheckPaid::class);



Route::get('/newmessages/{id}','messagesController@newMessages')->middleware(CheckPaid::class);

Route::get('/log/{from}/{to}/{text}','messagesController@logMessage')->middleware(CheckPaid::class);
