<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
Route::prefix('boards-rent')->group(function () {

    // departments routes
    Route::group(['prefix' => 'departments'], function () {
        Route::get('/', 'DepartmentController@all')->name('boards-rent.departments.all');
        Route::post('/', 'DepartmentController@create')->name('boards-rent.departments.create');
        Route::put('/{id}', 'DepartmentController@update')->name('boards-rent.departments.update');
        Route::delete("/bulk-delete", "DepartmentController@bulkDelete");
        Route::get('/logs/{id}', 'DepartmentController@logs')->name('boards-rent.departments.logs');
        Route::get('/{id}', 'DepartmentController@find')->name('boards-rent.departments.find');
        Route::delete('/{id}', 'DepartmentController@delete')->name('boards-rent.departments.delete');
    });

    // sell methods routes
    Route::group(['prefix' => 'sell-methods'], function () {
        Route::get('/', 'SellMethodController@all')->name('boards-rent.sell-methods.all');
        Route::post('/', 'SellMethodController@create')->name('boards-rent.sell-methods.create');
        Route::put('/{id}', 'SellMethodController@update')->name('boards-rent.sell-methods.update');
        Route::delete("/bulk-delete", "SellMethodController@bulkDelete");
        Route::get('/logs/{id}', 'SellMethodController@logs')->name('boards-rent.sell-methods.logs');
        Route::get('/{id}', 'SellMethodController@find')->name('boards-rent.sell-methods.find');
        Route::delete('/{id}', 'SellMethodController@delete')->name('boards-rent.sell-methods.delete');
    });

    //  sectors routes
    Route::group(['prefix' => 'sectors'], function () {
        Route::get('/', 'SectorController@all')->name('boards-rent.sectors.all');
        Route::post('/', 'SectorController@create')->name('boards-rent.sectors.create');
        Route::put('/{id}', 'SectorController@update')->name('boards-rent.sectors.update');
        Route::delete("/bulk-delete", "SectorController@bulkDelete");
        Route::get('/logs/{id}', 'SectorController@logs')->name('boards-rent.sectors.logs');
        Route::get('/{id}', 'SectorController@find')->name('boards-rent.sectors.find');
        Route::delete('/{id}', 'SectorController@delete')->name('boards-rent.sectors.delete');
    });

    // customer sources
    Route::group(['prefix' => 'customer-sources'], function () {
        Route::get('/', 'CustomerSourceController@all')->name('boards-rent.customer-sources.all');
        Route::post('/', 'CustomerSourceController@create')->name('boards-rent.customer-sources.create');
        Route::put('/{id}', 'CustomerSourceController@update')->name('boards-rent.customer-sources.update');
        Route::delete("/bulk-delete", "CustomerSourceController@bulkDelete");
        Route::get('/logs/{id}', 'CustomerSourceController@logs')->name('boards-rent.customer-sources.logs');
        Route::get('/{id}', 'CustomerSourceController@find')->name('boards-rent.customer-sources.find');
        Route::delete('/{id}', 'CustomerSourceController@delete')->name('boards-rent.customer-sources.delete');
    });

});

// customers
Route::group(['prefix' => 'general-customer'], function () {
    Route::get('/', 'CustomerController@all')->name('boards-rent.customers.all');
    Route::post('/', 'CustomerController@create')->name('boards-rent.customers.create');
    Route::put('/{id}', 'CustomerController@update')->name('boards-rent.customers.update');
    Route::delete("/bulk-delete", "CustomerController@bulkDelete");
    Route::get('/logs/{id}', 'CustomerController@logs')->name('boards-rent.customers.logs');
    Route::get('/{id}', 'CustomerController@find')->name('boards-rent.customers.find');
    Route::delete('/{id}', 'CustomerController@delete')->name('boards-rent.customers.delete');
});
