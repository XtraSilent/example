<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

###########################################################
Route::get('/getpost', [PostController::class, 'getData']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);
###########################################################

################################################################
Route::get('/getcomment', [CommentController::class, 'getData']);
Route::get('/comments', [CommentController::class, 'index']);
Route::post('/comment', [CommentController::class, 'getComment']);
################################################################