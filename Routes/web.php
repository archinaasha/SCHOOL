<?php



Route::get('/time', function() {
	return date('h:i A');
});


Route::get('/clear-cache', function() {
	Artisan::call('cache:clear');
	Artisan::call('config:clear');
	Artisan::call('config:cache');
	Artisan::call('view:clear');
	return "Cache is cleared";
});

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

