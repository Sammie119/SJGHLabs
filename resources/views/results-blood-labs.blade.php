@extends('layouts.app')

@section('title', 'SJGH-LRMS | Blood Donors Lab Results')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

@section('content')
    <div class="container-fluid" style="margin-top: 6%;">
        <div class="card">
            <div class="card-header">
                <h2><b style="color: #191970;">Blood Donors Lab Results</b>
                    <form class="form-inline my-2 my-lg-0 float-right">
                        <input class="form-control mr-sm-2" type="search" id="search" placeholder="Search" aria-label="Search">
                        <a href="{{ route('create-donor') }}" class="btn btn-info float-right">Reg. Donor</a>
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
                                    <th>Lab#</th>
                                    <th>Donor Name</th>
                                    <th>ANTI TPHA</th>
                                    <th>HBsAg</th>
                                    <th>HCV</th>
                                    <th>BF</th>
                                    <th>Bld Grp</th>
                                    <th>Retro</th>
                                    <th>Mass<br>(Kg)</th>
                                    <th>BP<br>(mmHg)</th>
                                    <th>Bld<br>#</th>
                                    <th>Status</th>
                                    <th>Staff</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="employee_table">
                                @foreach ($labs as $result)
                                <?php 
                                    $setdate = $result->updated_at->format('Y-m-d');
                                    $bday = new DateTime($setdate); // Your date of birth
                                    $today = new Datetime(date('m.d.y'));
                                    $diff = $today->diff($bday);
                                    $days = $diff->format('%d');

                                ?>
                                    <tr>
                                        <td>{{ $result->lab_number }}</td>
                                        <td>{{ $result->name }}</td>
                                        <td>{{ $result->anti_tpha }}</td>
                                        <td>{{ $result->hbs_ag }}</td>
                                        <td>{{ $result->hcv }}</td>
                                        <td>{{ $result->bf }}</td>
                                        <td>{{ $result->blood }}</td>
                                        <td>{{ $result->retro }}</td>
                                        <td>{{ $result->mass }}</td>
                                        <td>{{ $result->bp }}</td>
                                        <td>{{ $result->blood_number }}</td>
                                        <td>{{ $result->status }}</td>
                                        <td>{{ $result->user->username }}</td>
                                        <td>
                                        <div class="btn-group">                                            
                                            @if ((Session::get('user')['user_level'] === 'User') && $days <= 1)
                                                <a class="btn btn-success" href="edit-blood-labs/{{ $result->lab_info_id }}" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                            @elseif ((Session::get('user')['user_level'] === 'Admin'))
                                                <a class="btn btn-success" href="edit-blood-labs/{{ $result->lab_info_id }}" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                                <a class="btn btn-danger" onclick="return confirm('This {{ $result->lab_number }} Lab Number will be deleted permanently!!!')" href="delete-labs/{{ $result->lab_info_id }}" title="Delete"><i class="fa fa-trash-o"></i></a>
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
