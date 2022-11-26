<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;


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

Route::group(['prefix' => '/news'], function () {
    Route::get('/create', [NewsController::class, 'create']);
    Route::post('/store', [NewsController::class, 'store']);
    Route::get('/show/{id}', [NewsController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [NewsController::class, 'edit']);
    Route::put('/{id}', [NewsController::class, 'update']);
    Route::get('/{id}/delete', [NewsController::class, 'delete']);

});

// Route::get('/', function () {
//     return view('main/main');
// });

Route::get('/auth/reg', [AuthController::class, 'create']);
Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/reg', [AuthController::class, 'store']);
Route::post('/auth/login', [AuthController::class, 'customLogin']);
Route::get('/auth/logout', [AuthController::class, 'logout']);

Route::get('/', [Controller::class, 'index']);


Route::get('/news', [NewsController::class, 'index']);

Route::resource('comment', CommentController::class);

Route::get('/about', function () {
    return view('main/about');
});

Route::get('/gallery/{full}', [NewsController::class, 'image']);


Route::get('/contact', function () {
    $contact = [
        'name' => 'Андрей Киверин Александрович',
        'adress' => 'ул. Прянишникова, д.2а',
        'phone' => '+7(987)654-32-10',
        'email' => 'akiverin@stud.mospolytech.ru',
    ];
    return view('main/contact', ['contact' => $contact]);
});

Route::get('/view', [AuthController::class, 'view']);
Route::post('/signin', [AuthController::class, 'signin']);