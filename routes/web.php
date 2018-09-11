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

Route::get('/', function () {
    return redirect()->action(
        'HomeController@showLogin'
    );
});

//login routes:
Route::get('login', array('uses' => 'HomeController@showLogin'));
Route::post('login', array('uses' => 'HomeController@doLogin'));
Route::get('logout', array('uses' => 'HomeController@doLogout'));

Route::post('/makeorder', 'OrderController@makeOrder');
Route::get('/myorders','OrderController@listOrders');
Route::get('/booklist', 'OrderController@booklist');
Route::get('/orders', 'OrderController@showOrders');
Route::post('/acceptorder', 'OrderController@acceptOrder');
Route::post('/rejectorder', 'OrderController@rejectOrder');


Route::get('/availablebooks', 'BookController@librarianBookList');
Route::get('/booked', 'BookController@bookedBooks');

Route::post('/extendbooking', 'BookedController@extendBooking');
Route::post('/closebooking', 'BookedController@closeBooking');

Route::get('/addstudent', 'UserController@addStudentView');
Route::post('/addstudent', 'UserController@addStudent');

Route::get('/addbook', 'BookController@addBookView');
Route::post('/addbook', 'BookController@addBook');


Route::post('/deletebook', 'BookController@deleteBook');
Route::get('/books', 'UserController@getAdminView');

Route::get('/accesserror', function () {
    return view('error');
});

Route::get('/send', 'UserController@sendMail');
Route::get('/addimage', 'BookController@addimageView');
Route::post('/addimage', 'BookController@addimage');
