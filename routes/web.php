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
use Illuminate\Support\Facades\Hash;

// --DASHBOARD, LOGIN AND LOGOUT (PIC : FAJAR MARSETO)--
Route::get('/dashboard','ReminderController@show_all')->name('main')->middleware('auth');
Route::post('/dashboard/scheduleResponse', 'ReminderController@scheduleResponse')->middleware('auth');

Route::post('/logout', 'LoginController@logout');
Route::get('/hasher/{password}', function ($password) {
	return Hash::make($password);
});
Route::get('/', 'UserController@index');
// Route::get('/home', 'HomeController@index')->name('home');

//--AKTIVITAS PANGGILAN (PIC : MAKTAL SAKRIADHI)--
Route::get('/dataUser','AktivitasPanggilanController@show_all')->middleware('auth');
Route::get('/customer', 'AktivitasPanggilanController@create')->middleware('auth');
Route::post('/customer/store', 'AktivitasPanggilanController@store')->middleware('auth');
Route::get('/customer','AktivitasPanggilanController@show_all')->name('list_customers')->middleware('auth');
Route::post('/customer/storeResponse', 'AktivitasPanggilanController@storeResponse')->middleware('auth');
Auth::routes();

// --AKTIVITAS PERTEMUAN (PIC : FARHAN NURDIATAMAPAKAYA)--
// Route::get('/haha/{id}', 'AppointmentController@show')->middleware('auth');
Route::get('/users', 'UserController@show_all')->middleware('auth');
Route::get('/show/user/{id}','UserController@show')->middleware('auth');
Route::get('/create/user/{name}','UserController@store')->middleware('auth');
Route::get('/qt', 'AppointmentController@store')->middleware('auth');
Route::get('/appointment/{user_id}','AppointmentController@create')->name('make_appointment')->middleware('auth');
Route::post('/appointment/store','AppointmentController@store')->middleware('auth');
Route::get('/appointment/{user_id}','AppointmentController@create')->middleware('auth');
Route::get('/test/{id}','UserController@test');

// --TARGET CONTROLLER (PIC : FAIZ MUHAMMAD REFANO DAN FARHAN NURDIATAMAPAKAYA)
Route::get('/setTarget/product','TargetController@create')->middleware('auth');
Route::post('/setTarget/product/store','TargetController@store')->middleware('auth');


Route::get('/customer','CustomerController@show_all');
Route::get('/appointment/{user_id}','AppointmentController@create');

// --PENGELOLAAN PROSPECT (PIC : FAIZ MUHAMMAD REFANO)--
Route::get('/customer/{id}','CustomerController@show')->name('profile-prospect')->middleware('auth');
Route::post('/prospect/StoreProspect','AktivitasPanggilanController@storeProspect')->middleware('auth');
Route::get('/prospect/form','AktivitasPanggilanController@show')->middleware('auth');
Route::get('/customer','AktivitasPanggilanController@show_all')->name('list_customers')->middleware('auth');
Route::post('/customer/storeCsv','AktivitasPanggilanController@storeCsv');
Route::post('/customer/willingnessResponse','CustomerController@updateWillingness');

Route::post('/customer/storeExistingCust','CustomerController@store_response_ex_cust')->middleware('auth');

// --PENGELOLAAN PESAN (PIC : ICHSANDY RIZKI)--

Route::post('/messageInbox/store/{id}','MessageController@store')->middleware('auth');
Route::get('show/messageInbox','MessageController@showInbox')->name('show-inbox')->middleware('auth');
Route::get('show/messageSent','MessageController@showSent')->middleware('auth');
Route::get('show/message/{id}','MessageController@showMessage')->middleware('auth');
Route::get('show/message2/{id}','MessageController@showMessage2')->middleware('auth');

// --PENGELOLAAN DATA PEMESANAAN (PIC : AHMAD FARHAN HASANUDDIN ACHSANI)--
Route::get('/pemesanan/{id}','PemesananController@show')->middleware('auth');
Route::get('/pemesanan','PemesananController@show_all')->middleware('auth');
Route::get('/pemesanan/create','PemesananController@create')->middleware('auth');
Route::get('/formpemesanan','PemesananController@index')->middleware('auth');
Route::get('/generateUC/{id_pl}/{id_customer}','PemesananController@generateUniqueCode')->name('unique_code')->middleware('auth');


// --MENAMPILKAN DATA TRANSAKSI (PIC : MAKTALSAKRIADHI)--
Route::get('/dataTransaksi','DataTransaksiController@show')->middleware('auth');
Route::get('/dataTransaksi/print_PDF','DataTransaksiController@printPDF')->middleware('auth');



Route::get('/history','RiwayatController@show_all')->middleware('auth');
Route::get('/history/call/{id}','RiwayatController@show_call')->middleware('auth');
Route::get('/history/appointment/{id}','RiwayatController@show_appointment')->middleware('auth');
