@extends('layouts.app')

@section('title', 'SJGH-LRMS | Lab Prices')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

@section('content')
    <div class="container" style="margin-top: -2%;">
        <div class="card">
            <div class="card-header">
                <h2><b style="color: #191970;">Price Settings</b> 
                    <form class="form-inline my-2 my-lg-0 float-right">
                        <input class="form-control mr-sm-2" type="search" id="search" placeholder="Search" aria-label="Search">
                        {{-- <a href="{{ route('dropdown') }}" class="btn btn-info float-right">Add Dropdown</a> --}}
                    </form>
                    {{-- <a href="{{ route('category') }}" class="btn btn-info float-right" style="margin-right: 10px">Add Category</a> --}}
                </h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                <h4>{{ Session::get('success') }}</h4>
                            </div>
                        @endif
                        <form action="change-price" method="POST" autocomplete="off">
                            @csrf
                            <table class="table table-striped table-advance table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Description</th>
                                        <th>Alais</th>
                                        <th>Insured</th>
                                        <th>Non-Insured</th>
                                    </tr>
                                </thead>
                                <tbody id="employee_table">
                                    @foreach ($labs as $key => $lab)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $lab->description }}</td>
                                            <td>{{ $lab->alias }}</td>
                                            <td><input type="number" name="insured[]" step="0.01" min="0" value="{{ $lab->insured_amount }}" style="width: 100px"></td>
                                            <td><input type="number" name="noninsured[]" step="0.01" min="0" value="{{ $lab->noninsured_amount }}" style="width: 100px"></td>
                                            <input type="hidden" name="alias[]" value="{{ $lab->alias }}">
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button class="btn btn-success float-right" type="submit">Submit</button>
                        </form>
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