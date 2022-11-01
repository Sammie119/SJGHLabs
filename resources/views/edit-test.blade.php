<?php 
    use App\Http\Controllers\GetdataController;

    $query = GetdataController::selectOptions();

    $receipt_no = App\Models\MedicalRequest::select('receipt_no')->where('lab_number', substr($haema->lab_number, 1))->first()->receipt_no ?? 0;
    // dd($receipt_no);
?>

@extends('layouts.app')

@section('title', 'SJGH-LRMS | Enter Test')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

<style>
    body {font-family: Arial;}

    .nav-link {color: black}

    .lab_show {display: none}
</style>

@section('content')
    <div class="container-fluid" style="margin-top: 6%;">
        <div class="card">
            <div class="card-header">
                <h2><b style="color: #191970;">Edit Test</b>
                    <a href="{{ route('results') }}" class="btn btn-info float-right">View Results</a>
                </h2>
            </div>
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    <h4>{{ Session::get('success') }}</h4>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('update-labs') }}" method="POST" autocomplete="off" id="test_form" name="myform" onsubmit = "return validateForm()">
                @csrf
              <input type="hidden" name="req_id" value="{{ $data->req_id }}">
              <input type="hidden" name="id" value="{{ $haema->lab_info_id }}">
              <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">Info</a>
                    </li>
                    <li class="nav-item {{ (in_array("anti_tpha", $data->lab_alias) || in_array("hbsag", $data->lab_alias) || in_array("hcv", $data->lab_alias) || in_array("g6pd", $data->lab_alias) || in_array("fbs_rbs", $data->lab_alias) || in_array("blood_group", $data->lab_alias) || in_array("urine_hcg", $data->lab_alias) || in_array("esr", $data->lab_alias) || in_array("bf_mps", $data->lab_alias) || in_array("sickling", $data->lab_alias) || in_array("widal", $data->lab_alias) || in_array("m_rdt", $data->lab_alias) || in_array("covid", $data->lab_alias)) ? '' : 'lab_show' }}">
                      <a class="nav-link" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="false">General</a>
                    </li>
                    <li class="nav-item {{ (in_array("fbc", $data->lab_alias)) ? '' : 'lab_show' }}">
                      <a class="nav-link" id="fbc-tab" data-toggle="tab" href="#fbc" role="tab" aria-controls="fbc" aria-selected="false">FBC</a>
                    </li>
                    <li class="nav-item {{ (in_array("urinalysis", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="urinalysis-tab" data-toggle="tab" href="#urinalysis" role="tab" aria-controls="urinalysis" aria-selected="false">Urinalysis</a>
                    </li>
                    <li class="nav-item {{ (in_array("stool", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="stool-tab" data-toggle="tab" href="#stool" role="tab" aria-controls="stool" aria-selected="false">Stool</a>
                    </li>
                    <li class="nav-item {{ (in_array("art", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="art-tab" data-toggle="tab" href="#art" role="tab" aria-controls="art" aria-selected="false">ART</a>
                    </li>
                    <li class="nav-item {{ (in_array("cooms", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="cooms-tab" data-toggle="tab" href="#cooms" role="tab" aria-controls="cooms" aria-selected="false">COOMS</a>
                    </li>
                    <li class="nav-item {{ (in_array("hb_profile", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="hb_profile-tab" data-toggle="tab" href="#hb_profile" role="tab" aria-controls="hb_profile" aria-selected="false">HB Profile</a>
                    </li>
                    <li class="nav-item {{ (in_array("pfc", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="pfc-tab" data-toggle="tab" href="#pfc" role="tab" aria-controls="pfc" aria-selected="false">PFC</a>
                    </li>
                    <li class="nav-item {{ (in_array("semen", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="semen-tab" data-toggle="tab" href="#semen" role="tab" aria-controls="semen" aria-selected="false">Semen</a>
                    </li>
                    <li class="nav-item {{ (in_array("ogtt", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="ogtt-tab" data-toggle="tab" href="#ogtt" role="tab" aria-controls="ogtt" aria-selected="false">OGTT</a>
                    </li>
                    <li class="nav-item {{ (in_array("psa", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="psa-tab" data-toggle="tab" href="#psa" role="tab" aria-controls="psa" aria-selected="false">PSA</a>
                    </li>
                    <li class="nav-item {{ (in_array("h_pylori", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="h_pylori-tab" data-toggle="tab" href="#h_pylori" role="tab" aria-controls="h_pylori" aria-selected="false">H-Pylori</a>
                    </li>
                    <li class="nav-item {{ (in_array("dm_profile", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="dm_profile-tab" data-toggle="tab" href="#dm_profile" role="tab" aria-controls="dm_profile" aria-selected="false">DM Profile</a>
                    </li>
                    <li class="nav-item {{ (in_array("anc_urine", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="anc_urine-tab" data-toggle="tab" href="#anc_urine" role="tab" aria-controls="anc_urine" aria-selected="false">ANC Urine</a>
                    </li>
                    <li class="nav-item {{ (in_array("lft", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="lft-tab" data-toggle="tab" href="#lft" role="tab" aria-controls="lft" aria-selected="false">LFT</a>
                    </li>
                    <li class="nav-item {{ (in_array("rft", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="rft-tab" data-toggle="tab" href="#rft" role="tab" aria-controls="rft" aria-selected="false">RFT</a>
                    </li>
                    <li class="nav-item {{ (in_array("lipid", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="lipid-tab" data-toggle="tab" href="#lipid" role="tab" aria-controls="lipid" aria-selected="false">Lipid</a>
                    </li>
                    <li class="nav-item {{ (in_array("electrolytes", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="electrolytes-tab" data-toggle="tab" href="#electrolytes" role="tab" aria-controls="electrolytes" aria-selected="false">Electrolytes</a>
                    </li>
                    <li class="nav-item {{ (in_array("uric", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="uric-tab" data-toggle="tab" href="#uric" role="tab" aria-controls="uric" aria-selected="false">Uric</a>
                    </li>
                    <li class="nav-item {{ (in_array("glycated_h", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="glycated_h-tab" data-toggle="tab" href="#glycated_h" role="tab" aria-controls="glycated_h" aria-selected="false">Glycated Hemo</a>
                    </li>
                    <li class="nav-item {{ (in_array("serum", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="serum-tab" data-toggle="tab" href="#serum" role="tab" aria-controls="serum" aria-selected="false">Serum</a>
                    </li>
                    <li class="nav-item {{ (in_array("hvs", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="hvs-tab" data-toggle="tab" href="#hvs" role="tab" aria-controls="hvs" aria-selected="false">HVS</a>
                    </li>
                    <li class="nav-item {{ (in_array("pleural", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="pleural-tab" data-toggle="tab" href="#pleural" role="tab" aria-controls="pleural" aria-selected="false">Pleural</a>
                    </li>
                    <li class="nav-item {{ (in_array("peritoneal", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="peritoneal-tab" data-toggle="tab" href="#peritoneal" role="tab" aria-controls="peritoneal" aria-selected="false">Peritoneal</a>
                    </li>
                    <li class="nav-item {{ (in_array("csf", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="csf-tab" data-toggle="tab" href="#csf" role="tab" aria-controls="csf" aria-selected="false">CSF</a>
                    </li>
                    <li class="nav-item {{ (in_array("bacteriology", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <a class="nav-link" id="bacteriology-tab" data-toggle="tab" href="#bacteriology" role="tab" aria-controls="bacteriology" aria-selected="false">Bacteriology</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                    </li> --}}
                </ul>
                  
          {{-- General Information --}}
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                <h3>General Information</h3>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group"> 
                        <label for="lab_no">Lab Number</label> 
                        <input type="text" name="lab_no" id="lab_no" value="{{ $haema->lab_number }}" class = "form-control" maxlength="10" readonly>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group"> 
                        <label for="depart">Department</label> 
                        <select name="department" id="depart" class="form-control" required >
                            @foreach ($query['department'] as $depart)
                            <option @if ($haema->department === $depart['dropdown']) selected @endif value="{{ $depart['dropdown_id'] }}">{{ $depart['dropdown'] }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group"> <label for="opd_no">OPD Number</label> <input type="text" name="opd_no" id="opd_no" value="{{ $haema->opd_number }}" class = "form-control" maxlength="10" readonly ></div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <div><label for="name">Patient's Name</label><input type="text" class="form-control" value="{{ $haema->name }}" id="name" name="name" readonly> </div>
                    </div>
                    <div class="col-md-1">
                        <div> <label for="age">Age</label> <input type="text" class="form-control" id="age" value="{{ $haema->age }}" name="age" readonly > </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 mt-2">
                        <div class="form-group"> <label for="opd_no">Receipt Number</label> <input type="text" value="{{ $receipt_no }}" name="receipt_no" id="receipt_no" class = "form-control" maxlength="14" readonly ></div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                    <br>
                    <label for="disInfo">Static Info</label>
                        <table class="table" id="disInfo">
                            
                        </table>
                    </div>
                </div>
            </div>
            {{-- General Information --}}
            
            {{-- General Labs --}}
            <div class="tab-pane fade" id="general" role="tabpanel" aria-labelledby="general-tab">
                <h3>General Labs</h3>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-4 {{ (in_array("anti_tpha", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <div class="form-group"> <label for="anti">ANTI TPHA/VDRL</label> <select name="anti_tpha" class="form-control" id="anti" style="height: 35px;">
                                <option>{{ $haema->anti_tpha }}</option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                                <option>No Test Kits</option>
                            </select> </div>
                    </div>
                    <div class="col-md-4 {{ (in_array("hbsag", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <div class="form-group"> <label for="hbs_ag">HBsAg</label> 
                            <select name="hbs_ag" class="form-control" id="hbs_ag" style="height: 35px;">
                                <option>{{ $haema->hbsag }}</option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                                <option>No Test Kits</option>
                            </select></div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4 {{ (in_array("hcv", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <div class="form-group"> <label for="hcv">HCV</label> 
                            <select name="hcv" class="form-control" id="hcv" style="height: 35px;">
                                <option>{{ $haema->hcv }}</option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                                <option>No Test Kits</option>
                            </select> </div>
                    </div>
                    <div class="col-md-4 {{ (in_array("g6pd", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <div class="form-group"> <label for="g6pd">G6PD (Methemoglobin Reduction Test)</label> 
                            <select name="g6pd" id="g6pd" class="form-control" style="height: 35px;">
                                <option>{{ $haema->g6pd }}</option>
                                @foreach ($query['g6pd'] as $g6pd)
                                    <option>{{ $g6pd['dropdown'] }}</option>
                                @endforeach
                                <option>Pending</option>
                            </select> </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4 {{ (in_array("fbs_rbs", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <div class="form-group"> <label for="fbs_rbs_2">FBS/RBS</label> 
                            <select name="fbs_rbs_2" id="fbs_rbs_2" class="form-control" style="height: 35px;">
                                <option>{{ $haema->sel_fbs_rbs }}</option>
                                <option>FBS:</option>
                                <option>RBS:</option>
                            </select></div>
                    </div>
                    <div class="col-md-4 {{ (in_array("fbs_rbs", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <div class="form-group"> <label for="fbs">FBS/RBS Value (mmol/L)</label>
                            @if ($haema->fbs_rbs === '')
                                <input type="text" id="fbs" name="fbs_rbs" class="form-control" maxlength="4" readonly style="height: 35px;">
                            @else
                                <input type="text" id="fbs" value="{{ $haema->fbs }}" name="fbs_rbs" class="form-control" maxlength="4" style="height: 35px;">
                            @endif 
                            
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4 {{ (in_array("blood_group", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <div class="form-group"> <label for="blood">BLOOD GROUP</label> 
                            <select name="blood" id="blood" class="form-control" style="height: 35px;">
                                <option>{{ $haema->blood }}</option>
                                <option>A</option>
                                <option>AB</option>
                                <option>B</option>
                                <option>O</option>
                            </select> </div>
                    </div>
                    <div class="col-md-4 {{ (in_array("blood_group", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <div class="form-group"> <label for="blood_rh">Rh(D)</label>
                            @if ($haema->blood_rh == '')
                                <select name="blood_rh" id="blood_rh" class="form-control" disabled style="height: 35px;">
                            @else
                                <select name="blood_rh" id="blood_rh" class="form-control" style="height: 35px;"> 
                            @endif 
                                <option>{{ $haema->blood_rh }}</option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                            </select></div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4 {{ (in_array("urine_hcg", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <div class="form-group"> <label for="urine_hcg">URINE hCG</label> 
                            <select name="urine_hcg" class="form-control" id="urine_hcg" style="height: 35px;">
                                <option>{{ $haema->urine_hcg }}</option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                            </select> </div>
                    </div>
                    <div class="col-md-4 {{ (in_array("esr", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <div class="form-group"> <label for="esr">ESR (mmfall/hr)</label> 
                            <input type="text" id="esr" value="{{ $haema->esr }}" name="esr" class="form-control" maxlength="3" style="height: 35px;"></div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4 {{ (in_array("bf_mps", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <div class="form-group"> <label for="bf">BF</label> 
                            <select name="bf" id="bf" class="form-control" onchange='CheckColors(this.value);' style="height: 35px;">
                                <option>{{ $haema->bf }}</option>
                                @foreach ($query['bf'] as $bf)
                                    <option>{{ $bf['dropdown'] }}</option>                                        
                                @endforeach
                            </select> 
                        </div>
                    </div>
                    <div class="col-md-4 {{ (in_array("bf_mps", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <div class="form-group"> <label for="para">PARASITE DENSITY (mps/ul)</label> 
                            @if ($haema->bf_parasite == '')
                                <input type="text" id="para" name="bf_parasite" maxlength="7" class="form-control" readonly style="height: 35px;"></div>
                            @else
                                <input type="text" id="para" value="{{ $haema->bf_parasite }}" name="bf_parasite" maxlength="7" class="form-control" style="height: 35px;"></div>
                            @endif  
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4 {{ (in_array("sickling", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <div class="form-group"> <label for="sickling">SICKLING TEST</label> 
                            <select name="sickling" id="sickling" class="form-control" style="height: 35px;">
                                <option>{{ $haema->sickling }}</option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                            </select> </div>
                    </div>
                    <div class="col-md-4 {{ (in_array("sickling", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <div class="form-group"> <label for="sickling_hgb">Hgb ELECTROPHORESIS</label>
                            <select name="sickling_hgb" id="sickling_hgb" class="form-control"  style="height: 35px;">
                                <option>{{ $haema->sickling_hb }}</option>
                                @foreach ($query['Hgb_Elec'] as $Hgb_Elec)
                                    <option>{{ $Hgb_Elec['dropdown'] }}</option>
                                @endforeach
                            </select></div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4 {{ (in_array("widal", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <div class="form-group"> <label for="widal_o">WIDAL S. Typhi O</label> 
                            <select name="widal_o" class="form-control" id="widal_o" style="height: 35px;">
                                <option>{{ $haema->widal_o }}</option>
                                @foreach ($query['widal'] as $widal)
                                    <option>{{ $widal['dropdown'] }}</option>                                        
                                @endforeach
                            </select> </div>
                    </div>
                    <div class="col-md-4 {{ (in_array("widal", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <div class="form-group"> <label for="widal_h">WIDAL S. Typhi H</label> 
                            <select name="widal_h" id="widal_h" class="form-control" style="height: 35px;">
                                <option>{{ $haema->widal_h }}</option>
                                @foreach ($query['widal'] as $widal)
                                    <option>{{ $widal['dropdown'] }}</option>                                        
                                @endforeach
                            </select> </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4 {{ (in_array("m_rdt", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <div class="form-group"> <label for="rdt_pf">Malaria RDT (Pf)</label> 
                            <select name="rdt_pf" id="rdt_pf" class="form-control" style="height: 35px;">
                                <option>{{ $haema->rdt_pf }}</option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                            </select> </div>
                    </div>
                    <div class="col-md-4 {{ (in_array("covid", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <div class="form-group"> <label for="covid">SARS-CoV-2 Antigen Test</label> 
                            <select name="covid" id="covid" class="form-control" style="height: 35px;">
                                <option>{{ $haema->covid }}</option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                            </select> 
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8 {{ (in_array("anti_tpha", $data->lab_alias) || in_array("hbsag", $data->lab_alias) || in_array("hcv", $data->lab_alias) || in_array("g6pd", $data->lab_alias) || in_array("fbs_rbs", $data->lab_alias) || in_array("blood_group", $data->lab_alias) || in_array("urine_hcg", $data->lab_alias) || in_array("esr", $data->lab_alias) || in_array("bf_mps", $data->lab_alias) || in_array("sickling", $data->lab_alias) || in_array("widal", $data->lab_alias) || in_array("m_rdt", $data->lab_alias) || in_array("covid", $data->lab_alias)) ? '' : 'lab_show' }}">
                        <div class="form-group"> <label for="comment">General Comment</label> 
                            <textarea class="form-control rounded-0" id="comment" name="comment" form="test_form" rows="3">{{ $haema->comment }}</textarea></div>
                    </div>
                </div>
            </div>
            {{-- End General Labs --}}

            {{-- FBC --}}
            <div class="tab-pane fade" id="fbc" role="tabpanel" aria-labelledby="fbc-tab">
                <h3>Full Blood Count (FBC)</h3>
                <hr>
                <div class="row justify-content-center">
                <div class="btn-group">
                    <label class="btn btn-primary">
                    <input type="radio" name="fbc_radio" id="fbc_radio2" onclick="myFunFbc_radio2()" checked> FBC (3 Parts)
                    </label>
                    <label class="btn btn-primary">
                    <input type="radio" name="fbc_radio" id="fbc_radio" onclick="myFunFbc_radio()"> FBC (5 Parts)
                    </label>
                </div> 
                </div>
                <br>
                {{-- FBC 3 Parts --}}
                <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="form-group"> 
                        <label for="wbc">WBC (x10<sup>9</sup>/L)</label></label> 
                        <input type="text" class="form-control" id="wbc" value="{{ $haema->wbc }}" name="wbc" maxlength="5">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"> 
                        <label for="lym">LYM# (x10<sup>9</sup>/L)</label> 
                        <input type="text" class="form-control" id="lym" value="{{ $haema->lym }}" name="lym" maxlength="5"> 
                    </div>
                </div>
                </div>
                {{-- FBC 5 Parts --}}
                <div class="row justify-content-center">
                <div class="col-md-4" style="display: none;" id="fbc_hid1">
                    <div class="form-group"> 
                    <label for="mid">MONO# (x10<sup>3</sup>/uL)</label>
                    <input type="text" class="form-control" id="mono" value="{{ $haema->mono }}" name="mono" maxlength="5">
                    </div>
                </div>
                <div class="col-md-4" style="display: none;" id="fbc_hid4">
                    <div class="form-group"> 
                    <label for="eo">EO# (x10<sup>3</sup>/uL)</label> 
                    <input type="text" class="form-control" id="eo" value="{{ $haema->eo }}" name="eo" maxlength="5">
                    </div>
                </div>
                </div>
                {{-- End --}}
                <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="form-group" id="fbc_hid2" style="display: none;"> 
                    <label for="baso">BASO# (x10<sup>3</sup>/uL)</label>
                    <input type="text" class="form-control" id="baso" value="{{ $haema->baso }}" name="baso" maxlength="5">
                    </div>
                    <div class="form-group" id="fbc_hid3"> 
                    <label for="mid">MID# (x10<sup>9</sup>/L)</label>
                    <input type="text" class="form-control" id="mid" value="{{ $haema->mid }}" name="mid" maxlength="5">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"> 
                    <label for="neut">NEUT# (x10<sup>9</sup>/L)</label> 
                    <input type="text" class="form-control" id="neut" value="{{ $haema->neut }}" name="neut" maxlength="5">
                    </div>
                </div>
                </div>
                <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="form-group"> 
                    <label for="rbc">RBC (x10<sup>12</sup>/L)</label>
                    <input type="text" class="form-control" id="rbc" value="{{ $haema->rbc }}" name="rbc" maxlength="5">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"> 
                    <label for="fbc_hgb">HGB (g/dL)</label> 
                    <input type="text" class="form-control" id="fbc_hgb" value="{{ $haema->fbc_hgb }}" name="fbc_hgb" maxlength="5">
                    </div>
                </div>
                </div>
                <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="form-group"> 
                    <label for="hct">HCT (%)</label>
                    <input type="text" class="form-control" id="hct" value="{{ $haema->hct }}" name="hct" maxlength="5">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"> 
                    <label for="mcv">MCV (fL)</label> 
                    <input type="text" class="form-control" id="mcv" value="{{ $haema->mcv }}" name="mcv" maxlength="5">
                    </div>
                </div>
                </div>
                <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="form-group"> 
                    <label for="mch">MCH (pg)</label>
                    <input type="text" class="form-control" id="mch" value="{{ $haema->mch }}" name="mch" maxlength="5">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"> 
                    <label for="rdw_cv">RDW-CV (%)</label>
                    <input type="text" class="form-control" id="rdw_cv" value="{{ $haema->rdw_cv }}" name="rdw_cv" maxlength="5">
                    </div>
                </div>
                </div>
                <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="form-group"> 
                    <label for="mpv">MPV (fL)</label>
                    <input type="text" class="form-control" id="mpv" value="{{ $haema->mpv }}" name="mpv" maxlength="5">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"> 
                    <label for="plt">PLT (x10<sup>9</sup>/L)</label> 
                    <input type="text" class="form-control" id="plt" value="{{ $haema->plt }}" name="plt" maxlength="5">
                    </div>
                </div>
                </div>
                <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="form-group"> 
                    <label for="mpv">Comment</label>
                    <textarea class="form-control rounded-0" name="fbc_comment" id="fbc_comment" form="test_form" rows="3">{{ $haema->fbc_comment }}</textarea>
                    </div>
                </div>
                </div>
            </div>  
            {{-- FBC --}}

            {{-- Urinalysis --}}
            <div class="tab-pane fade" id="urinalysis" role="tabpanel" aria-labelledby="urinalysis-tab">
                <h3>Urinalysis</h3>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="appear">Appearance</label> 
                            <select name="appear" id="appear" class="form-control" style="height: 35px;">
                                <option>{{ $haema->appear }}</option>
                                @foreach ($query['appear'] as $appear)
                                    <option>{{ $appear['dropdown'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="color">Colour</label> 
                            <select name="color" id="color" class="form-control" style="height: 35px;">
                            <option>{{ $haema->color }}</option>
                            @foreach ($query['color'] as $color)
                                <option>{{ $color['dropdown'] }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <label>CHEMISTRY</label>
                <hr>
                
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="uri_blood">Blood</label> 
                            <select name="uri_blood" id="uri_blood" class="form-control" style="height: 35px;">
                            <option>{{ $haema->uri_blood }}</option>
                            @foreach ($query['response'] as $response)
                                <option>{{ $response['dropdown'] }}</option>
                            @endforeach
                                <option>Trace</option>
                            </select>
                            @if ($haema->blood_factor == '')
                            <select name="blood_factor" id="blood_factor" class="form-control" style="display: none; height: 35px;">
                            @else
                            <select name="blood_factor" id="blood_factor" class="form-control" style="height: 35px;">  
                            @endif
                                <option>{{ $haema->blood_factor }}</option>
                                @foreach ($query['factor'] as $factor)
                                <option>{{ $factor['dropdown'] }}</option>
                            @endforeach
                            </select> 
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="urobiln">Urobilnogen</label> 
                            <select name="urobiln" id="urobiln" class="form-control" style="height: 35px;">
                            <option>{{ $haema->urobiln }}</option>
                            @foreach ($query['urobiln'] as $urobiln)
                                <option>{{ $urobiln['dropdown'] }}</option>
                            @endforeach
                            </select>
                            @if ($haema->urobiln_factor == '')
                            <select name="urobiln_factor" id="urobiln_factor" class="form-control" style="display: none; height: 35px;">  
                            @else
                            <select name="urobiln_factor" id="urobiln_factor" class="form-control" style="height: 35px;">  
                            @endif
                            <option>{{ $haema->urobiln_factor }}</option>
                            @foreach ($query['factor'] as $factor)
                                <option>{{ $factor['dropdown'] }}</option>
                            @endforeach
                            </select></div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="glucose">Glucose</label> 
                            <select name="glucose" id="glucose" class="form-control" style="height: 35px;">
                            <option>{{ $haema->glucose }}</option>
                            @foreach ($query['response'] as $response)
                                <option>{{ $response['dropdown'] }}</option>
                            @endforeach
                                <option>Trace</option>
                            </select>
                            @if ($haema->glucose_factor == '')
                            <select name="glucose_factor" id="glucose_factor" class="form-control" style="display: none; height: 35px;">
                            @else
                            <select name="glucose_factor" id="glucose_factor" class="form-control" style="height: 35px;">   
                            @endif
                            <option>{{ $haema->glucose_factor }}</option>
                            @foreach ($query['factor'] as $factor)
                                <option>{{ $factor['dropdown'] }}</option>
                            @endforeach
                            </select> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="inputEmail4">Nitrite</label> 
                            <select name="nitrite" id="nitrite" class="form-control" style="height: 35px;">
                            <option>{{ $haema->nitrite }}</option>
                            @foreach ($query['response'] as $response)
                                <option>{{ $response['dropdown'] }}</option>
                            @endforeach
                            </select></div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="ph">pH</label> 
                            <input type="text" name="ph" value="{{ $haema->ph }}" id="ph" class="form-control" maxLength="3"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="bilirubin">Bilirubin</label> 
                            <select name="bilirubin" id="bilirubin" class="form-control" style="height: 35px;">
                            <option>{{ $haema->bilirubin }}</option>
                            @foreach ($query['response'] as $response)
                                <option>{{ $response['dropdown'] }}</option>
                            @endforeach
                                <option>Trace</option>
                            </select>
                            @if ($haema->bilirubin_factor == '')
                            <select name="bilirubin_factor" id="bilirubin_factor" class="form-control" style="display: none; height: 35px;">   
                            @else
                            <select name="bilirubin_factor" id="bilirubin_factor" class="form-control" style="height: 35px;">  
                            @endif
                            <option>{{ $haema->bilirubin_factor }}</option>
                            @foreach ($query['factor'] as $factor)
                                <option>{{ $factor['dropdown'] }}</option>
                            @endforeach
                            </select></div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="ketone">Ketone</label> 
                            <select name="ketone" id="ketone" class="form-control" style="height: 35px;">
                            <option>{{ $haema->ketone }}</option>
                            @foreach ($query['response'] as $response)
                                <option>{{ $response['dropdown'] }}</option>
                            @endforeach
                                <option>Trace</option>
                            </select>
                            @if ($haema->ketone_factor == '')
                            <select name="ketone_factor" id="ketone_factor" class="form-control" style="display: none; height: 35px;">
                            @else
                            <select name="ketone_factor" id="ketone_factor" class="form-control" style="height: 35px;">  
                            @endif
                            <option>{{ $haema->ketone_factor }}</option>
                            @foreach ($query['factor'] as $factor)
                                <option>{{ $factor['dropdown'] }}</option>
                            @endforeach
                            </select> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="protein">Protein</label> 
                            <select name="protein" id="protein" class="form-control" style="height: 35px;">
                            <option>{{ $haema->protein }}</option>
                            @foreach ($query['response'] as $response)
                                <option>{{ $response['dropdown'] }}</option>
                            @endforeach
                                <option>Trace</option>
                            </select>
                            @if ($haema->protein_factor == '')
                            <select name="protein_factor" id="protein_factor" class="form-control" style="display: none; height: 35px;">
                            @else
                            <select name="protein_factor" id="protein_factor" class="form-control" style="height: 35px;">  
                            @endif
                            <option>{{ $haema->protein_factor }}</option>
                            @foreach ($query['factor'] as $factor)
                                <option>{{ $factor['dropdown'] }}</option>
                            @endforeach
                            </select></div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="leuco">Leucocytes</label> 
                            <select name="leuco" id="leuco" class="form-control" style="height: 35px;">
                            <option>{{ $haema->leuco }}</option>
                            @foreach ($query['response'] as $response)
                                <option>{{ $response['dropdown'] }}</option>
                            @endforeach
                                <option>Trace</option>
                            </select>
                            @if ($haema->leuco_factor == '')
                            <select name="leuco_factor" id="leuco_factor" class="form-control" style="display: none; height: 35px;">
                            @else
                            <select name="leuco_factor" id="leuco_factor" class="form-control" style="height: 35px;">  
                            @endif
                            <option>{{ $haema->leuco_factor }}</option>
                            @foreach ($query['factor'] as $factor)
                                <option>{{ $factor['dropdown'] }}</option>
                            @endforeach
                            </select> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="spec_gra">Specific Gravity</label> 
                            <input type="text" name="spec_gra" value="{{ $haema->spec_gra }}" id="spec_gra" class="form-control"></div>
                    </div>
                </div>

                <label>MICROSCOPY</label>
                <hr>
                
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="pus_cell">Pus cell (/HPF)</label> 
                            <input type="text" id="pus_cell" name="pus_cell" value="{{ $haema->pus_cell }}" maxlength="4" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="red_cell">Red cells (/HPF)</label> 
                            <input type="text" id="red_cell" name="red_cell" value="{{ $haema->red_cell }}" maxlength="4" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="epi_cell">Epithelial cell (/HPF)</label> 
                            <input type="text" id="epi_cell" name="epi_cell" value="{{ $haema->epi_cell }}" maxlength="4" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group"> <label for="other">Other</label> 
                            <textarea class="form-control rounded-0" name="other" id="other" form="test_form" rows="3">{{ $haema->other }}</textarea></div>
                    </div>
                </div>
            </div>
            {{-- Urinalysis --}}

            {{-- Stool --}}
            <div class="tab-pane fade" id="stool" role="tabpanel" aria-labelledby="stool-tab">
                <h3>Stool R/E</h3>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group"> <label for="macro">MACROSCOPY</label> 
                            <textarea class="form-control rounded-0" name="macro" id="macro" form="test_form" rows="3">{{ $haema->macro }}</textarea></div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group"> <label for="micro">MICROSCOPY</label> 
                            <textarea class="form-control rounded-0" name="micro" id="micro" form="test_form" rows="3">{{ $haema->micro }}</textarea></div>
                    </div>
                </div>
            </div>
            {{-- Stool --}}

            {{-- ART --}}
            <div class="tab-pane fade" id="art" role="tabpanel" aria-labelledby="art-tab">
                <h3>Antigen Rapid Test</h3>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="type_one">First Response</label> 
                            <select name="first_resp" id="type_one" class="form-control" >
                                <option>{{ $haema->first_resp }}</option>
                                @foreach ($query['art_screen'] as $art_screen)
                                  <option>{{ $art_screen['dropdown'] }}</option>
                                @endforeach
                            </select> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="type_two">Ora Quick</label> 
                            <select name="ora_quick" id="type_two" class="form-control" >
                              <option>{{ $haema->ora_quick }}</option>
                              @foreach ($query['ora'] as $ora)
                                <option>{{ $ora['dropdown'] }}</option>
                              @endforeach
                            </select></div>
                    </div>
                  </div>

                  <label>Confirmation Test</label>
                  <hr>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="ora">SD Bioline</label> 
                            <select name="sd_bioline" id="ora" class="form-control" >
                                <option>{{ $haema->sd_bioline }}</option>
                                @foreach ($query['art_screen'] as $art_screen)
                                  <option>{{ $art_screen['dropdown'] }}</option>
                                @endforeach
                            </select> </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group"> <label for="ora">HIV Final Result</label>
                          <select name="hiv_final" id="hiv_final" class="form-control" >
                              <option>{{ $haema->hiv_final }}</option>
                              @foreach ($query['response'] as $response)
                                  <option>{{ $response['dropdown'] }}</option>
                              @endforeach
                              <option>Inconclusive</option>
                          </select> </div>
                    </div>
                </div>
            </div>
            {{-- ART --}}

            {{-- COOMS --}}
            <div class="tab-pane fade" id="cooms" role="tabpanel" aria-labelledby="cooms-tab">
                <h3>COOM'S Test</h3>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="indirect">Indirect Agglutination Test (IAT)</label> 
                            <select name="indirect" id="indirect" class="form-control" style="height: 35px;">
                              <option>{{ $haema->indirect }}</option>
                              @foreach ($query['response'] as $response)
                                <option>{{ $response['dropdown'] }}</option>
                              @endforeach
                            </select> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="direct">Direct Agglutination Test (DAT)</label> 
                            <select name="direct" id="direct" class="form-control" style="height: 35px;">
                              <option>{{ $haema->direct }}</option>
                              @foreach ($query['response'] as $response)
                                <option>{{ $response['dropdown'] }}</option>
                              @endforeach
                            </select></div>
                    </div>
                </div>
            </div>
            {{-- COOMS --}}

            {{-- HB_Profile --}}
            <div class="tab-pane fade" id="hb_profile" role="tabpanel" aria-labelledby="hb_profile-tab">
                <h3>HEPATITIS B PROFILE REPORT</h3>
                <hr>
        
                <label>Hepatitis B Marker/Results</label>
                <hr>  

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="hb_sag">HBsAg</label> 
                            <select name="hb_sag" id="hb_sag" class="form-control" style="height: 35px;">
                            <option>{{ $haema->hb_sag }}</option>
                            @foreach ($query['response'] as $response)
                                <option>{{ $response['dropdown'] }}</option>
                            @endforeach
                            </select> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="hb_sab">HBsAb</label> 
                            <select name="hb_sab" id="hb_sab" class="form-control" style="height: 35px;">
                            <option>{{ $haema->hb_sab }}</option>
                            @foreach ($query['response'] as $response)
                                <option>{{ $response['dropdown'] }}</option>
                            @endforeach
                            </select></div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="hb_eag">HBeAg</label> 
                            <select name="hb_eag" id="hb_eag" class="form-control" style="height: 35px;">
                            <option>{{ $haema->hb_eag }}</option>
                            @foreach ($query['response'] as $response)
                                <option>{{ $response['dropdown'] }}</option>
                            @endforeach
                            </select> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="hb_eab">HBeAb</label> 
                            <select name="hb_eab" id="hb_eab" class="form-control" style="height: 35px;">
                            <option>{{ $haema->hb_eab }}</option>
                            @foreach ($query['response'] as $response)
                                <option>{{ $response['dropdown'] }}</option>
                            @endforeach
                            </select></div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="hb_cab">HBcAb</label> 
                            <select name="hb_cab" id="hb_cab" class="form-control" style="height: 35px;">
                            <option>{{ $haema->hb_cab }}</option>
                            @foreach ($query['response'] as $response)
                                <option>{{ $response['dropdown'] }}</option>
                            @endforeach
                            </select> </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group"> <label for="hb_comment">COMMENT</label> 
                            <textarea class="form-control rounded-0" name="hb_comment" id="hb_comment" form="test_form" rows="3">{{ $haema->hb_comment }}</textarea></div>
                    </div>
                </div>
            </div>
            {{-- HB_Profile --}}

            {{-- PFC --}}
            <div class="tab-pane fade" id="pfc" role="tabpanel" aria-labelledby="pfc-tab">
                <h3>Peripheral Film Comment Report</h3>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group"> <label for="per_rbc">RBC</label> 
                            <textarea class="form-control rounded-0" id="per_rbc" name="per_rbc" form="test_form" rows="3">{{ $haema->per_rbc }}</textarea></div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group"> <label for="per_wbc">WBC</label> 
                            <textarea class="form-control rounded-0" id="per_wbc" name="per_wbc" form="test_form" rows="3">{{ $haema->per_wbc }}</textarea></div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group"> <label for="per_plt">Platelet</label> 
                            <textarea class="form-control rounded-0" id="per_plt" name="per_plt" form="test_form" rows="3">{{ $haema->per_plt }}</textarea></div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group"> <label for="per_imp">Impression</label> 
                            <textarea class="form-control rounded-0" id="per_imp" name="per_imp" form="test_form" rows="3">{{ $haema->per_imp }}</textarea></div>
                    </div>
                </div>
            </div>
            {{-- PFC --}}

            {{-- Semen --}}
            <div class="tab-pane fade" id="semen" role="tabpanel" aria-labelledby="semen-tab">
                <h3>Semen Analysis Report</h3>
                <hr>
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_date">Date of Sample</label> 
                            <input type="date" id="semen_date" value="{{ $haema->semen_date }}" max="<?php echo date('Y-m-d');?>" name="semen_date" class="form-control" style="height: 35px;"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_dura">Duration of Abstinence</label> 
                            <input type="text" id="semen_dura" value="{{ $haema->semen_dura }}" name="semen_dura" maxlength="1" class="form-control"></div>
                    </div>
                  </div>
                  <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_diff">Difficulty in Producing Specimen</label> 
                            <select id="semen_diff" name="semen_diff" class="form-control" style="height: 35px;">
                                <option>{{ $haema->semen_diff }}</option>
                                <option>Yes</option>
                                <option>No</option>
                            </select> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_all">Was all the Sample Collected</label> 
                            <select id="semen_all" name="semen_all" class="form-control" style="height: 35px;">
                                <option>{{ $haema->semen_all }}</option>
                                <option>Yes</option>
                                <option>No</option>
                            </select></div>
                    </div>
                  </div>
                  <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_mode">Mode of Collection</label> 
                            <select id="semen_mode" name="semen_mode" class="form-control" style="height: 35px;">
                                <option>{{ $haema->semen_mode }}</option>
                                @foreach ($query['semen_mode'] as $semen_mode)
                                    <option>{{ $semen_mode['dropdown'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_inter">Interval Ejaculation-Analysis(Min)</label> 
                            <input type="text" id="semen_inter" value="{{ $haema->semen_inter }}" name="semen_inter" maxlength="3" class="form-control"></div>
                    </div>
                  </div>
                  <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_vol">Volume (mL)</label> 
                            <input type="text" id="semen_vol" value="{{ $haema->semen_vol }}" name="semen_vol" maxlength="3" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_appear">Appearance</label> 
                            <select id="semen_appear" name="semen_appear" class="form-control" style="height: 35px;">
                                <option>{{ $haema->semen_appear }}</option>
                                @foreach ($query['semen_appear'] as $semen_appear)
                                    <option>{{ $semen_appear['dropdown'] }}</option>
                                @endforeach
                            </select></div>
                    </div>
                  </div>
                  <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_liquefaction">Liquefaction</label> 
                            <input type="text" id="semen_liquefaction" value="{{ $haema->semen_liquefaction }}" name="semen_liquefaction" maxlength="3" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_viscosity">Viscosity</label> 
                            <select id="semen_viscosity" name="semen_viscosity" class="form-control" style="height: 35px;">
                                <option>{{ $haema->semen_viscosity }}</option>
                                @foreach ($query['semen_visco'] as $semen_visco)
                                    <option>{{ $semen_visco['dropdown'] }}</option>
                                @endforeach
                            </select></div>
                    </div>
                  </div>
                  <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_ph">pH</label> 
                            <input type="text" id="semen_ph" value="{{ $haema->semen_ph }}" name="semen_ph" maxlength="4" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">

                    </div>
                </div>

                <label>MOTILITY(%) - 50% or more (a + b) 25% or more(a)</label>
                <hr>

                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_rapid">Rapid Linear Progression</label> 
                            <input type="text" id="semen_rapid" value="{{ $haema->semen_rapid }}" name="semen_rapid" maxlength="4" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_none">None Progressive</label> 
                            <input type="text" id="semen_none" value="{{ $haema->semen_none }}" name="semen_none" maxlength="4" class="form-control"></div>
                    </div>
                </div>
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_imm">Immotile</label> 
                            <input type="text" id="semen_imm" value="{{ $haema->semen_imm }}" name="semen_imm" maxlength="4" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>

                <label>VITALITY (%)</label>
                <hr>
                
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_vital">Vitality (%)</label> 
                            <input type="text" id="semen_vital" value="{{ $haema->semen_vital }}" name="semen_vital"  maxlength="4" class="form-control"></div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>

                <label>OTHER CELLS (*10<sup>6</sup>/ml)</label>
                <hr>

                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_wbc">WBC</label> 
                            <input type="text" id="semen_wbc" value="{{ $haema->semen_wbc }}" name="semen_wbc" maxlength="4" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>

                <label>CONCENTRATION (10<sup>6</sup>/ml)</label>
                <hr>
                
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_count">Count/ml</label> 
                            <input type="text" id="semen_count" value="{{ $haema->semen_count }}" name="semen_count" maxlength="4" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_totalc">Total Count in Ejaculation</label> 
                            <input type="text" id="semen_totalc" value="{{ $haema->semen_totalc }}" name="semen_totalc" maxlength="4" class="form-control"> </div>
                    </div>
                </div>

                <label>MORPHOLOGY</label>
                <hr>
                
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_normal">Normal</label> 
                            <input type="text" id="semen_normal" value="{{ $haema->semen_normal }}" name="semen_normal" maxlength="4" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_abn">Abnormal</label> 
                            <input type="text" id="semen_abn" value="{{ $haema->semen_abn }}" name="semen_abn" maxlength="4" class="form-control"> </div>
                    </div>
                </div>
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_head">Head Defect</label> 
                            <input type="text" id="semen_head" value="{{ $haema->semen_head }}" name="semen_head" maxlength="4" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_mid">Mid - Piece Defect</label> 
                            <input type="text" id="semen_mid" value="{{ $haema->semen_mid }}" name="semen_mid" maxlength="4" class="form-control"> </div>
                    </div>
                </div>
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_tail">Tail</label> 
                            <input type="text" id="semen_tail" value="{{ $haema->semen_tail }}" name="semen_tail" maxlength="4" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>
                <div class="row justify-content-center" >
                    <div class="col-md-8">
                        <div class="form-group"> <label for="semen_comment">COMMENTS</label> 
                            <textarea class="form-control rounded-0" name="semen_comment" id="semen_comment" form="test_form" rows="3">{{ $haema->semen_comment }}</textarea></div>
                    </div>
                </div>
            </div>
            {{-- Semen --}}

            {{-- OGTT --}}
            <div class="tab-pane fade" id="ogtt" role="tabpanel" aria-labelledby="ogtt-tab">
                <h3>Oral Glucose Tolerance Test (OGTT)</h3>
                <hr>
                
                <label>BLOOD</label>
                <hr>
            
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="oral_glucose">Fasting Blood Glucose</label> 
                            <input type="text" id="oral_glucose" value="{{ $haema->oral_glucose }}" name="oral_glucose" maxlength="4" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="oral_1hpost">60mins Postprandial Glucose</label> 
                            <input type="text" id="oral_1hpost" value="{{ $haema->oral_1hpost }}" name="oral_1hpost" maxlength="4" class="form-control"> </div>
                    </div>
                </div>
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="oral_1_30post">90mins Postprandial Glucose</label> 
                            <input type="text" id="oral_1_30post" value="{{ $haema->oral_1_30post }}" name="oral_1_30post" maxlength="4" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="oral_post">120mins Postprandial Glucose</label> 
                            <input type="text" id="oral_post" value="{{ $haema->oral_post }}" name="oral_post" maxlength="4" class="form-control"> </div>
                    </div>
                </div>

                    <label>URINE</label>
                    <hr>
                    
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="oral_glu">Fasting Urine Glucose</label> 
                            <select name="oral_glu" id="oral_glu" class="form-control" style="height: 35px;">
                                <option>{{ $haema->oral_glu }}</option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                            </select>
                            @if ($haema->oglu_f == '')
                                <select name="oglu_f" id="oglu_f" class="form-control" style="display: none; height: 35px;">
                            @else
                                <select name="oglu_f" id="oglu_f" class="form-control" style="height: 35px;">
                            @endif
                                <option>{{ $haema->oglu_f }}</option>
                                @foreach ($query['factor'] as $factor)
                                    <option>{{ $factor['dropdown'] }}</option>
                                @endforeach
                            </select> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="oral_pro">60mins Postprandial Glucose</label> 
                            <select name="oral_pro" id="oral_pro" class="form-control" style="height: 35px;">
                                <option>{{ $haema->oral_pro }}</option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                            </select>
                            @if ($haema->opro_f == '')
                                <select name="opro_f" id="opro_f" class="form-control" style="display: none; height: 35px;">
                            @else
                                <select name="opro_f" id="opro_f" class="form-control" style="display: none; height: 35px;">
                            @endif
                                <option>{{ $haema->opro_f }}</option>
                                @foreach ($query['factor'] as $factor)
                                    <option>{{ $factor['dropdown'] }}</option>
                                @endforeach
                            </select></div>
                    </div>
                </div>
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="oral_ninpro">120mins Postprandial Glucose</label> 
                            <select name="oral_ninpro" id="oral_ninpro" class="form-control" style="height: 35px;">
                                <option>{{ $haema->oral_ninpro }}</option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                            </select>
                            @if ($haema->opro_ninf == '')
                                <select name="opro_ninf" id="opro_ninf" class="form-control" style="display: none; height: 35px;">
                            @else
                                <select name="opro_ninf" id="opro_ninf" class="form-control" style="height: 35px;">
                            @endif
                                <option>{{ $haema->opro_ninf }}</option>
                                @foreach ($query['factor'] as $factor)
                                    <option>{{ $factor['dropdown'] }}</option>
                                @endforeach
                            </select></div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"></div> 
                    </div>
                </div>
                
                <label>OGTT GRAPH</label>
                <hr>
                
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="fst_min">0 Minutes</label> 
                            <input type="number" name="fst_min" value="{{ $haema->fst_min }}" id="fst_min" min="0" max="40" step="00.01" class="form-control" style="height: 35px;"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="snd_min">60 Minutes</label> 
                            <input type="number" name="snd_min" value="{{ $haema->snd_min }}" id="snd_min" min="0" max="40" step="00.01" class="form-control" style="height: 35px;"></div>
                    </div>
                </div>
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="thd_min">90 Minutes</label> 
                            <input type="number" name="thd_min" value="{{ $haema->thd_min }}" id="thd_min" min="0" max="40" step="00.01" class="form-control" style="height: 35px;"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="for_min">120 Minutes</label> 
                            <input type="number" name="for_min" value="{{ $haema->for_min }}" id="for_min" min="0" max="40" step="00.01" class="form-control" style="height: 35px;"></div>
                    </div>
                </div>
                <div class="row justify-content-center" >
                    <div class="col-md-8">
                        <div class="form-group"> <label for="oral_comment">COMMENTS</label> 
                            <textarea class="form-control rounded-0" name="oral_comment" id="oral_comment" form="test_form" rows="3">{{ $haema->oral_comment }}</textarea></div>
                    </div>
                </div>
            </div>
            {{-- OGTT --}}

            {{-- PSA --}}
            <div class="tab-pane fade" id="psa" role="tabpanel" aria-labelledby="psa-tab">
                <h3>Prostate Specific Antigen (PSA) Semi-Quantitative Report</h3>
                <hr>

                <div class="row justify-content-center">
                    <div class="col-md-2">
                        <div class="btn-group" style="width: 100%">
                        <label class="btn btn-primary">
                        @if ($haema->psa_positive == '')
                            <input type="radio" name="psa" id="psa_pos" value="Positive" onclick="myFunPSApositive()">
                        @else
                            <input type="radio" name="psa" id="psa_pos" value="Positive" onclick="myFunPSApositive()" checked>  
                        @endif
                            Positive
                        </label>
                        </div>
                    </div>
                    <div class="col-md-6" style="padding-top: 7.5px">
                        @if ($haema->psa_positive == '')
                            <select name="psa_positive" id="psa_positive" class="form-control" style="height: 35px;" disabled>
                        @else
                            <select name="psa_positive" id="psa_positive" class="form-control" style="height: 35px;">
                        @endif
                        
                        <option>{{ $haema->psa_positive }}</option>
                        <option>PSA level between 3-10ng/mg</option>
                        <option>PSA level approximately 10ng/ml</option>
                        <option>PSA level greater than 10ng/ml</option>
                        </select>
                    </div> 
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-2">
                        <div class="btn-group" style="width: 100%">
                        <label class="btn btn-primary">
                        @if ($haema->psa_negative == '')
                            <input type="radio" name="psa" id="psa_neg" value="Negative" onclick="myFunPSAnegative()">
                        @else
                            <input type="radio" name="psa" id="psa_neg" value="Negative" onclick="myFunPSAnegative()" checked>
                        @endif
                            Negative
                        </label>
                        </div>
                    </div>
                    <div class="col-md-6" style="padding-top: 7.5px">
                        @if ($haema->psa_negative == '')
                            <select name="psa_negative" id="psa_negative" class="form-control" style="height: 35px;" disabled>
                        @else
                            <select name="psa_negative" id="psa_negative" class="form-control" style="height: 35px;">
                        @endif
                        
                        <option>{{ $haema->psa_negative }}</option>
                        <option>PSA level less than 3ng/ml</option>
                    </select>
                    </div> 
                </div>
            
                <div class="row justify-content-center" >
                    <div class="col-md-8">
                        <div class="form-group"> <label for="psa_comment">COMMENTS</label> 
                            <textarea class="form-control rounded-0" name="psa_comment" id="psa_comment" form="test_form" rows="3">{{ $haema->psa_comment }}</textarea></div>
                    </div>
                </div>
            </div>
            {{-- PSA --}}

            {{-- H_pylori --}}
            <div class="tab-pane fade" id="h_pylori" role="tabpanel" aria-labelledby="h_pylori-tab">
                <h3>H-Pylori Qualitative Test Report</h3>
                <hr>
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="pylori_qual">H-pylori Qualitative</label> 
                            <select name="pylori_qual" id="pylori_qual" class="form-control" style="height: 35px;">
                              <option>{{ $haema->pylori_qual }}</option>
                              @foreach ($query['response'] as $response)
                                <option>{{ $response['dropdown'] }}</option>
                              @endforeach
                            </select> 
                        </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                  </div>
                  <div class="row justify-content-center" >
                      <div class="col-md-8">
                          <div class="form-group"> <label for="pylori_comment">COMMENTS</label> 
                              <textarea class="form-control rounded-0" name="pylori_comment" id="pylori_comment" form="test_form" rows="3">{{ $haema->pylori_comment }}</textarea></div>
                      </div>
                </div>
            </div>
            {{-- H_pylori --}}

            {{-- DM Profile --}}
            <div class="tab-pane fade" id="dm_profile" role="tabpanel" aria-labelledby="dm_profile-tab">
                <h3>DM Profile</h3>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="dm_fbs_rbs_2">FBS/RBS</label> 
                            <select name="dm_fbs_rbs_2" id="dm_fbs_rbs_2" class="form-control" style="height: 35px;">
                                <option>{{ $chem->dm_fbs_rbs_2 }}</option>
                                <option>FBS:</option>
                                <option>RBS:</option>
                            </select></div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="fbs">FBS/RBS Value (mmol/L)</label> 
                            <input type="text" id="dm_fbs" name="dm_fbs_rbs" value="{{ $chem->dm_fbs_rbs }}" class="form-control" maxlength="4" readonly style="height: 35px;">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="dm_urine_glucose">Urine Glucose</label> 
                            <select name="dm_urine_glucose" id="dm_urine_glucose" class="form-control" style="height: 35px;">
                                <option>{{ $chem->dm_urine_glucose }}</option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                                <option>Trace</option>
                            </select>
                            <select name="dm_urine_factor" id="dm_urine_factor" class="form-control" style="display: none; height: 35px;">
                                <option>{{ $chem->dm_urine_factor }}</option>
                                @foreach ($query['factor'] as $factor)
                                    <option>{{ $factor['dropdown'] }}</option>
                                @endforeach
                            </select> 
                        </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>
            </div>
            {{-- DM Profile --}}            

            {{-- ANC Urine --}}
            <div class="tab-pane fade" id="anc_urine" role="tabpanel" aria-labelledby="anc_urine-tab">
                <h3>ANC Urine</h3>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="anc_uri_glucose">Glucose</label> 
                            <select name="anc_uri_glucose" id="anc_uri_glucose" class="form-control" style="height: 35px;">
                            <option>{{ $chem->anc_uri_glucose }}</option>
                            @foreach ($query['response'] as $response)
                                <option>{{ $response['dropdown'] }}</option>
                            @endforeach
                            <option>Trace</option>
                            </select>
                            <select name="anc_glo_factor" id="anc_glo_factor" class="form-control" style="display: none; height: 35px;">
                                <option>{{ $chem->anc_glo_factor }}</option>
                                @foreach ($query['factor'] as $factor)
                                <option>{{ $factor['dropdown'] }}</option>
                            @endforeach
                            </select> 
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="anc_uri_profile">Protein</label> 
                            <select name="anc_uri_profile" id="anc_uri_profile" class="form-control" style="height: 35px;">
                            <option>{{ $chem->anc_uri_profile }}</option>
                            @foreach ($query['response'] as $urobiln)
                                <option>{{ $urobiln['dropdown'] }}</option>
                            @endforeach
                            <option>Trace</option>
                            </select>
                            <select name="anc_pro_factor" id="anc_pro_factor" class="form-control" style="display: none; height: 35px;">
                            <option>{{ $chem->anc_pro_factor }}</option>
                            @foreach ($query['factor'] as $factor)
                                <option>{{ $factor['dropdown'] }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>        
            </div>
            {{-- ANC Urine --}}

            {{-- LFT --}}
            <div class="tab-pane fade" id="lft" role="tabpanel" aria-labelledby="lft-tab">
                <h3>Liver Function Test</h3>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="liver_protein">Total Protein (TP)(g/l)</label> 
                            <input type="text" id="liver_protein" value="{{ $chem->liver_protein }}" name="liver_protein" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="liver_albumin">Albumin (ALB)(g/l)</label> 
                            <input type="text" id="liver_albumin" value="{{ $chem->liver_albumin }}" name="liver_albumin" maxlength="6" class="form-control"> </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="liver_globulin">Globulin (GLOB)(g/l)</label> 
                            <input type="text" id="liver_globulin" value="{{ $chem->liver_globulin }}" name="liver_globulin" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="liver_alkaline">Alkaline Phospatase (ALP)(U/L)</label> 
                            <input type="text" id="liver_alkaline" value="{{ $chem->liver_alkaline }}" name="liver_alkaline" maxlength="6" class="form-control"> </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="liver_alanine">Alanine Aminotransferase (ALT)(U/L)</label> 
                            <input type="text" id="liver_alanine" value="{{ $chem->liver_alanine }}" name="liver_alanine" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="liver_aspartate">Aspartate Aminotransferase (AST)(U/L)</label> 
                            <input type="text" id="liver_aspartate" value="{{ $chem->liver_aspartate }}" name="liver_aspartate" maxlength="6" class="form-control"> </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="liver_gamma">Gamma GT (GGT)(U/L)</label> 
                            <input type="text" id="liver_gamma" value="{{ $chem->liver_gamma }}" name="liver_gamma" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="liver_total">Total Bilirubin (T BIL)(&mu;mol/l)</label> 
                            <input type="text" id="liver_total" value="{{ $chem->liver_total }}" name="liver_total" maxlength="6" class="form-control"> </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="liver_direct">Direct Bilirubin (D BIL)(&mu;mol/l)</label> 
                            <input type="text" id="liver_direct" value="{{ $chem->liver_direct }}" name="liver_direct" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="liver_indirect">Indirect Bilirubin (I BIL)(&mu;mol/l)</label> 
                            <input type="text" id="liver_indirect" value="{{ $chem->liver_indirect }}" name="liver_indirect" maxlength="6" class="form-control"> </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group"> <label for="liver_comment">COMMENTS</label> 
                            <textarea class="form-control rounded-0" name="liver_comment" id="liver_comment" form="test_form" rows="3">{{ $chem->liver_comment }}</textarea></div>
                    </div>
                </div>
            </div>
            {{-- LFT --}}

            {{-- RFT --}}
            <div class="tab-pane fade" id="rft" role="tabpanel" aria-labelledby="rft-tab">
                <h3>Renal Function Test</h3>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="renal_urea">Urea (BUN)(mmol/l)</label> 
                            <input type="text" id="renal_urea" value="{{ $chem->renal_urea }}" name="renal_urea" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="renal_creatinine">Creatinine (CRE)(mmol/l)</label> 
                            <input type="text" id="renal_creatinine" value="{{ $chem->renal_creatinine }}" name="renal_creatinine" maxlength="6" class="form-control"> </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-md-8">
                          <div class="form-group"> <label for="renal_comment">COMMENTS</label> 
                              <textarea class="form-control rounded-0" name="renal_comment" id="renal_comment" form="test_form" rows="3">{{ $chem->renal_comment }}</textarea></div>
                      </div>
                </div>
            </div>
            {{-- RFT --}}

            {{-- Lipid --}}
            <div class="tab-pane fade" id="lipid" role="tabpanel" aria-labelledby="lipid-tab">
                <h3>Lipid Profile</h3>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="lipid_total">Total Cholesterol (TC)(mmol/l)</label> 
                            <input type="text" id="lipid_total" value="{{ $chem->lipid_total }}" name="lipid_total" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="lipid_trigly">Triglyceride (TG)(mmol/l)</label> 
                            <input type="text" id="lipid_trigly" value="{{ $chem->lipid_trigly }}" name="lipid_trigly" maxlength="6" class="form-control"> </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="lipid_hdl">HDL-Cholesterol(HDL-C)(mmol/l)</label> 
                            <input type="text" id="lipid_hdl" value="{{ $chem->lipid_hdl }}" name="lipid_hdl" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="lipid_ldl">LDL-Cholesterol (LDL-C)(mmol/l)</label> 
                            <input type="text" id="lipid_ldl" value="{{ $chem->lipid_ldl }}" name="lipid_ldl" maxlength="6" class="form-control"> </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="lipid_hdl">VLDL-Cholesterol(VLDL-C)(mmol/l)</label> 
                            <input type="text" id="lipid_vldl" name="lipid_vldl" value="{{ $chem->lipid_vldl }}" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group"> <label for="lipid_comment">COMMENTS</label> 
                            <textarea class="form-control rounded-0" name="lipid_comment" id="lipid_comment" form="test_form" rows="3">{{ $chem->lipid_comment }}</textarea></div>
                    </div>
                </div>            
            </div>
            {{-- Lipid --}}

            {{-- Electrolytes --}}
            <div class="tab-pane fade" id="electrolytes" role="tabpanel" aria-labelledby="electrolytes-tab">
                <h3>Electrolytes</h3>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="electro_potas">Potassium (K<sup>+</sup>)(mmol/l)</label> 
                            <input type="text" id="electro_potas" value="{{ $chem->electro_potas }}" name="electro_potas" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="electro_sodium">Sodium (Na<sup>+</sup>)(mmol/l)</label> 
                            <input type="text" id="electro_sodium" value="{{ $chem->electro_sodium }}" name="electro_sodium" maxlength="6" class="form-control"> </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="electro_chloride">Chloride (Cl<sup>-</sup>)(mmol/l)</label> 
                            <input type="text" id="electro_chloride" value="{{ $chem->electro_chloride }}" name="electro_chloride" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="electro_cca">Complexed Calcium (iCa)(mmol/l)</label> 
                            <input type="text" id="electro_cca" value="{{ $chem->electro_cca }}" name="electro_cca" maxlength="6" class="form-control"> </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="electro_ica">Ionized Calcium (nCa)(mmol/l)</label> 
                            <input type="text" id="electro_ica" value="{{ $chem->electro_ica }}" name="electro_ica" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="electro_tca">Total Calcium (TCa)(mmol/l)</label> 
                            <input type="text" id="electro_tca" value="{{ $chem->electro_tca }}" name="electro_tca" maxlength="6" class="form-control"> </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="electro_ph">PH (pH)</label> 
                            <input type="text" id="electro_ph" value="{{ $chem->electro_ph }}" name="electro_ph" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-md-8">
                          <div class="form-group"> <label for="electro_comment">COMMENTS</label> 
                              <textarea class="form-control rounded-0" name="electro_comment" id="electro_comment" form="test_form" rows="3">{{ $chem->electro_comment }}</textarea></div>
                      </div>
                </div>
            </div>
            {{-- Electrolytes --}}

            {{-- Uric --}}
            <div class="tab-pane fade" id="uric" role="tabpanel" aria-labelledby="uric-tab">
                <h3>Uric Acid</h3>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="uric_acid">Uric Acid (UA)(mmol/l)</label> 
                            <input type="text" id="uric_acid" value="{{ $chem->uric_acid }}" name="uric_acid" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-md-8">
                          <div class="form-group"> <label for="uric_comment">COMMENTS</label> 
                              <textarea class="form-control rounded-0" name="uric_comment" id="uric_comment" form="test_form" rows="3">{{ $chem->uric_comment }}</textarea></div>
                      </div>
                </div>
            </div>
            {{-- Uric --}}

            {{-- Glycated H --}}
            <div class="tab-pane fade" id="glycated_h" role="tabpanel" aria-labelledby="glycated_h-tab">
                <h3>Glycated Hemoglobin Report</h3>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="glycated_hba1c">HbA1c (%)</label> 
                            <input type="text" id="glycated_hba1c" value="{{ $chem->glycated_hba1c }}" name="glycated_hba1c" maxlength="5" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-md-8">
                          <div class="form-group"> <label for="glycated_comment">COMMENTS</label> 
                              <textarea class="form-control rounded-0" name="glycated_comment" id="glycated_comment" form="test_form" rows="3">{{ $chem->glycated_comment }}</textarea></div>
                      </div>
                </div>
            </div>
            {{-- Glycated H --}}

            {{-- Serum --}}
            <div class="tab-pane fade" id="serum" role="tabpanel" aria-labelledby="serum-tab">
                <h3>Serum Bilirubin</h3>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="serum_total">Total Bilirubin (T BIL)</label> 
                            <input type="text" id="serum_total" value="{{ $chem->serum_total }}" name="serum_total" maxlength="5" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="serum_direct">Direct Bilirubin (D BIL)</label> 
                            <input type="text" id="serum_direct" value="{{ $chem->serum_direct }}" name="serum_direct" maxlength="5" class="form-control"> </div>                                             
                    </div>
                </div>
                <div class="row justify-content-center">
                      <div class="col-md-4">
                          <div class="form-group"> <label for="serum_indirect">Indirect Bilirubin (I BIL)</label> 
                              <input type="text" id="serum_indirect" value="{{ $chem->serum_indirect }}" name="serum_indirect" maxlength="5" class="form-control"> </div>
                      </div>
                      <div class="col-md-4">
                                                                          
                      </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group"> <label for="serum_comment">COMMENTS</label> 
                            <textarea class="form-control rounded-0" name="serum_comment" id="serum_comment" form="test_form" rows="3">{{ $chem->serum_comment }}</textarea></div>
                    </div>
                </div>
            </div>
            {{-- Serum --}}
            
            {{-- HVS --}}
            <div class="tab-pane fade" id="hvs" role="tabpanel" aria-labelledby="hvs-tab">
                <h3>High Vaginal Swab R/E Report</h3>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="vaginal_epith">Epithelial Cells (HPF)</label> 
                            <input type="text" id="vaginal_epith" value="{{ $micro->vaginal_epith }}" name="vaginal_epith" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="vaginal_pus">Pus Cells (HPF)</label> 
                            <input type="text" id="vaginal_pus" value="{{ $micro->vaginal_pus }}" name="vaginal_pus" maxlength="6" class="form-control"> </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="vaginal_red">Red Cells (HPF)</label> 
                            <input type="text" id="vaginal_red" value="{{ $micro->vaginal_red }}" name="vaginal_red" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="vaginal_clue">Clue Cells (HPF)</label> 
                            <input type="text" id="vaginal_clue" value="{{ $micro->vaginal_clue }}" name="vaginal_clue" maxlength="6" class="form-control"> </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="vaginal_whiff">Whiff Test</label>
                            <select id="vaginal_whiff" name="vaginal_whiff" class="form-control" style="height: 35px;">
                                <option>{{ $micro->vaginal_whiff }}</option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>                                        
                                @endforeach
                            </select></div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="vaginal_koh">KOH</label>  
                            <select id="vaginal_koh" name="vaginal_koh" class="form-control" style="height: 35px;">
                                <option>{{ $micro->vaginal_koh }}</option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>                                        
                                @endforeach
                            </select></div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="vaginal_tricho">Trichomonas Vaginalis (HPF)</label> 
                            <input type="text" id="vaginal_tricho" value="{{ $micro->vaginal_tricho }}" name="vaginal_tricho" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>
                <div class="row justify-content-center">
                      <div class="col-md-8">
                          <div class="form-group"> <label for="vaginal_gram">Gram</label> 
                              <textarea class="form-control rounded-0" name="vaginal_gram" id="vaginal_gram" form="test_form" rows="3">{{ $micro->vaginal_gram }}</textarea></div>
                      </div>
                      <div class="col-md-8">
                          <div class="form-group"> <label for="vaginal_others">Others</label> 
                              <textarea class="form-control rounded-0" name="vaginal_others" id="vaginal_others" form="test_form" rows="3">{{ $micro->vaginal_others }}</textarea></div>
                      </div>
                </div>            
            </div>
            {{-- HVS --}}

            {{-- Pleural --}}
            <div class="tab-pane fade" id="pleural" role="tabpanel" aria-labelledby="pleural-tab">
                <h3>Pleural Fluid Report</h3>
                <hr>

                <label>MACROSCOPY</label>
                  <hr>
                  
                  <div class="row justify-content-center">
                      <div class="col-md-4">
                          <div class="form-group"> <label for="pleural_appear">Appearance</label> 
                          <select id="pleural_appear" name="pleural_appear" class="form-control" style="height: 35px;">
                                <option>{{ $micro->pleural_appear }}</option>
                                @foreach ($query['appear'] as $appear)
                                    <option>{{ $appear['dropdown'] }}</option>
                                @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group"> <label for="pleural_color">Colour</label>  
                          <select id="pleural_color" name="pleural_color" class="form-control" style="height: 35px;">
                            <option>{{ $micro->pleural_color }}</option>
                                @foreach ($query['color'] as $color)
                                    <option>{{ $color['dropdown'] }}</option>
                                @endforeach
                              </select>
                            </div>
                      </div>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-md-4">
                          <div class="form-group"> <label for="pleural_ph">pH</label> 
                              <input type="text" id="pleural_ph" value="{{ $micro->pleural_ph }}" name="pleural_ph" maxlength="5" class="form-control"> </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group"> <label for="pleural_spec">Specific Gravity</label> 
                              <input type="text" id="pleural_spec" value="{{ $micro->pleural_spec }}" name="pleural_spec" maxlength="6" class="form-control"> </div>
                      </div>
                  </div>

                  <label>BIOCHEMISTRY</label>
                  <hr>

                  <div class="row justify-content-center">
                      <div class="col-md-4">
                          <div class="form-group"> <label for="pleural_protein">Protein (g/l)</label> 
                              <input type="text" id="pleural_protein" value="{{ $micro->pleural_protein }}" name="pleural_protein" maxlength="6" class="form-control"> </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group"> <label for="pleural_glucose">Glucose (mmol/l)</label> 
                              <input type="text" id="pleural_glucose" value="{{ $micro->pleural_glucose }}" name="pleural_glucose" maxlength="6" class="form-control"> </div>
                      </div>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-md-4">
                          <div class="form-group"> <label for="pleural_total">Total Cholesterol (mmol/l)</label> 
                              <input type="text" id="pleural_total" value="{{ $micro->pleural_total }}" name="pleural_total" maxlength="6" class="form-control"> </div>
                      </div>
                      <div class="col-md-4">
                          
                      </div>
                  </div>

                  <label>MICROSCOPY</label>
                  <hr>

                  <div class="row justify-content-center">
                      <div class="col-md-4">
                          <div class="form-group"> <label for="pleural_count">Cell Count (CELLS/L)</label> 
                              <input type="text" id="pleural_count" value="{{ $micro->pleural_count }}" name="pleural_count" maxlength="6" class="form-control"> </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group"> <label for="pleural_type">Cell Type</label> 
                              <input type="text" id="pleural_type" value="{{ $micro->pleural_type }}" name="pleural_type" class="form-control"> </div>
                      </div>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-md-4">
                          <div class="form-group"> <label for="pleural_gram">Gram Reaction</label> 
                              <input type="text" id="pleural_gram" value="{{ $micro->pleural_gram }}" name="pleural_gram" class="form-control"> </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group"> <label for="pleural_culture">Culture</label> 
                              <input type="text" id="pleural_culture" value="{{ $micro->pleural_culture }}" name="pleural_culture" class="form-control"> </div>
                      </div>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-md-8">
                          <div class="form-group"> <label for="pleural_comment">COMMENT</label> 
                              <textarea class="form-control rounded-0" name="pleural_comment" id="pleural_comment" form="test_form" rows="3">{{ $micro->pleural_comment }}</textarea></div>
                      </div>
                  </div>            
            </div>
            {{-- Pleural --}}

            {{-- Peritoneal --}}
            <div class="tab-pane fade" id="peritoneal" role="tabpanel" aria-labelledby="peritoneal-tab">
                <h3>Peritoneal Fluid Report</h3>
                <hr>
                <label>MACROSCOPY</label>
                <hr>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="peritoneal_appear">Appearance</label> 
                        <select id="peritoneal_appear" name="peritoneal_appear" class="form-control" style="height: 35px;" >
                            <option>{{ $micro->peritoneal_appear }}</option>
                                @foreach ($query['appear'] as $appear)
                                    <option>{{ $appear['dropdown'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="peritoneal_color">Colour</label>  
                        <select id="peritoneal_color" name="peritoneal_color" class="form-control" style="height: 35px;" >
                            <option>{{ $micro->peritoneal_color }}</option>
                            @foreach ($query['color'] as $color)
                                <option>{{ $color['dropdown'] }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="peritoneal_spec">Specific Gravity</label> 
                            <input type="text" id="peritoneal_spec" value="{{ $micro->peritoneal_spec }}" name="peritoneal_spec" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>
                
                <label>BIOCHEMISTRY</label>
                <hr>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="peritoneal_protein">Protein (g/dl)</label> 
                            <input type="text" id="peritoneal_protein" value="{{ $micro->peritoneal_protein }}" name="peritoneal_protein" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="peritoneal_albumin">Albumin (g/l)</label> 
                            <input type="text" id="peritoneal_albumin" value="{{ $micro->peritoneal_albumin }}" name="peritoneal_albumin" maxlength="6" class="form-control"> </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="peritoneal_glucose">Glucose (mmol/l)</label> 
                            <input type="text" id="peritoneal_glucose" value="{{ $micro->peritoneal_glucose }}" name="peritoneal_glucose" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="peritoneal_alkaline">Alkaline Phosphatase (U/L)</label> 
                            <input type="text" id="peritoneal_alkaline" value="{{ $micro->peritoneal_alkaline }}" name="peritoneal_alkaline" maxlength="6" class="form-control"> </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="peritoneal_amylase">Amylase (U/L)</label> 
                            <input type="text" id="peritoneal_amylase" value="{{ $micro->peritoneal_amylase }}" name="peritoneal_amylase" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>

                <label>MICROSCOPY</label>
                <hr>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="peritoneal_count">Cell Count (CELLS/L)</label> 
                            <input type="text" id="peritoneal_count" value="{{ $micro->peritoneal_count }}" name="peritoneal_count" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="peritoneal_type">Cell Type</label> 
                            <input type="text" id="peritoneal_type" value="{{ $micro->peritoneal_type }}" name="peritoneal_type" class="form-control"> </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="peritoneal_gram">Gram Reaction</label> 
                            <input type="text" id="peritoneal_gram" value="{{ $micro->peritoneal_gram }}" name="peritoneal_gram" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group"> <label for="peritoneal_comment">COMMENT</label> 
                            <textarea class="form-control rounded-0" name="peritoneal_comment" id="peritoneal_comment" form="test_form" rows="3">{{ $micro->peritoneal_comment }}</textarea></div>
                    </div>
                </div>
            </div>
            {{-- Peritoneal --}}

            {{-- CSF --}}
            <div class="tab-pane fade" id="csf" role="tabpanel" aria-labelledby="csf-tab">
                <h3>Cerebrospinal (CSF) Fluid Report</h3>
                <hr>
                <label>MACROSCOPY</label>
                <hr>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="csf_appear">Appearance</label> 
                        <select id="csf_appear" name="csf_appear" class="form-control" style="height: 35px;">
                                <option>{{ $micro->csf_appear }}</option>
                                @foreach ($query['appear'] as $appear)
                                    <option>{{ $appear['dropdown'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="csf_color">Colour</label> 
                            <select id="csf_color" name="csf_color" class="form-control" style="height: 35px;">
                                <option>{{ $micro->csf_color }}</option>
                                @foreach ($query['color'] as $color)
                                    <option>{{ $color['dropdown'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <label>BIOCHEMISTRY</label>
                <hr>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="csf_protein">Protein (g/l)</label> 
                            <input type="text" id="csf_protein" value="{{ $micro->csf_protein }}" name="csf_protein" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="csf_glucose">Glucose (mmol/l)</label> 
                            <input type="text" id="csf_glucose" value="{{ $micro->csf_glucose }}" name="csf_glucose" maxlength="6" class="form-control"> </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="csf_globulin">Globulin</label> 
                            <select id="csf_globulin" name="csf_globulin" class="form-control" style="height: 35px;">
                                <option>{{ $micro->csf_globulin }}</option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>                                        
                                @endforeach
                            </select></div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>

                <label>MICROSCOPY</label>
                <hr>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="csf_count">Cell Count (CELLS/L)</label> 
                            <input type="text" id="csf_count" value="{{ $micro->csf_count }}" name="csf_count" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="csf_type">Cell Type</label> 
                            <input type="text" id="csf_type" value="{{ $micro->csf_type }}" name="csf_type" class="form-control"> </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="csf_gram">Gram Reaction</label> 
                            <input type="text" id="csf_gram" value="{{ $micro->csf_gram }}" name="csf_gram" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group"> <label for="csf_comment">COMMENT</label> 
                            <textarea class="form-control rounded-0" name="csf_comment" id="csf_comment" form="test_form" rows="3">{{ $micro->csf_comment }}</textarea></div>
                    </div>
                </div>
            </div>
            {{-- CSF --}}

            {{-- Bacteriology --}}
            <div class="tab-pane fade" id="bacteriology" role="tabpanel" aria-labelledby="bacteriology-tab">
                <h3>Bacteriology Results</h3>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> 
                            <label for="bacter_specimen">Type of Specimen</label> 
                            <select id="bacter_specimen" name="bacter_specimen" class="form-control" style="height: 35px;">
                                <option>{{ $micro->bacter_specimen }}</option>
                                @foreach ($query['bacter_specimen'] as $bacter_specimen)
                                    <option>{{ $bacter_specimen['dropdown'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> 
                            <label for="bacter_growth">Kind of Growth</label> 
                            <select id="bacter_growth" name="bacter_growth" class="form-control" style="height: 35px;" onchange='BacterDisplay(this.value);'>
                                <option>{{ $micro->bacter_growth }}</option>
                                <option>Isolates</option>
                                <option>No Growth</option>
                                <option>No Pathogen Isolated</option>
                                <option>Heavily Mixed Growth</option>
                            </select> 
                        </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> 
                            <label for="bacter_type1">Bacterial Type 1</label> 
                            <select id="bacter_type1" name="bacter_type1" class="form-control" style="height: 35px;">
                                <option>{{ $micro->bacter_type1 }}</option>
                                {{-- <option value="bacterial Type 1">Add New Bacterial</option> --}}
                            </select> 
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" id="bacter_type2_dis"> 
                            <label for="bacter_type2">Bacterial Type 2</label> 
                            <select id="bacter_type2" name="bacter_type2" class="form-control" style="height: 35px;">
                                <option>{{ $micro->bacter_type2 }}</option>
                                @foreach ($query['bacter_type'] as $bacter_type)
                                    <option>{{ $bacter_type['dropdown'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                  </div>
                  <div id="becter_display">
                    <label>SENSITIVITY</label>
                    <hr>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <b>ANTIBIOTICS</b>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <b>REACTION</b>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <b>ZONE</b>
                            </div>
                        </div>
                    </div>

                    <datalist id="antibioticsList">
                        <select id = "antibioticsListSel">
                                           
                        </select>
                    </datalist>

                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <input type="text" id="bacter_anti1" value="{{ $micro->bacter_anti1 }}" name="bacter_anti1" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react1" id="bacter_react1" class="form-control" style="height: 35px;">
                                    <option>{{ $micro->bacter_react1 }}</option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone1" value="{{ $micro->bacter_zone1 }}" id="bacter_zone1" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <input type="text" id="bacter_anti2" value="{{ $micro->bacter_anti2 }}" name="bacter_anti2" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react2" id="bacter_react2" class="form-control" style="height: 35px;">
                                    <option>{{ $micro->bacter_react2 }}</option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone2" value="{{ $micro->bacter_zone2 }}" id="bacter_zone2" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <input type="text" id="bacter_anti3" value="{{ $micro->bacter_anti3 }}" name="bacter_anti3" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react3" id="bacter_react3" class="form-control" style="height: 35px;">
                                    <option>{{ $micro->bacter_react3 }}</option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone3" value="{{ $micro->bacter_zone3 }}" id="bacter_zone3" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <input type="text" id="bacter_anti4" value="{{ $micro->bacter_anti4 }}" name="bacter_anti4" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react4" id="bacter_react4" class="form-control" style="height: 35px;">
                                    <option>{{ $micro->bacter_react4 }}</option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone4" value="{{ $micro->bacter_zone4 }}" id="bacter_zone4" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <input type="text" id="bacter_anti5" value="{{ $micro->bacter_anti5 }}" name="bacter_anti5" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react5" id="bacter_react5" class="form-control" style="height: 35px;">
                                    <option>{{ $micro->bacter_react5 }}</option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone5" value="{{ $micro->bacter_zone5 }}" id="bacter_zone5" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <input type="text" id="bacter_anti6" value="{{ $micro->bacter_anti6 }}" name="bacter_anti6" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react6" id="bacter_react6" class="form-control" style="height: 35px;">
                                    <option>{{ $micro->bacter_react6 }}</option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone6" value="{{ $micro->bacter_zone6 }}" id="bacter_zone6" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <input type="text" id="bacter_anti7" value="{{ $micro->bacter_anti7 }}" name="bacter_anti7" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react7" id="bacter_react7" class="form-control" style="height: 35px;">
                                    <option>{{ $micro->bacter_react7 }}</option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone7" value="{{ $micro->bacter_zone7 }}" id="bacter_zone7" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <input type="text" id="bacter_anti8"  value="{{ $micro->bacter_anti8 }}" name="bacter_anti8" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react8" id="bacter_react8" class="form-control" style="height: 35px;">
                                    <option> {{ $micro->bacter_react8 }}</option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone8"  value="{{ $micro->bacter_zone8 }}" id="bacter_zone8" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <input type="text" id="bacter_anti9" value="{{ $micro->bacter_anti9 }}" name="bacter_anti9" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react9" id="bacter_react9" class="form-control" style="height: 35px;">
                                    <option>{{ $micro->bacter_react9 }}</option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone9" value="{{ $micro->bacter_zone9 }}" id="bacter_zone9" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <input type="text" id="bacter_anti10" value="{{ $micro->bacter_anti10 }}" name="bacter_anti10" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react10" id="bacter_react10" class="form-control" style="height: 35px;">
                                    <option>{{ $micro->bacter_react10 }}</option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone10" value="{{ $micro->bacter_zone10 }}" id="bacter_zone10" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <input type="text" id="bacter_anti11" value="{{ $micro->bacter_anti11 }}" name="bacter_anti11" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react11" id="bacter_react11" class="form-control" style="height: 35px;">
                                    <option>{{ $micro->bacter_react11 }}</option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone11" value="{{ $micro->bacter_zone11 }}" id="bacter_zone11" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <input type="text" id="bacter_anti12" value="{{ $micro->bacter_anti12 }}" name="bacter_anti12" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react12" id="bacter_react12" class="form-control" style="height: 35px;">
                                    <option>{{ $micro->bacter_react12 }}</option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone12" value="{{ $micro->bacter_zone12 }}" id="bacter_zone12" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                 </div>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="form-group"> <label for="becter_comment">COMMENT</label> 
                                <textarea class="form-control rounded-0" name="becter_comment" id="becter_comment" form="test_form" rows="3">{{ $micro->becter_comment}}</textarea></div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Bacteriology --}}

            {{-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div> --}}
          </div>

          <div class="col-lg-2 float-right" style="margin-bottom: 2%"><button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Save</button> </div>
              </div>
              
            </form>
        </div>
    </div>

    
<script src="{{ asset('public/js/javascript.entertest.js') }}"></script>
@endsection