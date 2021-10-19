@extends('layouts.app')

@section('title', 'SJGH-LRMS | Donors List')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

@section('content')
    <div class="container-fluid" style="margin-top: 6%;">
        <div class="card">
            <div class="card-header">
                <h2><b style="color: #191970;">Donors List</b> 
                    <form class="form-inline my-2 my-lg-0 float-right">
                        <input class="form-control mr-sm-2" type="search" id="search" placeholder="Search" aria-label="Search">
                        <a href="{{ route('create-donor') }}" class="btn btn-info float-right">Add Donor</a>
                    </form>
                    {{-- <a href="{{ route('category') }}" class="btn btn-info float-right" style="margin-right: 10px">Add Category</a> --}}
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
                                    <th>Name of Donor</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Blood Group</th>
                                    <th>Marrital Status</th>
                                    <th>Profession</th>
                                    <th>Address</th>
                                    <th>Mobile</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="employee_table">
                                @foreach ($donors as $key => $donor)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $donor->name }}</td>
                                        <td>{{ $donor->gender }}</td>
                                        <td>{{ $donor->age }}</td>
                                        <td>{{ $donor->blood_group }}</td>
                                        <td>{{ $donor->marita_status }}</td>
                                        <td>{{ $donor->profession }}</td>
                                        <td>{{ $donor->address }}</td>
                                        <td>{{ $donor->mobile }}</td>
                                        <td>
                                        <div class="btn-group">
                                            <a class="btn btn-success" href="edit-donor/{{ $donor->donor_id }}" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                            <a class="btn btn-danger" onclick="return confirm('{{ $donor->name }} will be deleted permanently!!!')" href="delete-donor/{{ $donor->donor_id }}" title="Delete"><i class="fa fa-trash-o"></i></a>
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
    </div>

    @include('layouts.tableFilter')

@endsection