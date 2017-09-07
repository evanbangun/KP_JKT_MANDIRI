<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\tape;
use App\list_testing;
use App\audit_trail;
use DB;
use PDF;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stockopname()
    {
        $lokasi = DB::table('master_lokasis')->pluck('nama_lokasi', 'kode_lokasi');
        $rak = DB::table('master_raks')->pluck('nomor_rak', 'kode_rak');
        return view ('/stockopname',compact('lokasi', 'rak'));
    }

    public function opnamelist(Request $request)
    {
        $this->validate($request, [
            'opname_by' => 'required',
            ]);
        if($request->opname_by == 0)
        {
            $tapes = DB::table('tapes')->leftJoin('master_lokasis', 'tapes.lokasi_tape', '=', 'master_lokasis.kode_lokasi')
                                       ->leftJoin('master_raks', 'tapes.kode_rak_tape', '=', 'master_raks.kode_rak')
                                       ->where('digunakan_tape', 1)
                                       ->get();      
            $id=0;  
        }
        else if($request->opname_by == 1)
        {
            $tapes = DB::table('tapes')->leftJoin('master_lokasis', 'tapes.lokasi_tape', '=', 'master_lokasis.kode_lokasi')
                                       ->leftJoin('master_raks', 'tapes.kode_rak_tape', '=', 'master_raks.kode_rak')
                                       ->where('digunakan_tape', 1)
                                       ->where('lokasi_tape', $request->lokasi_opname)
                                       ->get();
            $id=$request->lokasi_opname;
        }
        else if($request->opname_by == 2)
        {   
            $tapes = DB::table('tapes')->leftJoin('master_lokasis', 'tapes.lokasi_tape', '=', 'master_lokasis.kode_lokasi')
                                       ->leftJoin('master_raks', 'tapes.kode_rak_tape', '=', 'master_raks.kode_rak')
                                       ->where('kode_rak_tape', $request->rak_opname)
                                       ->where('digunakan_tape', 1)
                                       ->get();
            $id=$request->rak_opname;
        }
        else if($request->opname_by == 3)
        {   
            $this->validate($request, [
                'tahun_opname' => 'required',
                ]);
            $tapes = DB::table('tapes')->leftJoin('master_lokasis', 'tapes.lokasi_tape', '=', 'master_lokasis.kode_lokasi')
                                       ->leftJoin('master_raks', 'tapes.kode_rak_tape', '=', 'master_raks.kode_rak')
                                       ->where('YEAR(bulan_tahun)', $request->tahun_opname)
                                       ->where('digunakan_tape', 1)
                                       ->get();
            $id=$request->tahun_opname;
        }
        $opnameby = $request->opname_by;
        return view ('opnamelist',compact('tapes', 'opnameby', 'id'));
    }

    public function pdfviewopname($opnameby, $id)
    {
        $audittrail = new audit_trail;
        if($opnameby == 0)
        {
            $tapes = DB::table('tapes')->leftJoin('master_lokasis', 'tapes.lokasi_tape', '=', 'master_lokasis.kode_lokasi')
                                       ->leftJoin('master_raks', 'tapes.kode_rak_tape', '=', 'master_raks.kode_rak')
                                       ->where('digunakan_tape', 1)
                                       ->get();  
            $audittrail->keterangan_at = "Tape Opname pada seluruh tape";
        }
        else if($opnameby == 1)
        {
            $tapes = DB::table('tapes')->leftJoin('master_lokasis', 'tapes.lokasi_tape', '=', 'master_lokasis.kode_lokasi')
                                       ->leftJoin('master_raks', 'tapes.kode_rak_tape', '=', 'master_raks.kode_rak')
                                       ->where('digunakan_tape', 1)
                                       ->where('lokasi_tape', $id)
                                       ->get();
            $audittrail->keterangan_at = "Tape Opname pada lokasi ".$tapes{0}->nama_lokasi;
        }
        else if($opnameby == 2)
        {   
            $tapes = DB::table('tapes')->leftJoin('master_lokasis', 'tapes.lokasi_tape', '=', 'master_lokasis.kode_lokasi')
                                       ->leftJoin('master_raks', 'tapes.kode_rak_tape', '=', 'master_raks.kode_rak')
                                       ->where('kode_rak_tape', $id)
                                       ->where('digunakan_tape', 1)
                                       ->get();
            $audittrail->keterangan_at = "Tape Opname pada rak ".$tapes{0}->nomor_rak;
        }
        // else if($opnameby == 3)
        // {   
        //     $tapes = DB::table('tapes')->leftJoin('master_lokasis', 'tapes.lokasi_tape', '=', 'master_lokasis.kode_lokasi')
        //                                ->leftJoin('master_raks', 'tapes.kode_rak_tape', '=', 'master_raks.kode_rak')
        //                                ->where('YEAR(bulan_tahun)', $id)
        //                                ->where('digunakan_tape', 1)
        //                                ->get();
        //     $audittrail->keterangan_at = "Tape Opname untuk tape tahun ".$id;
        // }
        view()->share('items',$tapes);

        $pdf = PDF::loadView('pdfviewopname');

        $audittrail->actor_at = session('email');
        $audittrail->save();

        return $pdf->download('Tape Opname '.date("d-m-Y").'.pdf');
    }


    public function pdfviewtesting(Request $request, $id)
    {
        $items = DB::table('list_testings')->leftJoin('tapes', 'list_testings.label_tape_testing', '=', 'tapes.nomor_label_tape')
                                           ->where('kode_tape_testing', $id)->get();
        view()->share('items',$items);

        if($request->has('download')){
            $pdf = PDF::loadView('pdfviewtesting');
            return $pdf->download($items{0}->kode_tape_testing.'.pdf');
        }

        return view('pdfviewtesting');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function movingtape()
    {
        $listlokasi = DB::table('master_lokasis')->pluck('nama_lokasi', 'kode_lokasi');
        return view ('/movingtape',compact('listlokasi'));
    }

    public function testingtape()
    {
        $jumlahtest = DB::table('list_testings')->groupBy('kode_tape_testing')->get();
        $index=0;
        foreach($jumlahtest as $jt)
        {
            $status = DB::table('list_testings')->where('kode_tape_testing', $jt->kode_tape_testing)
                                                ->where('hasil_tape_testing', 0)
                                                ->get();
            if($status->count())
            {
                $hasil[$index] = 'Not Finished';
            }
            else
            {
                $hasil[$index] = 'Finished';
            }
            $index++;
        }
        return view ('/testingtape',compact('jumlahtest', 'hasil'));
    }

    public function createtesting()
    {
        $jenistape = DB::table('master_jenis_tapes')->get();
        $index=0;
        foreach($jenistape as $jt)
        {
            $months3[$index] = tape::inRandomOrder()->where('jenis_tape', $jt->nomor_jenis)->whereRaw('bulan_tahun BETWEEN DATE_SUB(curdate(), INTERVAL 4 MONTH) AND DATE_SUB(CURDATE(), INTERVAL 3 MONTH)')->first();
            $months6[$index] = tape::inRandomOrder()->where('jenis_tape', $jt->nomor_jenis)->whereRaw('bulan_tahun BETWEEN DATE_SUB(curdate(), INTERVAL 7 MONTH) AND DATE_SUB(CURDATE(), INTERVAL 6 MONTH)')->first();
            $years1[$index] = tape::inRandomOrder()->where('jenis_tape', $jt->nomor_jenis)->whereRaw('bulan_tahun BETWEEN DATE_SUB(curdate(), INTERVAL 2 YEAR) AND DATE_SUB(CURDATE(), INTERVAL 1 YEAR)')->first();
            $years3[$index] = tape::inRandomOrder()->where('jenis_tape', $jt->nomor_jenis)->whereRaw('bulan_tahun BETWEEN DATE_SUB(curdate(), INTERVAL 4 YEAR) AND DATE_SUB(CURDATE(), INTERVAL 3 YEAR)')->first();
            $index++;
        }
        return view ('/createtesting', compact('jenistape', 'months3', 'months6', 'years1', 'years3'));
    }

    public function konfirmasitesting(Request $request)
    {
        $this->validate($request, [
            'nama_penguji' => 'required'
            ]);
        $jenistape = DB::table('master_jenis_tapes')->get();
        $index=0;
        $counttesting = DB::table('list_testings')->selectRaw('count(*) as jumlah_testing')->groupBy('kode_tape_testing')->get();    
        if($counttesting->count())
        {
            $indextesting = "TESTNUM_".($counttesting{0}->jumlah_testing + 1);
        }
        else
        {
            $indextesting = "TESTNUM_0";
        }
        foreach($jenistape as $jt)
        {
            if($request->months3save[$index] != '')
            {
                $list_testing = new list_testing;
                $list_testing->kode_tape_testing = $indextesting;
                $list_testing->label_tape_testing = $request->months3save[$index];
                $list_testing->umur_tape_testing = 3;
                $list_testing->hasil_tape_testing = 0;
                $list_testing->keterangan_tape_testing = '';
                $list_testing->penguji_tape_testing = $request->nama_penguji;
                $list_testing->save();
            }
            if($request->months6save[$index] != '')
            {
                $list_testing = new list_testing;
                $list_testing->kode_tape_testing = $indextesting;
                $list_testing->label_tape_testing = $request->months6save[$index];
                $list_testing->umur_tape_testing = 6;
                $list_testing->hasil_tape_testing = 0;
                $list_testing->keterangan_tape_testing = '';
                $list_testing->penguji_tape_testing = $request->nama_penguji;
                $list_testing->save();
            }
            if($request->years1save[$index] != '')
            {
                $list_testing = new list_testing;
                $list_testing->kode_tape_testing = $indextesting;
                $list_testing->label_tape_testing = $request->years1save[$index];
                $list_testing->umur_tape_testing = 12;
                $list_testing->hasil_tape_testing = 0;
                $list_testing->keterangan_tape_testing = '';
                $list_testing->penguji_tape_testing = $request->nama_penguji;
                $list_testing->save();
            }
            if($request->years3save[$index] != '')
            {
                $list_testing = new list_testing;
                $list_testing->kode_tape_testing = $indextesting;
                $list_testing->label_tape_testing = $request->years3save[$index];
                $list_testing->umur_tape_testing = 36;
                $list_testing->hasil_tape_testing = 0;
                $list_testing->keterangan_tape_testing = '';
                $list_testing->penguji_tape_testing = $request->nama_penguji;
                $list_testing->save();
            }
            $index++;
        }

        $audittrail = new audit_trail;
        $audittrail->actor_at = session('email');
        $audittrail->keterangan_at = "Testing tape";
        $audittrail->save();

        return redirect ('/testingtape');
    }

    public function edittest($ktt)
    {
        $listtesting = DB::table('list_testings')->leftJoin('tapes', 'list_testings.label_tape_testing', '=', 'tapes.nomor_label_tape')
                                                 ->where('kode_tape_testing', $ktt)
                                                 ->get();
        return view ('/edittest', compact('listtesting'));
    }

    public function updatetesting(Request $request)
    {
        $update = DB::table('list_testings')->where('kode_tape_testing', $request->kode_tape_testing)
                                            ->get();
        $index=0;
        foreach ($update as $up)
        {
            DB::table('list_testings')->where('kode_tape_testing', $up->kode_tape_testing)
                                      ->where('label_tape_testing', $request->label_tape_testing[$index])
                                      ->update(['object_awal_testing' => $request->object_awal_testing[$index],
                                                'library_awal_testing' => $request->library_awal_testing[$index],
                                                'library_tujuan_testing' => $request->library_tujuan_testing[$index],
                                                'object_new_testing' => $request->object_new_testing[$index],
                                                'hasil_tape_testing' => $request->hasil_testing[$index],
                                                'keterangan_tape_testing' => $request->keterangan_testing[$index]]);
            $index++;
        }

        $audittrail = new audit_trail;
        $audittrail->actor_at = session('email');
        $audittrail->keterangan_at = "Update testing tape kode ".$request->kode_tape_testing; 
        $audittrail->save();
        return redirect ('/testingtape');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function movetape(Request $request)
    {
        $arrlabel = preg_split("/[\s,]+/", $request->nomor_label_tape);
        
        foreach($arrlabel as $nlt)
        {
            $datatape = DB::table('tapes')->where('nomor_label_tape', $nlt)->first();
            if($datatape)
            {
                if($datatape->digunakan_tape == 0)
                {
                    DB::table('tapes')->where('nomor_label_tape', $nlt)
                                      ->update(['lokasi_tape' => $request->lokasi]);
                }
                else if($datatape->digunakan_tape == 1)
                {
                    $checkrak = DB::table('master_raks')->where('lokasi_rak', $request->lokasi)
                                                        ->where('jenis_tape_rak', $datatape->jenis_tape)
                                                        ->get();
                    if($checkrak->count())
                    {
                        $full = true;
                        foreach($checkrak as $cr)
                        {
                            $checktape = DB::table('tapes')->where('kode_rak_tape', $cr->kode_rak)->get();
                            if($checktape->count() < $cr->kapasitas_rak)
                            {
                                DB::table('tapes')->where('nomor_label_tape', $nlt)
                                                  ->update(['lokasi_tape' => $request->lokasi,
                                                            'kode_rak_tape' => $cr->kode_rak]);
                                $full = false;
                                break;
                            }
                        }
                        if($full)
                        {
                            DB::table('tapes')->where('nomor_label_tape', $nlt)
                                              ->update(['lokasi_tape' => $request->lokasi,
                                                        'kode_rak_tape' => NULL,
                                                        'slot_tape' => NULL]);
                        }
                    }
                    else
                    {
                        DB::table('tapes')->where('nomor_label_tape', $nlt)
                                          ->update(['lokasi_tape' => $request->lokasi,
                                                    'kode_rak_tape' => NULL,
                                                    'slot_tape' => NULL]);
                    }
                }
            }
        }

        $audittrail = new audit_trail;
        $audittrail->actor_at = session('email');
        $audittrail->keterangan_at = "Pemindahan tape ke ".$request->lokasi;
        $audittrail->save();

        return redirect('/daftartape');
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
