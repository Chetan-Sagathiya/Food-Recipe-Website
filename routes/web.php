<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\IsLogin;
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


Route::get('/index', [MainController::class, 'index'])->name('index');
Route::get('/login', [MainController::class, 'login'])->name('login');
Route::get('/register', [MainController::class, 'register'])->name('register');
Route::post('/post-register', [MainController::class, 'postRegister'])->name('post-register');
Route::post('/post-login', [MainController::class, 'postLogin'])->name('post-login');
Route::get('/forgetPassword', [MainController::class, 'forgetPassword'])->name('forget-password');
Route::post('/post-forgetPassword', [MainController::class, 'postForgetPassword'])->name('post-forget-password');
Route::get('/setPassword/{mail}', [MainController::class, 'setPassword'])->name('setPassword');
Route::post('/post-setPassword/{id}', [MainController::class, 'postSetPassword'])->name('post-set-password');
Route::get('verifyUser/{token}', [MainController::class, 'verifyUser'])->name('verifyUser');
Route::get('/show-recipe/{id}', [MainController::class, 'showRecipe'])->name('showRecipe');
Route::post('/search-categories', [MainController::class, 'searchCategories'])->name('search-categories');
Route::post('/search-by-categories', [MainController::class, 'searchByCategories'])->name('search-by-category');


Route::middleware([IsLogin::class])->group(function () {
    Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');
    Route::get('/add-recipe', [MainController::class, 'addRecipe'])->name('add-recipe')->middleware('is_login');
    Route::post('/post-add-recipe', [MainController::class, 'postAddRecipe'])->name('post-add-recipe');
    Route::post('/storeAjaxComment', [MainController::class, 'storeAjaxComment'])->name('ajax.comment.store');
    Route::post('/favoriteRecipe', [MainController::class, 'favoriteRecipe'])->name('favorite.recipe');
    Route::get('/favorites', [MainController::class, 'Favorite'])->name('favorite');
    });


Route::get('/admin-login', [AdminController::class, 'adminLogin'])->name('adminLogin');
Route::post('/post-admin-login', [AdminController::class, 'postAdminLogin'])->name('post-admin-login');
Route::get('/admin/users/{name}', [AdminController::class, 'showUser'])->name('show-user');
Route::get('/admin/users', [AdminController::class, 'displayUsers'])->name('display-users');
Route::get('/admin/latest-recipes', [AdminController::class, 'latestRecipes'])->name('latest-recipes');
Route::post('/update-isActive', [AdminController::class, 'updateIsActive'])->name('update-isactive');
Route::post('/gitfUser', [AdminController::class, 'gitfUser'])->name('gitfUser');
Route::post('/sendGift', [AdminController::class, 'sendGift'])->name('send-gift');
