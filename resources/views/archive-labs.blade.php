@extends('layouts.app')

@section('title', 'SJGH-LRMS | Archived Lab Results')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

@section('content')
    <div class="container-fluid" style="margin-top: 6%;">
        <div class="card">
            <div class="card-header">
                <h2><b style="color: #191970;">Archived Lab Results</b>
                    <form class="form-inline my-2 my-lg-0 float-right">
                        <input class="form-control mr-sm-2" type="search" id="search" placeholder="Search" aria-label="Search">
                        <a class="btn btn-primary mr-2" style="padding: 10px"><i class="fa fa-search"></i></a>
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
                                        <td>{{ $result->updated_at }}</td>
                                        <td>{{ $result->user->username }}</td>
                                        <td>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-primary" onclick="window.open('print-results/{{ $result->lab_info_id }}','', 'left=0,top=0,width=1000,height=600,toolbar=0,scrollbars=0,status=0')"><i class="fa fa-print"></i></a>
                                            <a class="btn btn-success" href="edit-test/{{ $result->lab_info_id }}" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                            <a class="btn btn-danger" onclick="return confirm('This {{ $result->lab_number }} Lab Number will be deleted permanently!!!')" href="delete-labs/{{ $result->lab_info_id }}" title="Delete"><i class="fa fa-trash-o"></i></a>
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

    <script type="text/javascript">
        window.onload = function(){
            document.getElementById('search').focus();
        
        $('#search').bind('change',function(){   
            var search = $(this).val();
            var pathArray = window.location.pathname.split('/');
            var url = pathArray[1];

            $.ajax({
                type:'POST',
                url:"/"+url+"/getResults",
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
