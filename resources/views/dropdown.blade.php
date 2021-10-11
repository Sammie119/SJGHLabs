@extends('layouts.app')

@section('title', 'SJGH-LRMS | Add Dropdown')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

@section('content')
    <div class="container" style="margin-top: -2%;">
        <div class="card">
            <div class="card-header">
                <h2><b style="color: #191970;">Add New Dropdown</b>
                    <a href="{{ route('custom-types') }}" class="btn btn-info float-right">View Custom Types</a>
                </h2>
            </div>
            <div class="card-body">
                <form action="{{ route('add-dropdown') }}" method="POST">
                    @csrf
                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('register'))
                        <div class="alert alert-success" role="alert">
                            <h4>{{ Session::get('register') }}</h4>
                        </div>
                    @endif
                    <div class="row justify-content-center ">
                        <div class="col-md-6">
                            <div class="form-group"> <label for="name">Category Name</label> 
                                <select type="text" name="category_id" class="form-control">
                                    <option value=""></option>
                                    @foreach ($category as $cat)
                                        <option value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>    
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"> <label for="name">Dropdown Name</label> 
                                <input type="text" name="dropdown_name" class="form-control">
                            </div>    
                        </div>
                    </div>
                    <div class="row justify-content-center" style="width: 70%; margin-left: 15%; margin-top: 10px;">
                        <div class="col-md-12 col-lg-10 col-12">
                            <div class="row justify-content-end mb-5">
                                <div class="col-lg-4 col-auto "><button type="reset" class="btn btn-primary btn-block"><small class="font-weight-bold"><i class="fa fa-refresh fa-spin" aria-hidden="true"></i> Clear</small></button> </div>
                                <div class="col-lg-4 col-auto "><button type="submit" class="btn btn-primary btn-block"><small class="font-weight-bold"><i class="fa fa-save"></i> Save</small></button> </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>   
    </div>

@endsection