<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\master_rak;
use App\master_jenis_tape;
use App\master_lokasi;
use App\audit_trail;
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

        $audittrail = new audit_trail;
        $audittrail->actor_at = session('email');
        $audittrail->keterangan_at = "Penambahaan lokasi baru : ".$request->nama_lokasi." (".strtoupper($request->kode_lokasi).")";
        $audittrail->save();
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

        $getlokasi = DB::table('master_lokasis')->where('kode_lokasi', $kl)->first();

        $updatelokasi = master_lokasi::findorfail($kl);
        $updatelokasi->update($request->all());

        $audittrail = new audit_trail;
        $audittrail->actor_at = session('email');
        $audittrail->keterangan_at = "Update lokasi : ".$getlokasi->nama_lokasi." -> ".$request->nama_lokasi.", ".$getlokasi->kode_lokasi." -> ".$request->kode_lokasi;
        $audittrail->save();

        return redirect('/daftarlokasi');
    }

    public function lokasidelete($kl)
    {
        $getlokasi = DB::table('master_lokasis')->where('kode_lokasi', $kl)->first();
        $lokasi = new master_lokasi;
        $lokasi->destroy($kl);

        $audittrail = new audit_trail;
        $audittrail->actor_at = session('email');
        $audittrail->keterangan_at = "Delete Lokasi : ".$getlokasi->nama_lokasi;
        $audittrail->save();
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

        $getlokasi = DB::table('master_lokasis')->where('kode_lokasi', $rak->lokasi_rak)->first();

        $audittrail = new audit_trail;
        $audittrail->actor_at = session('email');
        $audittrail->keterangan_at = "Tambah rak ".$request->lokasi_rak.'-'.$indexrak." di ".$getlokasi->nama_lokasi ;
        $audittrail->save();

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

        $lokasiasal = DB::table('master_lokasis')->where('kode_lokasi', $rakold->lokasi_rak)->first();
        $lokasitujuan = DB::table('master_lokasis')->where('kode_lokasi', $request->lokasi_rak)->first();
        
        $jenistapelama = DB::table('master_jenis_tapes')->where('nomor_jenis', $rakold->jenis_tape_rak)->first();    
        $jenistapebaru = DB::table('master_jenis_tapes')->where('nomor_jenis', $request->jenis_tape_rak)->first();    
        
        DB::table('master_raks')->where('kode_rak', $kr)
                                ->update(['lokasi_rak' => $request->lokasi_rak,
                                          'jenis_tape_rak' => $request->jenis_tape_rak,
                                          'kapasitas_rak' => $request->kapasitas_rak,
                                          'nomor_rak' => $request->lokasi_rak.'-'.$indexrak]);

        $audittrail = new audit_trail;
        $audittrail->actor_at = session('email');
        $audittrail->keterangan_at = "Update rak : ".$lokasiasal->nama_lokasi."->".$lokasitujuan->nama_lokasi.", ".$jenistapelama->nomor_jenis."->".$jenistapebaru->nomor_jenis.", ".$rakold->kapasitas_rak."->".$request->kapasitas_rak.", ".$rakold->nomor_rak."->".$request->lokasi_rak.'-'.$indexrak ;
        $audittrail->save();
       
        return redirect('/daftarrak');
    }

    public function rakdelete($kr)
    {
        $updateslot = DB::table('tapes')->where('kode_rak_tape', $kr)->update(['slot_tape' => NULL]);
        $getrak = DB::table('master_raks')->where('kode_rak', $kr)->first();

        $rak = new master_rak;
        $rak->destroy($kr);

        $audittrail = new audit_trail;
        $audittrail->actor_at = session('email');
        $audittrail->keterangan_at = "Delete rak : ".$getrak->nomor_rak ;
        $audittrail->save();
        
        return redirect('/daftarrak');
    }

    public function tambahjenistape(Request $request)
    {
        master_jenis_tape::create($request->all());

        $audittrail = new audit_trail;
        $audittrail->actor_at = session('email');
        $audittrail->keterangan_at = "Tambah jenis tape ".$request->nomor_jenis." (".$request->nama_jenis.")" ;
        $audittrail->save();
        
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

        $getjenistape = DB::table('master_jenis_tapes')->where('nomor_jenis', $nj)->first();

        $updatejenistape = master_jenis_tape::findorfail($nj);
        $updatejenistape->update($request->all());

        $audittrail = new audit_trail;
        $audittrail->actor_at = session('email');
        $audittrail->keterangan_at = "Update jenis tape ".$getjenistape->nomor_jenis."->".$request->nomor_jenis.", ".$getjenistape->nama_jenis."->".$request->nama_jenis ;
        $audittrail->save();

        return redirect('/daftarjenistape');
    }

    public function jenistapedelete(Request $request, $nj)
    {
        if(md5($request->password) != session('password'))
        {
            $msg = 'Password is wrong';
            return redirect('/daftarjenistape')->withErrors([$msg]);
        }
        $getjenistape = DB::table('master_jenis_tapes')->where('nomor_jenis', $nj)->first();

        $jenistape = new master_jenis_tape;
        $jenistape->destroy($nj);

        $audittrail = new audit_trail;
        $audittrail->actor_at = session('email');
        $audittrail->keterangan_at = "Delete jenis tape : ".$getjenistape->nomor_jenis." (".$getjenistape->nama_jenis.")" ;
        $audittrail->save();

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
