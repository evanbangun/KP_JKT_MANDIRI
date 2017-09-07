<style type="text/css">
  table td, table th{
    border:0px solid black;
  }
</style>
<div class="container">

  <br/>

  <table width='100%'>
    <tr align="center">
      <th>No</th>
      <th>Nomor Tape</th>
      <th>Jenis Tape</th>
      <th>Lokasi Rak</th>
      <th>Status</th>
      <th>Backup</th>
    </tr>
    @foreach ($items as $key => $item)
    <tr align="center">
      <td>{{ ++$key }}</td>
      <td>{{$item->nomor_label_tape}}</td>
      <td>{{$item->jenis_tape}}</td>
      <td>{{$item->nama_lokasi}}</td>
      <td>{{$item->status_tape}}</td>
      <td>{{$item->bulan_tahun}}</td>
      <td>{{ Form::checkbox('check', 1, null, ['id' => 'squaredFour']) }}</td>
    </tr>
    @endforeach
  </table>
</div>