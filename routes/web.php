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

Route::get('/', 'HomeController@index');

/*** Le projet ***/
Route::resource('projet', 'ProjetController');
/*** La maison ***/
Route::resource('maison', 'MaisonController');
/*** Le devis ***/
Route::resource('devis', 'DevisController');

Route::resource('pdf', 'PdfController');

Route::resource('client', 'ClientController');

Route::resource('produit', 'ProduitController');

Route::resource('composant', 'ComposantController');




Auth::routes();
