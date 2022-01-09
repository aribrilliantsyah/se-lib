<?php

namespace App\Http\Controllers;

use App\Helpers\AuthCommon;
use App\Helpers\Dummy;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = [
            'collection' => Dummy::members()
        ];
        return view('pages.member.list', $data);
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
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }

    /**
     * Login as member.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        //
        return view('auth.member.login');
    }

    /**
     * Login process for member.
     *
     * @return \Illuminate\Http\Response
     */
    public function login_proccess(Request $request)
    {
        //
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username Wajib Diisi',
            'password.required' => 'Username Wajib Diisi'
        ]);

        $credential = $request->only('username','password');
        
        if(AuthCommon::check_credential($credential)){
            return redirect('/member/dashboard');
        }

        return redirect('login')
            ->withInput()
            ->withErrors(['login_gagal' => 'Kredensial yang dimasukan tidak cocok dengan data kami.']);
    }

    /**
     * Reguster as member.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        //
        return view('auth.member.register');
    }
}
