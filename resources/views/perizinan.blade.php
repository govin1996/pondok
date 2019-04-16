@php
  header('Expires: Mon, 1 Jul 1998 01:00:00 GMT');
  header('Cache-Control: no-store, no-cache, must-revalidate');
  header('Cache-Control: post-check=0, pre-check=0', FALSE);
  header('Pragma: no-cache');
  header( "Last-Modified: " . gmdate( "D, j M Y H:i:s" ) . " GMT" );
@endphp
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Data Perizinan - Smart Boarding</title>
  <link rel="icon" type="image/png" href="{{ asset('template/img/mli.png') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('template/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('template/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <link href="{{ url('https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('template/dist/css/skins/_all-skins.min.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">

  <!-- Google Font -->
  <link rel="stylesheet" href="{{ url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic') }}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include('header')

  <!-- Main Section -->
    <section class="main-section">
        <!-- Add Your Content Inside -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <h1>
            Perizinan
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Perizinan</li>
          </ol>
        </div>

        <!-- Main content -->
        <div class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Perizinan</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="" style="margin-bottom: 20px;">
                    <button class="btn btn-info" onclick="addForm()">Tambah</button>
                  </div>
                  <table id="izin" class="table table-bordered table-striped" width="inherit">
                    <thead>
                      <tr>
                        <th>No</th>
                        {{-- <th>ID Izin</th> --}}
                        <th>NIS</th>
                        <th>Nama Santri</th>
                        <th>Keperluan</th>
                        <th>Tipe Penjemput</th>
                        <th>Nama Penjemput</th>
                        <th>Status Izin</th>
                        <th>Status Kembali</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
              <!-- /.box-body -->
              </div>
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.content -->
        </div>
        @include('master.perizinan')
        <!-- /.content -->
    </section>

    @include('footer')

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('template/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('template/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('template/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('template/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ url('https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js') }}"></script>
{{-- Validator --}}
<script src="{{ asset('assets/validator/validator.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('template/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('template/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('template/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>
</body>
<script type="text/javascript">
  var table = $('#izin').DataTable({
    processing: true,
    serverSide: false,
    ajax: "{{ route('api.tampilizin') }}",
    responsive: true,
    autoWidth: true,
    columns: [
        {data: 'DT_RowIndex', name:'DT_RowIndex'},
        {data: 'nis' , name : 'nis' },
        {data: 'nama_santri' , name : 'nama_santri' },
        {data: 'keperluan' , name : 'nama_mahrom' },
        {data: 'tipe_penjemput' , name : 'tipe_penjemput' },
        {data: 'nama_penjemput' , name : 'nama_penjemput' },
        {data: 'approve' ,
          render: function(data){
            if(data==0){
              return 'Belum Lengkap';
            }
            else{
              return 'Lengkap';
            }
          },
         name : 'approve' },
        {data: 'status_kembali' ,
          render: function(data){
            if(data==0){
              return 'Belum';
            }
            else{
              return data;
            }
          },
         name : 'status_kembali' },
        {data: 'action', name: 'action'}
    ]
  });

  function approve(id_izin) {
      $.ajax({
          url: "{{ url('api/tampilapprove/') }}"+"/"+id_izin,
          type: "GET",
          data: "id="+id_izin,
          cache: false,
          success: function(data){
              $('#tabelapprove').html(data);
          }
      });
  }

  function pulang(idizin) {
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
      swal({
          title: 'Yakin Santri Sudah Kembali?',
          text: "Data Akan Terupdate",
          type: 'warning',
          showCancelButton: true,
          cancelButtonColor: '#d33',
          confirmButtonColor: '#00e4d0',
          confirmButtonText: 'Ya'
      }).then(function () {
      $.ajax({
          url: "{{ url('api/pulang/') }}"+"/"+idizin,
          type: "GET",
          data: "id="+idizin,
          cache: false,
          success: function(data){
            table.ajax.reload();
          }
      });
    });
  }

  function addForm() {
    save_method = "add";
    $('input[name=_method]').val('POST');
    $('.modal').modal('show');
    $('#modal-form form')[0].reset();
    $('.modal-title').text('Tambah Data Perizinan');
    $('#nis').removeAttr('disabled');
    $('#tipe_penjemput').removeAttr('disabled');
    $('#nama_p').css('display', 'none');
    $('#nama_penjemput').removeAttr('disabled');
    $('#nama_m').css('display', 'none');
    $('#nama').removeAttr('disabled');
    $('#keperluan').removeAttr('disabled');
    $('#tgl_pulang2').css('display', 'none');
    $('#tgl_kembali2').css('display', 'none');
    $('#tgl_pulang').removeAttr('disabled');
    $('#tgl_kembali').removeAttr('disabled');
    $('#jam_pergi2').css('display', 'none');
    $('#jam_kembali2').css('display', 'none');
    $('#jam_pergi').removeAttr('disabled');
    $('#jam_kembali').removeAttr('disabled');
    $('#photo').css('display', 'none');
    $('#tabelapprove').css('display', 'none');
    $('#btnsimpan').css('display', 'flex');
  }

  function cek(id) {
      save_method = 'edit';
      $('input[name=_method]').val('PATCH');
      $('#modal-form form')[0].reset();
      $.ajax({
          url: "{{ url('/izin') }}" + '/' + id + "/edit",
          type: "GET",
          dataType: "JSON",
          success: function(data) {
              $('#modal-form').modal('show');
              $('.modal-title').text('Lihat Data Izin');
              $('#tabelapprove').css('display', 'block');
              $('#btnsimpan').css('display', 'none');
              $('#id').val(data.id);
              $('#nis').val(data.nis);
              $('#nis').attr('disabled', 'true');
              $('#photo').css('display', 'block');
              $('#photo').attr('src', data.photo);
              $('#nama_santri').val(data.nama);
              $('#nama_santri').attr('disabled', 'true');
              $('#tipe_penjemput').val(data.tipe_penjemput);
              $('#tipe_penjemput').attr('disabled', 'true');
              if(data.tipe_penjemput=="Mahrom"){
                $('#nama_p').css('display', 'none');
                $('#nama_m').css('display', 'inline-block');
                var opsi = '<option value="'+data.nama_penjemput+'">'+data.nama_penjemput+'</option>';
                $('#nama').html(opsi);
                $('#nama').attr('disabled', 'true');
              }else{
                $('#nama_m').css('display', 'none');
                $('#nama_p').css('display', 'inline-block');
                $('#nama_penjemput').val(data.nama_penjemput);
                $('#nama_penjemput').attr('disabled', 'true');
              }
              $('#keperluan').val(data.keperluan);
              $('#keperluan').attr('disabled', 'true');
              if(data.keperluan=="Pulang"){
                $('#tgl_pulang2').css('display', 'inline-block');
                $('#tgl_kembali2').css('display', 'inline-block');
                $('#jam_pergi2').css('display', 'none');
                $('#jam_kembali2').css('display', 'none');
                $('#tgl_pulang').val(data.tgl_plg);
                $('#tgl_kembali').val(data.tgl_kembali);
                $('#tgl_pulang').attr('disabled', 'true');
                $('#tgl_kembali').attr('disabled', 'true');
              }else{
                $('#tgl_pulang2').css('display', 'none');
                $('#tgl_kembali2').css('display', 'none');
                $('#jam_pergi2').css('display', 'inline-block');
                $('#jam_kembali2').css('display', 'inline-block');
                $('#jam_pergi').val(data.jam_pergi);
                $('#jam_kembali').val(data.jam_kembali);
                $('#jam_pergi').attr('disabled', 'true');
                $('#jam_kembali').attr('disabled', 'true');
              }
              approve(data.id_izin);
          },
          error : function() {
              alert("Tidak Ada Data");
          }
      });
  }

  function deleteData(id){
      var csrf_token = $('meta[name="csrf-token"]').attr('content');
      swal({
          title: 'Yakin Hapus Data?',
          text: "Data Akan Terhapus Secara Permanen",
          type: 'warning',
          showCancelButton: true,
          cancelButtonColor: '#d33',
          confirmButtonColor: '#00e4d0',
          confirmButtonText: 'Ya'
      }).then(function () {
          $.ajax({
              url : "{{ url('/izin') }}" + '/' + id,
              type : "POST",
              data : {'_method' : 'DELETE', '_token' : csrf_token},
              success : function(data) {
                  table.ajax.reload();
                  swal({
                      title: 'Sukses !',
                      text: 'Data Terhapus',
                      type: 'success',
                      timer: '1000'
                  })
              },
              error : function () {
                  swal({
                      title: 'Oops...',
                      text: data.message,
                      type: 'error',
                      timer: '1000'
                  })
              }
          });
      });
  }

  $(function(){
    $('#modal-form form').validator().on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            var id = $('#id').val();
            if (save_method == 'add') url = "{{ url('/izin') }}";
            else url = "{{ url('/izin') . '/' }}" + id;
            $.ajax({
                url: url,
                type: "POST",
                data: new FormData($("#modal-form form")[0]),
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#modal-form').modal('hide');
                    table.ajax.reload();
                    swal({
                        title: 'Sukses!',
                        text:'Data Berhasil Ditambah',
                        type: 'success',
                        timer: '1000'
                    })
                }
            });
            return false;
          }
      });
  });
</script>
</html>
