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

    public function lokasiedit($kl)
    {
        $getlokasi = DB::table('master_lokasis')->where('kode_lokasi', $kl)->first();    
        return view('/lokasiedit', compact('getlokasi'));
    }

    public function lokasiupdate(Request $request, $kl)
    {
        $check = DB::table('master_lokasis')->where('kode_lokasi', '!=', $kl)
                                            ->where('kode_lokasi', $request->kode_lokasi)
                                            ->orwhere('nama_lokasi', $request->nama_lokasi)
                                            ->get();   
        if($check->count())
        {
            $msg = 'Duplicate data detected';
            return redirect('/lokasiedit/'.$kl)->withErrors([$msg]);
        } 
        $updatelokasi = master_lokasi::findorfail($kl);
        $updatelokasi->update($request->all());
        return redirect('/daftarlokasi');
    }

    public function lokasidelete($kl)
    {
        $lokasi = new master_lokasi;
        $lokasi->destroy($kl);
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

    public function rakedit($kr)
    {
        $rak = DB::table('master_raks')->where('kode_rak', $kr)
                                       ->first();
        $jenistape = master_jenis_tape::pluck('nomor_jenis', 'nomor_jenis');
        $lokasi = master_lokasi::pluck('nama_lokasi', 'kode_lokasi');
        return view ('/rakedit',compact('jenistape', 'lokasi', 'rak'));
    }

    public function rakupdate(Request $request, $kr)
    {
        $rakold = DB::table('master_raks')->where('kode_rak', $kr)->first();
        $countrak = DB::table('master_raks')->selectRaw('count(*) as jumlah_rak')->where('lokasi_rak', '=', $request->lokasi_rak)->get();    
        
        $indexrak = $countrak{0}->jumlah_rak + 1;
        
        if($indexrak < 10)
        {
            $indexrak = "0".$indexrak;
        }

        $isirakold = DB::table('tapes')->where('kode_rak_tape', $kr)->get();

        if($isirakold->count() > $request->kapasitas_rak)
        {
            $selisih = $isirakold->count() - $request->kapasitas_rak;
            DB::table('tapes')->where('kode_rak_tape', $kr)
                              ->orderBy('slot_tape', 'desc')
                              ->limit($selisih)
                              ->update(['slot_tape' => NULL, 'kode_rak_tape' => NULL]);
        }

        if($rakold->jenis_tape_rak != $request->jenis_tape_rak)
        {
            DB::table('tapes')->where('kode_rak_tape', $kr)
                              ->update(['slot_tape' => NULL, 'kode_rak_tape' => NULL]);
        }

        DB::table('master_raks')->where('kode_rak', $kr)
                                ->update(['lokasi_rak' => $request->lokasi_rak,
                                          'jenis_tape_rak' => $request->jenis_tape_rak,
                                          'kapasitas_rak' => $request->kapasitas_rak,
                                          'nomor_rak' => $request->lokasi_rak.'-'.$indexrak]);
       
        return redirect('/daftarrak');
    }

    public function rakdelete($kr)
    {
        $updateslot = DB::table('tapes')->where('kode_rak_tape', $kr)->update(['slot_tape' => NULL]);
        $rak = new master_rak;
        $rak->destroy($kr);
        return redirect('/daftarrak');
    }

    public function tambahjenistape(Request $request)
    {
        master_jenis_tape::create($request->all());
        return redirect('/daftarjenistape');
    }

    public function jenistapeedit($nj)
    {
        $getjenistape = DB::table('master_jenis_tapes')->where('nomor_jenis', $nj)->first();    
        return view('/jenistapeedit', compact('getjenistape'));
    }

    public function jenistapeupdate(Request $request, $nj)
    {
        $check = DB::table('master_jenis_tapes')->where('nomor_jenis', '!=', $nj)
                                                ->where('nomor_jenis', $request->nomor_jenis)
                                                ->get();   
        if($check->count())
        {
            $msg = 'Duplicate data detected';
            return redirect('/jenistapeedit/'.$nj)->withErrors([$msg]);
        } 
        $updatejenistape = master_jenis_tape::findorfail($nj);
        $updatejenistape->update($request->all());
        return redirect('/daftarjenistape');
    }

    public function jenistapedelete($nj)
    {
        $jenistape = new master_jenis_tape;
        $jenistape->destroy($nj);
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
