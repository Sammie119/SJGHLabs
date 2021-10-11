@extends('layouts.app')

@section('title', 'SJGH-LRMS | Lab Results')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

@section('content')
    <div class="container-fluid" style="margin-top: 6%;">
        <div class="card">
            <div class="card-header">
                <h2><b style="color: #191970;">Lab Results</b>
                    <form class="form-inline my-2 my-lg-0 float-right">
                        <input class="form-control mr-sm-2" type="search" id="search" placeholder="Search" aria-label="Search">
                        <a href="{{ route('enter-test') }}" class="btn btn-info float-right">Enter Test</a>
                    </form>
                </h2>
            </div>
            <div class="card-body">
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        <h4>{{ Session::get('success') }}</h4>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-striped table-advance table-hover">
                            <thead>
                                <tr>
                                    <th>Lab #</th>
                                    <th>OPD #</th>
                                    <th>Department</th>
                                    <th>Patient's Name</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Date</th>
                                    <th>Staff</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="employee_table">
                                @foreach ($results as $result)
                                    <tr>
                                        <td>{{ $result->lab_number }}</td>
                                        <td>{{ $result->opd_number }}</td>
                                        <td>{{ $result->dropdown }}</td>
                                        <td>{{ $result->name }}</td>
                                        <td>{{ $result->gender }}</td>
                                        <td>{{ $result->age }}</td>
                                        <td>{{ $result->created_at }}</td>
                                        <td>{{ $result->user->username }}</td>
                                        <td>
                                        <div class="btn-group">
                                            {{-- @if ((Session::get('user')['user_level'] === 'Doctor') || (Session::get('user')['user_level'] === 'Nurse')) --}}
                                                <a class="btn btn-primary" href="javascript:void(0)" onclick="getPrint({{ $result->lab_info_id }})" title="Print"><i class="fa fa-print"></i></a>  
                                            {{-- @else --}}
                                                <a href="#" class="btn btn-primary" onclick="window.open('print-results/{{ $result->lab_info_id }}','', 'left=0,top=0,width=1000,height=600,toolbar=0,scrollbars=0,status=0')"><i class="fa fa-print"></i></a>
                                                <a class="btn btn-success" href="edit-test/{{ $result->lab_info_id }}" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                                <a class="btn btn-danger" onclick="return confirm('This {{ $result->lab_number }} Lab Number will be deleted permanently!!!')" href="delete-labs/{{ $result->lab_info_id }}" title="Delete"><i class="fa fa-trash-o"></i></a>
                                            {{-- @endif --}}
                                        </div>
                                        </td>
                                    </tr>
                                @endforeach
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
        // $(function getPrint(id) {
        //     $(".printModal").click(function() {
        //         var myID = $(this).data('id');
        //         $(".modal-body #myID").val(myID);
        //     })  
        // });

        function getPrint(id) {
            $.get('print-results/'+id, function(result) {
                //$("#myID").val(result);
                $(".modal-body").html(result);
                $("#print").modal('toggle');
            })
        }
        
    </script>

    @include('layouts.tableFilter')
    
@endsection
