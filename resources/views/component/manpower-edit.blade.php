@push('after-css')
<style>
    input[type=date]:required:invalid::-webkit-datetime-edit {
        color: transparent;
    }

    input[type=date]:focus::-webkit-datetime-edit {
        color: black !important;
    }

</style>
@endpush

@section('title','Edit Manpower')
@section('page-title','Manpower')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('manpower.index') }}">Data Manpower</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Edit</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title">Edit {{ $manpower->name }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('manpower.update', $manpower->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="dealer_id" name="dealer_id" value="{{ $manpower->dealer_id }}" required>
                            <input id="dealer_name" type="text" class="form-control input-border-bottom"
                                    name="dealer_name" value="{{ $manpower->dealer->dealer_name }}" data-toggle="modal"
                                    data-target=".modalDealer" required>
                            <label for="dealer_name" class="placeholder">Dealer</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="name" type="text" class="form-control input-border-bottom" name="name"
                                value="{{ $manpower->name }}" required>
                            <label for="name" class="placeholder">Name</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="address" type="text" class="form-control input-border-bottom" name="address"
                                value="{{ $manpower->address }}" required>
                            <label for="address" class="placeholder">Address</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="phone" type="text" class="form-control input-border-bottom" name="phone"
                                value="{{ $manpower->phone }}" required>
                            <label for="phone" class="placeholder">Phone</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="birthday" type="date" class="form-control input-border-bottom" name="birthday"
                                value="{{ $manpower->birthday }}" required>
                            <label for="birthday" class="placeholder">Birthday</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="gender" type="hidden" name="gender" value="{{ $manpower->gender }}" required>
                            <input id="gender_name" type="text" class="form-control input-border-bottom"
                                    name="gender_name" value="{{ $manpower->gender == 'L' ? 'Male' : 'Female' }}" data-toggle="modal"
                                    data-target=".modalGender" required>
                            <label for="gender_name" class="placeholder">Gender</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="join_date" type="date" class="form-control input-border-bottom" name="join_date"
                                value="{{ $manpower->join_date }}" required>
                            <label for="join_date" class="placeholder">Join Date</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group form-floating-label">
                            <input id="position" type="text" class="form-control input-border-bottom"
                                    name="position" value="{{ $manpower->position }}" data-toggle="modal"
                                    data-target=".modalPosition" required>
                            <label for="position" class="placeholder">Position</label>
                        </div>
                        <input type="hidden" id="category" name="category" value="{{ $manpower->category }}" required>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group form-floating-label">
                            <input id="education" type="text" class="form-control input-border-bottom"
                                    name="education" value="{{ $manpower->education }}" data-toggle="modal"
                                    data-target=".modalEducation" required>
                            <label for="education" class="placeholder">Education</label>
                        </div>
                    </div>

                    <div class="col-md-4" id="statusManpower">
                        <div class="form-group form-floating-label">
                            <select class="form-control input-border-bottom" id="status" name="status" required>
                                <option value="{{ $manpower->status }}">{{ ucfirst($manpower->status) }}</option>
                                <option disabled>Select Status</option>
                                <option value="active">Active</option>
                                <option value="mutation">Mutation</option>
                                <option value="resign">Resign</option>
                            </select>
                            <label for="status" class="placeholder">Select Status</label>
                        </div>
                    </div>

                    <div class="col-md-2" style="display: none;" id="resignDate">
                        <div class="form-group form-floating-label">
                            <input id="resign_date" type="date" class="form-control input-border-bottom" name="resign_date"
                                value="{{ $manpower->resign_date }}">
                            <label for="resign_date" class="placeholder">Resign Date</label>

                            <span class="invalid-feedback">
                                <strong><span id="error-msg"></span></strong>
                            </span>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success" type="submit"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

@include('component.modal-dealer')
@include('component.modal-position')
@include('component.modal-education')
@include('component.modal-gender')

@push('after-script')
    <script>
        // Show input resign date when status is resign
        $(document).ready(function(){
            $('#statusManpower').on('change', function(){
                let status = $('#statusManpower select').val();
                if (status == 'resign') {
                    $('#statusManpower').removeClass('col-md-4');
                    $('#statusManpower').addClass('col-md-2');
                    $('#resignDate').addClass('fadeInKanan');
                    $('#resignDate').css('display','block');
                }else{
                    $('#statusManpower').removeClass();
                    $('#statusManpower').addClass('col-md-4');
                    $('#resignDate').css('display','none');
                }
            });
        });

        // Form validation for resign date
        $(document).ready(function(){
            $('form').submit(function(e){
                let status = $('#statusManpower select').val();
                let resignDate = $('#resign_date').val();

                if (status == 'resign' && resignDate == '') {
                    e.preventDefault();
                    $('#resign_date').addClass('is-invalid');
                    $('#error-msg').text('field required');
                } else if (status != 'resign') {
                    $('#resign_date').val('');
                    $('form').submit();
                } else {
                    $('form').submit();
                }
            });
        });

        $(document).ready(function(){
            let status = $('#statusManpower select').val();
            if (status == 'resign') {
                $('#statusManpower').removeClass('col-md-4');
                $('#statusManpower').addClass('col-md-2');
                $('#resignDate').addClass('fadeInKanan');
                $('#resignDate').css('display','block');
            }
        });
    </script>
@endpush
