<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowLogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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
    return redirect('/member/login');
});

Route::prefix('member')->group(function () {
    Route::get('/login', [MemberController::class, 'login'])->name('member.login');
    Route::get('/register', [MemberController::class, 'register'])->name('member.register');
    Route::get('/dashboard', [DashboardController::class, 'member'])->name('dashboard.member');
    Route::get('/borrow_log/report', [BorrowLogController::class, 'report'])->name('member.borrow_log_report');
});

Route::prefix('admin')->group(function () {
    Route::get('/register', [UserController::class, 'register'])->name('user.register');
    Route::get('/login', [UserController::class, 'login'])->name('user.login');
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::get('/borrow_log/report', [BorrowLogController::class, 'report'])->name('borrow_log.report');
    
    Route::resources([
        'member' => MemberController::class,
        'author' => AuthorController::class,
        'category' => CategoryController::class,
        'book' => BookController::class,
        'borrow_log' => BorrowLogController::class,
        'role' => RoleController::class,
        'user' => UserController::class
    ]);
});



