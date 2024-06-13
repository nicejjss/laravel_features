<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mail', function () {
   Mail::to('locdaoduc2002@gmail.com')->send((new \App\Mail\MyMail())->onQueue('THIS_IS_MAIL_SHOULD_QUEUE'));
   return 'ok';
});

Route::get('/cache', function () {
    Illuminate\Support\Facades\Redis::set('name1', "Hello World");
    return Illuminate\Support\Facades\Redis::get('name1');
});

Route::get('/job',function(){
    \App\Jobs\MyJob::dispatch()->onQueue("THIS_IS_JOB_QUEUE");
    return 'ok';
});
