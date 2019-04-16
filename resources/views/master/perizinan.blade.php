<link href="{{ asset('assets/bismillah/css/util.css') }} " rel="stylesheet">
<link href="{{ asset('assets/bismillah/css/main.css') }} " rel="stylesheet">
{{-- SweetAlert2 --}}
<link href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
<style type="text/css">
    .modal-content {
        margin-top: 50px;
        margin-left: auto;
        width: 100%;
    }

    .container-login100-form-btn {
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        padding-top: 13px;
    }

    .wrap-login100-form-btn {
        width: 30%;
        display: block;
        position: relative;
        z-index: 1;
        border-radius: 25px;
        overflow: hidden;
        margin-bottom: 30px;
    }

    .login100-form-bgbtn {
        position: absolute;
        z-index: -1;
        width: 300%;
        height: 100%;
        background: #a64bf4;
        background: -webkit-linear-gradient(right, #21d4fd, #b721ff, #21d4fd, #b721ff);
        background: -o-linear-gradient(right, #21d4fd, #b721ff, #21d4fd, #b721ff);
        background: -moz-linear-gradient(right, #21d4fd, #b721ff, #21d4fd, #b721ff);
        background: linear-gradient(right, #21d4fd, #b721ff, #21d4fd, #b721ff);
        top: 0;
        left: -100%;

        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        -moz-transition: all 0.4s;
        transition: all 0.4s;
    }

    .login100-form-btn {
        font-family: Poppins-Medium;
        font-size: 15px;
        color: #fff;
        line-height: 1.2;
        text-transform: uppercase;

        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0 20px;
        width: 100%;
        height: 50px;
        top: 1px;

    }

    .img-baru {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .wrap-login100-form-btn:hover .login100-form-bgbtn {
        left: 0;
    }
</style>


<div class="modal" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static"  style="border-radius: 15px">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="form-contact" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times; </span>
                    </button>
                    <h3 class="modal-title" align="center"></h3>
                </div>
                <div class="modal-body">

                    <div>
                        <img class="img-baru" name="photo" id="photo" width="100" height="100" alt="Photo">
                    </div>

                    <div class="wrap-input150 validate-input" data-validate="Enter User" style="display: none;">
                        <span class="label-input100">ID :</span>
                        <input class="input100" type="text" name="id" id="id">
                        <span class="focus-input100" data-placeholder="User"></span>
                    </div>
                    <div class="wrap-input45 validate-input" data-validate="Enter Nis">
                        <span class="label-input100">NIS :</span>
                        <input class="input100" type="text" name="nis" id="nis" placeholder=". . . . .">
                        <span class="focus-input100" data-placeholder="NIS"></span>
                    </div>
                    <div class="wrap-input150 validate-input" data-validate="Enter Nis">
                        <span class="label-input100">Nama :</span>
                        <input class="input100" type="text" name="nama_santri" id="nama_santri" placeholder=". . . . .">
                        <span class="focus-input100" data-placeholder="Nama"></span>
                    </div>
                    <div id="nama_list"></div>
                    <div class="wrap-input45 input100-select">
                        <span class="label-input100">Tipe Penjemput :</span>
                        <div>
                            <select  class="input100 dynamic" name="tipe_penjemput" id="tipe_penjemput"  style="border: none" onchange="check2()" data-dependent="nama">
                                <option value="">Pilih Tipe Penjemput</option>
                                <option value="Mahrom">Mahrom</option>
                                <option value="Orang Lain">Orang Lain</option>
                            </select>
                        </div>
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input45 input100-select" id="nama_m" style="display: none;">
                        <span class="label-input100">Nama Mahrom :</span>
                        <div>
                            <select  class="input100 dynamic" name="nama" id="nama"  style="border: none">
                                <option value="">Pilih Mahrom</option>
                            </select>
                        </div>
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input45 validate-input" data-validate="Enter User" id="nama_p" style="display: none;">
                        <span class="label-input100">Nama Penjemput :</span>
                        <input class="input100" type="text" name="nama_penjemput" id="nama_penjemput" placeholder=". . . . .">
                        <span class="focus-input100" data-placeholder="User"></span>
                    </div>
                    <br>
                    <div class="wrap-input45 validate-input" data-validate="Enter User">
                        <span class="label-input100">Keperluan :</span>
                        <div class="coba">
                            <select  class="input100" name="keperluan" id="keperluan"  style="border: none" onchange="check()">
                                <option value="0">Pilih Keperluan</option>
                                <option value="Pergi">Pergi</option>
                                <option value="Pulang">Pulang</option>
                            </select>
                        </div>
                        <span class="focus-input100"></span>
                    </div>
                    <br>
                    <div class="wrap-input45 validate-input" data-validate="Enter User" id="tgl_pulang2" style="display: none">
                        <span class="label-input100">Tgl Pulang :</span>
                        <input class="input50" type="date" name="tgl_pulang" id="tgl_pulang" placeholder=". . . . ." value="<?php echo date('Y-m-d'); ?>" readonly>
                        <span class="focus-input100" data-placeholder="User"></span>
                    </div>
                    <div class="wrap-input45 validate-input" data-validate="Enter User" id="tgl_kembali2" style="display: none">
                        <span class="label-input100">Tgl Kembali :</span>
                        <input class="input50" type="date" name="tgl_kembali" id="tgl_kembali" placeholder=". . . . .">
                        <span class="focus-input100" data-placeholder="User"></span>
                    </div>
                    <div class="wrap-input45 validate-input" data-validate="Enter User" id="jam_pergi2" style="display: none">
                        <span class="label-input100">Jam Pergi :</span>
                        <input class="input50" type="time" name="jam_pergi" id="jam_pergi" placeholder=". . . . .">
                        <span class="focus-input100" data-placeholder="User"></span>
                    </div>
                    <div class="wrap-input45 validate-input" data-validate="Enter User" id="jam_kembali2" style="display: none">
                        <span class="label-input100">Jam Kembali :</span>
                        <input class="input50" type="time" name="jam_kembali" id="jam_kembali" placeholder=". . . . .">
                        <span class="focus-input100" data-placeholder="User"></span>
                    </div>
                    <div class="tabelapprove" id="tabelapprove"></div>
                <div class="container-login100-form-btn" id="btnsimpan">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button type="submit" class="login100-form-btn">
                            SIMPAN
                        </button>
                    </div>
                </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/bismillah/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="{{ asset('assets/bismillah/js/main.js')}}"></script>
<script type="text/javascript">

    function check() {
        var tipe = document.getElementById("keperluan").value;
        var tgl_pulang = document.getElementById("tgl_pulang2");
        var tgl_kembali = document.getElementById("tgl_kembali2");
        var jam_pergi = document.getElementById("jam_pergi2");
        var jam_kembali = document.getElementById("jam_kembali2");
        if(tipe == 'Pergi'){
            tgl_pulang.style.display = "none";
            tgl_kembali.style.display = "none";
            jam_pergi.style.display = "inline-block";
            jam_kembali.style.display = "inline-block";
        }else{
            jam_pergi.style.display = "none";
            jam_kembali.style.display = "none";
            tgl_pulang.style.display = "inline-block";
            tgl_kembali.style.display = "inline-block";
        }
    }

    function check2() {
        var tipep = document.getElementById("tipe_penjemput").value;
        var nama_m = document.getElementById("nama_m");
        var nama_p = document.getElementById("nama_p");
        if(tipep == 'Mahrom'){
            nama_p.style.display = "none";
            nama_m.style.display = "inline-block";
        }else{
            nama_m.style.display = "none";
            nama_p.style.display = "inline-block";
        }
    }

    $(document).ready(function () {
        // keyup function looks at the keys typed on the search box

         $('#nis').on('keyup',function(){
          if($(this).val() != '')
          {
           var select = $(this).attr("id");
           var value = $(this).val();
           var dependent = $(this).data('dependent');
           var coba = "nama";
           var _token = $('input[name="_token"]').val();
           $.ajax({
            url:"{{ route('dynamicdependent.fetch') }}",
            method:"POST",
            type: "GET",
            data:{select:select, value:value, _token:_token, dependent:dependent},
            success:function(result) {
                 $('#'+coba).html(result);
                 $.ajax({
                    // assign a controller function to perform search action - route name is search
                    url:"{{ route('cari') }}",
                    // since we are getting data methos is assigned as GET
                    type:"GET",
                    // data are sent the server
                    data:{'nis':value},
                    // if search is succcessfully done, this callback function is called
                    success:function (data) {
                        // print the search results in the div called country_list(id)
                        $('#nama_santri').val(data);
                    }
                });
            }

           })
          }
         });
    });
</script>