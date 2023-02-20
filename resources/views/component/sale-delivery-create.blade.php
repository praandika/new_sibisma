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
@section('button-title','Sale Delivery History')
@include('component.button-history')
@endpush

<div class="col-md-12" id="dataCreate">
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
                <div class="col-12">
                    <h4 class="card-title">Add Sale Delivery</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('sale-delivery.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="sale_delivery_date" type="date" class="form-control input-border-bottom"
                                name="sale_delivery_date"
                                value="{{ Session::has('input') ? Session::get('input.sale_delivery_date') : $today }}"
                                value="{{ old('sale_delivery_date') }}" required>
                            <label for="sale_delivery_date" class="placeholder">Date *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="sale_id" name="sale_id" value="{{ old('sale_id') }}" required>
                            <input id="model_name" type="text" class="form-control input-border-bottom"
                                name="model_name" data-toggle="modal" data-target=".modalData"
                                value="{{ old('model_name') }}" style="text-transform: uppercase;" required>
                            <label for="model_name" class="placeholder">Select Unit Sold *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="color" type="text" class="form-control input-border-bottom" name="color"
                                value="{{ old('color') }}" placeholder="Color *" style="text-transform: uppercase;">
                            <label for="color" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="year_mc" type="number" class="form-control input-border-bottom" name="year_mc"
                                value="{{ old('year_mc') }}" placeholder="Year MC *" style="text-transform: uppercase;">
                            <label for="year_mc" class="placeholder"></label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="frame_no" type="text" class="form-control input-border-bottom" name="frame_no"
                                value="{{ old('frame_no') }}" placeholder="Frame No." style="text-transform: uppercase;">
                            <label for="frame_no" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="customer_name" type="text" class="form-control input-border-bottom"
                                name="customer_name" value="{{ old('customer_name') }}" placeholder="Customer's Name" style="text-transform: uppercase;">
                            <label for="customer_name" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="phone" type="text" class="form-control input-border-bottom" name="phone"
                                value="{{ old('phone') }}" placeholder="Phone" style="text-transform: uppercase;">
                            <label for="phone" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="address" type="text" class="form-control input-border-bottom" name="address"
                                value="{{ old('address') }}" placeholder="Address" style="text-transform: uppercase;">
                            <label for="address" class="placeholder"></label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="delivery_time" type="time" class="form-control input-border-bottom"
                                name="delivery_time" value="{{ old('delivery_time') }}" value="{{ $time }}" style="text-transform: uppercase;" required>
                            <label for="delivery_time" class="placeholder">Delivery Time *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="arrival_time" type="time" class="form-control input-border-bottom"
                                name="arrival_time" value="{{ old('arrival_time') }}" value="{{ $time }}" style="text-transform: uppercase;">
                            <label for="arrival_time" class="placeholder">Arrival Time</label>
                        </div>
                    </div> -->

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="main_driver" name="main_driver" value="{{ old('main_driver') }}"
                                required>
                            <input id="driver_name" type="text" class="form-control input-border-bottom"
                                name="driver_name" value="{{ old('driver_name') }}" data-toggle="modal"
                                data-target=".modalMainDriver" style="text-transform: uppercase;" required>
                            <label for="driver_name" class="placeholder">Select Driver *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="backup_driver" name="backup_driver"
                                value="{{ old('backup_driver') }}" required>
                            <input id="pic_name" type="text" class="form-control input-border-bottom" name="pic_name"
                                value="{{ old('pic_name') }}" data-toggle="modal" data-target=".modalBackupDriver" style="text-transform: uppercase;"
                                required>
                            <label for="pic_name" class="placeholder">Select PIC *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="imagecheck mb-4">
                            <input name="selfpickup" type="checkbox" class="imagecheck-input">
                            <figure class="imagecheck-figure">
                                <img src="{{ asset('img/selfpickup.png') }}" alt="title" class="imagecheck-image">
                            </figure>
                        </label>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <textarea id="note" type="text" class="form-control input-border-bottom"
                                name="note" value="{{ old('note') }}"
                                placeholder="Note" style="text-transform: uppercase;"></textarea>
                            <label for="note" class="placeholder"></label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

@section('modal-title','Data Sale')
@include('component.modal-data')
@include('component.modal-main-driver')
@include('component.modal-backup-driver')
