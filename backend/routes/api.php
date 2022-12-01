<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
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

// Public routes
Route::post('register', [AuthController::class, 'Register']);
Route::post('login', [AuthController::class, 'Login']);
Route::post('logout', [AuthController::class, 'Logout']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('book')->group(function () {
        Route::post('/add', [BookController::class, 'AddBook']);
        Route::get('/{bookId}', [BookController::class, 'GetBook']);
        Route::post('/update/{bookId}', [BookController::class, 'UpdateBook']);
        Route::delete('/delete/{bookId}', [BookController::class, 'DeleteBook']);

        Route::post('/search', [BookController::class, 'SearchBooks']);
    });

    Route::get('/test', function () {
        return "test";
    });
});

Route::middleware('auth:api')->get('/user', function(Request $request) {
    return $request->user();
});
