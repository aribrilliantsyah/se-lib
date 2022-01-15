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

Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');

Route::prefix('member')->group(function () {
    Route::get('/login', [MemberController::class, 'login'])->name('member.login');
    Route::post('/login_process', [MemberController::class, 'login_process'])->name('member.login_process');
    Route::get('/register', [MemberController::class, 'register'])->name('member.register');
    
    Route::middleware(['ryuna_role:member'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'member'])->name('dashboard.member');
        Route::get('/borrow_log/report', [BorrowLogController::class, 'report'])->name('member.borrow_log_report');
    });
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('admin.login');
    Route::post('/login_process', [UserController::class, 'login_process'])->name('admin.login_process');

    Route::middleware(['ryuna_role:admin,operator'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard.admin');
        Route::get('/borrow_log/report', [BorrowLogController::class, 'report'])->name('borrow_log.report');
        Route::resources([
            'member' => MemberController::class,
            'author' => AuthorController::class,
            'category' => CategoryController::class,
            'book' => BookController::class,
            'borrow_log' => BorrowLogController::class
        ]);
    });

    Route::middleware(['ryuna_role:admin'])->group(function () {
        Route::resources([
            'user' => UserController::class
        ]);
    });
    
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['ryuna_role:admin,operator,member']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});