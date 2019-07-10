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
return "<html><head><title>Domain Name Seized</title><META NAME='ROBOTS' CONTENT='NOINDEX, NOFOLLOW'></head><body style='background-color:black;'><br/><br/><center><img src='https://i.imgur.com/AVnB6eY.png'/></center>";
});
Route::get('/t', function () {
		return "iNSIDE";

})->middleware(CheckCountry::class);

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('/','pagesController@home')->middleware(CheckPaid::class)->middleware(CheckCountry::class);;


Route::get('/success', function () {

	return redirect('/')->with('message', 'Thank you for your payment! you will receive an email when your account is ready.');
});

Route::get('/fail', function () {
return redirect('/')->with('message', 'Payment canceled!');

});

Route::get('/payeer','pagesController@home')->middleware(CheckPaid::class)->middleware(CheckCountry::class);;


Route::get('/ref/{ref}','pagesController@home')->middleware(CheckPaid::class)->middleware(CheckCountry::class);;

Route::get('/dashboard','pagesController@dashboard')->middleware(CheckCountry::class);;
Route::get('/validatetest','pagesController@validateTest')->middleware(CheckCountry::class);
Route::get('/api','pagesController@api')->middleware(CheckPaid::class)->middleware(CheckCountry::class);

Route::get('/payment/{plan?}/','userController@showPayment')->middleware(CheckPaid::class)->middleware(CheckCountry::class);

Route::get('/plan','pagesController@plan')->middleware(CheckPaid::class)->middleware(CheckCountry::class);

Route::get('/type','userController@showChooseType')->middleware(CheckPaid::class)->middleware(CheckCountry::class);
Route::post('/type','userController@redeem')->middleware(CheckPaid::class)->middleware(CheckCountry::class);

Route::get('/paypal','userController@redirectToPayPal')->middleware(CheckPaid::class)->middleware(CheckCountry::class);
Route::get('/bitcoin','userController@redirectToBitcoin')->middleware(CheckPaid::class)->middleware(CheckCountry::class);

Route::get('/terms','pagesController@terms')->middleware(CheckPaid::class)->middleware(CheckCountry::class);
Route::get('/thankyou','userController@thankyou')->middleware(CheckPaid::class)->middleware(CheckCountry::class);

Route::get('/privacy','pagesController@privacy')->middleware(CheckPaid::class)->middleware(CheckCountry::class);

Route::get('/login','pagesController@login')->middleware(CheckCountry::class);

Route::get('/account','pagesController@login')->middleware(CheckCountry::class);

Route::get('/test','userController@test')->middleware(CheckCountry::class);
Route::post('/login','userController@login')->middleware(CheckCountry::class);

Route::get('/forgot','pagesController@forgot')->middleware(CheckCountry::class);
Route::post('/forgot','userController@forgot')->middleware(CheckCountry::class);

Route::get('/logout','pagesController@logout')->middleware(CheckCountry::class);


Route::get('/getstarted/{plan?}','pagesController@register')->middleware(CheckCountry::class);


Route::get('/register/{plan?}','pagesController@register')->middleware(CheckCountry::class);

Route::post('/register','userController@create')->middleware(CheckCountry::class);
Route::post('/getstarted','userController@create')->middleware(CheckCountry::class);

Route::get('/pricing','pagesController@pricing')->middleware(CheckCountry::class);

Route::get('/contact','pagesController@contact')->middleware(CheckCountry::class);
Route::post('/contact','userController@contact')->middleware(CheckCountry::class);



Route::get('/newmessages/{id}','messagesController@newMessages')->middleware(CheckCountry::class);

Route::get('/log/{from}/{to}/{text}','messagesController@logMessage')->middleware(CheckCountry::class);
