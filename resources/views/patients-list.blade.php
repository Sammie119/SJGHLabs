@extends('layouts.app')

@section('title', 'SJGH-LRMS | Patient List')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

@section('content')
    <div class="container-fluid" style="margin-top: 6%;">
        <div class="card">
            <div class="card-header">
                <h2><b style="color: #191970;">Patients List</b>
                    <form class="form-inline my-2 my-lg-0 float-right">
                        <input class="form-control mr-sm-2" type="search" id="search" placeholder="Search" aria-label="Search">
                        <a class="btn btn-primary mr-2" style="padding: 10px"><i class="fa fa-search"></i></a>
                        <a href="{{ route('add-patient') }}" class="btn btn-info float-right">Add Patient</a>
                    </form>
                </h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        @if (Session::has('register'))
                            <div class="alert alert-success" role="alert">
                                <h4>{{ Session::get('register') }}</h4>
                            </div>
                        @endif
                        <table class="table table-striped table-advance table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>OPD No.</th>
                                    <th>Patient Name</th>
                                    <th>Date of Birth</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="employee_table">
                                @foreach ($patients as $key => $patient)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $patient->opd_number }}</td>
                                        <td>{{ $patient->name }}</td>
                                        <td>{{ $patient->date_of_birth }}</td>
                                        <td>{{ $patient->age }}</td>
                                        <td>{{ $patient->gender }}</td>
                                        <td>
                                        <div class="btn-group">
                                            <a class="btn btn-success" href="edit-patient/{{ $patient->patient_id }}" title="Edit Patient"><i class="fa fa-pencil-square-o"></i></a>
                                            <a class="btn btn-danger" onclick="return confirm('{{ $patient->name }} will be deleted permanently!!!')" href="delete-patient/{{ $patient->patient_id }}" title="Delete Patient"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="d-flex justify-content-center">
                            {!! $patients->links() !!}
                        </div> --}}
                    </div>
                </div>
            </div>
            </div>
        </div>   
    </div>

    <script type="text/javascript">
        window.onload = function(){
            document.getElementById('search').focus();
        
        $('#search').bind('change',function(){   
            var search = $(this).val();
            var pathArray = window.location.pathname.split('/');
            var url = pathArray[1];

            $.ajax({
                type:'POST',
                url:"/"+url+"/getPatients",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    search
                    },
                success:function(data) {
                    $("#employee_table").empty();
                    $("#employee_table").html(data);
                }
            });
        });
            
        };
    
    </script>

    {{-- @include('layouts.tableFilter') --}}

@endsection