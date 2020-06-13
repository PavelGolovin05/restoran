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
Auth::routes();
//Стартовая страница
Route::group(['prefix'=>'dishes'], function () {
    Route::get('/alldishes', 'DishesController@indexAction')->name('alldishes');
    Route::get('/dish/{id}', 'DishesController@dishAction')->name('dish');
    Route::get('/findDish', 'DishesController@findDishesAction')->name('find_dish');
});

Route::group(['prefix'=>'reservations','middleware'=>'auth'], function (){
   Route::get('/index','ReservationController@indexAction')->name('reservation_halls');
   Route::get('/hall/', 'ReservationController@tablesAction')->name('reservation');
   Route::any('/addReservation/','ReservationController@addReservationAction')->name('add_reservation');
   Route::any('/myReservations/','ReservationController@myReservationsAction')->name('myReservation');
});

Route::get('/main', 'HomeController@indexAction')->name('mainPage');
Route::get('/about', 'HomeController@aboutAction')->name('about');
Route::get('/stat','StatisticController@indexAction')->name('statistic');
Route::get('/statByParam','StatisticController@paramAction')->name('statisticParam');
Route::get('/halls/index','HallsController@indexAction')->name('halls');

Route::group(['prefix'=>'events','middleware'=>'auth'], function (){
    Route::get('/index','EventController@indexAction')->name('events');
    Route::get('/addEvent','EventController@addEventAction')->name('addEvent');
    Route::get('/myEvents','EventController@myEventsAction')->name('myEvents');
    Route::get('/dishes','EventController@dishesAction')->name('dishes');
    Route::get('/findDish','EventController@findDishesAction')->name('findDish');
    Route::get('/addDishes','EventController@addDishesAction')->name('addDishes');
});

Route::get('logout','Auth\LoginController@logout');

Route::group(['prefix'=>'admin','middleware'=>'auth'], function (){
    Route::get('/index','AdminController@indexAction');
    Route::get('/dishes','AdminController@dishesAction');
    Route::get('/category','AdminController@CategoryAction');
    Route::get('/addCategory','AdminController@addCategoryAction');
    Route::get('/addDishForm','AdminController@addDishFormAction');
    Route::get('/addDish','AdminController@addDishAction');
    Route::get('/removeDishForm','AdminController@removeDishFormAction');
    Route::get('/removeDish','AdminController@removeDishAction');
    Route::get('/removeDishFromStopForm','AdminController@removeDishFromStopFormAction');
    Route::get('/removeDishFromStop','AdminController@removeDishFromStopAction');
});

