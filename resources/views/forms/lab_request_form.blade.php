<?php 
    use App\Http\Controllers\GetdataController;

    $query = GetdataController::selectOptions();
?>

<form action="medical-request" method="POST" autocomplete="off" id="myform">
      @csrf
      @isset($data)
          <input type="hidden" name="id" value="{{ $data->req_id }}">
      @endisset
      <div class="form-group">
          <div class="row">
              <div class="col-3">
                  <label for="recipient-name" class="control-label">OPD Number:</label>
                  <input type="text" name="opd_number" placeholder="OPD Number" value="{{ (isset($data)) ? $data->opd_number : '' }}" class="form-control form-control-border bg-white" id="opd_number" <?php if(isset($data)) echo 'readonly'; ?> required>
              </div>
              <div class="col-7">
                  <label for="recipient-name" class="control-label">Patient's Full Name:</label>
                  <input type="text" placeholder="Unknown" value="{{ (isset($data)) ? $data->patient->name ?? 'Unknown' : '' }}" class="form-control form-control-border bg-white" name="name" id="name" required>
              </div>
              <div class="col-2">
                <label for="recipient-name" class="control-label">Patient's Age:</label>
                <input type="text" placeholder="0" value="{{ (isset($data)) ? $data->patient->age ?? '' : '' }}" class="form-control form-control-border bg-white" id="age" name="age" required>
            </div>
          </div>
      </div>

      <div class="form-group">
        <div class="row">
            <div class="col-3">
                <label for="recipient-name" class="control-label">Patient's Gender:</label>
                <select class="form-control form-control-border bg-white" name="gender" id="gender" style="height: 35px;" required>
                    <option value="" selected disabled>--Gender--</option>
                    <option @if (isset($data) && $data->patient->gender === 'Male') selected @endif value="Male">Male</option>
                    <option @if (isset($data) && $data->patient->gender === 'Female') selected @endif value="Female">Female</option>
                </select>
            </div>
            <div class="col-5">
              <label for="recipient-name" class="control-label">Department:</label>
              <select class="form-control form-control-border bg-white" name="department" style="height: 35px;" required>
                <option value="" selected disabled>--Department--</option>
                @foreach ($query['department'] as $depart)
                    <option @if (isset($data) && $data->department === $depart['dropdown']) selected @endif >{{ $depart['dropdown'] }}</option>
                @endforeach
            </select>
          </div>
            <div class="col-4"> 
              <label for="recipient-name" class="control-label">Insurance Status:</label>
              <select class="form-control form-control-border bg-white" name="ins_status" style="height: 35px;" required>
                  <option value="" selected disabled>--Ins. Status--</option>
                  <option @if (isset($data) && $data->ins_status === 'insured') selected @endif value="insured">Insured</option>
                  <option @if (isset($data) && $data->ins_status === 'noninsured') selected @endif value="noninsured">Non-insured</option>
              </select>
            </div>
        </div>
     </div>

     <hr>

     <div class="row mt-2">
        <div class="col-6">
            <label for="recipient-name" class="control-label">Clinical Summary</label>
        </div>
        <div class="col-md-12">
            <textarea name="clinical_summary" id="" rows="2" required>@if (isset($data)) {{ $data->clinical_summary }} @endif</textarea>
        </div>
    </div>

    <hr>
      {{-- <ul class="nav nav-tabs"> --}}
        <div class="form-group">
          <div class="row">
              <div class="col-6">
                  <label for="recipient-name" class="control-label">Labs</label>
                  <input type="text" placeholder="Select Labs" list="labs_list" class="form-control form-control-border bg-white" id="labs">
                  <datalist id="labs_list">
                    @php
                        $lab_array = [];    
                    @endphp

                    @foreach ($labs as $lab)
                        <option value="{{ $lab->description }}">

                        @php
                            $lab_array[] = $lab->description; //$lab->invest_id
                        @endphp
                    @endforeach
                  </datalist>
              </div>
              <div class="col-3"> 
                <label for="recipient-name" class="control-label">Action:</label><br>
                <button type="button" class="btn btn-success add-all-input"> <i class="fa fa-plus"></i> Add New</button> 
              </div>
          </div>
      </div>
        
        
        
    {{-- </ul> --}}
    
    <div class="row mt-2">
        <div class="col-md-11">Description</div>
        <div class="col-md-1">Action</div>
    </div>
    
    <div class="investigations">  
        @if (isset($data))
            @foreach ($data->lab_requests as $lab_request)
                <div class="row mt-2">
                    <div class="col-md-11">
                        <div class="mb-md-0">
                            <input type="text" value="{{ $lab_request }}" class="form-control form-control-border bg-white" name="lab_requests[]" required placeholder=" " style="height: 35px;" readonly>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-danger" onclick="remove(this)"><i class="fa fa-trash"></i></button>
                    </div>
                </div> 
            @endforeach

            <div class="row mt-2 add-input" style="display: none">
                <div class="col-md-12">
                    No data Found
                </div>
            </div>
        @else
            <div class="row mt-2 add-input">
                <div class="col-md-12">
                    No data Found
                </div>
            </div>
        @endif
        
    </div>
      
    <button type="submit" class="btn btn-primary float-right mt-4">Submit</button>
  </form>
  
  @php
    $labs = json_encode($lab_array);   
  @endphp

@include('includes.lab_request')