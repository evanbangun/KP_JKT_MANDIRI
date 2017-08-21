<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lokasi = DB::table('master_lokasis')->get();
        $rak = DB::table('master_raks')->leftJoin('master_lokasis', 'master_raks.lokasi_rak', '=', 'master_lokasis.kode_lokasi')
                                       ->get();
        $jenistape = DB::table('master_jenis_tapes')->get();
        $listlokasi = DB::table('master_lokasis')->pluck('nama_lokasi', 'kode_lokasi');
        $listjenis = DB::table('master_jenis_tapes')->pluck('nomor_jenis', 'nomor_jenis');
        return view ('daftar',compact('lokasi', 'jenistape', 'rak', 'listlokasi', 'listjenis'));
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
