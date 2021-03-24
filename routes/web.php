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

Route::get('/Login', function () {
    return view('sessions/signIn');
});

Auth::routes();


Route::group(['middleware' => 'auth'], function () {

    Route::get('/Reports/dashboard', ['uses'=>'App\Http\Controllers\HomeController@index', 'as' => 'Reports-dashboard']);
    Route::get('/logout', ['uses'=>'App\Http\Controllers\Auth\LoginController@logout', 'as' => 'logout']);

    Route::get('/admin/users', ['uses' => 'App\Http\Controllers\UserController@showUsers', 'as' => 'admin-users']);
    Route::get('/admin/users/form', ['uses' => 'App\Http\Controllers\UserController@adduserform', 'as' => 'admin-users-form']);

    // Dashboard routes
    Route::get('/get_client_data', ['uses' => 'App\Http\Controllers\DashboardController@get_client_data', 'as' => 'get_client_data']);
    Route::get('/Reports/facility_home', ['uses' => 'App\Http\Controllers\DashboardController@facility_dashboard', 'as' => 'Reports-facility_home']);
    Route::get('/Reports/clients/distribution', ['uses' => 'App\Http\Controllers\DashboardController@client_distribution_graphs', 'as' => 'Reports-clients-distribution']);

    // clients routes
    Route::get('/report/clients/list', ['uses' => 'App\Http\Controllers\ClientListController@get_client_list', 'as' => 'report-clients-list']);

    // DCM routes
    Route::get('/Reports/dsd', ['uses' => 'App\Http\Controllers\DcmReportController@dcm_report', 'as' => 'Reports-dsd']);

    // Appointments routes

    Route::get('report/appointment/dashboard', ['uses'=>'App\Http\Controllers\AppointmentController@appointment_dashboard', 'as' => 'report-appointment-dashboard']);
    Route::get('report/active/missed', ['uses'=>'App\Http\Controllers\AppointmentController@get_active_missed', 'as' => 'report-active-missed']);
    Route::get('report/active/defaulted', ['uses'=>'App\Http\Controllers\AppointmentController@get_active_defaulted', 'as' => 'report-active-defaulted']);
    Route::get('report/active/ltfu', ['uses'=>'App\Http\Controllers\AppointmentController@get_active_ltfu', 'as' => 'report-active-ltfu']);
    Route::get('report/appointment/honourned', ['uses'=>'App\Http\Controllers\AppointmentController@get_app_honourned', 'as' => 'report-appointment-honourned']);
    Route::get('report/created/appointments', ['uses'=>'App\Http\Controllers\AppointmentController@get_created_appointments', 'as' => 'report-created-appointments']);
    Route::get('get_future_appointments', ['uses'=>'App\Http\Controllers\AppointmentController@get_future_appointments', 'as' => 'get_future_appointments']);
    Route::get('report/appointments/missed', ['uses'=>'App\Http\Controllers\AppointmentController@get_missed_appointments', 'as' => 'report-appointments-missed']);
    Route::get('report/appointments/defaulted', ['uses'=>'App\Http\Controllers\AppointmentController@get_defaulted_appointments', 'as' => 'report-appointments-defaulted']);
    Route::get('report/appointments/ltfu_clients', ['uses'=>'App\Http\Controllers\AppointmentController@get_ltfu_appointments', 'as' => 'report-appointments-ltfu_clients']);
    Route::get('report/appointments', ['uses'=>'App\Http\Controllers\AppointmentController@get_appointment_list', 'as' => 'report-appointments']);
    Route::get('report/appointments/calender', ['uses'=>'App\Http\Controllers\AppointmentController@get_appointment_count', 'as' => 'report-appointments-calender']);
    Route::get('report/appointments', ['uses'=>'App\Http\Controllers\AppointmentController@get_appointment_list', 'as' => 'report-appointments']);
    Route::get('report/lab_investigation', ['uses'=>'App\Http\Controllers\AppointmentController@lab_investigation', 'as' => 'report-lab_investigation']);

    // wellness routes
    Route::get('report/ok_clients', ['uses'=>'App\Http\Controllers\WellnessController@get_ok_clients', 'as' => 'report-ok_clients']);
    Route::get('report/not_ok_clients', ['uses'=>'App\Http\Controllers\WellnessController@get_not_ok_clients', 'as' => 'report-not_ok_clients']);
    Route::get('report/unrecognised_response', ['uses'=>'App\Http\Controllers\WellnessController@get_unrecoginised_clients', 'as' => 'report-unrecognised_response']);

    // grouping routes
    Route::get('report/adolescent_clients', ['uses'=>'App\Http\Controllers\GroupController@get_adolescents_clients', 'as' => 'report-adolescent_clients']);
    Route::get('report/pmtct_clients', ['uses'=>'App\Http\Controllers\GroupController@get_pmtct_clients', 'as' => 'report-pmtct_clients']);
    Route::get('report/adults_clients', ['uses'=>'App\Http\Controllers\GroupController@get_psc_clients', 'as' => 'report-adults_clients']);
    Route::get('report/paeds_clients', ['uses'=>'App\Http\Controllers\GroupController@get_paeds_clients', 'as' => 'report-paeds_clients']);

    //routes for bulk clients upload
    Route::get('/upload/clients/form', ['uses'=>'App\Http\Controllers\BulkUploadController@uploadClientForm', 'as' => 'upload-clients-form']);
    Route::post('/import/client/file', ['uses'=>'App\Http\Controllers\BulkUploadController@importClients', 'as' => 'client-file-import']);
    Route::get('/download/client/template', ['uses'=>'App\Http\Controllers\BulkUploadController@downloadClientTemplate', 'as' => 'client-template-download']);


    // PMTCT routes
    Route::get('/get_pmtct_clients_data', ['uses' => 'App\Http\Controllers\PmtcController@get_pmtct_clients_data', 'as' => 'get_pmtct_clients_data']);
    Route::get('/report/pmtct/defaulter/dairy', ['uses' => 'App\Http\Controllers\PmtcController@pmtct_defaulter_dairy', 'as' => 'report-pmtct-defaulter-dairy']);
    Route::get('/report/pmtct/appointment/dairy', ['uses' => 'App\Http\Controllers\PmtcController@pmtct_appointment_dairy', 'as' => 'report-pmtct-appointment-dairy']);

    Route::get('/report/all_heis', ['uses' => 'App\Http\Controllers\PmtcController@get_all_hei', 'as' => 'report-all_heis']);
    Route::get('/report/hei/appointment/dairy', ['uses' => 'App\Http\Controllers\PmtcController@hei_appointment_dairy', 'as' => 'report-hei-appointment-dairy']);
    Route::get('/report/hei/defaulter/dairy', ['uses' => 'App\Http\Controllers\PmtcController@hei_defaulter_dairy', 'as' => 'report-hei-defaulter-dairy']);
    Route::get('/report/hei/final/outcome', ['uses' => 'App\Http\Controllers\PmtcController@hei_final_outcome', 'as' => 'report-hei-final-outcome']);

    // general reports
    Route::get('/report/deactivated_clients', ['uses' => 'App\Http\Controllers\ReportController@deactivated_clients', 'as' => 'report-deactivated_clients']);
    Route::get('/report/transfer', ['uses' => 'App\Http\Controllers\ReportController@transfer_out', 'as' => 'report-transfer']);
});