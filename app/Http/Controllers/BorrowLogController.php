<?php

namespace App\Http\Controllers;

use App\Helpers\Dummy;
use App\Models\BorrowLog;
use Illuminate\Http\Request;

class BorrowLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       
        return view('pages.borrow_log.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BorrowLog  $borrowLog
     * @return \Illuminate\Http\Response
     */
    public function show(BorrowLog $borrowLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BorrowLog  $borrowLog
     * @return \Illuminate\Http\Response
     */
    public function edit(BorrowLog $borrowLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BorrowLog  $borrowLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BorrowLog $borrowLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BorrowLog  $borrowLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(BorrowLog $borrowLog)
    {
        //
    }

    /**
     * Display a reporting of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function report()
    {
        //
        $data = [
            'collection' => Dummy::borrow_logs()
        ];
        return view('pages.borrow_log.report', $data);
    }
}
