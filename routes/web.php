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

    // DCM routes
    Route::get('/get_clients', ['uses' => 'App\Http\Controllers\DashboardController@get_clients', 'as' => 'get_clients']);
<<<<<<< HEAD
    Route::get('/get_dfc_clients', ['uses' => 'App\Http\Controller\DcmReportController@get_dfc_clients', 'as' => 'get_dfc_clients']);



    //routes for bulk clients upload
    Route::get('/upload/clients/form', ['uses'=>'App\Http\Controllers\BulkUploadController@uploadClientForm', 'as' => 'upload-clients-form']);
    Route::post('/import/client/file', ['uses'=>'App\Http\Controllers\BulkUploadController@importClients', 'as' => 'client-file-import']);
    Route::get('/download/client/template', ['uses'=>'App\Http\Controllers\BulkUploadController@downloadClientTemplate', 'as' => 'client-template-download']);});
=======
    Route::get('/get_dcm_less_well', ['uses' => 'App\Http\Controllers\DcmReportController@get_dcm_less_well', 'as' => 'get_dcm_less_well']);
    Route::get('/get_dcm_less_advanced', ['uses' => 'App\Http\Controllers\DcmReportController@get_dcm_less_advanced', 'as' => 'get_dcm_less_advanced']);
    Route::get('/get_dcm_more_stable', ['uses' => 'App\Http\Controllers\DcmReportController@get_dcm_more_stable', 'as' => 'get_dcm_more_stable']);
    Route::get('/get_dcm_more_unstable', ['uses' => 'App\Http\Controllers\DcmReportController@get_dcm_more_unstable', 'as' => 'get_dcm_more_unstable']);

    // PMTCT routes
    Route::get('/get_pmtct_clients_data', ['uses' => 'App\Http\Controllers\PmtcController@get_pmtct_clients_data', 'as' => 'get_pmtct_clients_data']);

    Route::get('/get_pmtct_booked_clients', ['uses' => 'App\Http\Controllers\PmtcController@get_pmtct_booked_clients', 'as' => 'get_pmtct_booked_clients']);
    Route::get('/get_pmtct_honored_appointment', ['uses' => 'App\Http\Controllers\PmtcController@get_pmtct_honored_appointment', 'as' => 'get_pmtct_honored_appointment']);
    Route::get('/get_pmtct_scheduled_appointments', ['uses' => 'App\Http\Controllers\PmtcController@get_pmtct_scheduled_appointments', 'as' => 'get_pmtct_scheduled_appointments']);
    Route::get('/get_pmtct_unscheduled_appointments', ['uses' => 'App\Http\Controllers\PmtcController@get_pmtct_unscheduled_appointments', 'as' => 'get_pmtct_unscheduled_appointments']);
    Route::get('/get_pmtct_missed_clients', ['uses' => 'App\Http\Controllers\PmtcController@get_pmtct_missed_clients', 'as' => 'get_pmtct_missed_clients']);
    Route::get('/get_pmtct_defaulted_clients', ['uses' => 'App\Http\Controllers\PmtcController@get_pmtct_defaulted_clients', 'as' => 'get_pmtct_defaulted_clients']);
    Route::get('/get_pmtct_ltfu_clients', ['uses' => 'App\Http\Controllers\PmtcController@get_pmtct_ltfu_clients', 'as' => 'get_pmtct_ltfu_clients']);
    Route::get('/get_deceased_clients', ['uses' => 'App\Http\Controllers\PmtcController@get_deceased_clients', 'as' => 'get_deceased_clients']);
});
>>>>>>> f4f66c8da82122534cf19e78c325e94f32745892
