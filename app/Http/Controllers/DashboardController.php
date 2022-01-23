<?php

namespace App\Http\Controllers;

use App\Helpers\AuthCommon;
use App\Helpers\Dummy;
use App\Models\Book;
use App\Models\BorrowLog;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a dashboard admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin() {
        $popular_book = DB::table('borrow_logs')
        ->select('borrow_logs.book_id', DB::raw('count(*) as total'), 'books.book as title')
        ->leftJoin('books','books.id', '=', 'borrow_logs.book_id')
        ->groupBy('borrow_logs.book_id', 'books.book')
        ->get();

        $data = [
            'borrowing_history' => BorrowLog::with(['book', 'member'])->limit(10)->orderBy('created_at', 'desc')->get(),
            'popular_books' => $popular_book,
            'total_borrowed' =>BorrowLog::all()->count(),
            'total_member' => Member::all()->count(),
            'total_admin' => User::all()->count(),
            'total_returned' => BorrowLog::where('is_returned', 1)->get()->count(),
        ];

        // dd($data);
        return view('pages.dashboard.admin', $data);
    }

    public function member() {
        $member_id = AuthCommon::user()->member->id;

        $data = [
            'total_borrowed' => BorrowLog::where('member_id', '=', $member_id)->get()->count(),
            'total_returned' => BorrowLog::where('member_id', '=', $member_id)->where('is_returned', '=', 1)->get()->count(),
            'late_return' => BorrowLog::where('member_id', '=', $member_id)
                                    ->where('is_returned', '=', 1)
                                    ->where('updated_at', '>', 'return_estimate')
                                    ->get()->count(),
            'timely_return' => BorrowLog::where('member_id', '=', $member_id)
                                    ->where('is_returned', '=', 1)
                                    ->where('updated_at', '<=', 'return_estimate')
                                    ->get()->count(),
        ];

        return view('pages.dashboard.member', $data);
    }
}
