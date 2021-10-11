@extends('layouts.app')

@section('title', 'SJGH-LRMS | Dashboard')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

@section('content')
    <div style="width: 80%; margin-top: 8%">
        <div style="width: 100%; margin-left: 13%">
            @if (Session::has('success'))
                <div class="alert alert-success text-center" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><small>x</small></button>
                    <h4>{{ Session::get('success') }}</h4>
                </div>
            @endif
            <div class="text-center" style="font-weight: bolder; color: #191970; font-family: Times new roman; margin-top: 20px; line-height: 250%;">
                <b style="font-size: 50px;"> ST. JOHN OF GOD HOSPITAL</b><br>
                <b style="font-size: 30px;"> Duayaw Nkwanta, Ahafo Region</b> <br>
                <b style="font-size: 30px;"> Laboratory Report Management System</b>
            </div>
        </div>

        {{-- Card --}}
        <div class="row ml-8" style="width: 100%; margin-left: 15%; margin-top:5%">
            <div class="card border-primary mb-3 ml-4 col-5">
                <div class="card-header bg-transparent border-primary"><h3>Blood Bank</h3></div>
                <div class="card-body text-primary">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">An item</li>
                        <li class="list-group-item">A second item</li>
                        <li class="list-group-item">A third item</li>
                    </ul>
                </div>
                <div class="card-footer bg-transparent border-primary"><h4>Footer</h4></div>
            </div>

            <div class="card border-primary mb-3 ml-4 col-5">
                <div class="card-header bg-transparent border-primary"><h3>Laboratory Report</h3></div>
                <div class="card-body text-primary">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">An item</li>
                        <li class="list-group-item">A second item</li>
                        <li class="list-group-item">A third item</li>
                    </ul>
                </div>
                <div class="card-footer bg-transparent border-primary"><h4>Footer</h4></div>
            </div>
        </div>
        {{-- End Card --}}
    </div>
    
    <div class="text-center">
        <footer>Created and Designed by: <i><b>SAMMAV I.T</b> Consult (0248376160 / 0556226864)</i> &nbsp &copy; <?php echo date('Y');?></footer>
    </div>

@endsection