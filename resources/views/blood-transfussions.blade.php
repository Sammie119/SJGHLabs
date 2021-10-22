@extends('layouts.app')

@section('title', 'SJGH-LRMS | Blood Transfussions')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

@section('content')
    <div class="container-fluid" style="margin-top: 6%;">
        <div class="card">
            <div class="card-header">
                <h2><b style="color: #191970;">Transfussions</b>
                    <form class="form-inline my-2 my-lg-0 float-right">
                        <input class="form-control mr-sm-2" type="search" id="search" placeholder="Search" aria-label="Search">
                        <a href="{{ route('blood-in-stock') }}" class="btn btn-info float-right">Blood in Stock</a>
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
                                    <th>Bld<br>#</th>
                                    <th>Donor Name</th>
                                    <th>Blood Group</th>
                                    <th>Recipient Staff</th>
                                    <th>Patient Name</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Department</th>
                                    <th>Vol<br>(ml)</th>
                                    <th>Blood Product</th>
                                    <th>Date</th>
                                    <th>Issuer</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="employee_table">
                                @foreach ($trans as $key => $result)
                                    <?php 
                                        // $today = date("Y-m-d");
                                        // $diff = date_diff(date_create($result->exp_date), date_create($today));
                                                        
                                        // $age = $diff->format('%a');
                                    ?>
                                    <tr>
                                        <td>{{ $result->blood_number }}</td>
                                        <td>{{ $result->donor_name }}</td>
                                        <td>{{ $result->blood_group }}</td>
                                        <td>{{ $result->nurse_name }}</td>
                                        <td>{{ $result->patient_name }}</td>
                                        <td>{{ $result->patient_gender }}</td>
                                        <td>{{ $result->patient_age }}</td>
                                        <td>{{ $result->department }}</td>
                                        <td>{{ $result->volume }}</td>
                                        <td>{{ $result->blood_product }}</td>
                                        <td>{{ $result->transfusion_date }}</td>
                                        <td>{{ $result->user->username }}</td>
                                        <td>
                                        <div class="btn-group">
                                            <a class="btn btn-success" href="edit-checkout-blood/{{ $result->bloodtrans_id }}" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                            @if ((Session::get('user')['user_level'] === 'Admin'))
                                                <a class="btn btn-danger" onclick="return confirm('This Transfussion will be deleted permanently!!!')" href="delete-checkout-blood/{{ $result->bloodtrans_id }}" title="Delete"><i class="fa fa-trash-o"></i></a>
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
