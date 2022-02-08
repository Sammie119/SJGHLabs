<?php 
    use App\Http\Controllers\GetdataController;

    $query = GetdataController::selectOptions();
?>

@extends('layouts.app')

@section('title', 'SJGH-LRMS | Enter Test')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

<style>
    body {font-family: Arial;}
    
    /* Style the tab */
    .tab {
      overflow: show;
      border-bottom: 1xp solid #fff;
      border-top: 1px solid #ccc;
      border-left: 1px solid #ccc;
      border-right: 1px solid #ccc;
      background-color: #f1f1f1;
    }
    
    /* Style the buttons inside the tab */
    .tab button {
      background-color: inherit;
      float: left;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 10px 10px;
      transition: 0.3s;
      font-size: 15px;
    }

    .tab a {
      background-color: #f1f1f1;
      border: 1px solid #ddd;
      cursor: pointer;
      font-size: 17px;
    }

    .tab a:hover, .tab .tablinks:hover{
      background-color: #ddd;
    }
    
    /* Change background color of buttons on hover */
    .tab button:hover {
      background-color: #ddd;
    }
    
    /* Create an active/current tablink class */
    .tab button.active {
      background-color: #fff;
      border: 1px solid #06c; 
      border-bottom: none;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      margin-bottom: -1px;
      color: #06c;
    }
    
    /* Style the tab content */
    .tabcontent {
      display: none;
      padding: 6px 12px;
      border-top: 1xp solid #fff;
      border-bottom: 1px solid #ccc;
      border-left: 1px solid #ccc;
      border-right: 1px solid #ccc;
      border-top: none;
    }

    .tabcontent {
      animation: fadeEffect 1s; /* Fading effect takes 1 second */
    }

    /* Go from zero to full opacity */
    @keyframes fadeEffect {
      from {opacity: 0;}
      to {opacity: 1;}
    }

    </style>

@section('content')
    <div class="container-fluid" style="margin-top: 6%;">
        <div class="card">
            <div class="card-header">
                <h2><b style="color: #191970;">Enter Test</b>
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
            <form action="{{ route('store-labs') }}" method="POST" id="test_form" name="myform" onsubmit = "return validateForm()">
                @csrf
              <div class="card-body">
                  <div class="tab">
                      <button class="tablinks" onclick="openCity(event, 'Info')" id="defaultOpen">Info</button>
                      <button class="tablinks" onclick="openCity(event, 'General')">General</button>
                      <button class="tablinks" onclick="openCity(event, 'FBC')">FBC</button>
                      <button class="tablinks" onclick="openCity(event, 'Urinalysis')">Urinalysis</button>
                      <button class="tablinks" onclick="openCity(event, 'Stool')">Stool</button>
                      <button class="tablinks" onclick="openCity(event, 'ART')">ART</button>
                      <button class="tablinks" onclick="openCity(event, 'COOMS')">COOMS</button>
                      <button class="tablinks" onclick="openCity(event, 'HB_Profile')">HB Profile</button>
                      <button class="tablinks" onclick="openCity(event, 'PFC')">PFC</button>
                      <button class="tablinks" onclick="openCity(event, 'Semen')">Semen</button>
                      <button class="tablinks" onclick="openCity(event, 'OGTT')">OGTT</button>
                      <button class="tablinks" onclick="openCity(event, 'PSA')">PSA</button>
                      <button class="tablinks" onclick="openCity(event, 'H_pylori')">H-Pylori</button>
                      
                      <div class="btn-group">
                        <button type="button" class="tablinks" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="chemss" onmouseover="m_over(this)" onmouseout="m_out(this)">Chemistries <i class="fa fa-caret-down"></i></button>
                          <ul class="dropdown-menu" role="tablist">
                            <li role="presentation"><a class="btn chesmis" onclick="openCity(event, 'LFT')">LFT</a></li>
                            <li role="presentation"><a class="btn chesmis" onclick="openCity(event, 'RFT')">RFT</a></li>
                            <li role="presentation"><a class="btn chesmis" onclick="openCity(event, 'Lipid')">Lipid</a></li>
                            <li role="presentation"><a class="btn chesmis" onclick="openCity(event, 'Electrolytes')">Electrolytes</a></li>
                            <li role="presentation"><a class="btn chesmis" onclick="openCity(event, 'Uric')">Uric</a></li>
                            <li role="presentation"><a class="btn chesmis" onclick="openCity(event, 'Glycated_H')">Glycated Hemo</a></li>
                            <li role="presentation"><a class="btn chesmis" onclick="openCity(event, 'Serum')">Serum</a></li>
                          </ul>
                      </div>
                      <div class="btn-group">
                        <button type="button" class="tablinks" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="microb" onmouseover="m_over(this)" onmouseout="m_out(this)">Micro B <i class="fa fa-caret-down"></i></button>
                          <ul class="dropdown-menu" role="tablist">
                            <li role="presentation"><a class="btn microb" onclick="openCity(event, 'HVS')">HVS</a></li>
                            <li role="presentation"><a class="btn microb" onclick="openCity(event, 'Pleural')">Pleural</a></li>
                            <li role="presentation"><a class="btn microb" onclick="openCity(event, 'Peritoneal')">Peritoneal</a></li>
                            <li role="presentation"><a class="btn microb" onclick="openCity(event, 'CSF')">CSF</a></li>
                            <li role="presentation"><a class="btn microb" onclick="openCity(event, 'Bacteriology')">Bacteriology</a></li>
                          
                          </ul>
                      </div>
                      {{-- <button class="tablinks" onclick="openCity(event, 'Micro_B')">Micro B</button> --}}
                  </div>

          {{-- General Information --}}
                  <div id="Info" class="tabcontent">
                    <h3>General Information</h3>
                    <hr>
                      <div class="row justify-content-center">
                          <div class="col-md-6">
                              <div class="form-group"> 
                                <label for="lab_no">Lab Number</label> 
                                <input type="text" name="lab_no" id="lab_no" class = "form-control" maxlength="10" required>
                              </div>
                          </div>
                      </div>
                      <div class="row justify-content-center">
                          <div class="col-md-6">
                              <div class="form-group"> 
                                <label for="depart">Department</label> 
                                <select name="department" id="depart" class="form-control" required >
                                  <option value=""></option>
                                  @foreach ($query['department'] as $depart)
                                    <option value="{{ $depart['dropdown_id'] }}">{{ $depart['dropdown'] }}</option>
                                  @endforeach
                                </select>
                              </div>
                          </div>
                      </div>
                      <div class="row justify-content-center">
                          <div class="col-md-6">
                              <div class="form-group"> <label for="opd_no">OPD Number</label> <input type="text" name="opd_no" id="opd_no" class = "form-control" maxlength="10" required ></div>
                          </div>
                      </div>
                      <div class="row justify-content-center">
                          <div class="col-md-5">
                              <div><label for="name">Patient's Name</label><input type="text" class="form-control" id="name" name="name" readonly> </div>
                          </div>
                          <div class="col-md-1">
                            <div> <label for="age">Age</label> <input type="text" class="form-control" id="age" name="age" readonly > </div>
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
            {{-- End General Information --}}

            {{-- General Labs --}}
                  <div id="General" class="tabcontent">
                    <h3>General Labs</h3>
                    <hr>
                      <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> <label for="anti">ANTI TPHA/VDRL</label> <select name="anti_tpha" class="form-control" id="anti" style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['response'] as $response)
                                        <option>{{ $response['dropdown'] }}</option>
                                    @endforeach
                                    <option>No Test Kits</option>
                                </select> </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> <label for="hbs_ag">HBsAg</label> 
                                <select name="hbs_ag" class="form-control" id="hbs_ag" style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['response'] as $response)
                                        <option>{{ $response['dropdown'] }}</option>
                                    @endforeach
                                    <option>No Test Kits</option>
                                </select></div>
                        </div>
                      </div>
                      <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> <label for="hcv">HCV</label> 
                                <select name="hcv" class="form-control" id="hcv" style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['response'] as $response)
                                        <option>{{ $response['dropdown'] }}</option>
                                    @endforeach
                                    <option>No Test Kits</option>
                                </select> </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> <label for="g6pd">G6PD (Methemoglobin Reduction Test)</label> 
                                <select name="g6pd" id="g6pd" class="form-control" style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['g6pd'] as $g6pd)
                                        <option>{{ $g6pd['dropdown'] }}</option>
                                    @endforeach
                                    <option>Pending</option>
                                </select> </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> <label for="fbs_rbs_2">FBS/RBS</label> 
                                <select name="fbs_rbs_2" id="fbs_rbs_2" class="form-control" style="height: 35px;">
                                    <option>FBS/RBS</option>
                                    <option>FBS:</option>
                                    <option>RBS:</option>
                                </select></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> <label for="fbs">FBS/RBS Value (mmol/L)</label> 
                                <input type="text" id="fbs" name="fbs_rbs" class="form-control" maxlength="4" readonly style="height: 35px;">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> <label for="blood">BLOOD GROUP</label> 
                                <select name="blood" id="blood" class="form-control" style="height: 35px;">
                                    <option></option>
                                    <option>A</option>
                                    <option>AB</option>
                                    <option>B</option>
                                    <option>O</option>
                                </select> </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> <label for="blood_rh">Rh(D)</label> 
                                <select name="blood_rh" id="blood_rh" class="form-control" disabled style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['response'] as $response)
                                        <option>{{ $response['dropdown'] }}</option>
                                    @endforeach
                                </select></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> <label for="urine_hcg">URINE hCG</label> 
                                <select name="urine_hcg" class="form-control" id="urine_hcg" style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['response'] as $response)
                                        <option>{{ $response['dropdown'] }}</option>
                                    @endforeach
                                </select> </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> <label for="esr">ESR (mmfall/hr)</label> 
                                <input type="text" id="esr" name="esr" class="form-control" maxlength="3" style="height: 35px;"></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> <label for="bf">BF</label> 
                                <select name="bf" id="bf" class="form-control" onchange='CheckColors(this.value);' style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['bf'] as $bf)
                                        <option>{{ $bf['dropdown'] }}</option>                                        
                                    @endforeach
                                </select> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> <label for="para">PARASITE DENSITY (mps/ul)</label> 
                                <input type="text" id="para" name="bf_parasite" maxlength="7" class="form-control" readonly style="height: 35px;"></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> <label for="sickling">SICKLING TEST</label> 
                                <select name="sickling" id="sickling" class="form-control" style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['response'] as $response)
                                        <option>{{ $response['dropdown'] }}</option>
                                    @endforeach
                                </select> </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> <label for="sickling_hgb">Hgb ELECTROPHORESIS</label>
                                <select name="sickling_hgb" id="sickling_hgb" class="form-control"  style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['Hgb_Elec'] as $Hgb_Elec)
                                        <option>{{ $Hgb_Elec['dropdown'] }}</option>
                                    @endforeach
                                </select></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> <label for="widal_o">WIDAL S. Typhi O</label> 
                                <select name="widal_o" class="form-control" id="widal_o" style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['widal'] as $widal)
                                        <option>{{ $widal['dropdown'] }}</option>                                        
                                    @endforeach
                                </select> </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> <label for="widal_h">WIDAL S. Typhi H</label> 
                                <select name="widal_h" id="widal_h" class="form-control" style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['widal'] as $widal)
                                        <option>{{ $widal['dropdown'] }}</option>                                        
                                    @endforeach
                                </select> </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> <label for="rdt_pf">Malaria RDT (Pf)</label> 
                                <select name="rdt_pf" id="rdt_pf" class="form-control" style="height: 35px;">
                                    <option></option>
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
                            <div class="form-group"> <label for="comment">General Comment</label> 
                                <textarea class="form-control rounded-0" id="comment" name="comment" form="test_form" rows="3"></textarea></div>
                        </div>
                    </div> 
                  </div>
            {{-- End General Labs --}}
          
            {{-- FBC --}}
                  <div id="FBC" class="tabcontent">
                      <h3>FBC</h3>
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
                              <input type="text" class="form-control" id="wbc" name="wbc" maxlength="5">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> 
                              <label for="lym">LYM# (x10<sup>9</sup>/L)</label> 
                              <input type="text" class="form-control" id="lym" name="lym" maxlength="5"> 
                            </div>
                        </div>
                      </div>
                      {{-- FBC 5 Parts --}}
                      <div class="row justify-content-center">
                        <div class="col-md-4" style="display: none;" id="fbc_hid1">
                          <div class="form-group"> 
                            <label for="mid">MONO# (x10<sup>3</sup>/uL)</label>
                            <input type="text" class="form-control" id="mono" name="mono" maxlength="5">
                          </div>
                        </div>
                        <div class="col-md-4" style="display: none;" id="fbc_hid4">
                          <div class="form-group"> 
                            <label for="eo">EO# (x10<sup>3</sup>/uL)</label> 
                            <input type="text" class="form-control" id="eo" name="eo" maxlength="5">
                          </div>
                        </div>
                      </div>
                      {{-- End --}}
                      <div class="row justify-content-center">
                        <div class="col-md-4">
                          <div class="form-group" id="fbc_hid2" style="display: none;"> 
                            <label for="baso">BASO# (x10<sup>3</sup>/uL)</label>
                            <input type="text" class="form-control" id="baso" name="baso" maxlength="5">
                          </div>
                          <div class="form-group" id="fbc_hid3"> 
                            <label for="mid">MID# (x10<sup>9</sup>/L)</label>
                            <input type="text" class="form-control" id="mid" name="mid" maxlength="5">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group"> 
                            <label for="neut">NEUT# (x10<sup>9</sup>/L)</label> 
                            <input type="text" class="form-control" id="neut" name="neut" maxlength="5">
                          </div>
                        </div>
                      </div>
                      <div class="row justify-content-center">
                        <div class="col-md-4">
                          <div class="form-group"> 
                            <label for="rbc">RBC (x10<sup>12</sup>/L)</label>
                            <input type="text" class="form-control" id="rbc" name="rbc" maxlength="5">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group"> 
                            <label for="fbc_hgb">HGB (g/dL)</label> 
                            <input type="text" class="form-control" id="fbc_hgb" name="fbc_hgb" maxlength="5">
                          </div>
                        </div>
                      </div>
                      <div class="row justify-content-center">
                        <div class="col-md-4">
                          <div class="form-group"> 
                            <label for="hct">HCT (%)</label>
                            <input type="text" class="form-control" id="hct" name="hct" maxlength="5">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group"> 
                            <label for="mcv">MCV (fL)</label> 
                            <input type="text" class="form-control" id="mcv" name="mcv" maxlength="5">
                          </div>
                        </div>
                      </div>
                      <div class="row justify-content-center">
                        <div class="col-md-4">
                          <div class="form-group"> 
                            <label for="mch">MCH (pg)</label>
                            <input type="text" class="form-control" id="mch" name="mch" maxlength="5">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group"> 
                            <label for="rdw_cv">RDW-CV (%)</label>
                            <input type="text" class="form-control" id="rdw_cv" name="rdw_cv" maxlength="5">
                          </div>
                        </div>
                      </div>
                      <div class="row justify-content-center">
                        <div class="col-md-4">
                          <div class="form-group"> 
                            <label for="mpv">MPV (fL)</label>
                            <input type="text" class="form-control" id="mpv" name="mpv" maxlength="5">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group"> 
                            <label for="plt">PLT (x10<sup>9</sup>/L)</label> 
                            <input type="text" class="form-control" id="plt" name="plt" maxlength="5">
                          </div>
                        </div>
                      </div>
                      <div class="row justify-content-center">
                        <div class="col-md-8">
                          <div class="form-group"> 
                            <label for="mpv">Comment</label>
                            <textarea class="form-control rounded-0" name="fbc_comment" id="fbc_comment" form="test_form" rows="3"></textarea>
                          </div>
                        </div>
                      </div>
                  </div>
            {{-- FBC --}}
                
            {{-- Urinalysis --}}
                <div id="Urinalysis" class="tabcontent">
                    <h3>Urinalysis</h3>
                    <hr>
                    <div class="row justify-content-center">
                      <div class="col-md-4">
                          <div class="form-group"> <label for="appear">Appearance</label> 
                              <select name="appear" id="appear" class="form-control" style="height: 35px;">
                                  <option></option>
                                  @foreach ($query['appear'] as $appear)
                                      <option>{{ $appear['dropdown'] }}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group"> <label for="color">Colour</label> 
                              <select name="color" id="color" class="form-control" style="height: 35px;">
                                <option></option>
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
                                <option></option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                                  <option>Trace</option>
                              </select>
                              <select name="blood_factor" id="blood_factor" class="form-control" style="display: none; height: 35px;">
                                  <option></option>
                                  @foreach ($query['factor'] as $factor)
                                    <option>{{ $factor['dropdown'] }}</option>
                                @endforeach
                              </select> 
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group"> <label for="urobiln">Urobilnogen</label> 
                              <select name="urobiln" id="urobiln" class="form-control" style="height: 35px;">
                                <option></option>
                                @foreach ($query['urobiln'] as $urobiln)
                                    <option>{{ $urobiln['dropdown'] }}</option>
                                @endforeach
                              </select>
                              <select name="urobiln_factor" id="urobiln_factor" class="form-control" style="display: none; height: 35px;">
                                <option></option>
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
                                <option></option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                                  <option>Trace</option>
                              </select>
                              <select name="glucose_factor" id="glucose_factor" class="form-control" style="display: none; height: 35px;">
                                <option></option>
                                @foreach ($query['factor'] as $factor)
                                    <option>{{ $factor['dropdown'] }}</option>
                                @endforeach
                              </select> </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group"> <label for="inputEmail4">Nitrite</label> 
                              <select name="nitrite" id="nitrite" class="form-control" style="height: 35px;">
                                <option></option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                              </select></div>
                      </div>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-md-4">
                          <div class="form-group"> <label for="ph">pH</label> 
                              <input type="text" name="ph" id="ph" class="form-control" maxLength="3"></div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group"> <label for="bilirubin">Bilirubin</label> 
                              <select name="bilirubin" id="bilirubin" class="form-control" style="height: 35px;">
                                <option></option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                                  <option>Trace</option>
                              </select>
                              <select name="bilirubin_factor" id="bilirubin_factor" class="form-control" style="display: none; height: 35px;">
                                <option></option>
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
                                <option></option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                                  <option>Trace</option>
                              </select>
                              <select name="ketone_factor" id="ketone_factor" class="form-control" style="display: none; height: 35px;">
                                <option></option>
                                @foreach ($query['factor'] as $factor)
                                    <option>{{ $factor['dropdown'] }}</option>
                                @endforeach
                              </select> </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group"> <label for="protein">Protein</label> 
                              <select name="protein" id="protein" class="form-control" style="height: 35px;">
                                <option></option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                                  <option>Trace</option>
                              </select>
                              <select name="protein_factor" id="protein_factor" class="form-control" style="display: none; height: 35px;">
                                <option></option>
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
                                <option></option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                                  <option>Trace</option>
                              </select>
                              <select name="leuco_factor" id="leuco_factor" class="form-control" style="display: none; height: 35px;">
                                <option></option>
                                @foreach ($query['factor'] as $factor)
                                    <option>{{ $factor['dropdown'] }}</option>
                                @endforeach
                              </select> </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group"> <label for="spec_gra">Specific Gravity</label> 
                              <input type="text" name="spec_gra" id="spec_gra" class="form-control"></div>
                      </div>
                  </div>

                  <label>MICROSCOPY</label>
                  <hr>
                  
                  <div class="row justify-content-center">
                      <div class="col-md-4">
                          <div class="form-group"> <label for="pus_cell">Pus cell (/HPF)</label> 
                              <input type="text" id="pus_cell" name="pus_cell" maxlength="4" class="form-control">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group"> <label for="red_cell">Red cells (/HPF)</label> 
                              <input type="text" id="red_cell" name="red_cell" maxlength="4" class="form-control">
                          </div>
                      </div>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-md-4">
                          <div class="form-group"> <label for="epi_cell">Epithelial cell (/HPF)</label> 
                              <input type="text" id="epi_cell" name="epi_cell" maxlength="4" class="form-control">
                          </div>
                      </div>
                      <div class="col-md-4">
                          
                      </div>
                  </div>

                  <div class="row justify-content-center">
                      <div class="col-md-8">
                          <div class="form-group"> <label for="other">Other</label> 
                              <textarea class="form-control rounded-0" name="other" id="other" form="test_form" rows="3"></textarea></div>
                      </div>
                  </div>
                </div>
            {{-- Urinalysis --}}

            {{-- Stool --}}
                <div id="Stool" class="tabcontent">
                    <h3>Stool R/E</h3>
                    <hr>
                    <div class="row justify-content-center">
                      <div class="col-md-8">
                          <div class="form-group"> <label for="macro">MACROSCOPY</label> 
                              <textarea class="form-control rounded-0" name="macro" id="macro" form="test_form" rows="3"></textarea></div>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-md-8">
                          <div class="form-group"> <label for="micro">MICROSCOPY</label> 
                              <textarea class="form-control rounded-0" name="micro" id="micro" form="test_form" rows="3"></textarea></div>
                      </div>
                  </div>
                </div>
            {{-- Stool --}}

            {{-- ART --}}
                <div id="ART" class="tabcontent">
                    <h3>Antigen Rapid Test</h3>
                    <hr>
                    <div class="row justify-content-center">
                      <div class="col-md-4">
                          <div class="form-group"> <label for="type_one">First Response</label> 
                              <select name="first_resp" id="type_one" class="form-control" >
                                  <option></option>
                                  @foreach ($query['art_screen'] as $art_screen)
                                    <option>{{ $art_screen['dropdown'] }}</option>
                                  @endforeach
                              </select> </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group"> <label for="type_two">Ora Quick</label> 
                              <select name="ora_quick" id="type_two" class="form-control" >
                                <option></option>
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
                                  <option></option>
                                  @foreach ($query['art_screen'] as $art_screen)
                                    <option>{{ $art_screen['dropdown'] }}</option>
                                  @endforeach
                              </select> </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group"> <label for="ora">HIV Final Result</label> 
                            <select name="hiv_final" id="hiv_final" class="form-control" >
                                <option></option>
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
                  <div id="COOMS" class="tabcontent">
                    <h3>COOM'S Test</h3>
                    <hr>
                    <div class="row justify-content-center">
                      <div class="col-md-4">
                          <div class="form-group"> <label for="indirect">Indirect Agglutination Test (IAT)</label> 
                              <select name="indirect" id="indirect" class="form-control" style="height: 35px;">
                                <option></option>
                                @foreach ($query['response'] as $response)
                                  <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                              </select> </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group"> <label for="direct">Direct Agglutination Test (DAT)</label> 
                              <select name="direct" id="direct" class="form-control" style="height: 35px;">
                                <option></option>
                                @foreach ($query['response'] as $response)
                                  <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                              </select></div>
                      </div>
                  </div>
                </div>
            {{-- COOMS --}}

            {{-- HB_Profile --}}
                  <div id="HB_Profile" class="tabcontent">
                    <h3>HEPATITIS B PROFILE REPORT</h3>
                    <hr>
          
                    <label>Hepatitis B Marker/Results</label>
                    <hr>  

                      <div class="row justify-content-center">
                          <div class="col-md-4">
                              <div class="form-group"> <label for="hb_sag">HBsAg</label> 
                                  <select name="hb_sag" id="hb_sag" class="form-control" style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['response'] as $response)
                                        <option>{{ $response['dropdown'] }}</option>
                                    @endforeach
                                  </select> </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group"> <label for="hb_sab">HBsAb</label> 
                                  <select name="hb_sab" id="hb_sab" class="form-control" style="height: 35px;">
                                    <option></option>
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
                                    <option></option>
                                    @foreach ($query['response'] as $response)
                                        <option>{{ $response['dropdown'] }}</option>
                                    @endforeach
                                  </select> </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group"> <label for="hb_eab">HBeAb</label> 
                                  <select name="hb_eab" id="hb_eab" class="form-control" style="height: 35px;">
                                    <option></option>
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
                                    <option></option>
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
                                  <textarea class="form-control rounded-0" name="hb_comment" id="hb_comment" form="test_form" rows="3"></textarea></div>
                          </div>
                      </div>
                    </div>
            {{-- HB_Profile --}}

            {{-- PFC --}}
                <div id="PFC" class="tabcontent">
                  <h3>Peripheral Film Comment Report</h3>
                  <hr>
                  <div class="row justify-content-center">
                      <div class="col-md-8">
                          <div class="form-group"> <label for="per_rbc">RBC</label> 
                              <textarea class="form-control rounded-0" id="per_rbc" name="per_rbc" form="test_form" rows="3"></textarea></div>
                      </div>
                      <div class="col-md-8">
                          <div class="form-group"> <label for="per_wbc">WBC</label> 
                              <textarea class="form-control rounded-0" id="per_wbc" name="per_wbc" form="test_form" rows="3"></textarea></div>
                      </div>
                      <div class="col-md-8">
                          <div class="form-group"> <label for="per_plt">Platelet</label> 
                              <textarea class="form-control rounded-0" id="per_plt" name="per_plt" form="test_form" rows="3"></textarea></div>
                      </div>
                      <div class="col-md-8">
                          <div class="form-group"> <label for="per_imp">Impression</label> 
                              <textarea class="form-control rounded-0" id="per_imp" name="per_imp" form="test_form" rows="3"></textarea></div>
                      </div>
                  </div>
              </div>
          {{-- PFC --}}

          {{-- Semen --}}
                <div id="Semen" class="tabcontent">
                  <h3>Semen Analysis Report</h3>
                  <hr>
                  <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_date">Date of Sample</label> 
                            <input type="date" id="semen_date" max="<?php echo date('Y-m-d');?>" name="semen_date" class="form-control" style="height: 35px;"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_dura">Duration of Abstinence</label> 
                            <input type="text" id="semen_dura" name="semen_dura" maxlength="1" class="form-control"></div>
                    </div>
                  </div>
                  <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_diff">Difficulty in Producing Specimen</label> 
                            <select id="semen_diff" name="semen_diff" class="form-control" style="height: 35px;">
                                <option></option>
                                <option>Yes</option>
                                <option>No</option>
                            </select> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_all">Was all the Sample Collected</label> 
                            <select id="semen_all" name="semen_all" class="form-control" style="height: 35px;">
                                <option></option>
                                <option>Yes</option>
                                <option>No</option>
                            </select></div>
                    </div>
                  </div>
                  <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_mode">Mode of Collection</label> 
                            <select id="semen_mode" name="semen_mode" class="form-control" style="height: 35px;">
                                <option></option>
                                @foreach ($query['semen_mode'] as $semen_mode)
                                    <option>{{ $semen_mode['dropdown'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_inter">Interval Ejaculation-Analysis(Min)</label> 
                            <input type="text" id="semen_inter" name="semen_inter" maxlength="3" class="form-control"></div>
                    </div>
                  </div>
                  <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_vol">Volume (mL)</label> 
                            <input type="text" id="semen_vol" name="semen_vol" maxlength="3" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_appear">Appearance</label> 
                            <select id="semen_appear" name="semen_appear" class="form-control" style="height: 35px;">
                                <option></option>
                                @foreach ($query['semen_appear'] as $semen_appear)
                                    <option>{{ $semen_appear['dropdown'] }}</option>
                                @endforeach
                            </select></div>
                    </div>
                  </div>
                  <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_liquefaction">Liquefaction</label> 
                            <input type="text" id="semen_liquefaction" name="semen_liquefaction" maxlength="3" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_viscosity">Viscosity</label> 
                            <select id="semen_viscosity" name="semen_viscosity" class="form-control" style="height: 35px;">
                                <option></option>
                                @foreach ($query['semen_visco'] as $semen_visco)
                                    <option>{{ $semen_visco['dropdown'] }}</option>
                                @endforeach
                            </select></div>
                    </div>
                  </div>
                  <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_ph">pH</label> 
                            <input type="text" id="semen_ph" name="semen_ph" maxlength="4" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">

                    </div>
                </div>

                <label>MOTILITY(%) - 50% or more (a + b) 25% or more(a)</label>
                <hr>

                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_rapid">Rapid Linear Progression</label> 
                            <input type="text" id="semen_rapid" name="semen_rapid" maxlength="4" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_none">None Progressive</label> 
                            <input type="text" id="semen_none" name="semen_none" maxlength="4" class="form-control"></div>
                    </div>
                </div>
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_imm">Immotile</label> 
                            <input type="text" id="semen_imm" name="semen_imm" maxlength="4" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>

                <label>VITALITY (%)</label>
                <hr>
                
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_vital">Vitality (%)</label> 
                            <input type="text" id="semen_vital" name="semen_vital"  maxlength="4" class="form-control"></div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>

                <label>OTHER CELLS (*10<sup>6</sup>/ml)</label>
                <hr>

                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_wbc">WBC</label> 
                            <input type="text" id="semen_wbc" name="semen_wbc" maxlength="4" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>

                <label>CONCENTRATION (10<sup>6</sup>/ml)</label>
                <hr>
                
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_count">Count/ml</label> 
                            <input type="text" id="semen_count" name="semen_count" maxlength="4" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_totalc">Total Count in Ejaculation</label> 
                            <input type="text" id="semen_totalc" name="semen_totalc" maxlength="4" class="form-control"> </div>
                    </div>
                </div>

                <label>MORPHOLOGY</label>
                <hr>
                
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_normal">Normal</label> 
                            <input type="text" id="semen_normal" name="semen_normal" maxlength="4" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_abn">Abnormal</label> 
                            <input type="text" id="semen_abn" name="semen_abn" maxlength="4" class="form-control"> </div>
                    </div>
                </div>
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_head">Head Defect</label> 
                            <input type="text" id="semen_head" name="semen_head" maxlength="4" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_mid">Mid - Piece Defect</label> 
                            <input type="text" id="semen_mid" name="semen_mid" maxlength="4" class="form-control"> </div>
                    </div>
                </div>
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="semen_tail">Tail</label> 
                            <input type="text" id="semen_tail" name="semen_tail" maxlength="4" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>
                <div class="row justify-content-center" >
                    <div class="col-md-8">
                        <div class="form-group"> <label for="semen_comment">COMMENTS</label> 
                            <textarea class="form-control rounded-0" name="semen_comment" id="semen_comment" form="test_form" rows="3"></textarea></div>
                    </div>
                </div>
              </div>
          {{-- Semen --}}

          {{-- OGTT --}}
                <div id="OGTT" class="tabcontent">
                  <h3>Oral Glucose Tolerance Test (OGTT)</h3>
                  <hr>
                  
                    <label>BLOOD</label>
                    <hr>
                   
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="oral_glucose">Fasting Blood Glucose</label> 
                            <input type="text" id="oral_glucose" name="oral_glucose" maxlength="4" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="oral_1hpost">60mins Postprandial Glucose</label> 
                            <input type="text" id="oral_1hpost" name="oral_1hpost" maxlength="4" class="form-control"> </div>
                    </div>
                </div>
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="oral_1_30post">90mins Postprandial Glucose</label> 
                            <input type="text" id="oral_1_30post" name="oral_1_30post" maxlength="4" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="oral_post">120mins Postprandial Glucose</label> 
                            <input type="text" id="oral_post" name="oral_post" maxlength="4" class="form-control"> </div>
                    </div>
                </div>

                    <label>URINE</label>
                    <hr>
                    
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="oral_glu">Fasting Urine Glucose</label> 
                            <select name="oral_glu" id="oral_glu" class="form-control" style="height: 35px;">
                                <option></option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                            </select>
                            <select name="oglu_f" id="oglu_f" class="form-control" style="display: none; height: 35px;">
                                <option></option>
                                  @foreach ($query['factor'] as $factor)
                                    <option>{{ $factor['dropdown'] }}</option>
                                  @endforeach
                            </select> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="oral_pro">60mins Postprandial Glucose</label> 
                            <select name="oral_pro" id="oral_pro" class="form-control" style="height: 35px;">
                                <option></option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                            </select>
                            <select name="opro_f" id="opro_f" class="form-control" style="display: none; height: 35px;">
                                <option></option>
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
                                <option></option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>
                                @endforeach
                            </select>
                            <select name="opro_ninf" id="opro_ninf" class="form-control" style="display: none; height: 35px;">
                                <option></option>
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
                            <input type="number" name="fst_min" id="fst_min" min="0" max="40" step="00.01" class="form-control" style="height: 35px;"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="snd_min">60 Minutes</label> 
                            <input type="number" name="snd_min" id="snd_min" min="0" max="40" step="00.01" class="form-control" style="height: 35px;"></div>
                    </div>
                </div>
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="thd_min">90 Minutes</label> 
                            <input type="number" name="thd_min" id="thd_min" min="0" max="40" step="00.01" class="form-control" style="height: 35px;"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="for_min">120 Minutes</label> 
                            <input type="number" name="for_min" id="for_min" min="0" max="40" step="00.01" class="form-control" style="height: 35px;"></div>
                    </div>
                </div>
                <div class="row justify-content-center" >
                    <div class="col-md-8">
                        <div class="form-group"> <label for="oral_comment">COMMENTS</label> 
                            <textarea class="form-control rounded-0" name="oral_comment" id="oral_comment" form="test_form" rows="3"></textarea></div>
                    </div>
                </div>
              </div>
          {{-- OGTT --}}

          {{-- PSA --}}
                <div id="PSA" class="tabcontent">
                  <h3>Prostate Specific Antigen (PSA) Semi-Quantitative Report</h3>
                  <hr>

                  <div class="row justify-content-center">
                    <div class="col-md-2">
                      <div class="btn-group" style="width: 100%">
                        <label class="btn btn-primary">
                          <input type="radio" name="psa" id="psa_pos" value="Positive" onclick="myFunPSApositive()"> Positive
                        </label>
                      </div>
                    </div>
                    <div class="col-md-6" style="padding-top: 7.5px">
                      <select name="psa_positive" id="psa_positive" class="form-control" style="height: 35px;" disabled>
                        <option></option>
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
                          <input type="radio" name="psa" id="psa_neg" value="Negative" onclick="myFunPSAnegative()"> Negative
                        </label>
                      </div>
                    </div>
                    <div class="col-md-6" style="padding-top: 7.5px">
                      <select name="psa_negative" id="psa_negative" class="form-control" style="height: 35px;" disabled>
                        <option></option>
                        <option>PSA level less than 3ng/ml</option>
                    </select>
                    </div> 
                  </div>
               
                  <div class="row justify-content-center" >
                      <div class="col-md-8">
                          <div class="form-group"> <label for="psa_comment">COMMENTS</label> 
                              <textarea class="form-control rounded-0" name="psa_comment" id="psa_comment" form="test_form" rows="3"></textarea></div>
                      </div>
                  </div>
                </div>
          {{-- PSA --}}

          {{-- H_pylori --}}
                <div id="H_pylori" class="tabcontent">
                  <h3>H-Pylori Qualitative Test Report</h3>
                  <hr>
                  <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <div class="form-group"> <label for="pylori_qual">H-pylori Qualitative</label> 
                            <select name="pylori_qual" id="pylori_qual" class="form-control" style="height: 35px;">
                              <option></option>
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
                              <textarea class="form-control rounded-0" name="pylori_comment" id="pylori_comment" form="test_form" rows="3"></textarea></div>
                      </div>
                  </div>
                </div>
          {{-- H_pylori --}}

          {{-- LFT --}}
                <div id="LFT" class="tabcontent">
                  <h3>Liver Function Test</h3>
                  <hr>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="liver_protein">Total Protein (TP)(g/l)</label> 
                            <input type="text" id="liver_protein" name="liver_protein" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="liver_albumin">Albumin (ALB)(g/l)</label> 
                            <input type="text" id="liver_albumin" name="liver_albumin" maxlength="6" class="form-control"> </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="liver_globulin">Globulin (GLOB)(g/l)</label> 
                            <input type="text" id="liver_globulin" name="liver_globulin" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="liver_alkaline">Alkaline Phospatase (ALP)(U/L)</label> 
                            <input type="text" id="liver_alkaline" name="liver_alkaline" maxlength="6" class="form-control"> </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="liver_alanine">Alanine Aminotransferase (ALT)(U/L)</label> 
                            <input type="text" id="liver_alanine" name="liver_alanine" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="liver_aspartate">Aspartate Aminotransferase (AST)(U/L)</label> 
                            <input type="text" id="liver_aspartate" name="liver_aspartate" maxlength="6" class="form-control"> </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="liver_gamma">Gamma GT (GGT)(U/L)</label> 
                            <input type="text" id="liver_gamma" name="liver_gamma" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="liver_total">Total Bilirubin (T BIL)(&mu;mol/l)</label> 
                            <input type="text" id="liver_total" name="liver_total" maxlength="6" class="form-control"> </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="liver_direct">Direct Bilirubin (D BIL)(&mu;mol/l)</label> 
                            <input type="text" id="liver_direct" name="liver_direct" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="liver_indirect">Indirect Bilirubin (I BIL)(&mu;mol/l)</label> 
                            <input type="text" id="liver_indirect" name="liver_indirect" maxlength="6" class="form-control"> </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group"> <label for="liver_comment">COMMENTS</label> 
                            <textarea class="form-control rounded-0" name="liver_comment" id="liver_comment" form="test_form" rows="3"></textarea></div>
                    </div>
                </div>
              </div>
          {{-- LFT --}}

          {{-- RFT --}}
                <div id="RFT" class="tabcontent">
                  <h3>Renal Function Test</h3>
                  <hr>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="renal_urea">Urea (BUN)(mmol/l)</label> 
                            <input type="text" id="renal_urea" name="renal_urea" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="renal_creatinine">Creatinine (CRE)(mmol/l)</label> 
                            <input type="text" id="renal_creatinine" name="renal_creatinine" maxlength="6" class="form-control"> </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-md-8">
                          <div class="form-group"> <label for="renal_comment">COMMENTS</label> 
                              <textarea class="form-control rounded-0" name="renal_comment" id="renal_comment" form="test_form" rows="3"></textarea></div>
                      </div>
                  </div>
              </div>
          {{-- RFT --}}

          {{-- Lipid --}}
                <div id="Lipid" class="tabcontent">
                  <h3>Lipid Profile</h3>
                  <hr>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="lipid_total">Total Cholesterol (TC)(mmol/l)</label> 
                            <input type="text" id="lipid_total" name="lipid_total" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="lipid_trigly">Triglyceride (TG)(mmol/l)</label> 
                            <input type="text" id="lipid_trigly" name="lipid_trigly" maxlength="6" class="form-control"> </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="lipid_hdl">HDL-Cholesterol(HDL-C)(mmol/l)</label> 
                            <input type="text" id="lipid_hdl" name="lipid_hdl" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="lipid_ldl">LDL-Cholesterol (LDL-C)(mmol/l)</label> 
                            <input type="text" id="lipid_ldl" name="lipid_ldl" maxlength="6" class="form-control"> </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group"> <label for="lipid_comment">COMMENTS</label> 
                            <textarea class="form-control rounded-0" name="lipid_comment" id="lipid_comment" form="test_form" rows="3"></textarea></div>
                    </div>
                </div>
              </div>
          {{-- Lipid --}}

          {{-- Electrolytes --}}
                <div id="Electrolytes" class="tabcontent">
                  <h3>Electrolytes</h3>
                  <hr>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="electro_potas">Potassium (K<sup>+</sup>)(mmol/l)</label> 
                            <input type="text" id="electro_potas" name="electro_potas" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="electro_sodium">Sodium (Na<sup>+</sup>)(mmol/l)</label> 
                            <input type="text" id="electro_sodium" name="electro_sodium" maxlength="6" class="form-control"> </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="electro_chloride">Chloride (Cl<sup>-</sup>)(mmol/l)</label> 
                            <input type="text" id="electro_chloride" name="electro_chloride" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="electro_cca">Complexed Calcium (iCa)(mmol/l)</label> 
                            <input type="text" id="electro_cca" name="electro_cca" maxlength="6" class="form-control"> </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="electro_ica">Ionized Calcium (nCa)(mmol/l)</label> 
                            <input type="text" id="electro_ica" name="electro_ica" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="electro_tca">Total Calcium (TCa)(mmol/l)</label> 
                            <input type="text" id="electro_tca" name="electro_tca" maxlength="6" class="form-control"> </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="electro_ph">PH (pH)</label> 
                            <input type="text" id="electro_ph" name="electro_ph" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-md-8">
                          <div class="form-group"> <label for="electro_comment">COMMENTS</label> 
                              <textarea class="form-control rounded-0" name="electro_comment" id="electro_comment" form="test_form" rows="3"></textarea></div>
                      </div>
                  </div>
                </div>
          {{-- Electrolytes --}}

          {{-- Uric --}}
                <div id="Uric" class="tabcontent">
                  <h3>Uric Acid</h3>
                  <hr>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="uric_acid">Uric Acid (UA)(mmol/l)</label> 
                            <input type="text" id="uric_acid" name="uric_acid" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-md-8">
                          <div class="form-group"> <label for="uric_comment">COMMENTS</label> 
                              <textarea class="form-control rounded-0" name="uric_comment" id="uric_comment" form="test_form" rows="3"></textarea></div>
                      </div>
                  </div>
                </div>
          {{-- Uric --}}

          {{-- Glycated H --}}
                <div id="Glycated_H" class="tabcontent">
                  <h3>Glycated Hemoglobin Report</h3>
                  <hr>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="glycated_hba1c">HbA1c (%)</label> 
                            <input type="text" id="glycated_hba1c" name="glycated_hba1c" maxlength="5" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-md-8">
                          <div class="form-group"> <label for="glycated_comment">COMMENTS</label> 
                              <textarea class="form-control rounded-0" name="glycated_comment" id="glycated_comment" form="test_form" rows="3"></textarea></div>
                      </div>
                  </div>
                </div>
          {{-- Glycated H --}}

          {{-- Serum --}}
                <div id="Serum" class="tabcontent">
                  <h3>Serum Bilirubin</h3>
                  <hr>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="serum_total">Total Bilirubin (T BIL)</label> 
                            <input type="text" id="serum_total" name="serum_total" maxlength="5" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="serum_direct">Direct Bilirubin (D BIL)</label> 
                            <input type="text" id="serum_direct" name="serum_direct" maxlength="5" class="form-control"> </div>                                             
                    </div>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-md-4">
                          <div class="form-group"> <label for="serum_indirect">Indirect Bilirubin (I BIL)</label> 
                              <input type="text" id="serum_indirect" name="serum_indirect" maxlength="5" class="form-control"> </div>
                      </div>
                      <div class="col-md-4">
                                                                          
                      </div>
                  </div>
                  <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="form-group"> <label for="serum_comment">COMMENTS</label> 
                                <textarea class="form-control rounded-0" name="serum_comment" id="serum_comment" form="test_form" rows="3"></textarea></div>
                        </div>
                    </div>
                  </div>
          {{-- Serum --}}

          {{-- HVS --}}
                <div id="HVS" class="tabcontent">
                  <h3>High Vaginal Swab R/E Report</h3>
                  <hr>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="vaginal_epith">Epithelial Cells (HPF)</label> 
                            <input type="text" id="vaginal_epith" name="vaginal_epith" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="vaginal_pus">Pus Cells (HPF)</label> 
                            <input type="text" id="vaginal_pus" name="vaginal_pus" maxlength="6" class="form-control"> </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="vaginal_red">Red Cells (HPF)</label> 
                            <input type="text" id="vaginal_red" name="vaginal_red" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="vaginal_clue">Clue Cells (HPF)</label> 
                            <input type="text" id="vaginal_clue" name="vaginal_clue" maxlength="6" class="form-control"> </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="vaginal_whiff">Whiff Test</label>
                            <select id="vaginal_whiff" name="vaginal_whiff" class="form-control" style="height: 35px;">
                                <option></option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>                                        
                                @endforeach
                            </select></div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"> <label for="vaginal_koh">KOH</label>  
                            <select id="vaginal_koh" name="vaginal_koh" class="form-control" style="height: 35px;">
                                <option></option>
                                @foreach ($query['response'] as $response)
                                    <option>{{ $response['dropdown'] }}</option>                                        
                                @endforeach
                            </select></div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> <label for="vaginal_tricho">Trichomonas Vaginalis (HPF)</label> 
                            <input type="text" id="vaginal_tricho" name="vaginal_tricho" maxlength="6" class="form-control"> </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-md-8">
                          <div class="form-group"> <label for="vaginal_gram">Gram</label> 
                              <textarea class="form-control rounded-0" name="vaginal_gram" id="vaginal_gram" form="test_form" rows="3"></textarea></div>
                      </div>
                      <div class="col-md-8">
                          <div class="form-group"> <label for="vaginal_others">Others</label> 
                              <textarea class="form-control rounded-0" name="vaginal_others" id="vaginal_others" form="test_form" rows="3"></textarea></div>
                      </div>
                  </div>
                </div>
          {{-- HVS --}}

          {{-- Pleural --}}
                <div id="Pleural" class="tabcontent">
                  <h3>Pleural Fluid Report</h3>
                  <hr>

                  <label>MACROSCOPY</label>
                  <hr>
                  
                  <div class="row justify-content-center">
                      <div class="col-md-4">
                          <div class="form-group"> <label for="pleural_appear">Appearance</label> 
                          <select id="pleural_appear" name="pleural_appear" class="form-control" style="height: 35px;">
                                <option></option>
                                @foreach ($query['appear'] as $appear)
                                    <option>{{ $appear['dropdown'] }}</option>
                                @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group"> <label for="pleural_color">Colour</label>  
                          <select id="pleural_color" name="pleural_color" class="form-control" style="height: 35px;">
                            <option></option>
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
                              <input type="text" id="pleural_ph" name="pleural_ph" maxlength="5" class="form-control"> </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group"> <label for="pleural_spec">Specific Gravity</label> 
                              <input type="text" id="pleural_spec" name="pleural_spec" maxlength="6" class="form-control"> </div>
                      </div>
                  </div>

                  <label>BIOCHEMISTRY</label>
                  <hr>

                  <div class="row justify-content-center">
                      <div class="col-md-4">
                          <div class="form-group"> <label for="pleural_protein">Protein (g/l)</label> 
                              <input type="text" id="pleural_protein" name="pleural_protein" maxlength="6" class="form-control"> </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group"> <label for="pleural_glucose">Glucose (mmol/l)</label> 
                              <input type="text" id="pleural_glucose" name="pleural_glucose" maxlength="6" class="form-control"> </div>
                      </div>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-md-4">
                          <div class="form-group"> <label for="pleural_total">Total Cholesterol (mmol/l)</label> 
                              <input type="text" id="pleural_total" name="pleural_total" maxlength="6" class="form-control"> </div>
                      </div>
                      <div class="col-md-4">
                          
                      </div>
                  </div>

                  <label>MICROSCOPY</label>
                  <hr>

                  <div class="row justify-content-center">
                      <div class="col-md-4">
                          <div class="form-group"> <label for="pleural_count">Cell Count (CELLS/L)</label> 
                              <input type="text" id="pleural_count" name="pleural_count" maxlength="6" class="form-control"> </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group"> <label for="pleural_type">Cell Type</label> 
                              <input type="text" id="pleural_type" name="pleural_type" class="form-control"> </div>
                      </div>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-md-4">
                          <div class="form-group"> <label for="pleural_gram">Gram Reaction</label> 
                              <input type="text" id="pleural_gram" name="pleural_gram" class="form-control"> </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group"> <label for="pleural_culture">Culture</label> 
                              <input type="text" id="pleural_culture" name="pleural_culture" class="form-control"> </div>
                      </div>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-md-8">
                          <div class="form-group"> <label for="pleural_comment">COMMENT</label> 
                              <textarea class="form-control rounded-0" name="pleural_comment" id="pleural_comment" form="test_form" rows="3"></textarea></div>
                      </div>
                  </div>
                </div>
          {{-- Pleural --}}

          {{-- Peritoneal --}}
                <div id="Peritoneal" class="tabcontent">
                  <h3>Peritoneal Fluid Report</h3>
                  <hr>
                  <label>MACROSCOPY</label>
                  <hr>

                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> <label for="peritoneal_appear">Appearance</label> 
                            <select id="peritoneal_appear" name="peritoneal_appear" class="form-control" style="height: 35px;" >
                                <option></option>
                                    @foreach ($query['appear'] as $appear)
                                        <option>{{ $appear['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> <label for="peritoneal_color">Colour</label>  
                            <select id="peritoneal_color" name="peritoneal_color" class="form-control" style="height: 35px;" >
                                <option></option>
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
                                <input type="text" id="peritoneal_spec" name="peritoneal_spec" maxlength="6" class="form-control"> </div>
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                    </div>
                    
                    <label>BIOCHEMISTRY</label>
                    <hr>

                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> <label for="peritoneal_protein">Protein (g/dl)</label> 
                                <input type="text" id="peritoneal_protein" name="peritoneal_protein" maxlength="6" class="form-control"> </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> <label for="peritoneal_albumin">Albumin (g/l)</label> 
                                <input type="text" id="peritoneal_albumin" name="peritoneal_albumin" maxlength="6" class="form-control"> </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> <label for="peritoneal_glucose">Glucose (mmol/l)</label> 
                                <input type="text" id="peritoneal_glucose" name="peritoneal_glucose" maxlength="6" class="form-control"> </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> <label for="peritoneal_alkaline">Alkaline Phosphatase (U/L)</label> 
                                <input type="text" id="peritoneal_alkaline" name="peritoneal_alkaline" maxlength="6" class="form-control"> </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> <label for="peritoneal_amylase">Amylase (U/L)</label> 
                                <input type="text" id="peritoneal_amylase" name="peritoneal_amylase" maxlength="6" class="form-control"> </div>
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                    </div>

                    <label>MICROSCOPY</label>
                    <hr>

                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> <label for="peritoneal_count">Cell Count (CELLS/L)</label> 
                                <input type="text" id="peritoneal_count" name="peritoneal_count" maxlength="6" class="form-control"> </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> <label for="peritoneal_type">Cell Type</label> 
                                <input type="text" id="peritoneal_type" name="peritoneal_type" class="form-control"> </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> <label for="peritoneal_gram">Gram Reaction</label> 
                                <input type="text" id="peritoneal_gram" name="peritoneal_gram" class="form-control"> </div>
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="form-group"> <label for="peritoneal_comment">COMMENT</label> 
                                <textarea class="form-control rounded-0" name="peritoneal_comment" id="peritoneal_comment" form="test_form" rows="3"></textarea></div>
                        </div>
                    </div>
                </div>
          {{-- Peritoneal --}}

          {{-- CSF --}}
                <div id="CSF" class="tabcontent">
                  <h3>Cerebrospinal (CSF) Fluid Report</h3>
                  <hr>
                  <label>MACROSCOPY</label>
                  <hr>

                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> <label for="csf_appear">Appearance</label> 
                            <select id="csf_appear" name="csf_appear" class="form-control" style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['appear'] as $appear)
                                        <option>{{ $appear['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> <label for="csf_color">Colour</label> 
                                <select id="csf_color" name="csf_color" class="form-control" style="height: 35px;">
                                    <option></option>
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
                                <input type="text" id="csf_protein" name="csf_protein" maxlength="6" class="form-control"> </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> <label for="csf_glucose">Glucose (mmol/l)</label> 
                                <input type="text" id="csf_glucose" name="csf_glucose" maxlength="6" class="form-control"> </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> <label for="csf_globulin">Globulin</label> 
                                <select id="csf_globulin" name="csf_globulin" class="form-control" style="height: 35px;">
                                    <option></option>
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
                                <input type="text" id="csf_count" name="csf_count" maxlength="6" class="form-control"> </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> <label for="csf_type">Cell Type</label> 
                                <input type="text" id="csf_type" name="csf_type" class="form-control"> </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> <label for="csf_gram">Gram Reaction</label> 
                                <input type="text" id="csf_gram" name="csf_gram" class="form-control"> </div>
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="form-group"> <label for="csf_comment">COMMENT</label> 
                                <textarea class="form-control rounded-0" name="csf_comment" id="csf_comment" form="test_form" rows="3"></textarea></div>
                        </div>
                    </div>
                </div>
          {{-- CSF --}}

          {{-- Bacteriology --}}
                <div id="Bacteriology" class="tabcontent">
                  <h3>Bacteriology Results</h3>
                  <hr>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group"> 
                            <label for="bacter_specimen">Type of Specimen</label> 
                            <select id="bacter_specimen" name="bacter_specimen" class="form-control" style="height: 35px;">
                                <option></option>
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
                                <option></option>
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
                                <option></option>
                                {{-- <option value="bacterial Type 1">Add New Bacterial</option> --}}
                            </select> 
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" id="bacter_type2_dis"> 
                            <label for="bacter_type2">Bacterial Type 2</label> 
                            <select id="bacter_type2" name="bacter_type2" class="form-control" style="height: 35px;">
                                <option></option>
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
                                <input type="text" id="bacter_anti1" name="bacter_anti1" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react1" id="bacter_react1" class="form-control" style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone1" id="bacter_zone1" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <input type="text" id="bacter_anti2" name="bacter_anti2" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react2" id="bacter_react2" class="form-control" style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone2" id="bacter_zone2" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <input type="text" id="bacter_anti3" name="bacter_anti3" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react3" id="bacter_react3" class="form-control" style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone3" id="bacter_zone3" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <input type="text" id="bacter_anti4" name="bacter_anti4" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react4" id="bacter_react4" class="form-control" style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone4" id="bacter_zone4" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <input type="text" id="bacter_anti5" name="bacter_anti5" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react5" id="bacter_react5" class="form-control" style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone5" id="bacter_zone5" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <input type="text" id="bacter_anti6" name="bacter_anti6" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react6" id="bacter_react6" class="form-control" style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone6" id="bacter_zone6" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <input type="text" id="bacter_anti7" name="bacter_anti7" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react7" id="bacter_react7" class="form-control" style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone7" id="bacter_zone7" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <input type="text" id="bacter_anti8" name="bacter_anti8" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react8" id="bacter_react8" class="form-control" style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone8" id="bacter_zone8" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <input type="text" id="bacter_anti9" name="bacter_anti9" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react9" id="bacter_react9" class="form-control" style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone9" id="bacter_zone9" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <input type="text" id="bacter_anti10" name="bacter_anti10" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react10" id="bacter_react10" class="form-control" style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone10" id="bacter_zone10" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <input type="text" id="bacter_anti11" name="bacter_anti11" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react11" id="bacter_react11" class="form-control" style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone11" id="bacter_zone11" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <input type="text" id="bacter_anti12" name="bacter_anti12" list="antibioticsList" class="form-control mov-1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group"> 
                                <select name="bacter_react12" id="bacter_react12" class="form-control" style="height: 35px;">
                                    <option></option>
                                    @foreach ($query['bacterial_react'] as $react)
                                        <option>{{ $react['dropdown'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group"> 
                                <input type="text" name="bacter_zone12" id="bacter_zone12" maxlength="2" class="form-control">
                            </div>
                        </div>
                    </div>
                 </div>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="form-group"> <label for="becter_comment">COMMENT</label> 
                                <textarea class="form-control rounded-0" name="becter_comment" id="becter_comment" form="test_form" rows="3"></textarea></div>
                        </div>
                    </div>
                </div>        
            </div>
          {{-- Bacteriology --}}
        
          <div class="col-lg-2 float-right" style="margin-bottom: 2%"><button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Save</button> </div>
              </div>
              
            </form>
        </div>
    </div>

    <script>
        function openCity(evt, cityName) {
          evt.preventDefault();

          var i, tabcontent, tablinks;
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
          }
          tablinks = document.getElementsByClassName("tablinks");
          for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
          }
          document.getElementById(cityName).style.display = "block";
          evt.currentTarget.className += " active";
        }
        
        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();

        $('.chesmis').click(function () {
          document.getElementById('chemss').style.color = '#06c';
          document.getElementById('chemss').style.backgroundColor = '#fff';
          document.getElementById('chemss').style.border = '1px solid #06c'; 
          document.getElementById('chemss').style.borderBottom = 'none';
          document.getElementById('chemss').style.borderTopLeftRadius = '10px';
          document.getElementById('chemss').style.borderTopRightRadius = '10px';
          document.getElementById('chemss').style.marginBottom = '-1px';
        });

        $('.microb').click(function () {
          document.getElementById('microb').style.color = '#06c';
          document.getElementById('microb').style.backgroundColor = '#fff';
          document.getElementById('microb').style.border = '1px solid #06c'; 
          document.getElementById('microb').style.borderBottom = 'none';
          document.getElementById('microb').style.borderTopLeftRadius = '10px';
          document.getElementById('microb').style.borderTopRightRadius = '10px';
          document.getElementById('microb').style.marginBottom = '-1px';
        });

        $(".tablinks").on('click', function() {
          document.getElementById('chemss').style.color = '#000';
          document.getElementById('chemss').style.backgroundColor = 'inherit';
          document.getElementById('chemss').style.border = 'none'; 
          document.getElementById('microb').style.color = '#000';
          document.getElementById('microb').style.backgroundColor = 'inherit';
          document.getElementById('microb').style.border = 'none'; 
        });

        function m_over(x) {
          x.style.backgroundColor = "#ddd";
        }

        function m_out(x) {
          x.style.backgroundColor = "inherit";
        }
    </script>

<script src="{{ asset('public/js/javascript.entertest.js') }}"></script>
@endsection