<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\master_rak;
use App\master_jenis_tape;
use App\master_lokasi;
use DB;

class TambahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function tambahlokasi(Request $request)
    {
        $lokasi = new master_lokasi;
        $lokasi->kode_lokasi = strtoupper($request->kode_lokasi);
        $lokasi->nama_lokasi = $request->nama_lokasi;
        $lokasi->save();
        return redirect('/daftarlokasi');
    }

    public function tambahrak(Request $request)
    {
        $countrak = DB::table('master_raks')->selectRaw('count(*) as jumlah_rak')->where('lokasi_rak', '=', $request->lokasi_rak)->get();    
        $indexrak = $countrak{0}->jumlah_rak + 1;
        if($indexrak < 10)
        {
            $indexrak = "0".$indexrak;
        }
        $rak = new master_rak;
        $rak->lokasi_rak = $request->lokasi_rak;
        $rak->nomor_rak = $request->lokasi_rak.'-'.$indexrak;
        $rak->jenis_tape_rak = $request->jenis_tape_rak;
        $rak->kapasitas_rak = $request->kapasitas_rak;
        $rak->save();
        return redirect('/daftarrak');
    }

    public function tambahjenistape(Request $request)
    {
        master_jenis_tape::create($request->all());
        return redirect('/daftarjenistape');
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
