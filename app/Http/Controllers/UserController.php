<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\audit_trail;
use App\user;
use DB;

class UserController extends Controller
{
    public function index()
    {
        $tape = DB::table('tapes')->count();
        $tiket = DB::table('peminjamen')->count();
        $newtiket = DB::table('peminjamen')->where('status', 0)->count();
        $ondelivery = DB::table('peminjamen')->where('status', 1)->count();
        $donetiket = DB::table('peminjamen')->where('status', 3)->count();
        $closetiket = DB::table('peminjamen')->where('status', 4)->count();
        $aktivitas = DB::table('audit_trails')->count();
        $user = DB::table('users')->count();
        $lokasi = DB::table('master_lokasis')->count();
        $testing = DB::table('list_testings')->groupBy('kode_tape_testing')->count();
        $rak = DB::table('master_raks')->count();
        return view('home', compact('tape', 'tiket', 'aktivitas', 'user', 'newtiket', 'donetiket', 'closetiket', 'lokasi', 'rak', 'ondelivery', 'testing'));
    }

    public function manageuser()
    {
        $user = DB::table('users')->get();
        return view('user', compact('user'));
    }

    public function tambahuser()
    {
        return view('tambahuser');
    }

    public function loginpost(Request $request)
    {
        $check = DB::table('users')->where('email', $request->email)
                                   ->where('password', md5($request->password))
                                   ->first();
        if($check)
        {
            Session::put('role', $check->role);
            Session::put('name', $check->name);
            Session::put('email', $check->email);
            Session::put('password', $check->password);
            return redirect('/home');   
        }
        else
        {
            return view('/login')->withErrors(["Invalid email or password"]);
        }
    }

    public function loginpage()
    {
        return view('/login');
    }

    public function logout()
    {
        //Session::flush();
        return view('/login');
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
        $this->validate($request, [
        'email' => 'required',
        'name' => 'required',
        'password' => 'required|min:6',
        'role' => 'required',
        ]);
        $user = new user;
        $user->email = $request->email;
        $user->password = md5($request->password);
        $user->name = $request->name;
        $user->role = $request->role;
        $user->save();

        $audittrail = new audit_trail;
        $audittrail->actor_at = session('email');
        $audittrail->keterangan_at = "Tambah user ".$id;
        $audittrail->save();

        return redirect("/manageuser");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $useredit = user::findorfail($id);
        return view('edituser',compact('useredit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
        'email' => 'required',
        'name' => 'required',
        'password' => 'required|min:6',
        'role' => 'required',
        ]);
        $getuser = DB::table('users')->where('email', $id)->first();
        
        DB::table('users')->where('email', $id)
                          ->update(['email' => $request->email,
                                    'name' => $request->name,
                                    'password' => md5($request->password),
                                    'role' => $request->role,]);

        $audittrail = new audit_trail;
        $audittrail->actor_at = session('email');
        $audittrail->keterangan_at = "Update user ".$id."->".$request->email.", ".$getuser->name."->".$request->name.", ".$getuser->role."->".$request->role;
        $audittrail->save();

        return redirect('/manageuser');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userdele = user::findorfail($id);
        
        $audittrail = new audit_trail;
        $audittrail->actor_at = session('email');
        $audittrail->keterangan_at = "Delete user ".$id;
        $audittrail->save();

        $userdele->delete();
        return redirect('/manageuser');
    }
}
