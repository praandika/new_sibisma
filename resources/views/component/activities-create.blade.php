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
    @section('button-title','Add Activities')
    @include('component.button-add')
@endpush

<div class="col-md-12" id="dataCreate" @if(Session::has('display')) style="display: block;" @else style="display: none;" @endif>
    <div class="card">
        <div class="card-header">
            <span id="color_code" style="
                width: 10px; height: 50%; 
                display: inline-block;
                position: absolute;
                left: 0px;
                top: 0px;">
            </span>
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title">Add New Activities</h4>
                </div>
                <div class="col-2">
                    <h4 class="card-title" style="text-align: right; cursor: pointer; color: red;" id="btnCloseCreate">
                        <i class="fas fa-times-circle"></i></h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('activities.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="start_date" type="date" class="form-control input-border-bottom"
                                name="start_date" value="{{ old('start_date') }}" required>
                            <label for="start_date" class="placeholder">Start Date *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="end_date" type="date" class="form-control input-border-bottom"
                                name="end_date" value="{{ old('end_date') }}" required>
                            <label for="end_date" class="placeholder">End Date *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="acttype_id" name="acttype_id" value="{{ old('acttype_id') }}" required>
                            <input id="type_activity" type="text" class="form-control input-border-bottom"
                                name="type_activity" value="{{ old('type_activity') }}" data-toggle="modal"
                                data-target=".modalData" style="text-transform: uppercase;" required>
                            <label for="type_activity" class="placeholder">Type of Activity</label>
                        </div>
                    </div>

                    @if(Auth::user()->access == 'master' || Auth::user()->access == 'promotion')
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="dealer_id" name="dealer_id" value="{{ old('dealer_id') }}" required>
                            <input type="hidden" id="dealer_code" name="dealer_code" value="{{ old('dealer_code') }}" required>
                                <input id="dealer_name" type="text" class="form-control input-border-bottom"
                                    name="dealer_name" value="{{ old('dealer_name') }}" data-toggle="modal"
                                    data-target=".modalDealer" style="text-transform: uppercase;" required>
                                <label for="dealer" class="placeholder">Dealer *</label>
                            </div>
                    </div>
                    @else
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="dealer_id" name="dealer_id" value="{{ $dealerCode }}" required> 
                                <input id="dealer_name" type="text" class="form-control input-border-bottom"
                                    name="dealer_name" value="{{ $dealerName }}" style="text-transform: uppercase;" required>
                                <label for="dealer_name" class="placeholder">Dealer *</label>
                            </div>
                    </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-floating-label">
                            <textarea name="note_event" id="note_event" cols="30" rows="10" maxlength="100"
                                class="form-control input-border-bottom" placeholder="Note Event"
                                value="{{ old('note_event') }}"
                                style="border: 1px dashed #e6e6e6; padding: 10px;"></textarea>
                            <label for="note_event" class="placeholder"></label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

@section('modal-title','Data Activity Type')
@include('component.modal-data')
@include('component.modal-dealer')

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
