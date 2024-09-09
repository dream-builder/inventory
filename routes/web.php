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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();



Route::get('/dashboard', 'DashboardController@index');
Route::get('/my_assignment', 'DashboardController@my_assignment');

Route::get('/dashboard/issue', 'DashboardController@issue');
Route::get('/dashboard/detail', 'DashboardController@detail');
Route::get('dashboard/my_pending_issue', 'DashboardController@my_pending_issue');
Route::get('/dashboard/issue_search', 'DashboardController@issue_search');
Route::get('/dashboard/goal', 'DashboardController@goal');


Route::get('/getusers', 'commentsController@get_users');

Route::get('/getzilla', 'commentsController@get_zilla');
Route::get('/getupazila', 'commentsController@get_upazila');
Route::get('/getunions', 'commentsController@get_unions');
Route::get('/getfacility', 'commentsController@get_facility');

//Route::get('/issueDetails/get_comments', 'commentsController@get_comments');
Route::get('/issueDetails/id={id}', 'commentsController@issue_details');
Route::get('/issueDetails/add_comments', 'commentsController@add_comments');
Route::get('/issueDetails/update_issue_details', 'commentsController@update_issue_details');
Route::get('/issueDetails/update_status', 'commentsController@update_status');

Route::get('/update_status', 'commentsController@update_status');
Route::get('/update_issue_details', 'commentsController@update_issue_details');
Route::get('/facility_detail', 'detailController@index');

//Profile
Route::get('/account', 'accountController@index');
Route::get('/account/password_change', 'accountController@reset_pass');
Route::get('/account/add_user', 'accountController@add_user');



Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home_1');
Route::get('/api/get_geo_code', 'HomeController@get_geo_code')->name('/api/get_geo_code');
Route::get('/api/add_facility', 'APIController@add_facility');

Route::get('/register/list', 'Auth\RegisterController@register_list')->name('register/list');

Route::get('/section', 'SectionController@index');
Route::get('/section/list_all', 'SectionController@section_list');
Route::post('/section/add_section', 'SectionController@add_section');
Route::post('/section/del', 'SectionController@del');
Route::post('/section/edit', 'SectionController@edit');
Route::post('/section/update', 'SectionController@update');


Route::get('/survey', 'SurveyController@index');
Route::post('/survey/submit', 'SurveyController@store');
Route::get('/survey/save_survey', 'SurveyController@save_survey');
Route::get('/api/get_latest_submission', 'SurveyController@getLatestData')->name('/api/get_latest_submission');
Route::get('/api/get_previous_submission', 'SurveyController@getPreviousData')->name('/api/get_previous_submission');
Route::get('/update_survey_status', 'SurveyController@update_survey_status');

Route::get('/go404', 'HomeController@go404')->name('/go404');

//Route::get('/reports/category_details', 'ReportsController@index');
Route::get('/reports/category_details', 'ReportsController@category_compare');
Route::get('/reports/year_wise_category', 'ReportsController@year_wise_category');

Route::get('/report/facilities_ajax', 'ReportsController@facilities_ajax');
Route::get('/report/', 'SurveyReportsController@index');




Route::get('/forgot_password', 'ForgotPasswordController@index');
Route::get('/forgot_password_request', 'ForgotPasswordController@send_password_reset_request');
Route::get('/reset_pass', 'ForgotPasswordController@reset_pass');
Route::get('/reset_password_change', 'ForgotPasswordController@reset_password_change');



Route::get('/create_account_request', 'RegistationController@index');
Route::get('/is_account_exists', 'RegistationController@is_account_exists');
Route::get('/create_account', 'RegistationController@create_account');

Route::get('/facility/register', 'FacilityRegistrationController@index');
Route::get('/facility/get_facility_by_id', 'commentsController@get_facility_by_id');
Route::get('/facility/info', 'FacilityController@index');
Route::get('/facility/edit', 'FacilityRegistrationController@facility_edit');
Route::get('/facility/update', 'FacilityRegistrationController@facility_update');
Route::get('/facility/delete', 'FacilityRegistrationController@facility_delete');


Route::get('/user/logindetail', 'DashboardController@logindetail');
Route::get('/profile', 'ProfileController@index');
Route::get('/profile_update', 'ProfileController@profile_update');
Route::get('/performance', 'ReportsController@performance');


Route::get('/httptest', 'WebHTTP@api');

#Fie Upload Route
Route::get('/uploadfile', 'FileUpload@index');
Route::post('/upload', 'FileUpload@upload');
Route::get('/remove_user_file', 'FileUpload@remove_user_file');

#Focal mail
Route::get('/focalpersonmail', 'FocalPersonMailController@index');
Route::get('/set_focal_person', 'FocalPersonMailController@set_focal_person');
Route::get('/del_focal_person', 'FocalPersonMailController@del_focal_person');
Route::get('/find_user', 'FocalPersonMailController@find_user');


//Org
Route::get('/assign_factory', 'AssignHsopitalController@index');
Route::get('/assign_list', 'AssignHsopitalController@assign_list');
Route::get('/register_assignment', 'AssignHsopitalController@register_assignment');
Route::get('/remove_assignment', 'AssignHsopitalController@remove_assignment');
Route::get('/assessment_status', 'AssessmentController@assessment_status');
Route::get('/assessment_status_list', 'AssessmentController@assessment_status_list');

Route::get('/preassessment', 'PreAssessmentController@index');
Route::get('/api/facility_suggestion', 'APIController@facility_suggestion');
Route::get('/api/facility_id_check', 'APIController@facility_id_check');

Route::get('/baseline_survey', 'BaselineSurveyController@index');
Route::get('/baseline_survey/list', 'BaselineSurveyController@baseline_survey_list');
Route::get('/baseline_survey/register', 'BaselineSurveyController@register');

//Organization
Route::get('/organization/profile', 'OrganizationController@profile');
Route::get('/facilities', 'ReportsController@facilities');



Route::get('/question', 'QuestionController@index');
Route::get('/question/load_by_section', 'QuestionController@load_by_section');
Route::get('/question/add_edit', 'QuestionController@add_edit');
Route::get('/question/add_update_question', 'QuestionController@add_update_question');
Route::get('/question/delete_question', 'QuestionController@delete_question');
Route::get('/question/update_serial', 'QuestionController@update_serial');



//INventory 
Route::get('/wearhouse', 'WearhouseController@index');
Route::post('/wearhouse/addnew', 'WearhouseController@addnew');


Route::get('/center', 'CenterController@index');
Route::post('/center/addnew', 'CenterController@addnew');

Route::get('/item', 'ItemController@index');
Route::post('/item/addnew', 'ItemController@addnew');

Route::get('/stock', 'StockController@index');
Route::post('/stock/addnew', 'StockController@addnew');
Route::get('/movein', 'StockController@movein');
Route::get('/stock/getitems', 'StockController@getitems');
