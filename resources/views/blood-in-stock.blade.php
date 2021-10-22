@extends('layouts.app')

@section('title', 'SJGH-LRMS | Blood in Stock')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

@section('content')
    <div class="container-fluid" style="margin-top: 6%;">
        <div class="card">
            <div class="card-header">
                <h2><b style="color: #191970;">Available Blood in Stock</b>
                    <form class="form-inline my-2 my-lg-0 float-right">
                        <input class="form-control mr-sm-2" type="search" id="search" placeholder="Search" aria-label="Search">
                        <a href="{{ route('stock-blood') }}" class="btn btn-info float-right">Stock Blood</a>
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
                                    <th>#</th>
                                    <th>Blood<br>Number</th>
                                    <th>Donor Name</th>
                                    <th>Patient Name</th>
                                    <th>Blood Group</th>
                                    <th>Volume</th>
                                    <th>Date Taken</th>
                                    <th>Expiry Date</th>
                                    <th>Days to<br>Expire</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="employee_table">
                                @foreach ($blood as $key => $result)
                                    <?php 
                                        // $today = date("Y-m-d");
                                        // $diff = date_diff(date_create($result->exp_date), date_create($today));
                                                        
                                        // $age = $diff->format('%a');
                                    ?>
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $result->blood_number }}</td>
                                        <td>{{ $result->name }}</td>
                                        <td>{{ $result->patient_name }}</td>
                                        <td>{{ $result->blood_group }}</td>
                                        <td>{{ $result->volume }} ml</td>
                                        <td>{{ $result->taken_date }}</td>
                                        <td>{{ $result->exp_date }}</td>
                                        <td>{{ $result->expire_days }}</td>
                                        <td>
                                        <div class="btn-group">
                                            <a class="btn btn-primary" href="checkout-blood/{{ $result->bloodbank_id }}" title="Checkout"><i class="fa fa-sign-out"></i></a>
                                            <a class="btn btn-success" href="edit-blood-in-stock/{{ $result->bloodbank_id }}" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                            @if ((Session::get('user')['user_level'] === 'Admin'))
                                                <a class="btn btn-danger" onclick="return confirm('This {{ $result->blood_number }} Blood Number will be deleted permanently!!!')" href="delete-blood/{{ $result->bloodbank_id }}" title="Delete"><i class="fa fa-trash-o"></i></a>
                                            @endif
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

    @include('layouts.tableFilter')
    
@endsection
