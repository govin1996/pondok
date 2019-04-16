<link href="{{ asset('assets/bismillah/css/util.css') }} " rel="stylesheet">
<link href="{{ asset('assets/bismillah/css/main.css') }} " rel="stylesheet">

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

    .wrap-login100-form-btn:hover .login100-form-bgbtn {
        left: 0;
    }
</style>


<div class="modal" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static"  style="border-radius: 15px">
    <div class="modal-dialog modal-lg" style="width: 600px">
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
                    <div class="wrap-input150 validate-input" data-validate="Enter User" style="display: none;">
                        <span class="label-input100">ID :</span>
                        <input class="input100" type="text" name="id" id="id">
                        <span class="focus-input100" data-placeholder="User"></span>
                    </div>
                    <div class="wrap-input150 validate-input" data-validate="Enter User">
                        <span class="label-input100">Nama :</span>
                        <input class="input100" type="text" name="nama" id="nama" placeholder=". . . . .">
                        <span class="focus-input100" data-placeholder="User"></span>
                    </div>
                    <div class="wrap-input150 validate-input" data-validate="Enter User">
                        <span class="label-input100">Jabatan :</span>
                        <div>
                            <select  class="input100" name="jabatan" id="jabatan"  style="border: none">
                                <option value="">Pilih Jabatan</option>
                                @foreach ($data as $data2)
                                    <option value="{{ $data2->nama_jabatan }}">{{ $data2->nama_jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input150 validate-input" data-validate="Enter User">
                        <span class="label-input100">No HP :</span>
                        <input class="input100" type="text" name="nohp" id="nohp" placeholder=". . . . .">
                        <span class="focus-input100" data-placeholder="User"></span>
                    </div>
                <div class="container-login100-form-btn">
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
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');

    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });
    $(function() {
        $( "#tgllhr" ).datepicker();
    });
</script>