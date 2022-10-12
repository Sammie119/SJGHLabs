@extends('layouts.app')

@section('title', 'SJGH-LRMS | Lab Request')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

@section('content')
    <div class="container-fluid" style="margin-top: 6%;">
        <div class="card">
            <div class="card-header">
                <h3><b style="color: #191970;">Lab Request</b>
                    <form class="form-inline my-2 my-lg-0 float-right">
                        <input class="form-control mr-sm-2" id="search" type="text" placeholder="Search...">
                        @csrf
                        <a class="btn btn-info float-right" href="javascript:void(0)" onclick="getRequest('request')" title="Print">New Request</a>
                    </form>
                </h3>
            </div>
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    <h4>{{ Session::get('success') }}</h4>
                </div>
            @endif

            @if (Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    <h4>{{ Session::get('error') }}</h4>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><h4>{{ $error }}</h4></li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card-body">
                <div class="row">                    
                    <div class="col-lg-12">
                        <table class="table table-striped table-advance table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>OPD #</th>
                                    <th>Depart.</th>
                                    <th>Patient's Name</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Staff</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="employee_table">
                                @forelse ($labs as $key => $lab)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $lab->opd_number }}</td>
                                        <td>{{ $lab->department }}</td>
                                        <td>{{ $lab->patient->name ?? 'Unknown' }}</td>
                                        <td>{{ $lab->patient->gender ?? 'Unknown' }}</td>
                                        <td>{{ $lab->patient->age ?? 0 }}</td>
                                        <td>{{ number_format($lab->total_amount, 2) }}</td>
                                        <td>{{ $lab->updated_at->format("d-m-Y h:s a") }}</td>
                                        <td>{{ getUsername($lab->updated_by) }}</td>
                                        <td>
                                        <div class="btn-group">
                                            <a class="btn btn-primary" href="javascript:void(0)" onclick="getEdit({{ $lab->req_id }})" title="Edit"><i class="fa fa-edit"></i></a> 
                                            <a class="btn btn-danger" onclick="return confirm('This record will be deleted permanently!!!')" href="delete-request/{{ $lab->req_id }}" title="Delete"><i class="fa fa-trash"></i></a> 
                                        </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="20">No Data Found</td>
                                    </tr>
                                @endforelse 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    
    @include('layouts.tableFilter')
    <!-- Large modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#print">Large modal</button> --}}

<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" id="labRequest" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
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
            // document.getElementById('opd_number').focus();
            
        };
      
        function getRequest(form) {
            $('.modal-title').text('Request Labs');

            $.get('doc-lab-request/'+form+'/1', function(result) {
                //$("#myID").val(result);
                $(".modal-body").html(result);
                $("#labRequest").modal('toggle');
            })
        }

        function getEdit(id) {
            $('.modal-title').text('Edit Request Labs');

            $.get('doc-lab-request/edit/'+id, function(result) {
                //$("#myID").val(result);
                $(".modal-body").html(result);
                $("#labRequest").modal('toggle');
            })
        }
        
    </script>
    
@endsection
