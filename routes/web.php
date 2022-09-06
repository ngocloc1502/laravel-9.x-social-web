<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

require __DIR__.'/auth.php';

// Auth::routes();

Route::middleware('auth')->controller(App\Http\Controllers\UserController::class)->group(function() {
    Route::get('/profile', 'index')->name('profile');

    Route::get('/profile/{id}', 'index')->name('profile.show');
    
    Route::get('/setting', 'edit')->name('setting');

    Route::put('/setting', 'update')->name('user.update');
});

Route::middleware('auth', 'role:administrator')->controller(App\Http\Controllers\ReportController::class)->group(function() {
    Route::get('/reports', 'index')->name('reports');
    
    Route::get('/report/topview', 'viewTop');
});

Route::middleware('auth')->controller(App\Http\Controllers\BlogController::class)->group(function() {
    Route::get('/blogs', 'index');

    Route::get('/blogs/create', 'create');

    Route::post('/blogs', 'store')->name('blog.create');
    
    Route::get('/blogs/{id}', 'index')->name('blog.show');

    Route::get('/blogs/{id}/edit', 'edit');

    Route::put('/blogs/{id}', 'update')->name('blog.update');

    Route::delete('/blogs/{id}', 'destroy')->name('blog.delete');

    Route::post('/blogs/{id}/comments', 'storeComment')->name('blog.createComment');

    Route::put('/blogs/{postId}/comments/{commentId}', 'updateComment')->name('blog.updateComment');

    Route::delete('/blogs/{postId}/comments/{commentId}', 'destroyComment')->name('blog.deleteComment');

    Route::get('/blogs/{id}/likes', 'storeLike')->name('blog.createLike');

    Route::get('/blogs/{id}/hidden', 'hiden')->name('blog.hidden');
    
    Route::get('/blogs/{id}/report', 'report');

    Route::post('/blogs/{id}/report', 'storeReport')->name('blog.report');
});


Route::controller(App\Http\Controllers\NewsController::class)->group(function() {
    Route::get('/news/create', 'create')->middleware('auth');

    Route::post('/news', 'store')->name('news.create');

    Route::get('/', 'index');

    Route::get('/news', 'index');

    Route::get('/news/{id}', 'index')->name('news.show');

    Route::get('/news/{id}/edit', 'edit')->name('news.edit');

    Route::put('/news/{id}', 'update')->name('news.update');

    Route::delete('news/{id}', 'destroy')->name('news.delete');

    Route::post('news/{id}/comments', 'storeComment')->name('news.createComment');

    Route::put('news/{postId}/comments/{commentId}', 'updateComment')->name('news.updateComment');

    Route::delete('news/{postId}/comments/{commentId}', 'destroyComment')->name('news.deleteComment');

    Route::get('/news/{id}/hidden', 'hiden')->name('news.hidden');
    
    Route::get('/news/{id}/report', 'report');

    Route::post('/news/{id}/report', 'storeReport')->name('news.report');
});

Route::middleware('auth', 'role:moderator')->controller(App\Http\Controllers\UserProgressController::class)->group(function() {
    Route::get('/notifications', 'index');

    Route::get('/progress/{id}/report', 'index')->name('progress.show');

    Route::post('/progress/{id}', 'store')->name('progress.create');

    Route::get('/progress/{id}/edit', 'edit')->name('progress.edit');

    Route::put('/progress/{id}', 'update')->name('progress.update');

    Route::delete('/progress/{id}', 'destroy')->name('progress.delete');
});

Route::get('/categories/{name}', [App\Http\Controllers\CategoriesController::class, 'index']);

Route::get('/search', [App\Http\Controllers\CategoriesController::class, 'search'])->name('search');
