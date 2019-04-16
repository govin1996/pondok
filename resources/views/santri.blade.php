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
  <title>Data Santri - Smart Boarding</title>
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
            Santri
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Santri</li>
          </ol>
        </div>

        <!-- Main content -->
        <div class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Santri</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="" style="margin-bottom: 20px;">
                    <button class="btn btn-info" onclick="addForm()">Tambah</button>
                  </div>
                  <table id="santri" class="table table-bordered table-striped" width="inherit">
                    <thead>
                      <tr>
                        <th>No</th>
                        {{-- <th>Kodeapp</th> --}}
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Daerah</th>
                        <th>Kamar</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Status</th>
                        <th>Foto</th>
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
        @include('master.santri')
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
  var table = $('#santri').DataTable({
    processing: true,
    serverSide: false,
    ajax: "{{ route('api.tampilsantri') }}",
    responsive: true,
    autoWidth: true,
    columns: [
        {data: 'DT_RowIndex', name:'DT_RowIndex'},
        // {data: 'kodeapp' , name : 'kodeapp'},
        {data: 'nis' , name : 'nis' },
        {data: 'nama' , name : 'nama' },
        {data: 'daerah' , name : 'daerah' },
        {data: 'kamar' , name : 'kamar' },
        {data: 'tempat_lahir' , name : 'tempat_lahir' },
        {data: 'tanggal_lahir' , name : 'tanggal_lahir' },
        {data: 'status' , name : 'status' },
        {data: 'photo', name: 'photo'},
        {data: 'action', name: 'action'}
    ]
  });

  function addForm() {
    save_method = "add";
    $('input[name=_method]').val('POST');
    $('.modal').modal('show');
    $('#modal-form form')[0].reset();
    $('.modal-title').text('Tambah Data Santri');
  }

  function editForm(id) {
      save_method = 'edit';
      $('input[name=_method]').val('PATCH');
      $('#modal-form form')[0].reset();
      $.ajax({
          url: "{{ url('/santri') }}" + '/' + id + "/edit",
          type: "GET",
          dataType: "JSON",
          success: function(data) {
              $('#modal-form').modal('show');
              $('.modal-title').text('Edit Data Santri');
              $('#id').val(data.id);
              $('#nis').val(data.nis);
              $('#nis').attr('readonly','true');
              $('#nama').val(data.nama);
              $('#daerah').val(data.daerah);
              $('#kamar').val(data.kamar);
              $('#tempat_lahir').val(data.tempat_lahir);
              $('#tanggal_lahir').val(data.tanggal_lahir);
              $('#status').val(data.status);
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
              url : "{{ url('/santri') }}" + '/' + id,
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
            if (save_method == 'add') url = "{{ url('/santri') }}";
            else url = "{{ url('/santri') . '/' }}" + id;
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
