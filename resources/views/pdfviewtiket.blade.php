	<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-yw4l{vertical-align:top}
tr.noBorder td {
  border: 0;
}
</style>
<div class="panel panel-default">

    <div class="panel-body">
       <br>
        <div>
         
          <div style="float:left; margin:0px">
<!-- <img src="{{asset('images/logo.png')}}" align="right"  alt="Mandiri Logo" style="width:200px;height:50px;"> -->
<br>
<br>
<br>
<br>
<h2><center><b><u>DELIVERABLE ACCEPTANCE CERTIFICATE</u></b> </center> </h2>
  <center>
<table class="tg" >
  <tr>
    <th class="tg-yw4l">Nomor Tiket</th>
    <th class="tg-yw4l">{{$items{0}->no_tiket}}</th>
  </tr>
  <tr>
    <td class="tg-yw4l">File &amp; Periode</td>
    <td class="tg-yw4l">
       <table style="width: 100%" class="table table-bordered table-striped table-hover table-condensed tfix">
                    <thead align="center">
                       <tr>
                           <td><b>File</b></td>
                           <td><b>Periode</b></td>
                       </tr>
                   </thead>
                   @foreach($items as $item)
                       <tr>
                           <td>{{$item->nomor_label_tape}}</td>
                           <td>{{$item->nomor_label_tape}}</td>
                       </tr>
                   @endforeach
                   </table>
    </td>
  </tr>
  <tr>
    <td class="tg-yw4l">Tempat Restore</td>
    <td class="tg-yw4l">{{$items{0}->nama_lokasi}}</td>
  </tr>
  <!-- <tr>
    <td class="tg-yw4l">Request By</td>
    <td class="tg-yw4l"></td>
  </tr> -->
  <tr>
    <td class="tg-yw4l">Description</td>
    <td class="tg-yw4l">{{$items{0}->keterangan}}</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Dengan diterimanya BAST oleh pihak pertama dan kedua, maka kegiatan restore data ini telah selesai dilaksanakan. <br>Terimakasih.</td>
  </tr>
  <tr class="noBorder">
    <td >Mengetahui,<br>Pihak Pertama<br><br><br>Liga Awami<br>TL IT Data & Storage Management<br>IT Infrastructure Group</td>
    <td ><br>Pihak Kedua<br><br><br>Nama Peminjam<br>Nama Jabatan<br>Group Peminjam</td>
</tr>
</table>
  </center>
         </div>
      
        </div>
    </div>
    </center>
    </div>
