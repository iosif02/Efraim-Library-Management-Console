<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EntityController;
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
    Route::prefix('books')->group(function () {
        Route::get('/homepage', [BookController::class, 'GetHomepage']);
        Route::post('/delayed-books', [BookController::class, 'SearchDelayedBooks']);
        Route::post('/popular-books', [BookController::class, 'SearchPopularBooks']);
        Route::post('/categories', [BookController::class, 'SearchCategories']);
        Route::post('/recommended-books', [BookController::class, 'SearchRecommendedBooks']);

        Route::post('/add', [BookController::class, 'AddBook']);
        Route::get('/{bookId}', [BookController::class, 'GetBook']);
        Route::post('/update/{bookId}', [BookController::class, 'UpdateBook']);
        Route::delete('/delete/{bookId}', [BookController::class, 'DeleteBook']);

        Route::post('/add-category', [BookController::class, 'AddCategory']);
        Route::post('/update-category/{bookId}', [BookController::class, 'UpdateCategory']);
        Route::delete('/delete-category/{bookId}', [BookController::class, 'DeleteCategory']);

        Route::post('/search', [BookController::class, 'SearchBooks']);
    });

    Route::prefix('entities')->group(function () {
        Route::prefix('authors')->group(function (){
            Route::post('/search', [EntityController::class, 'SearchAuthors']);
            Route::post('/add', [BookController::class, 'AddAuthor']);
            Route::post('/update/{bookId}', [BookController::class, 'UpdateAuthor']);
            Route::delete('/delete/{bookId}', [BookController::class, 'DeleteAuthor']);
        });
        Route::prefix('publisher')->group(function (){
            Route::post('/search', [EntityController::class, 'SearchPublisher']);
            Route::post('/add', [BookController::class, 'AddPublisher']);
            Route::post('/update/{bookId}', [BookController::class, 'UpdatePublisher']);
            Route::delete('/delete/{bookId}', [BookController::class, 'DeletePublisher']);
        });
        Route::prefix('category')->group(function (){
//            Route::post('/search', [EntityController::class, 'SearchCategory']);
            Route::post('/add', [BookController::class, 'AddCategory']);
            Route::post('/update/{bookId}', [BookController::class, 'UpdateCategory']);
            Route::delete('/delete/{bookId}', [BookController::class, 'DeleteCategory']);

        });
    });
});

Route::middleware('auth:api')->get('/user', function(Request $request) {
    return $request->user();
});
