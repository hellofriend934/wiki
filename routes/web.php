<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/home',[\App\Http\Controllers\HomeController::class,'index'])->name('home');
Route::get('/article/{slug?}',[\App\Http\Controllers\ArticleController::class,'index'])->name('article');
Route::post('/comment/{id}/{type}/{reply_id?}/{reply_user_id?}',[\App\Http\Controllers\CommentsController::class,'__invoke'])->name('comment.store');
Route::get('/profile/{id?}',\App\Http\Controllers\ProfileController::class)->name('profile');
Route::get('/complaint/{slug}',[\App\Http\Controllers\ComplaintController::class,'index'])->name('complaint');
Route::post('/complaint/{slug}/store',[\App\Http\Controllers\ComplaintController::class,'store'])->name('complaint.store');
Route::get('/bookmark/add/{id}',[\App\Http\Controllers\ArticleController::class,'bookmarks'])->name('bookmark.add');
Route::get('/agrigate',[\App\Http\Controllers\AgrigateController::class,'store']);


Route::get('/author/register' ,[\Wink\Http\Controllers\RegisterController::class,'index'])->name('author.register');
Route::post('/wink/register', [\Wink\Http\Controllers\RegisterController::class,'store'])->name('author.register.store')->middleware(\Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class);

Route::get('/admin/panel',[\App\Http\Controllers\AdminController::class,'stat'])->can('block users')->name('admin.panel');
Route::post('/block/{id}',[\App\Http\Controllers\AdminController::class,'block_users'])->name('block.user');
Route::get('/delete/comment/{id}',[\App\Http\Controllers\AdminController::class,'delete_comments'])->name('delete.comment');

Route::get('/search', [\App\Http\Controllers\SearchController::class, '__invoke'])->name('search.posts');
Route::get('/clear/notification', [\App\Http\Controllers\HomeController::class, 'clear_notification'])->name('clear.notification');
