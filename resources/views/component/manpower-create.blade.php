@push('after-css')
<style>
    input[type=date]:required:invalid::-webkit-datetime-edit {
        color: transparent;
    }
    input[type=date]:focus::-webkit-datetime-edit {
        color: black !important;
    }
    ::-webkit-input-placeholder { /* WebKit browsers */
        text-transform: none;
    }
    :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
        text-transform: none;
    }
    ::-moz-placeholder { /* Mozilla Firefox 19+ */
        text-transform: none;
    }
    :-ms-input-placeholder { /* Internet Explorer 10+ */
        text-transform: none;
    }
    ::placeholder { /* Recent browsers */
        text-transform: none;
    }
</style>
@endpush

@push('button')
    @section('button-title','Add New Manpower')
    @include('component.button-add')
@endpush

<div class="col-md-12" id="dataCreate" @if(Session::has('display')) style="display: block;" @else style="display: none;" @endif>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title">Add New Manpower</h4>
                </div>
                <div class="col-2">
                    <h4 class="card-title" style="text-align: right; cursor: pointer; color: red;" id="btnCloseCreate">
                        <i class="fas fa-times-circle"></i></h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('manpower.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                @if(Auth::user()->dealer_code == 'group')
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="dealer_id" name="dealer_id" value="{{ old('dealer_id') }}" required>
                            <input id="dealer_name" type="text" class="form-control input-border-bottom"
                                    name="dealer_name" value="{{ old('dealer_name') }}" data-toggle="modal"
                                    data-target=".modalDealer" style="text-transform: uppercase;" required>
                            <label for="dealer_name" class="placeholder">Select Dealer *</label>
                        </div>
                    </div>
                @else
                    <input type="hidden" id="dealer_id" name="dealer_id" value="{{ $dealer }}" style="text-transform: uppercase;" required>
                @endif

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="name" type="text" class="form-control input-border-bottom"
                                name="name" value="{{ old('name') }}" style="text-transform: uppercase;" required>
                            <label for="name" class="placeholder">Name</label>
                        </div>
                    </div>

                    <div class="{{ Auth::user()->dealer_code == 'group' ? 'col-md-4' : 'col-md-8' }}">
                        <div class="form-group form-floating-label">
                            <input id="address" type="text" class="form-control input-border-bottom"
                                name="address" value="{{ old('address') }}" style="text-transform: uppercase;" required>
                            <label for="address" class="placeholder">Address</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="phone" type="text" class="form-control input-border-bottom"
                                name="phone" value="{{ old('phone') }}" style="text-transform: uppercase;" required>
                            <label for="phone" class="placeholder">Phone</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="birthday" type="date" class="form-control input-border-bottom"
                                name="birthday" value="{{ old('birthday') }}" style="text-transform: uppercase;" required>
                            <label for="birthday" class="placeholder">Birthday</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="gender" type="hidden" name="gender" value="{{ old('gender') }}" required>
                            <input id="gender_name" type="text" class="form-control input-border-bottom"
                                    name="gender_name" value="{{ old('gender_name') }}" data-toggle="modal"
                                    data-target=".modalGender" style="text-transform: uppercase;" required>
                            <label for="gender_name" class="placeholder">Select Gender *</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="join_date" type="date" class="form-control input-border-bottom"
                                name="join_date" value="{{ old('join_date') }}" style="text-transform: uppercase;" required>
                            <label for="join_date" class="placeholder">Join Date</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="position" type="text" class="form-control input-border-bottom"
                                    name="position" value="{{ old('position') }}" data-toggle="modal"
                                    data-target=".modalPosition" style="text-transform: uppercase;" required>
                            <label for="position" class="placeholder">Select Position *</label>
                        </div>
                    </div>
                    <input type="hidden" id="category" name="category" required>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="education" type="text" class="form-control input-border-bottom"
                                    name="education" value="{{ old('education') }}" data-toggle="modal"
                                    data-target=".modalEducation" style="text-transform: uppercase;" required>
                            <label for="education" class="placeholder">Select Education *</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="image" type="file" class="form-control input-border-bottom"
                                name="image" value="{{ old('image') }}">
                            <label for="image" class="placeholder">Photo for ID Card</label>

                            <span class="invalid-feedback">
                                <strong>format required: jpg|jpeg|png</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

@if(Auth::user()->dealer_code == 'group')
    @include('component.modal-dealer')
@endif
@include('component.modal-position')
@include('component.modal-education')
@include('component.modal-gender')

@push('after-script')
<script>
    $(document).ready(function () {
        $('#btnCreate').click(function () {
            $(this).css('display', 'none');
            $('#dataCreate').fadeIn();
        });

        $('#btnCloseCreate').click(function () {
            $('#dataCreate').css('display', 'none');
            $('#btnCreate').fadeIn();
        });
    });

</script>
@endpush
