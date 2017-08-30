<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\tape;
use App\master_rak;
use App\master_jenis_tape;
use App\master_lokasi;
use App\tiket;
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
        return view ('home',compact('tape', 'jumlahtotaltape', 'jumlahtapeterpakai'));
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
            'nomor_label_tape' => 'required',
            'jenis_tape' => 'required',
            'status_tape' => 'required',
            'lokasi_tape' => 'required',
            // 'kode_rak_tape' => 'required',
            // 'lapis_tape' => 'required',
            // 'baris_tape' => 'required',
            // 'slot_tape' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            ]);

            $arrlabel = preg_split("/[\s,]+/", $request->nomor_label_tape);
        
            foreach($arrlabel as $nlt)
            {
                $check = DB::table('tapes')->where('digunakan_tape', '=', '1')
                                       ->where('nomor_label_tape', '=', $nlt);
                if($check->count())
                {
                    return redirect('/tape/create')->withErrors(['Tape with label number '+$nlt+' already exists']);
                }

                $check = DB::table('master_raks')->where('lokasi_rak', '=', $request->lokasi_tape)
                                                 ->where('jenis_tape_rak', $request->jenis_tape)
                                                 ->get();
                if($check->count() == 0)
                {
                    return redirect('/tape/create')->withErrors(['No rack for '+ $request->jenis_tape +' is available at'+ $request->lokasi_tape]);
                }
                else
                {
                    $rak_pilihan = $check{0}->kode_rak;
                }   
                
                $counttape = DB::table('tapes')->selectRaw('count(*) as jumlah_tape')->where('kode_rak_tape', $rak_pilihan)->get();        
                if($counttape->count())
                {
                    $jlhtape = $counttape{0}->jumlah_tape + 1;
                }
                else
                {
                    $jlhtape = 1;
                }

                $check = DB::table('tapes')->where('digunakan_tape', '=', '0')
                                            ->where('nomor_label_tape', '=', $nlt);
                if($check->count())
                {
                    tape::where('nomor_label_tape', $nlt)->delete();
                }

                $tape = new tape;
                $tape->nomor_label_tape = $nlt;
                $tape->lokasi_tape = $request->lokasi_tape;
                $tape->kode_rak_tape = $rak_pilihan;
                $tape->lapis_tape = 1;
                $tape->baris_tape = 1;
                $tape->slot_tape = $jlhtape;
                $tape->jenis_tape = $request->jenis_tape;
                $tape->bulan = $request->bulan;
                $tape->tahun = $request->tahun;
                $tape->digunakan_tape = 1;
                if($nlt != '')
                {       
                    $tape->save();   
                }
            }
            return redirect('/');

            // $check = DB::table('tapes')->where('lokasi_tape', '=', $request->lokasi_tape)
            //                            ->where('kode_rak_tape', '=', $request->kode_rak_tape)
            //                            ->where('lapis_tape', '=', $request->lapis_tape)
            //                            ->where('baris_tape', '=', $request->baris_tape)
            //                            ->where('slot_tape', '=', $request->slot_tape);
            // if ($check->count())
            // {
            //     return redirect('/tape/create')->withErrors(['Slot tape is already used']);
            // }

            // $check = DB::table('master_raks')->where('kode_rak', '=', $request->kode_rak_tape)
            //                                  ->where('jenis_tape_rak', '=', $request->jenis_tape);
            // if($check->count()==0)
            // {
            //     $msg = 'This rack is not for tape type '.$request->jenis_tape;
            //     return redirect('/tape/create')->withErrors([$msg]);
            // }

            // $check = DB::table('tapes')->where('digunakan_tape', '=', '0')
            //                             ->where('nomor_label_tape', '=', $request->nomor_label_tape);
            // if($check->count())
            // {
            //     tape::where('nomor_label_tape', $request->nomor_label_tape)->delete();
            // }
            // $tape = new tape;
            // $tape->nomor_label_tape = $request->nomor_label_tape;
            // $tape->jenis_tape = $request->jenis_tape;
            // $tape->status_tape = $request->status_tape;
            // $tape->lokasi_tape = $request->lokasi_tape;
            // $tape->bulan = $request->bulan;
            // $tape->tahun = $request->tahun;
            // $tape->kode_rak_tape = $request->kode_rak_tape;
            // $tape->lapis_tape = $request->lapis_tape;
            // $tape->baris_tape = $request->baris_tape;
            // $tape->slot_tape = $request->slot_tape;
            // $tape->keterangan_tape = $request->keterangan_tape;
            // $tape->digunakan_tape = $request->digunakan_tape;
            // tape::create($request->all());
            // return redirect('/');
        }
        // else if($request->digunakan_tape == 0)
        // {
        //     tape::create($request->all());
        //     return redirect('/tapekosong');
        // }
    }

    public function storebatch(Request $request)
    {
        $arrlabel = preg_split("/[\s,]+/", $request->nomor_label_tape);
        
        foreach($arrlabel as $nlt)
        {
            $tape = new tape;
            $tape->nomor_label_tape = $nlt;
            $tape->lokasi_tape = $request->lokasi_tape;
            $tape->jenis_tape = $request->jenis_tape;
            $tape->digunakan_tape = $request->digunakan_tape;
            if($nlt != '')
            {       
                $tape->save();   
            }
        }
        return redirect('/tapekosong');
    }

    public function create()
    {
        $jenistape = master_jenis_tape::pluck('nomor_jenis', 'nomor_jenis');
        $raktape = master_rak::pluck('nomor_rak', 'kode_rak');
        $lokasitape = master_lokasi::pluck('nama_lokasi', 'kode_lokasi');

        return view ('tambahtape',compact('jenistape', 'raktape', 'lokasitape'));
    }

    public function advancedsearch()
    {
        $jenistape = master_jenis_tape::pluck('nomor_jenis', 'nomor_jenis');
        $jenistape->prepend('All', '');
        $raktape = master_rak::pluck('nomor_rak', 'kode_rak');
        $raktape->prepend('All', '');
        $lokasitape = master_lokasi::pluck('nama_lokasi', 'kode_lokasi');
        $lokasitape->prepend('All', '');
        $bulantape = tape::pluck('bulan', 'bulan');
        $bulantape->prepend('All', '');
        $tahuntape = tape::pluck('tahun', 'tahun');
        $tahuntape->prepend('All', '');
        return view('advancedsearch', compact('jenistape', 'raktape', 'lokasitape','tahuntape','bulantape'));
    }

    public function advsearchdatabc(Request $request)
    {
        $found = DB::table('tapes')
        ->where('nomor_label_tape', 'LIKE', '%' . $request->nomor_label_tape . '%')
        ->where('jenis_tape', 'LIKE', '%' . $request->jenis_tape . '%')
        ->where('lokasi_tape', 'LIKE', '%' . $request->lokasi_tape . '%')
        ->where('kode_rak_tape', 'LIKE', '%' . $request->kode_rak_tape . '%')
        ->where('bulan', 'LIKE', '%' . $request->bulan . '%')
        ->where('tahun', 'LIKE', '%' . $request->tahun . '%')
        ->leftJoin('master_lokasis', 'tapes.lokasi_tape', '=', 'master_lokasis.kode_lokasi')
        ->leftJoin('master_raks', 'tapes.kode_rak_tape', '=', 'master_raks.kode_rak')
        ->get();
        $jenistape = master_jenis_tape::pluck('nomor_jenis', 'nomor_jenis');
        $raktape = master_rak::pluck('nomor_rak', 'kode_rak');
        $lokasitape = master_lokasi::pluck('nama_lokasi', 'kode_lokasi');
        return view('find', compact('found', 'jenistape', 'raktape', 'lokasitape'));
    }

    public function advsearchdatakw(Request $request)
    {
        if($request->select_rak == 1)
        {
            $selectrak = '%'. $request->kode_rak_tape .'%';
        }
        else if($request->select_rak == 2)
        {
            $selectrak =  $request->kode_rak_tape .'%';
        }
        else if($request->select_rak == 3)
        {
            $selectrak = '%'. $request->kode_rak_tape;
        }

        if($request->select_jenis == 1)
        {
            $selectjenistape = '%'. $request->jenis_tape .'%';
        }
        else if($request->select_jenis == 2)
        {
            $selectjenistape =  $request->jenis_tape .'%';
        }
        else if($request->select_jenis == 3)
        {
            $selectjenistape = '%'. $request->jenis_tape;
        }

        if($request->select_lokasi == 1)
        {
            $selectlokasi = '%'. $request->lokasi_tape .'%';
        }
        else if($request->select_lokasi == 2)
        {
            $selectlokasi =  $request->lokasi_tape .'%';
        }
        else if($request->select_lokasi == 3)
        {
            $selectlokasi = '%'. $request->lokasi_tape;
        }

        if($request->select_label == 1)
        {
            $selectlabel = '%'. $request->nomor_label_tape .'%';
        }
        else if($request->select_label == 2)
        {
            $selectlabel =  $request->nomor_label_tape .'%';
        }
        else if($request->select_label == 3)
        {
            $selectlabel = '%'. $request->nomor_label_tape;
        }

        if($request->select_tahun == 1)
        {
            $selecttahun = '%'. $request->tahun .'%';
        }
        else if($request->select_tahun == 2)
        {
            $selecttahun =  $request->tahun .'%';
        }
        else if($request->select_tahun == 3)
        {
            $selecttahun = '%'. $request->tahun;
        }

        $found = DB::table('tapes')
        ->leftJoin('master_lokasis', 'tapes.lokasi_tape', '=', 'master_lokasis.kode_lokasi')
        ->leftJoin('master_raks', 'tapes.kode_rak_tape', '=', 'master_raks.kode_rak')
        ->where('nomor_label_tape', 'LIKE', $selectlabel)
        ->where('jenis_tape', 'LIKE', $selectjenistape)
        ->where('nama_lokasi', 'LIKE', $selectlokasi)
        ->where('nomor_rak', 'LIKE', $selectrak)
        ->where('tahun', 'LIKE', $selecttahun)
        ->get();
        return view('find', compact('found'));
    }

    public function tambahticket()
    {
      
        return view ('tambahticket');
    }

     public function tiket()
    {
       // $tiket= DB::table('tikets')->get();

       $tiket = DB::select("select no_tiket,Email,FullName,TicketSource,HelpTopic,Departement,SLAplan,DueDate,IssueSummary,IssueDetails, file , Priority ,PeriodeWaktu,jumlahFile,DataSource,CASE WHEN status=0 THEN 'Open'  ELSE 'Close' END as status
          from tikets");

        return view ('daftartiket',compact('tiket'));
    }

    public function storetiket(Request $request)
    {
           tiket::create($request->all());
           // $file = $request->file('file');
           // $destinationPath = 'uploads';
           // $file->move($destinationPath, $file->getClientOriginalName());
           return redirect('/daftartiket');
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
        $this->validate($request, [
            'search' => 'required',
            ]);
        $searchdata = $request->input('search');
        $found = DB::table('tapes')
        ->where('nomor_label_tape', 'LIKE', '%' . $searchdata . '%')
        ->orwhere('jenis_tape', 'LIKE', '%' . $searchdata . '%')
        ->orwhere('status_tape', 'LIKE', '%' . $searchdata . '%')
        ->orwhere('lokasi_tape', 'LIKE', '%' . $searchdata . '%')
        ->orwhere('kode_rak_tape', 'LIKE', '%' . $searchdata . '%')
        ->orwhere('keterangan_tape', 'LIKE', '%' . $searchdata . '%')
        ->orwhere('bulan', 'LIKE', '%' . $searchdata . '%')
        ->orwhere('tahun', 'LIKE', '%' . $searchdata . '%')
        ->leftJoin('master_lokasis', 'tapes.lokasi_tape', '=', 'master_lokasis.kode_lokasi')
        ->leftJoin('master_raks', 'tapes.kode_rak_tape', '=', 'master_raks.kode_rak')
        ->get();
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
