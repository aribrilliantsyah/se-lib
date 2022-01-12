<?php

namespace App\Http\Controllers;

use App\Helpers\AuthCommon;
use App\Helpers\Dummy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
            'collection' => Dummy::users()
        ];
        return view('pages.user.list', $data);
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Login as admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        //
        // dd(Auth::user());
        if(Auth::check()) return redirect('admin/dashboard');
        return view('auth.admin.login');
    }

    /**
     * Login process for admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function login_process(Request $request)
    {
        //
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credential = $request->only('username','password');
        
        if(AuthCommon::check_credential($credential)){
            $user = AuthCommon::user();
            if(in_array($user->role_id, [2,3])) return redirect('/admin/dashboard');

            AuthCommon::logout();
        }
        
        return redirect('/admin/login')
            ->withInput()
            ->withErrors(['login_failed' => 'These credentials do not match our records.']);
    }

    /**
     * Logout.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        //
        if(Auth::check()){
            $role = AuthCommon::user()->role->role;
            Auth::logout();
            if(strtolower($role) == 'member'){
                return redirect('member/login');
            }
            return redirect('admin/login');
        }

    }
}
