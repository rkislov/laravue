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

Route::post('/register', 'API\AuthController@register');
Route::post('/login', 'API\AuthController@login');

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', 'API\AuthController@logout');
    Route::post('/get-user', 'API\AuthController@getUser');
    Route::get('/categories', 'API\CategoryController@all');
    Route::post('/new_ticket_store', 'API\TicketController@create');
    Route::post('/new_comment', 'API\CommentController@create');
    Route::get('/comments/{id}', 'API\CommentController@ticketComments');
    Route::get('/tickets/{id}', 'API\TicketController@userTickets');
    Route::get('/ticket/{id}', 'API\TicketController@showTicket');
    Route::put('/closeticket/{id}', 'API\TicketController@closeTicket');


});
