@extends('layouts.app')

@section('title', 'SJGH-LRMS | Report')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

@section('content')
    <div class="container" style="margin-top: -2%;">
        <div class="card">
            <div class="card-header">
                <h2><b style="color: #191970;">Report</b></h2>
            </div>
            <div class="card-body">
                <form action="{{ route('print-report') }}" method="POST" autocomplete="off">
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
                            <div class="form-group"> <label for="pus_cell">Reporting Month</label> 
                                <select name="report_month" id="report_month" class="form-control" style="height: 35px;" required>
                                    <option></option>
                                    <option>January</option>
                                    <option>February</option>
                                    <option>March</option>
                                    <option>April</option>
                                    <option>May</option>
                                    <option>June</option>
                                    <option>July</option>
                                    <option>August</option>
                                    <option>September</option>
                                    <option>October</option>
                                    <option>November</option>
                                    <option>December</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="pus_cell">Reporting Year</label> 
                                <select name="report_year" id="report_year" class="form-control" style="height: 35px;" required>
                                    <option></option>
                                    <?php 
                                       for($i = 2020 ; $i <= date('Y'); $i++){
                                          echo "<option>$i</option>";
                                       }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center" style="width: 70%; margin-left: 15%;">
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> 
                                <button type="submit" name="action" value="haematology" class="btn btn-primary btn-block load"><small class="font-weight-bold"><i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i> Haematology Report</small></button>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> 
                                <button type="submit" name="action" value="micro" class="btn btn-primary btn-block load"><small class="font-weight-bold"><i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i> Microbiology Report</small></button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row justify-content-center" style="width: 70%; margin-left: 15%;">
                        @if (Session::get('user')['user_id'] === 1 || Session::get('user')['user_id'] === 2 || Session::get('user')['user_id'] === 3)
                            <div class="col-lg-5 col-md-6 col-sm-12">
                                <div class="form-group"> 
                                    <button type="submit" name="action" value="hiv" class="btn btn-primary btn-block load"><small class="font-weight-bold"><i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i> HIV Report</small></button>
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> 
                                <button type="submit" name="action" value="blood" class="btn btn-primary btn-block load"><small class="font-weight-bold"><i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i> Chem, Blood Bank  & Att Report</small></button>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
            <div class="d-flex justify-content-center">
                <ul class="list-group list-group-flush" id="gif_load" style="display: none">
                    <li class="list-group-item d-flex justify-content-center"><img src="{{ asset('public/img/loading.gif') }}" id="gif_load" height="150px" alt="Loading"></li>
                    <li class="list-group-item d-flex justify-content-center"><h4 style="font-weight: bolder;" id="lab">Report Loading....</h4></li>
                    <li class="list-group-item d-flex justify-content-center"><small style="font-weight: bolder;" id="lab">This will take about 5 minutes</small></li>
                    
                  </ul>
            </div>
            
        </div>   
    </div>

    <script>
        $('.load').click(function () {
            if(document.getElementById('report_month').value == '' || document.getElementById('report_year').value == ''){
                document.getElementById('gif_load').style.display = 'none';
            }
            else{
                document.getElementById('gif_load').style.display = 'block';
            }
        });
    </script>
    
@endsection