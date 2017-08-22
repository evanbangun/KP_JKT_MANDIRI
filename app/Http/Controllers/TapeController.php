<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\tape;
use App\master_rak;
use App\master_jenis_tape;
use App\master_lokasi;
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
        $tape = DB::table('tapes')->leftJoin('master_lokasis', 'tapes.lokasi_tape', '=', 'master_lokasis.kode_lokasi')
                                  ->leftJoin('master_raks', 'tapes.kode_rak_tape', '=', 'master_raks.kode_rak')
                                  ->where('digunakan_tape', '=', '1')
                                  ->get();
        $jumlahtotaltape = DB::table('tapes')->count();
        $jumlahtapeterpakai = DB::table('tapes')->where('digunakan_tape', '=', '1')
                                                ->count();
        $jenistape = master_jenis_tape::pluck('nomor_jenis', 'nomor_jenis');
        $raktape = master_rak::pluck('nomor_rak', 'kode_rak');
        $lokasitape = master_lokasi::pluck('nama_lokasi', 'kode_lokasi');
        return view ('home',compact('tape', 'jenistape', 'raktape', 'lokasitape', 'jumlahtotaltape', 'jumlahtapeterpakai'));
    }

    public function index2()
    {
        $tape = DB::table('tapes')->leftJoin('master_lokasis', 'tapes.lokasi_tape', '=', 'master_lokasis.kode_lokasi')
                                  ->where('digunakan_tape', '=', '0')
                                  ->orderBy('tapes.created_at', 'desc')
                                  ->get();
        $jumlahtotaltape = DB::table('tapes')->count();
        $jumlahtapeterpakai = DB::table('tapes')->where('digunakan_tape', '=', '1')
                                                ->count();
        $jenistape = master_jenis_tape::pluck('nomor_jenis', 'nomor_jenis');
        $raktape = master_rak::pluck('nomor_rak', 'kode_rak');
        $lokasitape = master_lokasi::pluck('nama_lokasi', 'kode_lokasi');
        return view ('tapekosong',compact('tape', 'jenistape', 'raktape', 'lokasitape', 'jumlahtotaltape', 'jumlahtapeterpakai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createtapekosong()
    {
        $lokasitape = master_lokasi::pluck('nama_lokasi', 'kode_lokasi');
        $jenistape = master_jenis_tape::pluck('nomor_jenis', 'nomor_jenis');
        return view ('tambahtapekosong',compact('jenistape', 'lokasitape'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->digunakan_tape == 1)
        {
            $this->validate($request, [
            'nomor_label_tape' => 'required|unique:tapes',
            'jenis_tape' => 'required',
            'status_tape' => 'required',
            'lokasi_tape' => 'required',
            'kode_rak_tape' => 'required',
            'lapis_tape' => 'required',
            'baris_tape' => 'required',
            'slot_tape' => 'required',
            ]);
            $check = DB::table('tapes')->where('lokasi_tape', '=', $request->lokasi_tape)
                                       ->where('kode_rak_tape', '=', $request->kode_rak_tape)
                                       ->where('lapis_tape', '=', $request->lapis_tape)
                                       ->where('baris_tape', '=', $request->baris_tape)
                                       ->where('slot_tape', '=', $request->slot_tape);
            if($check)
            {
                return redirect('/');
            }

            $check = DB::table('master_raks')->where('nomor_rak', '=', $request->kode_rak_tape)
                                             ->where('jenis_tape_rak', '=', $request->jenis_tape);
            if(!$check)
            {
                return redirect('/');
            }

            $check = DB::table('tapes')->where('digunakan_tape', '=', '0')
                                       ->where('nomor_label_tape', '=', $request->nomor_label_tape);
            if($check)
            {
                tape::where('nomor_label_tape', $request->nomor_label_tape)->delete();
            }
            tape::create($request->all());
            return redirect('/');
        }
        else if($request->digunakan_tape == 0)
        {
            tape::create($request->all());
            return redirect('/tapekosong');
        }
    }

    public function storebatch(Request $request)
    {
        $inputs = $request->input;
        $temp = array();

        foreach($inputs as $input)
        {
            $tape = new tape;
            $tape->nomor_label_tape = $input['nomor_label_tape'];
            $tape->lokasi_tape = $request->lokasi_tape;
            $tape->jenis_tape = $request->jenis_tape;
            if($input['nomor_label_tape'] != '')
            {       
                $tape->save();   
            }
        }
        return redirect('/tapekosong');
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
        ->where('nomor_label_tape', 'LIKE', '%' . $searchdata . '%')
        ->orwhere('jenis_tape', 'LIKE', '%' . $searchdata . '%')
        ->orwhere('status_tape', 'LIKE', '%' . $searchdata . '%')
        ->orwhere('lokasi_tape', 'LIKE', '%' . $searchdata . '%')
        ->orwhere('kode_rak_tape', 'LIKE', '%' . $searchdata . '%')
        ->orwhere('keterangan_tape', 'LIKE', '%' . $searchdata . '%')
        ->leftJoin('master_lokasis', 'tapes.lokasi_tape', '=', 'master_lokasis.kode_lokasi')
        ->leftJoin('master_raks', 'tapes.kode_rak_tape', '=', 'master_raks.kode_rak')
        ->get();
        }
        $jenistape = master_jenis_tape::pluck('nomor_jenis', 'nomor_jenis');
        $raktape = master_rak::pluck('nomor_rak', 'kode_rak');
        $lokasitape = master_lokasi::pluck('nama_lokasi', 'kode_lokasi');
        return view('find', compact('found', 'jenistape', 'raktape', 'lokasitape'));
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
