<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<title>SJGH-Laboratory Report Management System</title>

<link rel="shortcut icon" href={{ asset('public/img/logo_icon.ico') }}>
<link href={{ asset('public/css/bootstrap.min.css') }} rel='stylesheet'>

<link rel="stylesheet" href={{ asset('public/font-awesome/css/font-awesome.min.css') }}>

<style>
    body {
        background: #DDDDDD;
    }

    .bb-login {
         margin-top: 5px;
         margin-bottom: 0px
     }

     input {
         outline: none;
         border: none
     }

     input:focus {
         border-color: transparent !important
     }

     input:focus::-webkit-input-placeholder {
         color: transparent
     }

     input:focus:-moz-placeholder {
         color: transparent
     }

     input:focus::-moz-placeholder {
         color: transparent
     }

     input:focus:-ms-input-placeholder {
         color: transparent
     }

     input::-webkit-input-placeholder {
         color: #adadad
     }

     input:-moz-placeholder {
         color: #adadad
     }

     input::-moz-placeholder {
         color: #adadad
     }

     input:-ms-input-placeholder {
         color: #adadad
     }

     button {
         outline: none !important;
         border: none;
         background: transparent
     }

     button:hover {
         cursor: pointer
     }

     iframe {
         border: none !important
     }

     .txt1 {
         font-family: Poppins-Regular;
         font-size: 13px;
         color: #666666;
         line-height: 1.5
     }

     .txt2 {
         font-family: Poppins-Regular;
         font-size: 13px;
         color: #333333;
         line-height: 1.5
     }

     .p-t-115 {
         padding-top: 40px
     }

     .p-b-48 {
         padding-bottom: 0px
     }

     .limit {
         width: 100%;
         margin: 0 auto
     }

     .login-container {
         width: 100%;
         display: -webkit-box;
         display: -webkit-flex;
         display: -moz-box;
         display: -ms-flexbox;
         display: flex;
         flex-wrap: wrap;
         justify-content: center;
         align-items: center;
         padding: 15px;
         background: #DDDDDD;
     }

     .bb-login {
         width: 390px;
         background: #fff;
         border-radius: 0px;
         overflow: hidden;
         padding: 26px 23px 35px 21px;
         box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
         -moz-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
         -webkit-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
         -o-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
         -ms-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1)
     }

     .bb-form {
         width: 100%
     }

     .bb-form-title {
         display: block;
         font-family: Poppins-Bold;
         font-size: 30px;
         color: #333333;
         line-height: 1;
         text-align: center
     }

     .bb-form-title i {
         font-size: 60px
     }

     .wrap-input100 {
         width: 100%;
         position: relative;
         border-bottom: 2px solid #adadad;
         margin-bottom: 37px
     }

     .input100 {
         font-family: Poppins-Regular;
         font-size: 16px;
         color: #555555;
         line-height: 1.2;
         display: block;
         width: 100%;
         height: 45px;
         background: transparent;
         padding: 0 5px
     }

     .bbb-input {
         position: absolute;
         display: block;
         width: 100%;
         height: 100%;
         top: 0;
         left: 0;
         pointer-events: none
     }

     .bbb-input::before {
         content: "";
         display: block;
         position: absolute;
         bottom: -2px;
         left: 0;
         width: 0;
         height: 2px;
         -webkit-transition: all 0.4s;
         -o-transition: all 0.4s;
         -moz-transition: all 0.4s;
         transition: all 0.4s;
         background: #6a7dfe;
         background: -webkit-linear-gradient(left, #21d4fd, #b721ff);
         background: -o-linear-gradient(left, #21d4fd, #b721ff);
         background: -moz-linear-gradient(left, #21d4fd, #b721ff);
         background: linear-gradient(left, #21d4fd, #b721ff)
     }

     .bbb-input::after {
         font-family: Poppins-Regular;
         font-size: 15px;
         color: #999999;
         line-height: 1.2;
         content: attr(data-placeholder);
         display: block;
         width: 100%;
         position: absolute;
         top: 16px;
         left: 0px;
         padding-left: 5px;
         -webkit-transition: all 0.4s;
         -o-transition: all 0.4s;
         -moz-transition: all 0.4s;
         transition: all 0.4s
     }

     .input100:focus+.bbb-input::after {
         top: -15px

     }

     .input100:focus+.bbb-input::before {
         width: 100%

     }

     .has-val.input100+.bbb-input::after {
         top: -15px

     }

     .has-val.input100+.bbb-input::before {
         width: 100%
     }

     .btn-show-pass {
         font-size: 15px;
         color: #999999;
         display: -webkit-box;
         display: -webkit-flex;
         display: -moz-box;
         display: -ms-flexbox;
         display: flex;
         align-items: center;
         position: absolute;
         height: 100%;
         top: 0;
         right: 0;
         padding-right: 5px;
         cursor: pointer;
         -webkit-transition: all 0.4s;
         -o-transition: all 0.4s;
         -moz-transition: all 0.4s;
         transition: all 0.4s
     }

     .btn-show-pass:hover {
         color: #6a7dfe;
         color: -webkit-linear-gradient(left, #21d4fd, #b721ff);
         color: -o-linear-gradient(left, #21d4fd, #b721ff);
         color: -moz-linear-gradient(left, #21d4fd, #b721ff);
         color: linear-gradient(left, #21d4fd, #b721ff)
     }

     .btn-show-pass.active {
         color: #6a7dfe;
         color: -webkit-linear-gradient(left, #21d4fd, #b721ff);
         color: -o-linear-gradient(left, #21d4fd, #b721ff);
         color: -moz-linear-gradient(left, #21d4fd, #b721ff);
         color: linear-gradient(left, #21d4fd, #b721ff)
     }

     .login-container-form-btn {
         display: -webkit-box;
         display: -webkit-flex;
         display: -moz-box;
         display: -ms-flexbox;
         display: flex;
         flex-wrap: wrap;
         justify-content: center;
         padding-top: 13px
     }

     .bb-login-form-btn {
         width: 100%;
         display: block;
         position: relative;
         z-index: 1;
         border-radius: 25px;
         overflow: hidden;
         margin: 0 auto
     }

     .bb-form-bgbtn {
         position: absolute;
         z-index: -1;
         width: 300%;
         height: 100%;
         background: #a64bf4;
         background: -webkit-linear-gradient(right, #21d4fd, #FF9800, #FFC107, #F44336);
         background: -o-linear-gradient(right, #21d4fd, #b721ff, #21d4fd, #b721ff);
         background: -moz-linear-gradient(right, #21d4fd, #b721ff, #21d4fd, #b721ff);
         background: linear-gradient(right, #21d4fd, #b721ff, #21d4fd, #b721ff);
         top: 0;
         left: -100%;
         -webkit-transition: all 0.4s;
         -o-transition: all 0.4s;
         -moz-transition: all 0.4s;
         transition: all 0.4s
     }

     .bb-form-btn {
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
         height: 50px
     }

     .bb-login-form-btn:hover .bb-form-bgbtn {
         left: 0
     }

     @media (max-width: 576px) {
         .bb-login {
             padding: 77px 15px 33px 15px
         }
     }

     .validate-input {
         position: relative
     }

     .alert-validate::before {
         content: attr(data-validate);
         position: absolute;
         max-width: 70%;
         background-color: #fff;
         border: 1px solid #c80000;
         border-radius: 2px;
         padding: 4px 25px 4px 10px;
         top: 50%;
         -webkit-transform: translateY(-50%);
         -moz-transform: translateY(-50%);
         -ms-transform: translateY(-50%);
         -o-transform: translateY(-50%);
         transform: translateY(-50%);
         right: 0px;
         pointer-events: none;
         font-family: Poppins-Regular;
         color: #c80000;
         font-size: 13px;
         line-height: 1.4;
         text-align: left;
         visibility: hidden;
         opacity: 0;
         -webkit-transition: opacity 0.4s;
         -o-transition: opacity 0.4s;
         -moz-transition: opacity 0.4s;
         transition: opacity 0.4s
     }

     .alert-validate::after {
         content: "\f06a";
         font-family: FontAwesome;
         font-size: 16px;
         color: #c80000;
         display: block;
         position: absolute;
         background-color: #fff;
         top: 50%;
         -webkit-transform: translateY(-50%);
         -moz-transform: translateY(-50%);
         -ms-transform: translateY(-50%);
         -o-transform: translateY(-50%);
         transform: translateY(-50%);
         right: 5px
     }

     .alert-validate:hover:before {
         visibility: visible;
         opacity: 1
     }

     @media (max-width: 992px) {
         .alert-validate::before {
             visibility: visible;
             opacity: 1
         }
     }

     a {
         text-decoration: none !important
     }

     .fa {
         color: #515A5A !important
     }

     .show_password {
         color: black !important;
         margin-right: 8px
     }
</style>

<script type='text/javascript' src={{ asset('public/js/jquery.min.js') }}></script>
<script type='text/javascript' src={{ asset('public/js/popper.min.js') }}></script>
<script type='text/javascript' src={{ asset('public/js/bootstrap.min.js') }}></script>

<script type='text/javascript'>
    $(document).ready(function(){

        document.getElementById("username").focus();

        var showPass = 0;

        $('.btn-show-pass').on('click', function(){
            if(showPass == 0) {
                $(this).next('input').attr('type','text');
                $(this).find('i').removeClass('fa-eye-slash');
                $(this).find('i').addClass('fa-eye');
                showPass = 1;
            }
            else {
                $(this).next('input').attr('type','password');
                $(this).find('i').addClass('fa-eye-slash');
                $(this).find('i').removeClass('fa-eye');
                showPass = 0;
            }

        });

        $('#username').on("input", function(){
            if(document.getElementById('username').value != ''){
                document.getElementById('demo').style.display='none';
            }else{
                document.getElementById('demo').style.display='block';
            }
        });

        $('#password').on("input", function(){
            if(document.getElementById('password').value != ''){
                document.getElementById('demo2').style.display='none';
            }else{
                document.getElementById('demo2').style.display='block';
            }
        });
    });
</script>

</head>
<body>
    <div style="text-align: center; font-weight: bolder; color: #191970; font-family: Times new roman; margin-top: 20px; line-height: 200%;">
            <b style="font-size: 50px;"> ST. JOHN OF GOD HOSPITAL</b><br>
            <b style="font-size: 30px;"> Duayaw Nkwanta, Ahafo Region</b> <br>
            <b style="font-size: 30px;"> Laboratory Report Management System</b>
    </div>
                
    <div class="login-container">
        <div class="bb-login" style="border-radius: 20px;">
            @isset($data)
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><small>x</small></button>
                    {{  $data }}
                </div>
            @endisset

            <form class="bb-form validate-form" name="login-form" action="login" method="post"> 
                @csrf
                <span class="bb-form-title p-b-26" style="font-weight: bolder;"> Welcome </span> <span class="bb-form-title p-b-48" style="font-size: 50px;"> <i class="fa fa-user"></i> </span>

                <div class="wrap-input100 validate-input" style="margin-top: 0%;"> 
                    <input class="input100" type="text" name="username" id="username" required> <span id="demo" class="bbb-input" data-placeholder="Enter Username"></span> 
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password"> 
                    <span class="btn-show-pass"> <i class="fa fa-eye-slash show_password"></i> </span> <input class="input100" type="password" name="password" id="password" required> <span id="demo2" class="bbb-input" data-placeholder="Password"></span> 
                </div>

                {{-- <div class="wrap-input100 validate-input"> 
                    <select style="border: none; padding-right: 20px" name="lab" required>
                        <option value="" disabled selected>Please Select Lab</option>
                        <option value="Main Lab">Main Lab</option>
                        <option value="RCH Mini-Lab">RCH Lab</option>
                    </select>
                </div> --}}

                <div class="login-container-form-btn">
                    <div class="bb-login-form-btn">
                        <div class="bb-form-bgbtn"></div> <button type="submit" class="bb-form-btn"> Login </button>
                    </div>
                </div>

                <div class="text-center p-t-115" style="padding: 2%; margin: 0%;"> <span class="txt1"><i><b>SAMMAV I.T</b> Consult (0248376160 / 0556226864)</i></span></div>
            </form>
        </div>
    </div>
</body>

<script>
    $(".alert").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert").slideUp(500);
    });
</script>

</html>