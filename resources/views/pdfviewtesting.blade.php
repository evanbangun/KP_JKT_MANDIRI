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
      <td>{{ $item->label_tape_testing }}</td>
      <td>
          
      </td>
      <td></td>
      <td></td>
      <td></td>
      <td align="left">{{ $item->keterangan_tape_testing }}</td>
    </tr>
    @endforeach
  </table>
  <h3>Catatan : </h3>
</div>