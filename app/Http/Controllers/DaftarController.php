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
    public function indexlokasi()
    {
        $jenistape = DB::table('master_jenis_tapes')->get();
        $lokasi = DB::table('master_lokasis')->get();
        $rakperlokasi = DB::table('master_raks')->selectRaw('lokasi_rak, count(*) as jumlah_rak')->groupBy('lokasi_rak')->get();
        $tapeperlokasi = DB::table('tapes')->selectRaw('lokasi_tape, count(*) as jumlah_tape')->groupBy('lokasi_tape')->get();
        return view ('daftarlokasi',compact('lokasi', 'rakperlokasi', 'tapeperlokasi'));
    }

    public function indexrak()
    {
        $jenistape = DB::table('master_jenis_tapes')->get();
        $tapeperrak = DB::table('tapes')->selectRaw('kode_rak_tape as krt, count(*) as jumlah_tape')->groupBy('kode_rak_tape')->get();
        $totaltape = DB::table('tapes')->selectRaw('jenis_tape, count(*) as jumlah_tape')->groupBy('jenis_tape')->get();
        $listlokasi = DB::table('master_lokasis')->pluck('nama_lokasi', 'kode_lokasi');
        $lokasi = DB::table('master_lokasis')->get();
        $listjenis = DB::table('master_jenis_tapes')->pluck('nomor_jenis', 'nomor_jenis');
        $rak = DB::table('master_raks')->leftJoin('master_lokasis', 'master_raks.lokasi_rak', '=', 'master_lokasis.kode_lokasi')
                                       ->get();
        return view ('daftarrak',compact('rak', 'jenistape', 'listlokasi', 'listjenis', 'tapeperrak', 'totaltape', 'lokasi'));
    }

    public function indextape()
    {
        $jenistape = DB::table('master_jenis_tapes')->get();
        $tapeterpakai = DB::table('tapes')->selectRaw('jenis_tape, count(*) as jumlah_tape')->where('digunakan_tape', '=', '1')->groupBy('jenis_tape')->get();
        $tapekosong = DB::table('tapes')->selectRaw('jenis_tape, count(*) as jumlah_tape')->where('digunakan_tape', '=', '0')->groupBy('jenis_tape')->get();
        $totaltape = DB::table('tapes')->selectRaw('jenis_tape, count(*) as jumlah_tape')->groupBy('jenis_tape')->get();
        return view ('daftarjenistape',compact('jenistape', 'tapeterpakai', 'tapekosong', 'totaltape'));
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
