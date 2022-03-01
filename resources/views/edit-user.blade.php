@extends('layouts.app')

@section('title', 'SJGH-LRMS | Edit User')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

@section('content')
    <div class="container" style="margin-top: -2%;">
        <div class="card">
            <div class="card-header">
                <h2><b style="color: #191970;">Edit User</b>
                    <a href="{{ route('user-list') }}" class="btn btn-info float-right">View Users</a>
                </h2>
            </div>
            <div class="card-body">
                <form action="{{ route('update-user') }}" method="POST" autocomplete="off" onsubmit="return validateForm()">
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
                    {{-- @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach (Session::get('error')->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    <input type="hidden" name="id" value="{{ $user->user_id }}">
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-10 col-12" style="margin-left: 27%;">
                            <div class="form-group"> <label for="name">Name</label> 
                                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" style="width: 66.5%;" required>
                            </div>    
                        </div>
                    </div>
                    <div class="row justify-content-center" style="width: 70%; margin-left: 15%;">
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="pus_cell">User Level</label> 
                                <select name="level" id="level" class="form-control" style="height: 35px;" required>
                                    <option>{{ $user->user_level }}</option>
                                    <option>Admin</option>
                                    <option>User</option>
                                    <option>Doctor</option>
                                    <option>Nurse</option>
                                </select></div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="red_cell">Mobile Number</label> 
                                <input type="text" class = "form-control" value="{{ $user->mobile }}" id="tel" name="mobile" required></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-10 col-12" style="margin-left: 27%;">
                            <div class="form-group"> <label for="department">Department</label> 
                                <select class = "form-control" id="department" name="department" style="width: 66.5%; height: 35px;" required>
                                    <option>{{ $user->department }}</option>
                                    <option value="Main Lab">Main Lab</option>
                                    <option value="RCH Mini-Lab">RCH Lab</option>
                                    @foreach ($department as $depart)
                                        <option value="{{ $depart->dropdown }}">{{ $depart->dropdown }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-10 col-12" style="margin-left: 27%;">
                            <div class="form-group"> <label for="lab_no">Username</label> 
                                <input type="text" class = "form-control" name="username" value="{{ $user->username }}" style="width: 66.5%;" readonly></div>
                        </div>
                    </div>
                    {{-- <div class="row justify-content-center" style="width: 70%; margin-left: 15%;">
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="pus_cell">Password</label> 
                                <input type="password" class = "form-control" id="new_pass" name="new_pass" required style="height: 35px;"></div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="form-group"> <label for="red_cell">Confirm Password</label> 
                                <input type="password" class = "form-control" id="con_pass" required style="height: 35px;"></div>
                        </div>
                    </div> --}}
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
    <script type="text/javascript">
        window.onload = function(){
            document.getElementById('name').focus();

            jQuery(function($){
                   $("#tel").mask("0999999999");
                });

//Restrictions .................................................

            $('#name').on("input", function(){
                var regexp = /[^a-zA-Z -]/g;

                if ($(this).val().match(regexp)){
                    $(this).val($(this).val().replace(regexp, ''));
                }
               });
        };
        
        function validateForm(){
            if(document.getElementById('new_pass').value != document.getElementById('con_pass').value){
                alert("Password does not march");
                document.getElementById('con_pass').focus();
                return false;
            }
        }
    </script>

@endsection