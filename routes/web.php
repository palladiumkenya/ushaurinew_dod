<?php

use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('sessions/signIn');
});

Auth::routes();


Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/logout', ['uses'=>'App\Http\Controllers\Auth\LoginController@logout', 'as' => 'logout']);
    Route::get('/get_clients', ['uses' => 'App\Http\Controllers\DashboardController@get_clients', 'as' => 'get_clients']);
    Route::get('/get_dcm_less_well', ['uses' => 'App\Http\Controllers\DcmReportController@get_dcm_less_well', 'as' => 'get_dcm_less_well']);
    Route::get('/get_dcm_less_advanced', ['uses' => 'App\Http\Controllers\DcmReportController@get_dcm_less_advanced', 'as' => 'get_dcm_less_advanced']);
    Route::get('/get_dcm_more_stable', ['uses' => 'App\Http\Controllers\DcmReportController@get_dcm_more_stable', 'as' => 'get_dcm_more_stable']);
    Route::get('/get_dcm_more_unstable', ['uses' => 'App\Http\Controllers\DcmReportController@get_dcm_more_unstable', 'as' => 'get_dcm_more_unstable']);
    Route::get('/get_pmtct_clients_data', ['uses' => 'App\Http\Controllers\PmtcController@get_pmtct_clients_data', 'as' => 'get_pmtct_clients_data']);
    
});