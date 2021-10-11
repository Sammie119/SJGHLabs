@extends('layouts.app')

@section('title', 'SJGH-LRMS | Add Patient')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

@section('content')
    <div class="container" style="margin-top: -2%;">
        <div class="card">
            <div class="card-header">
                <h2><b style="color: #191970;">Add New Patient</b>
                    <a href="{{ route('patients-list') }}" class="btn btn-info float-right">Patients List</a>
                </h2>
            </div>
            <div class="card-body">
                <form action="{{ route('new-patient') }}" method="POST" onsubmit="return validateForm()">
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
                    <div class="row justify-content-center" style="width: 70%; margin-left: 15%;">
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="pus_cell">OPD Number</label> 
                                <input type="text" name="opd_no" id="opd_no" maxlength="10" class="form-control" style="height: 35px;" required>
                                    </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-10 col-12" style="margin-left: 27%;">
                            <div class="form-group"> <label for="name">Name</label> 
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
                                <select class = "form-control" id="gender" name="gender" required>
                                    <option></option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select></div>
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

//Restrictions .................................................
        
            $('#opd_no').on("input", function(){
                var regexp = /[^0-9/]/g;

                if ($(this).val().match(regexp)){
                    $(this).val($(this).val().replace(regexp, ''));
                }
               });

            $('#name').on("input", function(){
                var regexp = /[^a-zA-Z -]/g;

                if ($(this).val().match(regexp)){
                    $(this).val($(this).val().replace(regexp, ''));
                }
               });

            $('#opd_no').bind('change',function(){   
                var opd_no = 'opd_no=' +$(this).val();
                $.post('php/get_opd_no_check.php?func=name', opd_no, processResponseopd_no);
            });

            function processResponseopd_no(data) {
                $("#opd_no").empty();
                $("#opd_no").html(data);
            };
            
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