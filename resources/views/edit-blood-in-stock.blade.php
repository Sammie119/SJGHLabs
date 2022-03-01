@extends('layouts.app')

@section('title', 'SJGH-LRMS | Edit Blood Bank')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

@section('content')
    <div class="container" style="margin-top: -2%;">
        <div class="card">
            <div class="card-header">
                <h2><b style="color: #191970;">Edit Blood In Stock</b>
                    <a href="{{ route('blood-in-stock') }}" class="btn btn-info float-right">Blood in Stock</a>
                </h2>
            </div>
            @if (Session::has('register'))
                <div class="alert alert-success" role="alert">
                    <h4>{{ Session::get('register') }}</h4>
                </div>
            @endif
            <div class="card-body">
                <form action="{{ route('update-blood-in-stock') }}" method="POST" autocomplete="off" onsubmit="return validateForm()">
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
                                <input type="text" name="blood_number" value="{{ $blood->blood_number }}" id="bld" class = "form-control" maxlength="9" required style="width: 66.5%;"></div>
                        </div>
                        <input type="hidden" name="id" value="{{ $blood->bloodbank_id }}">
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-10 col-12" style="margin-left: 27%;">
                            <div class="form-group"> <label for="lab_no">Name of Donor</label> 
                                <input type="text" id="name" name="name" value="{{ $blood->name }}" class="form-control" readonly style="width: 66.5%;"></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-10 col-12" style="margin-left: 27%;">
                            <div class="form-group"> <label for="lab_no">Name of Patient</label> 
                                <input type="text" id="patient_name" name="patient_name" value="{{ $blood->patient_name }}" class="form-control" required style="width: 66.5%;"></div>
                        </div>
                    </div>

                    <div class="row justify-content-center" style="width: 70%; margin-left: 15%;">
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="pus_cell">Blood Group</label> 
                                <input type="text" id="blood_group" name="blood_group" value="{{ $blood->blood_group }}" class="form-control" readonly></div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="red_cell">Volume of Blood</label> 
                                <input type="text" id="volume" name="volume" maxlength="4" value="{{ $blood->volume }}" class="form-control" required></div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="epi_cell">Blood Taken Date</label> 
                                <input type="date" name="date_taken" value="{{ $blood->taken_date }}" id="date_taken" max="<?php echo date('Y-m-d');?>" style="height: 35px;" required></div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="epi_cell">Blood Expiry Date</label> 
                                <input type="date" name="exp_date" value="{{ $blood->exp_date }}" id="exp_date" min="<?php echo date('Y-m-d');?>" required style="height: 35px;"></div>
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
            document.getElementById('bld').focus();

        
        $('#bld').bind('keyup',function(){   
            var bld_no = $(this).val();
            var pathArray = window.location.pathname.split('/');
            var url = pathArray[1];

            $.ajax({
                type:'POST',
                url:"/"+url+"/get-donor",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    bld_no
                    },
                success:function(data) {
                $("#name").val(data.name);
                $("#blood_group").val(data.blood);
                }
            });
        });

        $('#bld').bind('keyup',function(){   
                if(document.getElementById('bld').value == ''){
                    document.getElementById('name').value = '';
                    document.getElementById('blood_group').value = '';
                }
            });


//Getting the Blood number checked to avoid repeatition................
        $('#bld').bind('change',function(){   
            var bld_no = $(this).val();
            var pathArray = window.location.pathname.split('/');
            var url = pathArray[1];
            
            $.ajax({
                type:'POST',
                url:"/"+url+"/getblood-number",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    bld_no
                    },
                success:function(data) {
                    $("#bld").empty();
                    $("#bld").html(data);
                }
            });
        });

//Check if the patient is registered already not.........................
        $('#bld').bind('change',function(){
            if (document.getElementById("name").value == "") {
                alert("Blood Number "+$(this).val()+" has not been Registered");
                //window.open("user_profile.php");
                window.location.href = 'create-donor';
            }
        });     

//Restrictions .................................................

            $('#bld, #volume').on("input", function(){
                var regexp = /[^0-9]/g;

                if ($(this).val().match(regexp)){
                    $(this).val($(this).val().replace(regexp, ''));
                }
               });

            $('#patient_name').on("input", function(){
                var regexp = /[^a-zA-Z -]/g;

                if ($(this).val().match(regexp)){
                    $(this).val($(this).val().replace(regexp, ''));
                }
               });
 
        };

    </script>


@endsection