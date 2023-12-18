<?php

use App\Models\Comment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/blog-details', function () {
    return view('blog_details');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('category', CategoryController::class);
    Route::resource('tag', TagController::class);
    Route::resource('post', PostController::class);
    Route::resource('comment', CommentController::class);
    Route::get('/admin/comment/reply/{id}',[CommentController::class, 'AdminCommentReply'])->name('admin.comment.reply');
    Route::post('/comment/reply',[CommentController::class, 'CommentReplay'])->name('reply.comment');

    Route::get( '/changeStatus', [CommentController::class, 'changeStatus'] )->name('changeStatus');

});

Route::get('blog-details/{id}',[FrontendController::class, 'BlogDetails'])->name('blog.details');

require __DIR__.'/auth.php';
