<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/weather' , function(){
    $key= config('services.weatherStack.key');
    $res = Http::get("http://api.weatherstack.com/forecast?access_key=${key}&query=New%20York");
    return $res->json();
});

Route::get('/unsplash' , function(){
    $key= config('services.unsplash.key');
    $query = Request('query');
    $res = Http::get("https://api.unsplash.com/search/photos?page=1&query=${query}%20%nature&client_id=${key}");
    return $res['results'];
});
