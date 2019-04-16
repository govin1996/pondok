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
                    <div id="nama_list"></div>
                    <div id="txt" class="wrap-input150 validate-input" data-validate="Enter Nis">
                        <span class="label-input100">Nama :</span>
                        <input class="input100" type="text" name="nama_santri" id="nama_santri" placeholder=". . . . .">
                        <span class="focus-input100" data-placeholder="Nama"></span>
                    </div>
                    <div class="wrap-input150 validate-input" data-validate="Enter User">
                        <span class="label-input100">Nama Mahrom :</span>
                        <input class="input100" type="text" name="nama_mahrom" id="nama_mahrom" placeholder=". . . . .">
                        <span class="focus-input100" data-placeholder="User"></span>
                    </div>
                    <div class="wrap-input45 validate-input" data-validate="Enter User">
                        <span class="label-input100">No HP :</span>
                        <input class="input100" type="text" name="nohp" id="nohp" placeholder=". . . . .">
                        <span class="focus-input100" data-placeholder="User"></span>
                    </div>
                    &nbsp;
                    <div class="wrap-input45 validate-input" data-validate="Enter User">
                        <span class="label-input100">Status :</span>
                        <input class="input100" type="text" name="status" id="status" placeholder=". . . . .">
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

<script type="text/javascript">
    // jQuery wait till the page is fullt loaded
    $(document).ready(function () {
        // keyup function looks at the keys typed on the search box
        $('#nis').on('keyup',function() {
            // the text typed in the input field is assigned to a variable 
            var query = $(this).val();
            // call to an ajax function
            $.ajax({
                // assign a controller function to perform search action - route name is search
                url:"{{ route('cari') }}",
                // since we are getting data methos is assigned as GET
                type:"GET",
                // data are sent the server
                data:{'nis':query},
                // if search is succcessfully done, this callback function is called
                success:function (data) {
                    // print the search results in the div called country_list(id)
                    $('#nama_santri').val(data);
                    $('#nama_santri').attr('readonly','true');
                }
            })
            // end of ajax call
        });
    });
</script>