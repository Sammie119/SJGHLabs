@extends('layouts.app')

@section('title', 'SJGH-LRMS | View Lab Results')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

@section('content')
    <div class="container-fluid" style="margin-top: 6%;">
        <div class="card">
            <div class="card-header">
                <h3><b style="color: #191970;">Lab Results @isset($results)
                    for {{ $results[0]->name }} ({{ $results[0]->opd_number }})
                @endisset</b>
                    <form class="form-inline my-2 my-lg-0 float-right" method="POST" autocomplete="off" action="{{ route('doc-view-labs') }}">
                        <input class="form-control mr-sm-2" id="opd_no" type="text" name="opd_no" placeholder="Enter OPD Number" required>
                        @csrf
                        <button type="submit" class="btn btn-info float-right">Generate</button>
                    </form>
                </h3>
            </div>
            @isset($error)
                <div class="alert alert-danger" role="alert">
                    <h4>{{ $error }}</h4>
                </div>
            @endisset
            <div class="card-body">
                <div class="row">

                    @isset($static_info)
                        <div style="width: 70%; margin-left: 15%">
                            <div class="col-lg-12 card">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="4">Patient's Static Info</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Blood Group:</th>
                                            <td>{{ $static_info['blood_group'] }}</td>
                                            <th>G6PD:</th>
                                            <td>{{ $static_info['g6pd'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Sickling:</th>
                                            <td>{{ $static_info['sickling'] }}</td>
                                            <th>Hgb Electrophoresis:</th>
                                            <td>{{ $static_info['sickling_hb'] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                        </div>
                    @endisset
                    
                    <div class="col-lg-12">
                        <table class="table table-striped table-advance table-hover">
                            <thead>
                                <tr>
                                    <th>Lab #</th>
                                    <th>OPD #</th>
                                    <th>Depart.</th>
                                    <th>Patient's Name</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Date</th>
                                    <th>Staff</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($results)
                                    @foreach ($results as $result)
                                        <tr>
                                            <td>{{ $result->lab_number }}</td>
                                            <td>{{ $result->opd_number }}</td>
                                            <td>{{ getDepartment($result->department_id) }}</td>
                                            <td>{{ $result->name }}</td>
                                            <td>{{ $result->gender }}</td>
                                            <td>{{ $result->age }}</td>
                                            <td>{{ $result->updated_at }}</td>
                                            <td>{{ getUsername($result->updated_by) }}</td>
                                            <td>
                                            <div class="btn-group">
                                                <a class="btn btn-primary" href="javascript:void(0)" onclick="getPrint({{ $result->lab_info_id }})" title="Print"><i class="fa fa-print"></i></a> 
                                            </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    
    <!-- Large modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#print">Large modal</button> --}}

<div class="modal fade" tabindex="-1" role="dialog" id="print" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title float-left"> View Lab Results</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
                        
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

    <script>
        window.onload = function(){
            document.getElementById('opd_no').focus();
        };
      
        function getPrint(id) {
            $.get('print-results/'+id, function(result) {
                //$("#myID").val(result);
                $(".modal-body").html(result);
                $("#print").modal('toggle');
            })
        }
        
    </script>
    
@endsection
