<?php

namespace App\Http\Controllers;

use App\Helpers\AuthCommon;
use App\Helpers\Dummy;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DataTables\MembersDataTable;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MembersDataTable $dataTable)
    {
        //
        return $dataTable->render('pages.member.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.member.create');
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
            'gender' => 'required',
            'profession' => 'required',
            'address' => 'required',
            'username' => 'required|alpha_dash|unique:users,username|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|alpha_dash',
            'photo' => '',
        ]);
        $photo = $request->photo;
        $code = Member::generateCodeMember();

        $user = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 1,
            'avatar' => $photo,
        ];
        if(!$photo) unset($user['avatar']);
        $user = User::create($user);
        $user_id = $user->id;

        $member = [
            'code' => $code,
            'full_name' => $request->name,
            'address' => $request->address,
            'gender' => $request->gender,
            'user_id'=>$user_id,
            'profession' => $request->profession,
            'photo' => $photo,
        ];
        if(!$photo) unset($member['photo']);
        $trx = Member::create($member);        

        if($trx){
            return redirect()->route('member.index')->with(['success' => 'Data Saved Successfully!']);
        }else{
            return redirect()->route('member.index')->with(['error' => 'Data Failed to Save!']);
        }
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
        $data = $member;
        $id = $data->id;
        return view('pages.member.show', compact( 'data'));
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
        $data = Member::with(['user'])->find($member->id);
        $id = $data->id;
        return view('pages.member.edit', compact('data', 'id'));
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
        $rules = [  
            'name' => 'required|max:255',
            'gender' => 'required',
            'profession' => 'required',
            'address' => 'required',
            'username' => 'required|alpha_dash|unique:users,username,'.$member->user_id.'|max:100',
            'email' => 'required|email|unique:users,email,'.$member->user_id,
            'password' => 'alpha_dash',
            'photo' => '',
        ];
        if(!$request->password) unset($rules['password']);
        
        $request->validate($rules);
        $photo = $request->photo;
        $update = [];
        if(!$request->password) {
            $update = $request->except(['_token', '_method', 'password', 'gender', 'address', 'profession', 'photo']);
            if($photo) $update['avatar'] = $photo;
        }else{
            $update = $request->except(['_token', '_method', 'gender', 'address', 'profession', 'photo']);
            $update['password'] = bcrypt($request['password']);
            if($photo) $update['avatar'] = $photo;
        }
        User::where('id', $member->user_id)->update($update);
        
        $update = [
            'full_name' => $request->name,
            'address' => $request->address,
            'gender' => $request->gender,
            'profession' => $request->profession,
            'photo' => $photo,
        ];

        if(!$update['photo']) unset($update['photo']);
        // dd($update);
        $trx = $member->update($update); 

        if($trx){
            return redirect()->route('member.index')->with(['success' => 'Data Saved Successfully!']);
        }else{
            return redirect()->route('member.index')->with(['error' => 'Data Failed to Save!']);
        }
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
        $delete = $member->delete();
        if($delete){
            User::find($member->user_id)->delete();
            return response()->json([
                'message' => 'Data Deleted Successfully!'
            ]);
        }
        return response()->json([
            'message' => 'Data Failed Successfully!'
        ]);
    }

    /**
     * Login as member.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        //
        if(Auth::check()) return redirect('member/dashboard');
        return view('auth.member.login');
    }

    /**
     * Login process for member.
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
            if($user->role_id == '1') return redirect('/member/dashboard');

            AuthCommon::logout();
        }
        
        return redirect('/member/login')
            ->withInput()
            ->withErrors(['login_failed' => 'These credentials do not match our records.']);
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

    /**
     * Register process for member.
     *
     * @return \Illuminate\Http\Response
     */
    public function register_process(Request $request)
    {
        //
       // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|alpha_dash|confirmed',
            'password_confirmation' => 'required',
        ]);

        $trx = User::create([
            'name' => $request->name,
            'username' => $request->email,
            'email' => $request->email,
            'password' =>  bcrypt($request->password),
            'role_id' => 1,
        ]);

        $code = Member::generateCodeMember();

        $member = [
            'code' => $code,
            'full_name' => $request->name,
            'address' => '-',
            'gender' => 'Male',
            'user_id'=> $trx->id,
            'profession' => '-'
        ];

        Member::create($member);

        if($trx){
            $credential = $request->only('email','password');
        
            if(AuthCommon::check_credential($credential)){
                $user = AuthCommon::user();
                if($user->role_id == '1') return redirect('/member/dashboard');

                AuthCommon::logout();
            }
        }
    }
}
