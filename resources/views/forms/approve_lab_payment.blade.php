  
<form action="approve-payment" method="POST" autocomplete="off" id="myform">
    @csrf
    @isset($data)
        <input type="hidden" name="id" value="{{ $data->req_id }}">
    @endisset
    <div class="form-group">
        <div class="row">
            <div class="col-2">
                <label for="recipient-name" class="control-label">OPD Number:</label>
                <input type="text" name="opd_number" placeholder="OPD Number" value="{{ (isset($data)) ? $data->opd_number : '' }}" class="form-control form-control-border bg-white" id="opd_number" <?php if(isset($data)) echo 'readonly'; ?> required>
            </div>
            <div class="col-5">
                <label for="recipient-name" class="control-label">Patient's Full Name:</label>
                <input type="text" placeholder="Unknown" value="{{ (isset($data)) ? $data->patient->name ?? 'Unknown' : '' }}" class="form-control form-control-border bg-white" id="name" readonly>
            </div>
            <div class="col-2">
              <label for="recipient-name" class="control-label">Patient's Age:</label>
              <input type="text" placeholder="0" value="{{ (isset($data)) ? $data->patient->age ?? '' : '' }}" class="form-control form-control-border bg-white" id="age" readonly>
          </div>
            <div class="col-3"> 
              <label for="recipient-name" class="control-label">Insurance Status:</label>
              <select class="form-control form-control-border bg-white" name="ins_status" style="height: 35px;" disabled>
                  <option @if (isset($data) && $data->ins_status === 'insured') selected @endif value="insured">Insured</option>
                  <option @if (isset($data) && $data->ins_status === 'noninsured') selected @endif value="noninsured">Non-insured</option>
              </select>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->lab_requests as $key => $lab_request)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $lab_request }}</td>
                    <td>{{ $data->amounts[--$key] }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>Total</th>
                <th>{{ number_format($data->total_amount, 2) }}</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th><input type="text" placeholder="0" style="width: 100%" name="receipt_no" class="form-control form-control-border bg-white" required></th>
            </tr>
        </tfoot>
    </table>
    
  <button type="submit" class="btn btn-primary float-right mt-4">Approve Payment</button>
</form>
