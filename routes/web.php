<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ReactionsController;

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
    return Inertia::render('Forum/container', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/forum', function () {
    return Inertia::render('Forum/container');
})->name('forum');
Route::get('/user/{id}', [PostsController::class,'getUserById']);

Route::get('/posts', [PostsController::class,'posts']);
Route::post('/post', [PostsController::class,'createPost']);
Route::get('/post/{id}', [PostsController::class,'getPost'])->name('post');

Route::post('/comments', [PostsController::class,'comments']);
Route::post('/comment', [PostsController::class,'createComment']);
Route::get('/comment/{post_id}/{id}', [PostsController::class,'getCommentById']);

Route::post('/like', [ReactionsController::class, 'fetchLike']);
Route::post('/like/{id}', [ReactionsController::class, 'handleLike']);
// Route::post(
//     '/post/{id}',
//     function () {
//         return Inertia::render(
//             'Forum/postPage',
//             [
//                 'post' => [PostsController::class,'getPost'],
//             ]
//         );
//     }
// )->name( 'post' );

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Route::get('/post/{post_id}', function () {
    //     return Inertia::render('Forum/postPage');
    // })->name('post');
});
