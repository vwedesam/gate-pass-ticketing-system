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

Route::resource('/ticket', 'TicketController')
				->except(['create', 'show'])
				->middleware('active_user');

Route::resource('/issued-ticket', 'IssuedTicketController')
				->only(['show', 'store'])
				->middleware('active_user');
Route::resource('/ticket-setup', 'TicketSetupController')
				->except(['create', 'show'])
				->middleware('active_user');
Route::resource('/user', 'UserController')
				->only(['index', 'show', 'store', 'edit', 'update', 'destroy'])
				->middleware('active_user');
Route::resource('/role', 'RoleController')
				->only(['index', 'store', 'show'])
				->middleware('active_user');
Route::resource('/permission', 'PermissionController')
				->only(['update'])
				->middleware('active_user');

// Organization Info
Route::get('/app-setup', 'OrganizationInfoController@index')
				->name('app_setup.index')
				->middleware('active_user');
Route::post('/organization/update/{id}', 'OrganizationInfoController@update')
				->name('organization.update')
				->middleware('active_user');

Route::delete('/issued-ticket/destroy', 'IssuedTicketController@multiDelete')
				->name('issued-ticket.multiDelete')
				->middleware('active_user');
Route::delete('/issued-ticket/truncate', 'IssuedTicketController@truncate')
				->name('issued-ticket.truncate')->middleware('active_user');
Route::get('/print/issued-ticket/{id}', 'IssuedTicketController@print')
				->name('issued-ticket.print')
				->middleware('active_user');
// report Route
Route::get('/reports', 'ReportController@index')
				->name('reports.index')
				->middleware('active_user');
Route::get('/print/reports/{date}', 'ReportController@print')
				->name('reports.print')
				->middleware('active_user');

Auth::routes();

Route::get('/', 'HomeController@index')
				->name('home')
				->middleware('active_user');
