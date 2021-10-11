@extends('layouts.app')

@section('title', 'SJGH-LRMS | Custom Types')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

@section('content')
    <div class="container" style="margin-top: -2%;">
        <div class="card">
            <div class="card-header">
                <h2><b style="color: #191970;">Custom Settings</b> 
                    <form class="form-inline my-2 my-lg-0 float-right">
                        <input class="form-control mr-sm-2" type="search" id="search" placeholder="Search" aria-label="Search">
                        <a href="{{ route('dropdown') }}" class="btn btn-info float-right">Add Dropdown</a>
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
                                    <th>Catogory Name</th>
                                    <th>Dropdown</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="employee_table">
                                @foreach ($custom as $key => $cust)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $cust->category_name }}</td>
                                        <td>{{ $cust->dropdown }}</td>
                                        <td>
                                        <div class="btn-group">
                                            <a class="btn btn-success" href="edit-dropdown/{{ $cust->dropdown_id }}" title="Edit Dropdown"><i class="fa fa-pencil-square-o"></i></a>
                                            <a class="btn btn-danger" onclick="return confirm('{{ $cust->dropdown }} will be deleted permanently!!!')" href="delete-dropdown/{{ $cust->dropdown_id }}" title="Delete Dropdown"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="d-flex justify-content-center">
                            {!! $custom->links() !!}
                        </div> --}}
                    </div>
                </div>
            </div>
            </div>
        </div>   
    </div>

    @include('layouts.tableFilter')

@endsection