@extends('layouts.app')

@section('title', 'SJGH-LRMS | Checkout Blood')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

@section('content')
    <div class="container" style="margin-top: -2%;">
        <div class="card">
            <div class="card-header">
                <h2><b style="color: #191970;">Checkout Blood</b>
                    <a href="{{ route('blood-transfussions') }}" class="btn btn-info float-right">Transfussions</a>
                </h2>
            </div>
            @if (Session::has('register'))
                <div class="alert alert-success" role="alert">
                    <h4>{{ Session::get('register') }}</h4>
                </div>
            @endif
            <div class="card-body">
                <form action="{{ route('store-transfussion') }}" method="POST" autocomplete="off" onsubmit="return validateForm()">
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
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-10 col-12" style="margin-left: 27%;">
                            <div class="form-group"> <label for="lab_no">Blood Number</label> 
                                <input type="text" name="blood_number" value="{{ $blood->blood_number }}" id="bld" class = "form-control" maxlength="9" readonly style="width: 66.5%;"></div>
                        </div>
                        <input type="hidden" name="id" value="{{ $blood->bloodbank_id }}">
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-10 col-12" style="margin-left: 27%;">
                            <div class="form-group"> <label for="lab_no">Name of Donor</label> 
                                <input type="text" id="name" name="name" value="{{ $blood->name }}" class="form-control" readonly style="width: 66.5%;"></div>
                        </div>
                    </div>
                    <div class="row justify-content-center" style="width: 70%; margin-left: 15%;">
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="pus_cell">Blood Group</label> 
                                <input type="text" id="blood_group" name="blood_group" value="{{ $blood->blood_group }}" class="form-control" readonly></div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="red_cell">Volume of Blood</label> 
                                <input type="text" id="oldVolume" name="volume" maxlength="4" value="{{ $blood->volume }}" class="form-control" readonly></div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="epi_cell">Blood Taken Date</label> 
                                <input type="date" name="date_taken" value="{{ $blood->taken_date }}" id="date_taken" max="<?php echo date('Y-m-d');?>" style="height: 35px;" readonly></div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="epi_cell">Blood Expiry Date</label> 
                                <input type="date" name="exp_date" value="{{ $blood->exp_date }}" id="exp_date" min="<?php echo date('Y-m-d');?>" readonly style="height: 35px;"></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-10 col-12" style="margin-left: 27%;">
                            <div class="form-group"> <label for="lab_no">Recipient Staff's Name</label> 
                                <input type="text" id="name_staff" name="name_staff" class="form-control" required style="width: 66.5%;"></div>
                        </div>
                        <div class="col-md-12 col-lg-10 col-12" style="margin-left: 27%;">
                            <div class="form-group"> <label for="opd_no">Recipient Patient's Name</label> 
                                <input type="text" id="name_patient" name="name_patient" class="form-control" required style="width: 66.5%;"></div>
                        </div>
                    </div>
                    <div class="row justify-content-center" style="width: 70%; margin-left: 15%;">
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="pus_cell">Recipient Patient's Gender</label> 
                                <select name="gender" id="depart" class="form-control" required style="height: 35px;">
                                    <option></option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select> </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="red_cell">Recipient Patient's Age</label> 
                                <input type="text" id="age" name="age" maxlength="3" class="form-control" required></div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="epi_cell">Volume of Blood</label> 
                                <input type="text" id="volume" name="volume" maxlength="4" class="form-control" required></div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="epi_cell">Blood Product</label> 
                                <select name="blood_product" id="product" class="form-control" required style="height: 35px;">
                                    <option></option>
                                    <option>Whole Blood(WB)</option>
                                    <option>Concentrated Red Cells (CRC)</option>
                                    <option>Fresh Frozen Plasma (FFP)</option>
                                    <option>Platelet Concentrate (PL. CONC)</option>
                                    <option>Cryoprecipitate (Cryo)</option>
                                </select> </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                                <div class="form-group"> <label for="epi_cell">Department</label> 
                                <select name="department" id="depart" class="form-control" required style="height: 35px;">
                                    <option></option>
                                    <option>Childrens Ward</option>
                                    <option>Emergency</option>
                                    <option>General Ward</option>
                                    <option>Maternity Ward</option>
                                    <option>Orthopaedic Ward</option>
                                </select> </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="epi_cell">Transfusion Date</label> 
                                <input type="date" name="date_transfuss" id="date_taken" max="<?php echo date('Y-m-d');?>" style="height: 35px;" required></div>
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
            document.getElementById('name_staff').focus();
    

//Restrictions .................................................age

            $('#name_staff, #name_patient').on("input", function(){
                var regexp = /[^a-zA-Z -]/g;

                if ($(this).val().match(regexp)){
                    $(this).val($(this).val().replace(regexp, ''));
                }
               });

            $('#age, #volume').on("input", function(){
                var regexp = /[^0-9]/g;

                if ($(this).val().match(regexp)){
                    $(this).val($(this).val().replace(regexp, ''));
                }
               });

            $('#volume').bind('change',function(){
                if ((document.getElementById("volume").value) > (document.getElementById("oldVolume").value)) {
                    
                    alert('Blood Volume Entered is Higher than Volume in Stock');
                    document.getElementById('volume').value = "";
                    document.getElementById('volume').focus();
                }
                
            });
 
        };

    </script>


@endsection