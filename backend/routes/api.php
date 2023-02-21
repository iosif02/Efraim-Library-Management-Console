<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
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
        Route::post('/recommended-books', [BookController::class, 'SearchRecommendedBooks']);

        Route::post('/add', [BookController::class, 'AddBook']);
        Route::get('/{bookId}', [BookController::class, 'GetBook']);
        Route::post('/update', [BookController::class, 'UpdateBook']);
        Route::delete('/delete/{bookId}', [BookController::class, 'DeleteBook']);
        Route::post('/search', [BookController::class, 'SearchBooks']);

        Route::post('/borrow', [BookController::class, 'BorrowBook']);
        Route::post('/return', [BookController::class, 'ReturnBook']);

    });

    Route::prefix('entities')->group(function () {
        Route::prefix('authors')->group(function (){
            Route::post('/search', [EntityController::class, 'SearchAuthors']);
            Route::post('/add-author', [EntityController::class, 'AddAuthor']);
            Route::post('/update-author', [EntityController::class, 'UpdateAuthor']);
            Route::delete('/delete-author/{authorId}', [EntityController::class, 'DeleteAuthor']);
        });
        Route::prefix('publishers')->group(function (){
            Route::post('/search', [EntityController::class, 'SearchPublisher']);
            Route::post('/add-publisher', [EntityController::class, 'AddPublisher']);
            Route::post('/update-publisher', [EntityController::class, 'UpdatePublisher']);
            Route::delete('/delete-publisher/{publisherId}', [EntityController::class, 'DeletePublisher']);
        });
        Route::prefix('categories')->group(function (){
            Route::post('/search', [EntityController::class, 'SearchCategories']);
            Route::post('/add-category', [EntityController::class, 'AddCategory']);
            Route::post('/update-category', [EntityController::class, 'UpdateCategory']);
            Route::delete('/delete-category/{categoryId}', [EntityController::class, 'DeleteCategory']);
        });
    });

    Route::prefix('user')->group(function () {
        Route::get('users', [UserController::class, 'GetUsers']);
        Route::post('/add-user', [UserController::class, 'AddUser']);
        Route::post('/update-user', [UserController::class, 'UpdateUser']);
        Route::delete('/delete-user/{userId}', [UserController::class, 'DeleteUser']);
    });

});

Route::middleware('auth:api')->get('/user', function(Request $request) {
    return $request->user();
});
