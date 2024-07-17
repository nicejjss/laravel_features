<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Http\Controllers\HomeController;


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
// Assuming your string is stored in a variable called $s3Url
    $s3Url = 's3://dr-dev-video-public-bucket/endirect/videos/out/video/video/1605/9f76b01d-b529-4d3b-a253-53d50642589a.m3u8';

// Extract the desired substring
    $substring = Str::substr($s3Url, strrpos($s3Url, '/') + 1);

    echo $substring;
});

//Mail
Route::get('/mail', function () {
    Mail::to('locdaoduc2002@gmail.com')->send((new \App\Mail\MyMail()));
    return 'ok';
});


//Cache
Route::get('/cache', function () {
    Illuminate\Support\Facades\Redis::set('name1', "Hello World");
    return Illuminate\Support\Facades\Redis::get('name1');
});

//Jobs
Route::get('/job',function(){
    \App\Jobs\MyJob::dispatch()->onQueue("THIS_IS_JOB_QUEUE");
    return 'ok';
});

//Controller
Route::get('/home', 'HomeController@index');
