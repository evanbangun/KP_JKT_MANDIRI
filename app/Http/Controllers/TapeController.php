<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tape;
use App\master_rak;
use App\master_jenis_tape;
use DB;

class TapeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tape = tape::all();
        $jenistape = master_jenis_tape::pluck('nomor_jenis', 'nomor_jenis');
        $raktape = master_rak::pluck('kode_rak', 'kode_rak');
        return view ('home',compact('tape', 'jenistape', 'raktape'));
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
        tape::create($request->all());
        return redirect('/');
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

    public function searchdata(Request $request)
    {
        $searchdata = $request->input('search');
        if(!empty($searchdata)){
        $found = DB::table('tapes')
        ->where('kode_label_tape', 'LIKE', '%' . $searchdata . '%')
        ->orwhere('nomor_jenis_tape', 'LIKE', '%' . $searchdata . '%')
        ->orwhere('kode_rak_tape', 'LIKE', '%' . $searchdata . '%')
        ->get();
        }
        $jenistape = master_jenis_tape::pluck('nomor_jenis', 'nomor_jenis');
        $raktape = master_rak::pluck('kode_rak', 'kode_rak');
        return view('find', compact('found', 'jenistape', 'raktape'));
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
