<?php 
    use App\Http\Controllers\GetdataController;

    $query = GetdataController::selectOptions();
?>

@extends('layouts.app')

@section('title', 'SJGH-LRMS | Donor Labs')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

@section('content')
    <div class="container" style="margin-top: -2%;">
        <div class="card">
            <div class="card-header">
                <h2><b style="color: #191970;">Enter Donor Labs</b>
                    {{-- <a href="{{ route('donors-list') }}" class="btn btn-info float-right">Donors List</a> --}}
                </h2>
            </div>
            @if (Session::has('register'))
                <div class="alert alert-success" role="alert">
                    <h4>{{ Session::get('register') }}</h4>
                </div>
            @endif
            <div class="card-body">
                <form action="{{ route('donor-labs') }}" method="POST" onsubmit="return validateForm()">
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
                    <input type="hidden" name="id" value="{{ $donor->donor_id }}">
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-10 col-12" style="margin-left: 27%;">
                            <div class="form-group"> <label for="lab_no">Lab Number</label> 
                                <input type="text" name="lab_no" id="lab_no" class = "form-control" maxlength="9" required style="width: 66.5%;"></div>
                        </div>
                    </div>

                    <div class="row justify-content-center" style="width: 70%; margin-left: 15%;">
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="hb_sag">ANTI TPHA/VDRL</label> 
                                <select name="anti_tpha" class="form-control" required style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['response'] as $response)
                                        <option>{{ $response['dropdown'] }}</option>
                                    @endforeach
                                </select> </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="hb_sab">HBsAg</label> 
                                <select name="hbs_ag" class="form-control" required style="height: 35px;">
                                    <option value=""></option>
                                    @foreach ($query['response'] as $response)
                                        <option>{{ $response['dropdown'] }}</option>
                                    @endforeach
                                </select></div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="hb_eag">HCV</label> 
                                <select name="hcv" class="form-control" required style="height: 35px;">
                                    <option value=""></option>
                                    @foreach ($query['response'] as $response)
                                        <option>{{ $response['dropdown'] }}</option>
                                    @endforeach
                                </select> </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="hb_eab">BF</label> 
                                <select name="bf" id="bf" class="form-control" required style="height: 35px;">
                                    <option value=""></option>
                                    @foreach ($query['response'] as $response)
                                        <option>{{ $response['dropdown'] }}</option>
                                    @endforeach
                                </select></div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="hb_cab">BLOOD GROUP</label> 
                                <input type="text" id="blood" name="blood" value="{{ $donor->blood_group }}" class="form-control" style="background: white" readonly> </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="hb_cab">Retro</label> 
                                <select name="retro" class="form-control" required style="height: 35px;">
                                    <option value=""></option>
                                    @foreach ($query['ora'] as $ora)
                                        <option>{{ $ora['dropdown'] }}</option>
                                    @endforeach
                                </select> </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="hb_cab">Mass (Kg)</label> 
                                <input type="text" id="mass" name="mass" maxlength="4" class="form-control" required> </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="hb_cab">BP (mmHg)</label> 
                                <input type="text" id="bp" name="bp" maxlength="7" class="form-control" required> </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="hb_cab">Status</label> 
                                <select id="status" name="status" class="form-control" style="height: 35px" required>
                                    <option></option>
                                    <option>Passed</option>
                                    <option>Failed</option>
                                </select> </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group" id="blood_no" style="display: none;"> <label for="hb_cab">Blood Number</label> 
                                <input type="text" name="blood_no" id="bld" maxlength="7" class="form-control"></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-10 col-12" style="margin-left: 27%;">
                            <div class="form-group"> <label for="lab_no">Donor Name</label> 
                                <input type="text" value="{{ $donor->name }}" class = "form-control" maxlength="9" readonly style="width: 66.5%;"></div>
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
            document.getElementById('lab_no').focus();

        
//Restrictions .................................................

            $('#bp').on("input", function(){
                var regexp = /[^0-9 /]/g;

                if ($(this).val().match(regexp)){
                    $(this).val($(this).val().replace(regexp, ''));
                }
               });

            $('#mass, #lab_no, #bld').on("input", function(){
                var regexp = /[^0-9]/g;

                if ($(this).val().match(regexp)){
                    $(this).val($(this).val().replace(regexp, ''));
                }
               });


//Getting the Lab number checked to avoid repeatition................
        $('#lab_no').bind('change',function(){   
            var lab_no = $(this).val();
            var pathArray = window.location.pathname.split('/');
            var url = pathArray[1];
            
            $.ajax({
                type:'POST',
                url:"/"+url+"/getlab-number-check",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    lab_no
                    },
                success:function(data) {
                    $("#lab_no").empty();
                    $("#lab_no").html(data);
                }
            });
        });


//Getting the Blood number checked to avoid repeatition................
        $('#bld').bind('change',function(){   
            var bld_no = $(this).val();
            var pathArray = window.location.pathname.split('/');
            var url = pathArray[1];
            
            $.ajax({
                type:'POST',
                url:"/"+url+"/getblood-number-check",
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
             

        $('#status').bind('change',function(){
        if (document.getElementById("status").value == "Passed"){
            
            document.getElementById('blood_no').style.display='block';
        }
        else {
            document.getElementById('blood_no').style.display='none';
        }
        }); 


        };

    </script>


@endsection