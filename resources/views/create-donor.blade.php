@extends('layouts.app')

@section('title', 'SJGH-LRMS | Register Donor')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

@section('content')
    <div class="container" style="margin-top: -2%;">
        <div class="card">
            <div class="card-header">
                <h2><b style="color: #191970;">Register New Donor</b>
                    <a href="{{ route('donors-list') }}" class="btn btn-info float-right">Donors List</a>
                </h2>
            </div>
            <div class="card-body">
                <form action="{{ route('register-donor') }}" method="POST" onsubmit="return validateForm()">
                    @csrf
                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('register'))
                        <div class="alert alert-success" role="alert">
                            <h4>{{ Session::get('register') }}</h4>
                        </div>
                    @endif
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-10 col-12" style="margin-left: 27%;">
                            <div class="form-group"> <label for="name">Donor's Name</label> 
                                <input type="text" name="name" id="name" class="form-control" style="width: 66.5%;" required>
                            </div>    
                        </div>
                    </div>
                    <div class="row justify-content-center" style="width: 70%; margin-left: 15%;">
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="pus_cell">Date of Birth</label> 
                                <input type="date" name="dob" id="dob" max="<?php echo date('Y-m-d');?>" onchange="Javascript:myAgeValidation()" required style="height: 35px;">
                                Age: <label id="aged">0</label>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="red_cell">Gender</label> 
                                <select class = "form-control" id="gend" name="gender" required>
                                    <option></option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select></div>
                        </div>
                    </div>
                    <div class="row justify-content-center" style="width: 70%; margin-left: 15%;">
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="pus_cell">Blood Group</label> 
                                <select name="blood" id="bld" class="form-control" style="height: 35px;" required>
                                    <option></option>
                                    <option>A (Positive)</option>
                                    <option>A (Negative)</option>
                                    <option>AB (Positive)</option>
                                    <option>AB (Negative)</option>
                                    <option>B (Positive)</option>
                                    <option>B (Negative)</option>
                                    <option>O (Positive)</option>
                                    <option>O (Negative)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="red_cell">Marital Status</label> 
                                <select id="marital_status" name="marital_status" class="form-control" required style="height: 35px;">
                                    <option></option>
                                    <option>Married</option>
                                    <option>Not Married</option>
                                    <option>Single</option>
                                </select></div>
                        </div>
                    </div>
                    <div class="row justify-content-center" style="width: 70%; margin-left: 15%;">
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="pus_cell">Profession</label> 
                                <select name="profession" id="profess" class="form-control" style="height: 35px;" required>
                                    <option></option>
                                    @foreach ($profession as $prof)
                                        <option>{{ $prof->dropdown }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="red_cell">Contact</label> 
                                <input type="text" name="contact" id="contact" class = "form-control" maxlength="10"></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-10 col-12" style="margin-left: 27%;">
                            <div class="form-group"> <label for="name">Address</label> 
                                <input type="text" id="address" name="address" class="form-control" style="width: 66.5%;" required>
                            </div>    
                        </div>
                    </div>
                    <div class="row justify-content-center" style="width: 70%; margin-left: 15%; margin-top: 10px;">
                        <div class="col-md-12 col-lg-10 col-12">
                            <div class="row justify-content-end mb-5">
                                <div class="col-lg-4 col-auto "><button type="reset" class="btn btn-primary btn-block"><small class="font-weight-bold"><i class="fa fa-refresh fa-spin" aria-hidden="true"></i> Clear</small></button> </div>
                                <div class="col-lg-4 col-auto "><button type="submit" class="btn btn-primary btn-block"><small class="font-weight-bold"><i class="fa fa-save"></i> Save</small></button> </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>   
    </div>
    <script type="text/javascript">
        
        window.onload = function(){
            document.getElementById('name').focus();

                

//Restrictions .................................................

        $('#name').on("input", function(){
            var regexp = /[^a-zA-Z -]/g;

            if ($(this).val().match(regexp)){
                $(this).val($(this).val().replace(regexp, ''));
            }
            });

        $('#mass, #contact').on("input", function(){
            var regexp = /[^0-9]/g;

            if ($(this).val().match(regexp)){
                $(this).val($(this).val().replace(regexp, ''));
            }
            });
    };

    //Age Calculator.............................................................
        
            function myAgeValidation() {
             
                var lre = /^\s*/;
                var datemsg = "";
                
                var inputDate = document.getElementById("dob").value;
                inputDate = inputDate.replace(lre, "");
                document.getElementById("dob").value = inputDate;
                getAge(new Date(inputDate));
             
            }
             
            function getAge(birth) {
             
                var today = new Date();
                var nowyear = today.getFullYear();
                var nowmonth = today.getMonth() + 1;
                var nowday = today.getDate();
             
                var birthyear = birth.getFullYear();
                var birthmonth = birth.getMonth() + 1;
                var birthday = birth.getDate();
             
                var age = nowyear - birthyear;
                var age_month = nowmonth - birthmonth;
                var age_day = nowday - birthday;


                if(age_month < 0 || (age_month == 0 && age_day < 0) ) {
                        age = parseInt(age) -1;
                        //age = age -1;
                    }
                document.getElementById("aged").innerHTML = age;
             
            }

    </script>

@endsection