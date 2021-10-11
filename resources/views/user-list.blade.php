@extends('layouts.app')

@section('title', 'SJGH-LRMS | User List')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

@section('content')
    <div class="container-fluid" style="margin-top: 6%;">
        <div class="card">
            <div class="card-header">
                <h2><b style="color: #191970;">Users List</b>
                    <form class="form-inline my-2 my-lg-0 float-right">
                        <input class="form-control mr-sm-2" type="search" id="search" placeholder="Search" aria-label="Search">
                        <a href="{{ route('add-user') }}" class="btn btn-info float-right">Add New User</a>
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

                        @if (Session::has('errors'))
                            <div class="alert alert-danger" role="alert">
                                <h4>{{ Session::get('errors') }}</h4>
                            </div>
                        @endif

                        @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                <h4>{{ Session::get('success') }}</h4>
                            </div>
                        @endif
                        <table class="table table-striped table-advance table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>Mobile</th>
                                    <th>Username</th>
                                    <th>Department</th>
                                    <th>User Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="employee_table">
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->mobile }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->department }}</td>
                                        <td>{{ $user->user_level }}</td>
                                        <td>
                                        <div class="btn-group">
                                            <a class="btn btn-success" href="edit-user/{{ $user->user_id }}" title="Edit {{ $user->username }}"><i class="fa fa-pencil-square-o"></i></a>
                                            <a class="btn btn-danger" onclick="return confirm('{{ $user->username }} will be deleted permanently!!!')" href="delete-user/{{ $user->user_id }}" title="Delete {{ $user->username }}"><i class="fa fa-trash-o"></i></a>
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
