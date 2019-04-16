<table id="approve" class="table-bordered table-striped" style="width: 100%">
<thead>
  <tr>
    <th>No</th>
    <th>ID Pimpinan</th>
    <th>Nama</th>
    <th>Status Izin</th>
    <th>Action</th>
  </tr>
</thead>
<tbody>
	@php
		$no = 0;
	@endphp
	@foreach ($data as $data2)
		@php
			$no++;
		@endphp
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $data2->id_pimpinan }}</td>
			<td>{{ $data2->nama }}</td>
			@php
				if($data2->status == '1'){
					$status = 'Disetujui';
					$act = '0';
				}else{
					$status = 'Belum';
					$act = '1';
				}
			@endphp
			<td>{{ $status }}</td>
			<form method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
				<input type="hidden" name="idizin" id="idizin" value="{{ $data2->id_izin }}">
			<td>
			@php
			if($data2->status == '1'){
			@endphp
					<a onclick="return confirm('Apakah Anda Yakin Akan Membatalkan Izin?')?coba({{ $data2->id }},{{ $act }}):'';" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></a>
			@php
				}else{
			@endphp
					<a onclick="return confirm('Apakah Anda Yakin Akan Mengizinkan?')?coba({{ $data2->id }},{{ $act }}):'';" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-ok"></i></a>
			@php
				}
			@endphp
			</td>
		</tr>
	@endforeach
</tbody>
</table>

<div class="container-login100-form-btn">
    <div class="wrap-login100-form-btn">
        <div class="login100-form-bgbtn"></div>
        @php
			if($jmlapprove < '1'){
				if($datalengkap == '1'){
					@endphp
					<button id="btnizin" onclick="coba2()" class="login100-form-btn">Izinkan</button>
			@php
				}else{

				}
			}else{

			}
			@endphp
    </div>
</div>
</form>
<script type="text/javascript">
	function coba(idapprove,act) {
		var idizin = document.getElementById("idizin").value;
      $.ajax({
          url: "{{ url('api/setujui/') }}"+"/"+idapprove+"/"+act,
          type: "GET",
          data: "id="+idapprove,
          cache: false,
          success: function(data){
              approve(idizin);
          }
      });
  }
  function coba2() {
		var idizin = document.getElementById("idizin").value;
      $.ajax({
          url: "{{ url('api/datalengkap/') }}"+"/"+idizin,
          type: "GET",
          data: "id="+idizin,
          cache: false,
          success: function(data){
              $('#modal-form').modal('hide');
          }
      });
  }
</script>