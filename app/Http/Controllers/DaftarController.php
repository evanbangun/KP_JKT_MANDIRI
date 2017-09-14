<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\peminjaman;
use App\master_lokasi;
use App\audit_trail;
use DB;
use PDF;

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

    public function peminjaman()
    {
         $lokasitape = master_lokasi::pluck('nama_lokasi', 'kode_lokasi');
        return view ('tambahticket',compact('lokasitape'));
   
    }

    public function storepeminjaman(Request $request)
    {   
        $this->validate($request, [
        'no_tiket' => 'unique:peminjamen',
        ]);
        $arrlabel = preg_split("/[\s,]+/", $request->nomor_label_tape);
        
        foreach($arrlabel as $nlt)
        {
            $lokasisumber = DB::table('tapes')->where('nomor_label_tape', $nlt)->first();
            $peminjaman = new peminjaman;
            $peminjaman->no_tiket = $request->no_tiket;
            $peminjaman->nomor_label_tape = $nlt;
            $peminjaman->lokasi_sumber = $lokasisumber->lokasi_tape;
            $peminjaman->lokasi_tujuan = $request->lokasi_tujuan;
            $peminjaman->lama_peminjaman = $request->lama_peminjaman;
            $peminjaman->keterangan = $request->keterangan;
            $peminjaman->save();
            // peminjaman::create($request->all());
            // $lokasisumber = DB::select("select lokasi_tape from tapes where nomor_label_tape = ?",[$request->nomor_label_tape]);
            // DB::update("update peminjamen set lokasi_sumber = '".$lokasisumber{0}->lokasi_tape."'  where nomor_label_tape  = '".$request->nomor_label_tape."' " );

            // DB::update('update tapes set lokasi_tape = ? where nomor_label_tape  = ?', [$request->lokasi_tujuan,$request->nomor_label_tape]);
        }
        return redirect ('/daftartiket');
    }


    public function open()
    {
        $tiket = DB::select("select p.no_tiket,p.nomor_label_tape,m.nama_lokasi as Sumber,ml.nama_lokasi as Tujuan,p.lama_peminjaman,p.keterangan,p.created_at,p.updated_at,CASE WHEN status=0 THEN 'New Ticket' WHEN status=1 THEN 'Tape On Delivery' WHEN status=2 THEN 'Restoring' WHEN status=3 THEN 'DONE' WHEN status=4 THEN 'Close Ticket'  ELSE 'Over Due Ticket' END as status
        from peminjamen p 
        left join master_lokasis m on m.kode_lokasi = p.lokasi_sumber
        left join master_lokasis ml on ml.kode_lokasi = p.lokasi_tujuan
        where status = 0
        GROUP BY no_tiket");

        
        return view ('OpenTicket',compact('tiket'))->with('alert','Tape On Delivery');
    }

    public function OnDeliver()
    {
        $tiket = DB::select("select p.no_tiket,p.nomor_label_tape,m.nama_lokasi as Sumber,ml.nama_lokasi as Tujuan,p.lama_peminjaman,p.keterangan,p.created_at,p.updated_at,CASE WHEN status=0 THEN 'New Ticket' WHEN status=1 THEN 'Tape On Delivery' WHEN status=2 THEN 'Restoring' WHEN status=3 THEN 'DONE' WHEN status=4 THEN 'Close Ticket'  ELSE 'Over Due Ticket' END as status
        from peminjamen p 
        left join master_lokasis m on m.kode_lokasi = p.lokasi_sumber
        left join master_lokasis ml on ml.kode_lokasi = p.lokasi_tujuan
        where status = 1
        GROUP BY no_tiket");

        
        return view ('daftarondelivery',compact('tiket'))->with('alert','New Ticket');
    }

    public function restore()
    {
        $tiket = DB::select("select p.no_tiket,p.nomor_label_tape,m.nama_lokasi as Sumber,ml.nama_lokasi as Tujuan,p.lama_peminjaman,p.keterangan,p.created_at,p.updated_at,CASE WHEN status=0 THEN 'New Ticket' WHEN status=1 THEN 'Tape On Delivery' WHEN status=2 THEN 'Restoring' WHEN status=3 THEN 'DONE' WHEN status=4 THEN 'Close Ticket'  ELSE 'Over Due Ticket' END as status
        from peminjamen p 
        left join master_lokasis m on m.kode_lokasi = p.lokasi_sumber
        left join master_lokasis ml on ml.kode_lokasi = p.lokasi_tujuan
        where status = 2
        GROUP BY no_tiket");

        
        return view ('daftarrestoring',compact('tiket'))->with('alert','New Ticket');
    }

    public function pdfviewtiket($id)
    {
        $items = DB::table('peminjamen')->leftJoin('master_lokasis', 'peminjamen.lokasi_tujuan', '=', 'master_lokasis.kode_lokasi')
                                        ->where('no_tiket', $id)
                                        ->get();
        view()->share('items',$items);

        $pdf = PDF::loadView('pdfviewtiket');
        return $pdf->download($items{0}->no_tiket.'.pdf');
    }

    public function editrestore($no_tiket) 
    {
        DB::update('update peminjamen set status = 2 where no_tiket = "'.$no_tiket.'"');
        echo "Record updated successfully.<br/>";
        $audittrail = new audit_trail;
        $audittrail->actor_at = session('email');
        $audittrail->keterangan_at = "Update status ".$no_tiket." menjadi restoring";
        $audittrail->save();
        return redirect ('/daftardeliver');
    }

    public function editdone($no_tiket) 
    {
        DB::update('update peminjamen set status = 3 where no_tiket = "'.$no_tiket.'"');
        echo "Record updated successfully.<br/>";

        $audittrail = new audit_trail;
        $audittrail->actor_at = session('email');
        $audittrail->keterangan_at = "Update status ".$no_tiket." menjadi done";
        $audittrail->save();
        return redirect ('/daftarrestore');
    }

    public function edit($no_tiket) 
    {
        DB::update('update peminjamen set status = 1 where no_tiket = "'.$no_tiket.'"');
        echo "Record updated successfully.<br/>";

        $audittrail = new audit_trail;
        $audittrail->actor_at = session('email');
        $audittrail->keterangan_at = "Update status ".$no_tiket." menjadi on deliver";
        $audittrail->save();
        return redirect ('/openticket');
    }
    
    public function daftarclose()
    {
        $tiket = DB::select("select p.no_tiket,p.nomor_label_tape,m.nama_lokasi as Sumber,ml.nama_lokasi as Tujuan,p.lama_peminjaman,p.keterangan,p.created_at,p.updated_at,CASE WHEN status=0 THEN 'New Ticket' WHEN status=1 THEN 'Tape On Delivery' WHEN status=2 THEN 'Restoring' WHEN status=3 THEN 'DONE' WHEN status=4 THEN 'Close Ticket'  ELSE 'Over Due Ticket' END as status
        from peminjamen p 
        left join master_lokasis m on m.kode_lokasi = p.lokasi_sumber
        left join master_lokasis ml on ml.kode_lokasi = p.lokasi_tujuan
        where status = 4
        GROUP BY no_tiket");
        return view ('daftarcloseticket',compact('tiket'));
    }

    public function closed()
    {
        $tiket = DB::select("select p.no_tiket,p.nomor_label_tape,m.nama_lokasi as Sumber,ml.nama_lokasi as Tujuan,p.lama_peminjaman,p.keterangan,p.created_at,p.updated_at,CASE WHEN status=0 THEN 'New Ticket' WHEN status=1 THEN 'Tape On Delivery' WHEN status=2 THEN 'Restoring' WHEN status=3 THEN 'DONE' WHEN status=4 THEN 'Close Ticket'  ELSE 'Over Due Ticket' END as status
        from peminjamen p 
        left join master_lokasis m on m.kode_lokasi = p.lokasi_sumber
        left join master_lokasis ml on ml.kode_lokasi = p.lokasi_tujuan
        where status = 3
        GROUP BY no_tiket");
        return view ('CloseTicket',compact('tiket'));
    }

    public function editclose($no_tiket) 
    {

        $lokasi = DB::select('select lokasi_sumber from peminjamen where no_tiket = "'.$no_tiket.'"');
        $label=DB::select('select nomor_label_tape from peminjamen where no_tiket = "'.$no_tiket.'"');
        DB::update('update tapes set lokasi_tape = ? where nomor_label_tape  = ?', [$lokasi{0}->lokasi_sumber,$label{0}->nomor_label_tape]);
        DB::update('update peminjamen set status = 4 where no_tiket = "'.$no_tiket.'"');
        echo "Record updated successfully.<br/>";
        $audittrail = new audit_trail;
        $audittrail->actor_at = session('email');
        $audittrail->keterangan_at = "Update status ".$no_tiket." menjadi closed";
        $audittrail->save();
        return redirect ('/daftardone');
    }

    public function overdue()
    {

           $tiket = DB::select("select p.no_tiket,p.nomor_label_tape,m.nama_lokasi as Sumber,ml.nama_lokasi as Tujuan,p.lama_peminjaman,p.keterangan,p.created_at,p.updated_at,CASE WHEN status=0 THEN 'New Ticket' WHEN status=1 THEN 'Tape On Delivery' WHEN status=2 THEN 'Restoring' WHEN status=3 THEN 'DONE' WHEN status=4 THEN 'Close Ticket'  ELSE 'Over Due Ticket' END as status
          from peminjamen p 
          left join master_lokasis m on m.kode_lokasi = p.lokasi_sumber
          left join master_lokasis ml on ml.kode_lokasi = p.lokasi_tujuan
          where p.lama_peminjaman < CURDATE() and status IN (0,1,2,3)
          GROUP BY no_tiket");

        return view ('OverDueTicket',compact('tiket'));
    }

    public function extendtiket($no_tiket)
    {
        $getno_tiket = DB::table('peminjamen')->where('no_tiket', $no_tiket)->first();    
        return view('/extendtiket', compact('getno_tiket'));
    }

    public function extendupdate(Request $request , $no_tiket)
    {
         DB::table('peminjamen')->where('no_tiket', $no_tiket)
                                ->update(['lama_peminjaman' => $request->lama_peminjaman,
                                          'keterangan' => $request->keterangan]);
       
        return redirect('/overdueticket');
    }

    public function listpinjam($no_tiket) 
     {
        $tiket = DB::select('select p.no_tiket,p.nomor_label_tape,m.nama_lokasi as Sumber,ml.nama_lokasi as Tujuan
          from peminjamen p 
          left join master_lokasis m on m.kode_lokasi = p.lokasi_sumber
          left join master_lokasis ml on ml.kode_lokasi = p.lokasi_tujuan
        where p.no_tiket = "'.$no_tiket.'"');
        return view ('listpinjamtape',compact('tiket'));
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
