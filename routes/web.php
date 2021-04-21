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

Route::get('/time', function() {
	return date('h:i A');
});

Route::get('/frontendtestget', 'Login@frontendtestget');
Route::post('/frontendtestpost', 'Login@frontendtestpost');

Route::get('/clear-cache', function() {
	Artisan::call('cache:clear');
	Artisan::call('config:clear');
	Artisan::call('config:cache');
	Artisan::call('view:clear');
	return "Cache is cleared";
});

Route::get('/', 'Login@index');
Route::get('/login', 'Login@index');

Route::post('/loginCheck', 'Login@loginCheck');



Route::group(['middleware' => 'admin'], function () {

	Route::get('/logout', 'Login@logout');
	Route::get('/welcome', 'HomeController@index');

	//Student_manag
	Route::get('/students-manag','StudentsManag@index');
	Route::post('/add-student','StudentsManag@addStudent');
	Route::get('/studentDataTable','StudentsManag@studentListDataTable');
	Route::get('/getstudentById/{id}','StudentsManag@getStudentById');
	Route::post('/studentDelete','StudentsManag@studentItemDelete');



	//Fees
	//Payment
	Route::get('/payment-category','Payment@index');
	Route::post('/add-payment_category','Payment@addpayment_category');
	Route::get('/payment_categoryDataTable','Payment@payment_categoryListDataTable');
	Route::post('/payment_categoryDelete','Payment@payment_categoryItemDelete');




	//Tuition & Fees
	Route::get('/fees-book','FeesBook@index');
	Route::get('/feesBook/{id}','FeesBook@getFeesBookById');


	
	// User
	Route::get('/user', 'User@index');
	Route::get('/myProfile', 'User@myProfile');
	Route::get('/myProfileData', 'User@myProfileData');
	Route::post('/changePass', 'User@changePass');
	Route::post('/addNewUser', 'User@addNewUser');
	Route::get('/userListDataTable', 'User@userListDataTable');
	Route::get('/getUserDepratment', 'User@getUserDepratment');
	Route::post('/userDelete', 'User@userDelete');
	Route::post('/myProfileEdit', 'User@myProfileEdit');
	


});
