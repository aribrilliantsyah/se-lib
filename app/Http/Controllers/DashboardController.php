<?php

namespace App\Http\Controllers;

use App\Helpers\Dummy;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a dashboard admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin() {
        $data = [
            'borrowing_history' => Dummy::borrowing_history(),
            'popular_books' => Dummy::popular_books()
        ];

        return view('pages.dashboard.admin', $data);
    }

    public function member() {
        return view('pages.dashboard.member');
    }
}
