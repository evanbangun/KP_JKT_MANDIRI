<style type="text/css">
  table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
</style>
<div class="container">

  <br/>
  <a href="{{ route('pdfviewtesting',['download'=>'pdf', 'id'=>$items{0}->kode_tape_testing]) }}">Download PDF</a>
  <h2 align="center">FORMULIR PENGUJIAN TAPE</h1>
  <h3>Tanggal : {{date_create($items{0}->created_at)->format('d-m-Y')}}</h3>
  <table width="100%">
    <tr align="center">
      <th>No</th>
      <th>Nomor Label Tape / Tanggal Backup</th>
      <th>Nama File/Object</th>
      <th>Library</th>
      <th>Direstore ke Library</th>
      <th>Nama File/Object Baru</th>
      <th>Keterangan Status Uji</th>
    </tr>
    @foreach ($items as $key => $item)
    <tr align="center">
      <td>{{ ++$key }}</td>
      <td>{{ $item->label_tape_testing }} / {{ $item->bulan_tahun }} </td>
      <td>{{ $item->object_awal_testing }}</td>
      <td>{{ $item->library_awal_testing }}</td>
      <td>{{ $item->library_tujuan_testing }}</td>
      <td>{{ $item->object_new_testing }}</td>
      <td align="left">{{ $item->keterangan_tape_testing }}</td>
    </tr>
    @endforeach
  </table>
  <h4>Catatan : </h4>
  <table style="border:none" width="100%" style="margin:0px">
    <tr>
      <td style="padding:100px" colspan="6"></td>
    </tr>
    <tr style="border:none">
      <td colspan="2" align="center" style="border:none; padding-bottom:125px; padding-top:50px">Diserahkan oleh</td>
      <td colspan="2" align="center" style="border:none; padding-bottom:125px; padding-top:50px">Direstore oleh</td>
      <td colspan="2" align="center" style="border:none; padding-bottom:125px; padding-top:50px">Diperiksa oleh</td>
    </tr>
    <tr style="border:none">
      <td align="center" style="border:none;">(</td>
      <td align="center" style="border:none;">)</td>
      <td align="center" style="border:none;">(</td>
      <td align="center" style="border:none;">)</td>
      <td align="center" style="border:none;">(</td>
      <td align="center" style="border:none;">)</td>
    </tr>    
  </table>
</div>