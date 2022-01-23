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
Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
Route::put('/update_profile/{id}', [UserController::class, 'update_profile'])->name('user.update_profile');
Route::put('/update_member_profile/{id}', [UserController::class, 'update_member_profile'])->name('user.update_member_profile');

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
        Route::get('/borrow_log/member_list', [BorrowLogController::class, 'member_list'])->name('borrow_log.member_list');
        Route::get('/borrow_log/member_detail/{member_id}', [BorrowLogController::class, 'member_detail'])->name('borrow_log.member_detail');
        Route::get('/borrow_log/borrowed_books/{member_id}', [BorrowLogController::class, 'borrowed_books'])->name('borrow_log.borrowed_books');
        Route::get('/borrow_log/borrow/{member_id}', [BorrowLogController::class, 'borrow'])->name('borrow_log.borrow');
        Route::get('/borrow_log/on_borrow/{member_id}/{book_id}', [BorrowLogController::class, 'on_borrow'])->name('borrow_log.on_borrow');
        Route::get('/borrow_log/on_return/{member_id}/{book_id}/{borrow_id}', [BorrowLogController::class, 'on_return'])->name('borrow_log.on_return');
        Route::get('/borrow_log/on_extend/{member_id}/{book_id}/{borrow_id}', [BorrowLogController::class, 'on_extend'])->name('borrow_log.on_extend');
        Route::post('/borrow_log/on_preview_report', [BorrowLogController::class, 'on_preview_report'])->name('borrow_log.on_preview_report');
        Route::post('/borrow_log/on_export_report/{type}', [BorrowLogController::class, 'on_export_report'])->name('borrow_log.on_export_report');
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