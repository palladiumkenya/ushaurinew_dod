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
  return view('auth/login');
});

//SMS Scheduler routes
//schedule appointment notifications
Route::get('/schedule/notified', ['uses' => 'App\Http\Controllers\ScheduleSMSController@notifiedScheduler', 'as' => 'notified-sms']);

//schedule missed appointment notifications
Route::get('/schedule/missed', ['uses' => 'App\Http\Controllers\ScheduleSMSController@missedScheduler', 'as' => 'missed-sms']);

//schedule defaulter notifications
Route::get('/schedule/defaulted', ['uses' => 'App\Http\Controllers\ScheduleSMSController@defaultedScheduler', 'as' => 'defaulted-sms']);

//schedule LTFU notifications
Route::get('/schedule/ltfu', ['uses' => 'App\Http\Controllers\ScheduleSMSController@ltfuScheduler', 'as' => 'ltfu-sms']);

//send sms notifications
Route::get('/sms/sender', ['uses' => 'App\Http\Controllers\ScheduleSMSController@sender', 'as' => 'sms-sender']);

Route::post('/reset/user', ['uses' => 'App\Http\Controllers\UserController@resetuser', 'as' => 'resetuser']);
Route::get('/admin/reset', ['uses' => 'App\Http\Controllers\UserController@reset', 'as' => 'reset']);
Route::get('/user/passwordreset', ['uses' => 'App\Http\Controllers\UserController@resetshow', 'as' => 'resetshow']);
Route::post('/changepass', ['uses' => 'App\Http\Controllers\UserController@changepass', 'as' => 'changepass']);

Auth::routes();

Route::group(['middleware' => 'admin'], function () {
  Route::get('/Reports/dashboard', ['uses' => 'App\Http\Controllers\DashboardController@main_graph_dashboard', 'as' => 'Reports-dashboard']);
});


Route::group(['middleware' => 'auth'], function () {

  // Route::get('/Reports/dashboard', ['uses'=>'App\Http\Controllers\HomeController@index', 'as' => 'Reports-dashboard']);
  Route::get('/logout', ['uses' => 'App\Http\Controllers\Auth\LoginController@logout', 'as' => 'logout']);

  Route::get('/admin/users', ['uses' => 'App\Http\Controllers\UserController@showUsers', 'as' => 'admin-users']);
  Route::get('/admin/users/form', ['uses' => 'App\Http\Controllers\UserController@adduserform', 'as' => 'admin-users-form']);
  Route::post('/admin/users/roles', ['uses' => 'App\Http\Controllers\UserController@access_level_load', 'as' => 'admin-users-roles']);
  Route::post('/add/users', ['uses' => 'App\Http\Controllers\UserController@adduser', 'as' => 'adduser']);
  Route::post('/edit/user', ['uses' => 'App\Http\Controllers\UserController@edituser', 'as' => 'edituser']);
  Route::get('/get_roles/{id}', ['uses' => 'App\Http\Controllers\UserController@get_roles', 'as' => 'get_roles']);
  Route::get('/get_sub_counties/{id}', ['uses' => 'App\Http\Controllers\UserController@get_sub_counties', 'as' => 'get_sub_counties']);
  Route::get('/admin/tracer/clients', ['uses' => 'App\Http\Controllers\TracerController@tracer_client', 'as' => 'admin-tracer-clients']);

  // Dashboard routes
  Route::get('/main_graph_dashboard', ['uses' => 'App\Http\Controllers\DashboardController@main_graph_dashboard', 'as' => 'main_graph_dashboard']);
  Route::get('/filter_client_dashboard', ['uses' => 'App\Http\Controllers\DashboardController@filter_client_dashboard', 'as' => 'filter_client_dashboard']);
  Route::get('/filter_appointment_dashboard', ['uses' => 'App\Http\Controllers\AppointmentController@filter_appointment_dashboard', 'as' => 'filter_appointment_dashboard']);
  Route::get('/dashboard_data', ['uses' => 'App\Http\Controllers\DashboardController@get_data', 'as' => 'dashboard_data']);
  Route::post('/filter_dashboard', ['uses' => 'App\Http\Controllers\DashboardController@filter_dashboard', 'as' => 'filter_dashboard']);
  Route::get('/get_dashboard_counties/{id}', ['uses' => 'App\Http\Controllers\DashboardController@get_counties', 'as' => 'get_counties']);
  Route::get('/get_dashboard_units/{id}', ['uses' => 'App\Http\Controllers\DashboardController@get_dashboard_units', 'as' => 'get_dashboard_units']);
  Route::get('/get_dashboard_facilities/{id}', ['uses' => 'App\Http\Controllers\DashboardController@get_dashboard_facilities', 'as' => 'get_dashboard_facilities']);
  //Route::get('get_client_data', ['uses' => 'App\Http\Controllers\DashboardController@get_client_data', 'as' => 'get_client_data']);
  Route::get('/Reports/facility_home', ['uses' => 'App\Http\Controllers\DashboardController@facility_dashboard', 'as' => 'Reports-facility_home']);
  Route::get('/Reports/clients/distribution', ['uses' => 'App\Http\Controllers\DashboardController@client_distribution_graphs', 'as' => 'Reports-clients-distribution']);
  Route::get('/Reports/clients_dashboard', ['uses' => 'App\Http\Controllers\DashboardController@client_dashboard', 'as' => 'Reports-clients_dashboard']);
  // clients routes
  Route::get('/report/clients/profile', ['uses' => 'App\Http\Controllers\ClientListController@get_client_profile', 'as' => 'profile']);
  Route::get('/add/clients', ['uses' => 'App\Http\Controllers\ClientController@index', 'as' => 'new_client']);
  Route::post('/new/clients', ['uses' => 'App\Http\Controllers\ClientController@add_client', 'as' => 'add_client']);
  Route::get('/edit/clientform/{client}', ['uses' => 'App\Http\Controllers\ClientController@edit_client_form', 'as' => 'edit_client_form']);
  Route::post('/edit/client', ['uses' => 'App\Http\Controllers\ClientController@edit_client', 'as' => 'edit_client']);
  Route::get('/profile_search', ['uses' => 'App\Http\Controllers\ClientListController@profile_search', 'as' => 'profile_search']);
  Route::get('/report/clients/list', ['uses' => 'App\Http\Controllers\ClientListController@get_client_list', 'as' => 'report-clients-list']);
  Route::get('/report/clients/extract', ['uses' => 'App\Http\Controllers\ClientListController@client_extract', 'as' => 'clients-extract']);
  Route::get('/get/clients/extract', ['uses' => 'App\Http\Controllers\ClientListController@filter_client_extract', 'as' => 'filter-clients-extract']);
  Route::post('/report/clients/consent', ['uses' => 'App\Http\Controllers\ConsentController@consent_test', 'as' => 'report-clients-consent']);
  Route::get('/consent/clients', ['uses' => 'App\Http\Controllers\ConsentController@index', 'as' => 'consent-clients']);
  Route::get('/add/consent', ['uses' => 'App\Http\Controllers\ConsentController@addconsentform', 'as' => 'add-consent']);
  Route::get('/clients/booked', ['uses' => 'App\Http\Controllers\TracerController@booked_clients_tracing', 'as' => 'clients-booked']);
  Route::post('/clients/assign/tracer', ['uses' => 'App\Http\Controllers\TracerController@assign_client', 'as' => 'assign-tracer']);
  Route::get('/transit/clients', ['uses' => 'App\Http\Controllers\ClientController@transit_client', 'as' => 'transit_client']);

  // DCM routes
  Route::get('/Reports/dsd', ['uses' => 'App\Http\Controllers\DcmReportController@dcm_report', 'as' => 'Reports-dsd']);

  // Facilities routes
  Route::get('/Reports/active/facilities', ['uses' => 'App\Http\Controllers\DashboardController@active_facilities', 'as' => 'Reports-active-facilities']);
  Route::get('/Reports/il/facilities', ['uses' => 'App\Http\Controllers\ILUushauriController@facilities_il', 'as' => 'Reports-il-facilities']);
  Route::get('/admin/facilities', ['uses' => 'App\Http\Controllers\FacilityController@admin_facilities', 'as' => 'admin_facilities']);
  Route::get('/admin/my_facilities', ['uses' => 'App\Http\Controllers\FacilityController@my_facility', 'as' => 'my_facilities']);
  Route::post('/approve_facility', ['uses' => 'App\Http\Controllers\FacilityController@approve_facility', 'as' => 'approve-facility']);
  Route::post('/add_facility', ['uses' => 'App\Http\Controllers\FacilityController@add_facility', 'as' => 'add_facility']);
  Route::post('/edit_facility', ['uses' => 'App\Http\Controllers\FacilityController@edit_facility', 'as' => 'edit_facility']);

  // Partner routes
  Route::get('/Reports/il/partners', ['uses' => 'App\Http\Controllers\ILUushauriController@partners_il', 'as' => 'Reports-il-partners']);
  Route::get('/admin/partners', ['uses' => 'App\Http\Controllers\PartnerController@index', 'as' => 'admin-partners']);
  Route::get('/admin/partners/form', ['uses' => 'App\Http\Controllers\PartnerController@addpartnerform', 'as' => 'admin-partners-form']);
  Route::post('/add/partners', ['uses' => 'App\Http\Controllers\PartnerController@addpartner', 'as' => 'addpartner']);
  Route::post('/edit/partner', ['uses' => 'App\Http\Controllers\PartnerController@editpartner', 'as' => 'editpartner']);
  Route::post('/delete/partner', ['uses' => 'App\Http\Controllers\PartnerController@deletepartner', 'as' => 'deletepartner']);

  // Appointments routes
  Route::get('report/future/appointments', ['uses' => 'App\Http\Controllers\AppointmentController@index', 'as' => 'future-apps']);
  Route::post('edit/appointments', ['uses' => 'App\Http\Controllers\AppointmentController@editappointment', 'as' => 'editappointment']);
  Route::get('report/appointment/dashboard', ['uses' => 'App\Http\Controllers\AppointmentController@appointment_dashboard', 'as' => 'report-appointment-dashboard']);
  Route::get('report/active/missed', ['uses' => 'App\Http\Controllers\AppointmentController@get_active_missed', 'as' => 'report-active-missed']);
  Route::get('report/active/defaulted', ['uses' => 'App\Http\Controllers\AppointmentController@get_active_defaulted', 'as' => 'report-active-defaulted']);
  Route::get('report/active/ltfu', ['uses' => 'App\Http\Controllers\AppointmentController@get_active_ltfu', 'as' => 'report-active-ltfu']);
  Route::get('report/appointment/honourned', ['uses' => 'App\Http\Controllers\AppointmentController@get_app_honourned', 'as' => 'report-appointment-honourned']);
  Route::get('report/created/appointments', ['uses' => 'App\Http\Controllers\AppointmentController@get_created_appointments', 'as' => 'report-created-appointments']);
  Route::get('get_future_appointments', ['uses' => 'App\Http\Controllers\AppointmentController@get_future_appointments', 'as' => 'get_future_appointments']);
  Route::get('report/appointments/missed', ['uses' => 'App\Http\Controllers\AppointmentController@get_missed_appointments', 'as' => 'report-appointments-missed']);
  Route::get('report/appointments/defaulted', ['uses' => 'App\Http\Controllers\AppointmentController@get_defaulted_appointments', 'as' => 'report-appointments-defaulted']);
  Route::get('report/appointments/ltfu_clients', ['uses' => 'App\Http\Controllers\AppointmentController@get_ltfu_appointments', 'as' => 'report-appointments-ltfu_clients']);
  Route::get('report/appointments', ['uses' => 'App\Http\Controllers\AppointmentController@get_appointment_list', 'as' => 'report-appointments']);
  Route::get('report/appointments/calender', ['uses' => 'App\Http\Controllers\AppointmentController@get_appointment_count', 'as' => 'report-appointments-calender']);
  Route::get('report/appointments', ['uses' => 'App\Http\Controllers\AppointmentController@get_appointment_list', 'as' => 'report-appointments']);
  Route::get('report/lab_investigation', ['uses' => 'App\Http\Controllers\AppointmentController@lab_investigation', 'as' => 'report-lab_investigation']);
  Route::get('report/appointment_calendar', ['uses' => 'App\Http\Controllers\CalendarController@index', 'as' => 'app_calendar']);
  Route::get('report/app_count_calendar', ['uses' => 'App\Http\Controllers\CalendarController@app_calendar', 'as' => 'app_count_calendar']);
  Route::get('report/normal_calender', ['uses' => 'App\Http\Controllers\CalendarController@normal_calender', 'as' => 'normal_calender']);
  Route::get('report/pcr_calendar', ['uses' => 'App\Http\Controllers\CalendarController@pcr_calendar', 'as' => 'pcr_calendar']);
  Route::get('report/other_calendar', ['uses' => 'App\Http\Controllers\CalendarController@other_calendar', 'as' => 'other_calendar']);
  Route::get('report/viral_load', ['uses' => 'App\Http\Controllers\CalendarController@viral_load', 'as' => 'viral_load']);
  Route::get('report/lab_calendar', ['uses' => 'App\Http\Controllers\CalendarController@lab_calendar', 'as' => 'lab_calendar']);
  Route::get('report/adherence_calendar', ['uses' => 'App\Http\Controllers\CalendarController@adherence_calendar', 'as' => 'adherence_calendar']);
  Route::get('report/clinical_calendar', ['uses' => 'App\Http\Controllers\CalendarController@clinical_calendar', 'as' => 'clinical_calendar']);
  Route::get('report/refill_calendar', ['uses' => 'App\Http\Controllers\CalendarController@refill_calendar', 'as' => 'refill_calendar']);
  Route::get('report/refill_apps', ['uses' => 'App\Http\Controllers\CalendarController@refill_apps', 'as' => 'refill_apps']);
  Route::get('report/vl_cd_calendar', ['uses' => 'App\Http\Controllers\CalendarController@vl_cd_calendar', 'as' => 'vl_cd_calendar']);

  // wellness routes
  Route::get('report/ok_clients', ['uses' => 'App\Http\Controllers\WellnessController@get_ok_clients', 'as' => 'report-ok_clients']);
  Route::get('report/not_ok_clients', ['uses' => 'App\Http\Controllers\WellnessController@get_not_ok_clients', 'as' => 'report-not_ok_clients']);
  Route::get('report/unrecognised_response', ['uses' => 'App\Http\Controllers\WellnessController@get_unrecoginised_clients', 'as' => 'report-unrecognised_response']);

  // grouping routes
  Route::get('report/adolescent_clients', ['uses' => 'App\Http\Controllers\GroupController@get_adolescents_clients', 'as' => 'report-adolescent_clients']);
  Route::get('report/pmtct_clients', ['uses' => 'App\Http\Controllers\GroupController@get_pmtct_clients', 'as' => 'report-pmtct_clients']);
  Route::get('report/adults_clients', ['uses' => 'App\Http\Controllers\GroupController@get_psc_clients', 'as' => 'report-adults_clients']);
  Route::get('report/paeds_clients', ['uses' => 'App\Http\Controllers\GroupController@get_paeds_clients', 'as' => 'report-paeds_clients']);
  Route::get('admin/groups', ['uses' => 'App\Http\Controllers\GroupController@index', 'as' => 'admin-groups']);

  //routes for bulk clients upload
  Route::get('/upload/clients/form', ['uses' => 'App\Http\Controllers\BulkUploadController@uploadClientForm', 'as' => 'upload-clients-form']);
  Route::post('/import/client/file', ['uses' => 'App\Http\Controllers\BulkUploadController@importClients', 'as' => 'client-file-import']);
  Route::get('/download/client/template', ['uses' => 'App\Http\Controllers\BulkUploadController@downloadClientTemplate', 'as' => 'client-template-download']);


  // PMTCT routes
  Route::get('/get_pmtct_clients_data', ['uses' => 'App\Http\Controllers\PmtcController@get_pmtct_clients_data', 'as' => 'get_pmtct_clients_data']);
  Route::get('/report/pmtct/defaulter/dairy', ['uses' => 'App\Http\Controllers\PmtcController@pmtct_defaulter_dairy', 'as' => 'report-pmtct-defaulter-dairy']);
  Route::get('/report/pmtct/appointment/dairy', ['uses' => 'App\Http\Controllers\PmtcController@pmtct_appointment_dairy', 'as' => 'report-pmtct-appointment-dairy']);
  Route::get('/report/pmtct/summary', ['uses' => 'App\Http\Controllers\PmtcController@pmtct_dashboard', 'as' => 'report-pmtct-summary']);
  Route::get('/pmtct/summary', ['uses' => 'App\Http\Controllers\FilterController@filter_pmtct_dashboard', 'as' => 'filter-pmtct-summary']);
  Route::get('/report/hei/summary', ['uses' => 'App\Http\Controllers\PmtcController@hei_dashboard', 'as' => 'report-hei-summary']);

  Route::get('/report/all_heis', ['uses' => 'App\Http\Controllers\PmtcController@get_all_hei', 'as' => 'report-all_heis']);
  Route::get('/report/hei/appointment/dairy', ['uses' => 'App\Http\Controllers\PmtcController@hei_appointment_dairy', 'as' => 'report-hei-appointment-dairy']);
  Route::get('/report/hei/defaulter/dairy', ['uses' => 'App\Http\Controllers\PmtcController@hei_defaulter_dairy', 'as' => 'report-hei-defaulter-dairy']);
  Route::get('/report/hei/final/outcome', ['uses' => 'App\Http\Controllers\PmtcController@hei_final_outcome', 'as' => 'report-hei-final-outcome']);
  Route::get('/filter_hei_dashboard', ['uses' => 'App\Http\Controllers\PmtcController@filter_hei_dashboard', 'as' => 'filter_hei_dashboard']);
  Route::get('/filter_select_pmtct_dashboard', ['uses' => 'App\Http\Controllers\PmtcController@filter_select_pmtct_dashboard', 'as' => 'filter_select_pmtct_dashboard']);

  // general reports
  Route::get('/report/deactivated_clients', ['uses' => 'App\Http\Controllers\ReportController@deactivated_clients', 'as' => 'report-deactivated_clients']);
  Route::get('/report/transfer', ['uses' => 'App\Http\Controllers\ReportController@transfer_out', 'as' => 'report-transfer']);
  Route::get('/report/today_appointments', ['uses' => 'App\Http\Controllers\ReportController@today_appointments', 'as' => 'report-today_appointments']);
  Route::get('/report/consented', ['uses' => 'App\Http\Controllers\ReportController@consented_report', 'as' => 'report-consented']);
  Route::get('/report/tracing/cost', ['uses' => 'App\Http\Controllers\TracerController@tracing_cost', 'as' => 'tracing-cost']);
  Route::get('/report/TracingOutcome', ['uses' => 'App\Http\Controllers\ReportController@tracing_outcome', 'as' => 'tracing-outcome-report']);
  Route::get('/report/MessageExtract', ['uses' => 'App\Http\Controllers\ReportController@messages_extract_report', 'as' => 'message-extract-report']);
  Route::get('/report/Users_report', ['uses' => 'App\Http\Controllers\ReportController@access_report', 'as' => 'access-report']);
  Route::get('/report/Client/Summary', ['uses' => 'App\Http\Controllers\ReportController@client_report', 'as' => 'client-summary-report']);
  Route::get('/report/Monthly/Appointment/Summary', ['uses' => 'App\Http\Controllers\ReportController@monthly_appointments', 'as' => 'monthly-appointment-summary']);


  //IL routes
  Route::get('/report/IL/dashboard', ['uses' => 'App\Http\Controllers\ILUushauriController@il_dashboard', 'as' => 'report-IL-dashboard']);
  Route::get('/filter_ildashboard', ['uses' => 'App\Http\Controllers\ILUushauriController@filter_ildashboard', 'as' => 'filter_ildashboard']);

  // Donors routes
  Route::get('/admin/donors', ['uses' => 'App\Http\Controllers\DonorController@index', 'as' => 'admin-donors']);
  Route::get('/admin/donors/form', ['uses' => 'App\Http\Controllers\DonorController@adddonorform', 'as' => 'admin-donors-form']);
  Route::post('/add/donors', ['uses' => 'App\Http\Controllers\DonorController@adddonor', 'as' => 'adddonor']);
  Route::post('/edit/donor', ['uses' => 'App\Http\Controllers\DonorController@editdonor', 'as' => 'editdonor']);
  Route::post('/delete/donor', ['uses' => 'App\Http\Controllers\DonorController@deletedonor', 'as' => 'deletedonor']);

  //Broadcast routes
  Route::get('/broadcast', ['uses' => 'App\Http\Controllers\BroadcastController@broadcast_form', 'as' => 'broadcast']);
  Route::post('/send-broadcast', ['uses' => 'App\Http\Controllers\BroadcastController@sendSMS', 'as' => 'send-broadcast']);

  // Units routes
  Route::get('/admin/units', ['uses' => 'App\Http\Controllers\UnitController@index', 'as' => 'admin-units']);
  Route::post('/admin/add/units', ['uses' => 'App\Http\Controllers\UnitController@addUnit', 'as' => 'add-units']);
  Route::post('/admin/edit/units', ['uses' => 'App\Http\Controllers\UnitController@editUnit', 'as' => 'editunits']);
  Route::post('/admin/delete/units', ['uses' => 'App\Http\Controllers\UnitController@deleteUnit', 'as' => 'delete-units']);

  // Rankss routes
  Route::get('/admin/ranks', ['uses' => 'App\Http\Controllers\RankController@index', 'as' => 'adminranks']);
  Route::post('/admin/add/ranks', ['uses' => 'App\Http\Controllers\RankController@addRank', 'as' => 'addranks']);
  Route::post('/admin/edit/ranks', ['uses' => 'App\Http\Controllers\RankController@editRank', 'as' => 'editranks']);
  Route::post('/admin/delete/ranks', ['uses' => 'App\Http\Controllers\RankController@deleteRank', 'as' => 'deleteranks']);

  // Data routes
  Route::post('/all/units', ['uses' => 'App\Http\Controllers\DataController@get_units', 'as' => 'allunits']);
  Route::post('/all/facilities', ['uses' => 'App\Http\Controllers\DataController@get_facilities', 'as' => 'allfacilities']);

  Route::post('/kdod_save', ['uses' => 'App\Http\Controllers\KdodController@update_kdod', 'as' => 'kdod_save']);
  Route::get('/unassigned_kdod', ['uses' => 'App\Http\Controllers\KdodController@unassigned_kdod', 'as' => 'unassigned_kdod']);
 // Route::get('/request/unassigned_kdod', ['uses' => 'App\Http\Controllers\KdodController@unassigned_kdod', 'as' => 'unassigned_kdod']);
});
