<?php

use Illuminate\Http\Request;
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

/*
    Rotas de login.
*/
Route::post('login', 'API\AuthController@login');
Route::post('signup', 'API\AuthController@signup');

/* 
    Rotas de autenticação.
*/
Route::middleware(['auth:api'])->group(function () {

    Route::get('logout', 'API\AuthController@logout');
    Route::get('user', 'API\AuthController@user');

});

/*
    Rotas de servicos
*/
Route::apiResource('service', 'API\ServiceController');
//Route::post('storeService', 'API\ServiceController@store');
//Route::put('updateService', 'API\ServiceController@update');
//Route::post('deleteService', 'API\ServiceController@destroy');
//Route::get('indexServices', 'API\ServiceController@index');
//Route::get('showService/{id}', 'API\ServiceController@show');

/*
    Rotas Imagens
*/
Route::apiResource('image', 'API\ImageController');
//Route::post('storeImage', 'API\ImageController@store');
//Route::put('updateImage', 'API\ImageController@update');
//Route::post('deleteImage', 'API\ImageController@destroy');
//Route::get('indexImages', 'API\ImageController@index');
//Route::get('showImage/{id}', 'API\ImageController@show');

/*
    Rotas de Depoimentos
*/
Route::apiResource('testimony', 'API\TestimonyController');
//Route::post('storeTestimony', 'API\TestimonyController@store');
//Route::put('updateTestimony', 'API\TestimonyController@update');
//Route::post('deleteTestimony', 'API\TestimonyController@destroy');
//Route::get('indexTestimonies', 'API\TestimonyController@index');
//Route::get('showTestimony/{id}', 'API\TestimonyController@show');

/*
    Rotas de Categorias
*/
Route::apiResource('category', 'API\CategoryController');
//Route::post('storeCategory', 'API\CategoryController@store');
//Route::put('updateCategory', 'API\CategoryController@update');
//Route::post('deleteCategory', 'API\CategoryController@destroy');
//Route::get('indexCategories', 'API\CategoryController@index');
//Route::get('showCategory/{id}', 'API\CategoryController@show');

/*
    Rotas de Portfolio
 */
Route::apiResource('portfolio', 'API\PortfolioController');
//Route::post('storePortfolio', 'API\PortfolioController@store');
//Route::put('updatePortfolio', 'API\PortfolioController@update');
//Route::post('deletePortfolio', 'API\PortfolioController@destroy');
//Route::get('indexPortfolio', 'API\PortfolioController@index');
//Route::get('showPortfolio/{id}', 'API\PortfolioController@show');

/*
Rotas de mensagens
*/
Route::apiResource('message','API\MessageController');

/*
    Rotas de equipe
 */
Route::apiResource('team','API\TeamController');
