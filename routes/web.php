<?php

Auth::routes();
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('contacts', 'Api\ContactsController@index')->name('contacts.index');
Route::post('contacts/update/{id}', 'ContactsController@update')->name('contacts.update');
Route::post('contacts/delete', 'ContactsController@destroy')->name('contacts.delete');
Route::post('contacts/store', 'ContactsController@store')->name('contacts.store');

