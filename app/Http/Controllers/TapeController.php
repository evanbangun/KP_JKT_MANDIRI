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
use App\audit_trail;
use App\tiket;
use App\peminjaman;
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
                                  ->orderBy('nomor_rak')
                                  ->orderBy('slot_tape')
                                  ->paginate(15);
        $jumlahtotaltape = DB::table('tapes')->count();
        $jumlahtapeterpakai = DB::table('tapes')->where('digunakan_tape', '=', '1')
                                                ->count();
        $rows = tape::get(); // Get all users from the database
        $table = Table::create($rows); // Generate a Table based on these "rows"
        return view ('daftartape',compact('tape', 'jumlahtotaltape', 'jumlahtapeterpakai', 'table'));
    }

    public function index2()
    {
        $tape = DB::table('tapes')->leftJoin('master_lokasis', 'tapes.lokasi_tape', '=', 'master_lokasis.kode_lokasi')
                                  ->where('digunakan_tape', '=', '0')
                                  ->orderBy('tapes.created_at', 'desc')
                                  ->paginate(15);
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
            'bulan_tahun' => 'required',
            ]);

            $arrlabel = preg_split("/[\s,]+/", $request->nomor_label_tape);
        
            foreach($arrlabel as $nlt)
            {
                $check = DB::table('tapes')->where('digunakan_tape', '=', '1')
                                       ->where('nomor_label_tape', '=', $nlt);
                if($check->count())
                {
                    return redirect('/tape/create')->withErrors(['Tape with label number '.$nlt.' already exists']);
                }

                $check = DB::table('master_raks')->where('lokasi_rak', '=', $request->lokasi_tape)
                                                 ->where('jenis_tape_rak', $request->jenis_tape)
                                                 ->get();
                if($check->count() == 0)
                {
                    $namalokasi = DB::table('master_lokasis')->where('kode_lokasi', $request->lokasi_tape)->first();
                    return redirect('/tape/create')->withErrors(['No rack for '. $request->jenis_tape .' is available at '. $namalokasi->nama_lokasi]);
                }
                else
                {
                    // $rak_pilihan = $check{0}->kode_rak;
                    // $kapasitas_rak = $check{0}->kapasitas_rak;
                    $full=true;
                    foreach ($check as $c)
                    {
                        $cekkapasitas = DB::table('tapes')->where('kode_rak_tape', '=', $c->kode_rak)
                                                          ->get();
                        if($cekkapasitas->count() < $c->kapasitas_rak)
                        {
                             $rak_pilihan = $c->kode_rak;
                             $kapasitas_rak = $c->kapasitas_rak;
                             $full=false;
                             break;
                        }
                    }
                    if($full)
                    {
                        return redirect('/daftartape')->withErrors(['Some tape was not stored due to lack of spaces in all the racks']);
                    }
                }   
                
                $check = DB::table('tapes')->where('kode_rak_tape', $rak_pilihan)->orderBy('slot_tape')
                                                                                 ->get();        
                if($check->count())
                {
                    if($check->count() < $kapasitas_rak)
                    {
                        $i=1;
                        $new = true;
                        foreach ($check as $c)
                        {
                            if($c->slot_tape != $i)
                            {
                                $jlhtape = $i;
                                $new = false;
                                break;
                            }
                            $i++;
                        }
                        if($new)
                        {
                            $jlhtape = $check->count() + 1;
                        }
                    }
                    else
                    {
                        return redirect('/tape/create')->withErrors(['Rack '.$request->jenis_tape.' is already full']);
                    }
                }
                else
                {
                    $jlhtape = 1;
                }

                $check = DB::table('tapes')->where('digunakan_tape', '=', '0')
                                           ->where('nomor_label_tape', '=', $nlt)
                                           ->get();

                $getlokasi = DB::table('master_lokasis')->where('kode_lokasi', $request->lokasi_tape)
                                                        ->first();

                $newtape = true;

                if($check->count())
                {
                    tape::where('nomor_label_tape', $nlt)->delete();

                    $audittrail = new audit_trail;
                    $audittrail->actor_at = session('email');
                    $audittrail->keterangan_at = "Backup tape ".$nlt.", jenis ".$request->jenis_tape.", di ".$getlokasi->nama_lokasi.", rak ".$rak_pilihan.", slot ".$jlhtape." backup-an ".$request->bulan_tahun; 
                    $audittrail->save();

                    $newtape = false;
                }

                $tape = new tape;
                $tape->nomor_label_tape = $nlt;
                $tape->lokasi_tape = $request->lokasi_tape;
                $tape->kode_rak_tape = $rak_pilihan;
                $tape->slot_tape = $jlhtape;
                $tape->jenis_tape = $request->jenis_tape;
                $tape->bulan_tahun = $request->bulan_tahun;
                $tape->keterangan_tape = $request->keterangan_tape;
                $tape->status_tape = $request->status_tape;
                $tape->digunakan_tape = 1;
                if($nlt != '')
                {       
                    $tape->save();
                    if($newtape)
                    {
                        $audittrail = new audit_trail;
                        $audittrail->actor_at = session('email');
                        $audittrail->keterangan_at = "Tambah tape ".$nlt.", jenis ".$request->jenis_tape.", di ".$getlokasi->nama_lokasi.", rak ".$rak_pilihan.", slot ".$jlhtape." backup-an ".$request->bulan_tahun; 
                        $audittrail->save();
                    }
                }
            }
            return redirect('/daftartape');

            // $check = DB::table('tapes')->where('lokasi_tape', '=', $request->lokasi_tape)
            //                            ->where('kode_rak_tape', '=', $request->kode_rak_tape)
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
            // $tape->slot_tape = $request->slot_tape;
            // $tape->keterangan_tape = $request->keterangan_tape;
            // $tape->digunakan_tape = $request->digunakan_tape;
            // tape::create($request->all());
            // return redirect('/daftartape');
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
            $check = DB::table('tapes')->where('nomor_label_tape', $nlt)->get();
            if($check->count())
            {
                $msg = "nomor label tape ".$nlt." already exists";
                return redirect('/tapekosong')->withErrors([$msg]);
            }
            $tape = new tape;
            $tape->nomor_label_tape = $nlt;
            $tape->lokasi_tape = $request->lokasi_tape;
            $getlokasi = DB::table('master_lokasis')->where('kode_lokasi', $request->lokasi_tape)
                                                    ->first();
            $tape->jenis_tape = $request->jenis_tape;
            $tape->digunakan_tape = $request->digunakan_tape;
            if($nlt != '')
            {       
                $tape->save();

                $audittrail = new audit_trail;
                $audittrail->actor_at = session('email');
                $audittrail->keterangan_at = "Tambah tape kosong ".$nlt.", jenis ".$request->jenis_tape.", di ".$getlokasi->nama_lokasi; 
                $audittrail->save();
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
        $bulantahuntape = tape::pluck('bulan_tahun', 'bulan_tahun');
        return view('advancedsearch', compact('jenistape', 'raktape', 'lokasitape','bulan_tahun'));
    }

    public function advsearchdatabc(Request $request)
    {
        $found = DB::table('tapes')
        ->leftJoin('master_lokasis', 'tapes.lokasi_tape', '=', 'master_lokasis.kode_lokasi')
        ->leftJoin('master_raks', 'tapes.kode_rak_tape', '=', 'master_raks.kode_rak')
        ->where('nomor_label_tape', 'LIKE', '%' . $request->nomor_label_tape . '%')
        ->where('jenis_tape', 'LIKE', '%' . $request->jenis_tape . '%')
        ->where('lokasi_tape', 'LIKE', '%' . $request->lokasi_tape . '%')
        ->where('kode_rak_tape', 'LIKE', '%' . $request->kode_rak_tape . '%')
        ->where('bulan_tahun', 'LIKE', '%' . $request->tahun . '%')
        ->orderBy('nomor_rak')
        ->orderBy('slot_tape')
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

        $found = DB::table('tapes')->leftJoin('master_lokasis', 'tapes.lokasi_tape', '=', 'master_lokasis.kode_lokasi')
                                   ->leftJoin('master_raks', 'tapes.kode_rak_tape', '=', 'master_raks.kode_rak')
                                   ->where('nomor_label_tape', 'LIKE', $selectlabel)
                                   ->where('jenis_tape', 'LIKE', $selectjenistape)
                                   ->where('nama_lokasi', 'LIKE', $selectlokasi)
                                   ->where('nomor_rak', 'LIKE', $selectrak)
                                   ->where('bulan_tahun', 'LIKE', $selecttahun)
                                   ->orderBy('nomor_rak')
                                   ->orderBy('slot_tape')
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

        $tiket = DB::select("select p.no_tiket,p.nomor_label_tape,m.nama_lokasi as Sumber,ml.nama_lokasi as Tujuan,p.lama_peminjaman,p.keterangan,p.created_at,p.updated_at,CASE WHEN status=0 THEN 'New Ticket' WHEN status=1 THEN 'Tape On Delivery' WHEN status=2 THEN 'Restoring' WHEN status=3 THEN 'DONE' WHEN status=4 THEN 'Close Ticket'  ELSE 'Over Due Ticket' END as status
                             from peminjamen p 
                             left join master_lokasis m on m.kode_lokasi = p.lokasi_sumber
                             left join master_lokasis ml on ml.kode_lokasi = p.lokasi_tujuan
                             GROUP BY no_tiket");

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

    public function tapeedit($nlt)
    {
        $datatape = DB::table('tapes')->where('nomor_label_tape', $nlt)
                                      ->first();
        $listlokasi = DB::table('master_lokasis')->pluck('nama_lokasi', 'kode_lokasi');
        $listjenis = DB::table('master_jenis_tapes')->pluck('nomor_jenis', 'nomor_jenis');
        $listrak = DB::table('master_raks')->pluck('nomor_rak', 'kode_rak');
        
        return view ('/tapeedit',compact('datatape', 'listlokasi', 'listjenis', 'listrak'));
    }

    public function tapeupdate(Request $request, $nlt)
    {
        if($request->digunakan_tape == 0)
        {
             $checkunique = DB::table('tapes')->where('nomor_label_tape', $request->nomor_label_tape)->get();
             if($checkunique->count())
             {
                    $msg = 'Error duplicate tape name detected';
                    return redirect('/tapeedit/'.$nlt)->withErrors([$msg]);
             }
             
             $gettapedata = DB::table('tapes')->where('nomor_label_tape', $nlt)->first();
             DB::table('tapes')->where('nomor_label_tape', $nlt)
                               ->update(['nomor_label_tape' => $request->nomor_label_tape,
                                         'lokasi_tape' => $request->lokasi_tape,
                                         'jenis_tape' => $request->jenis_tape]);
            
            $audittrail = new audit_trail;
            $audittrail->actor_at = session('email');
            $audittrail->keterangan_at = "Update tape ".$nlt."->".$request->nomor_label_tape.", ".$gettapedata->jenis_tape."->".$request->jenis_tape.", ".$gettapedata->bulan_tahun."-> NULL, ".$gettapedata->keterangan_tape."->".$request->keterangan_tape.", ".$gettapedata->digunakan_tape."->".$request->digunakan_tape.", ".$gettapedata->slot_tape."->".$request->slot_tape.", ".$gettapedata->kode_rak_tape."-> NULL, ".$gettapedata->lokasi_tape."->".$request->lokasi_tape.", ".$gettapedata->status_tape."->".$request->status_tape;
            $audittrail->save();

            return redirect('/tapekosong');
        }
        if($request->digunakan_tape == 1)
        {
            $gettapedata = DB::table('tapes')->where('nomor_label_tape', $nlt)->first();
             
            if($request->kode_rak_tape != '' AND $request->lokasi_tape != '' AND $request->jenis_tape != '' )
            {
                $check = DB::table('master_raks')->where('kode_rak', $request->kode_rak_tape)
                                                 ->where('lokasi_rak', $request->lokasi_tape)
                                                 ->where('jenis_tape_rak', $request->jenis_tape)
                                                 ->get();
                if($check->count() == 0)
                {
                    $msg = 'Error location input';
                    return redirect('/tapeedit/'.$nlt)->withErrors([$msg]);
                }
            }
            $check = DB::table('tapes')->where('nomor_label_tape', $request->nomor_label_tape)
                                       ->where('nomor_label_tape', '!=', $nlt)
                                       ->get();
            if($check->count())
            {
                $msg = $request->nomor_label_tape.' already exist';
                return redirect('/tapeedit/'.$nlt)->withErrors([$msg]);
            }
            $check = DB::table('tapes')->where('lokasi_tape', $request->lokasi_tape)
                                       ->where('kode_rak_tape', $request->kode_rak_tape)
                                       ->where('slot_tape', $request->slot_tape)
                                       ->where('nomor_label_tape', '!=', $nlt)
                                       ->get();
            if($check->count())
            {
                $msg ='Slot is already occupied';
                return redirect('/tapeedit/'.$nlt)->withErrors([$msg]);
            }
            DB::table('tapes')->where('nomor_label_tape', $nlt)
                               ->update(['nomor_label_tape' => $request->nomor_label_tape,
                                         'bulan_tahun' => $request->bulan_tahun,
                                         'keterangan_tape' => $request->keterangan_tape,
                                         'digunakan_tape' => $request->digunakan_tape,
                                         'slot_tape' => $request->slot_tape,
                                         'kode_rak_tape' => $request->kode_rak_tape,
                                         'lokasi_tape' => $request->lokasi_tape,
                                         'status_tape' => $request->status_tape,
                                         'jenis_tape' => $request->jenis_tape]);
            
            $audittrail = new audit_trail;
            $audittrail->actor_at = session('email');
            $audittrail->keterangan_at = "Update tape ".$nlt."->".$request->nomor_label_tape.", ".$gettapedata->jenis_tape."->".$request->jenis_tape.", ".$gettapedata->bulan_tahun."->".$request->bulan_tahun.", ".$gettapedata->keterangan_tape."->".$request->keterangan_tape.", ".$gettapedata->digunakan_tape."->".$request->digunakan_tape.", ".$gettapedata->slot_tape."->".$request->slot_tape.", ".$gettapedata->kode_rak_tape."-> ".$request->kode_rak_tape.", ".$gettapedata->lokasi_tape."->".$request->lokasi_tape.", ".$gettapedata->status_tape."->".$request->status_tape;
            $audittrail->save();
            
            return redirect('/daftartape');
        }
    }

    public function tapedelete($nlt)
    {
        $tapes = new tape();
        $datatape = DB::table('tapes')->where('nomor_label_tape', $nlt)
                                      ->first();
        $tapes->destroy($nlt);
        if($datatape->digunakan_tape == 1)
        {
            return redirect('/daftartape');
        }
        else
        {
            return redirect('/tapekosong');
        }
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
        ->leftJoin('master_lokasis', 'tapes.lokasi_tape', '=', 'master_lokasis.kode_lokasi')
        ->leftJoin('master_raks', 'tapes.kode_rak_tape', '=', 'master_raks.kode_rak')
        ->where('nomor_label_tape', 'LIKE', '%' . $searchdata . '%')
        ->orwhere('jenis_tape',  'LIKE', '%' . $searchdata . '%')
        ->orwhere('status_tape', 'LIKE', '%' . $searchdata . '%')
        ->orwhere('lokasi_tape', 'LIKE', '%' . $searchdata . '%')
        ->orwhere('nama_lokasi', 'LIKE', '%' . $searchdata . '%')
        ->orwhere('nomor_rak', 'LIKE', '%' . $searchdata . '%')
        ->orwhere('keterangan_tape', 'LIKE', '%' . $searchdata . '%')
        ->orwhere('bulan_tahun', 'LIKE', '%' . $searchdata . '%')
        ->orderBy('nomor_rak')
        ->orderBy('slot_tape')
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
