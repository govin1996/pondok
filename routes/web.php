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
/* Halaman Pertama */
/* Route::get('/', function () {
    return view('index');
}); */
Route::get('/', 'LoginController@dashboard');

/* Route Login */
Route::get('/dashboard', 'LoginController@dashboard');
Route::get('/login', 'LoginController@login');
Route::post('/loginPost', 'LoginController@loginPost');
Route::get('/logout', 'LoginController@logout');

/* Route Pimpinan */
Route::get('api/tampilpimpinan', 'PimpinanController@apiPimpinan')->name('api.tampilpimpinan');
Route::resource('/pimpinan', 'PimpinanController', [
    'except' => ['create']
]);

/* Route Santri */
Route::get('api/tampilsantri', 'SantriController@apiSantri')->name('api.tampilsantri');
Route::resource('/santri', 'SantriController', [
    'except' => ['create']
]);

/* Route Mahrom */
Route::get('api/tampilmahrom', 'MahromController@apiMahrom')->name('api.tampilmahrom');
Route::resource('/mahrom', 'MahromController', [
    'except' => ['create']
]);
Route::get('cari', 'MahromController@cari')->name('cari');

/* Route Mahrom Detail */
Route::get('api/mahromdetail/{id}', 'MahromDetailController@apiMahromDetail')->name('api.mahromdetail');
Route::resource('/mahromdetail/{id}', 'MahromDetailController', [
	'only' => ['index']
]);

/* Route Kamar */
Route::get('api/tampilkamar', 'KamarController@apiKamar')->name('api.tampilkamar');
Route::resource('/kamar', 'KamarController', [
    'except' => ['create']
]);

/* Route Daerah */
Route::get('api/tampildaerah', 'DaerahController@apiDaerah')->name('api.tampildaerah');
Route::resource('/daerah', 'DaerahController', [
    'except' => ['create']
]);

/* Route Jabatan */
Route::get('api/tampiljabatan', 'JabatanController@apiJabatan')->name('api.tampiljabatan');
Route::resource('/jabatan', 'JabatanController', [
    'except' => ['create']
]);

/* Route Status */
Route::get('api/tampilstatus', 'StatusController@apiStatus')->name('api.tampilstatus');
Route::resource('/status', 'StatusController', [
    'except' => ['create']
]);

/* Route Perizinan */
Route::get('api/tampilizin', 'PerizinanController@apiIzin')->name('api.tampilizin');
Route::get('api/tampilapprove/{nis}', 'PerizinanController@apiApprove')->name('api.tampilapprove');
Route::get('api/setujui/{idapprove}/{act}', 'PerizinanController@setujui')->name('api.setujui');
Route::get('api/datalengkap/{idizin}', 'PerizinanController@datalengkap')->name('api.datalengkap');
Route::get('api/pulang/{idizin}', 'PerizinanController@pulang')->name('api.pulang');
Route::resource('/izin', 'PerizinanController', [
    'except' => ['create']
]);
Route::get('carinama', 'PerizinanController@cari')->name('carinama');
Route::post('dynamic_dependent/fetch', 'PerizinanController@fetch')->name('dynamicdependent.fetch');

/* Route Peringatan Pergi */
Route::get('api/tampilperingatanpergi', 'PPergiController@apiPPergi')->name('api.tampilperingatanpergi');
Route::resource('/peringatanpergi', 'PPergiController', [
    'except' => ['create']
]);

/* Route Peringatan Pulang */
Route::get('api/tampilperingatanpulang', 'PPulangController@apiPPulang')->name('api.tampilperingatanpulang');
Route::resource('/peringatanpulang', 'PPulangController', [
    'except' => ['create']
]);