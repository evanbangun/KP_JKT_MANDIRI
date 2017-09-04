<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function index()
    {
        return view('home');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
