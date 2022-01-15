<?php

namespace App\Http\Controllers;

use App\Helpers\AuthCommon;
use App\Helpers\Dummy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DataTables\UsersDataTable;
use App\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDatatable $dataTable)
    {
        return $dataTable->render('pages.user.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::all();
        return view('pages.user.create', compact('roles'));
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
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|alpha_dash|unique:users,username|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|alpha_dash',
            'role_id' => 'required',
            'avatar' => '',
        ]);

        $trx = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => $request->role_id,
            'avatar' => $request->avatar,
        ]);

        if($trx){
            return redirect()->route('user.index')->with(['success' => 'Data Saved Successfully!']);
        }else{
            return redirect()->route('user.index')->with(['error' => 'Data Failed to Save!']);
        }
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
        $data = $user;
        $id = $data->id;
        $roles = Role::all();
        return view('pages.user.show', compact('roles', 'data'));
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
        $data = $user;
        $id = $data->id;
        $roles = Role::all();
        return view('pages.user.edit', compact('roles', 'data', 'id'));
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
        $rules = [
            'name' => 'required|max:255',
            'username' => 'required|alpha_dash|unique:users,username,'.$user->id.'|max:100',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'alpha_dash',
            'role_id' => 'required',
            'avatar' => '',
        ];

        if(!$request->password) unset($rules['password']);
        
        $request->validate($rules);

        if(!$request->password) $request = $request->except(['password']);
        $trx = $user->update($request);

        if($trx){
            return redirect()->route('user.index')->with(['success' => 'Data Saved Successfully!']);
        }else{
            return redirect()->route('user.index')->with(['error' => 'Data Failed to Save!']);
        }
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
        $delete = $user->delete();
        if($delete){
            return response()->json([
                'message' => 'Data Deleted Successfully!'
            ]);
        }
        return response()->json([
            'message' => 'Data Failed Successfully!'
        ]);
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
