@push('button')
    @section('button-title','Add New User')
    @include('component.button-add')
@endpush

<div class="col-md-12" id="dataCreate" @if(Session::has('display')) style="display: block;" @else style="display: none;" @endif>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title">Add New User</h4>
                </div>
                <div class="col-2">
                    <h4 class="card-title" style="text-align: right; cursor: pointer; color: red;" id="btnCloseCreate">
                        <i class="fas fa-times-circle"></i></h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="first_name" type="text" class="form-control input-border-bottom"
                                name="first_name" value="{{ old('first_name') }}" autofocus required>
                            <label for="first_name" class="placeholder">First Name *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="last_name" type="text" class="form-control input-border-bottom"
                                name="last_name" value="{{ old('last_name') }}" required>
                            <label for="last_name" class="placeholder">Last Name *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="username" type="text" class="form-control input-border-bottom"
                                name="username" value="{{ old('username') }}" required>
                            <label for="username" class="placeholder">Username *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="email" type="email" class="form-control input-border-bottom"
                                name="email" value="{{ old('email') }}" required>
                            <label for="email" class="placeholder">Email *</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="dealer_code" type="text" class="form-control input-border-bottom"
                                name="dealer_code" value="{{ old('dealer_code') }}" data-toggle="modal"
                                data-target=".modalDealer" required>
                            <label for="dealer_code" class="placeholder">Select Dealer *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="password" type="password" class="form-control input-border-bottom"
                                name="password" value="{{ old('password') }}" required>
                            <label for="password" class="placeholder">Password *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="confirm" type="password" class="form-control input-border-bottom"
                                name="confirm" value="{{ old('confirm') }}" required>
                            <label for="confirm" class="placeholder">Retype Password *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="access" type="text" class="form-control input-border-bottom"
                                name="access" value="{{ old('access') }}" data-toggle="modal"
                                data-target=".modalAccess" required>
                            <label for="access" class="placeholder">Select Access *</label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

@include('component.modal-dealer')
@include('component.modal-access')

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
