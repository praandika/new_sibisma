@section('title','Edit Sale Delivery')
@section('page-title','Sale Delivery')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('sale-delivery.index') }}">Data Sale Delivery</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Edit</a>
</li>
@endpush

<div class="col-md-12" id="dataCreate">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title">Edit Sale Delivery {{ $saleDelivery->sale->frame_no }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('sale-delivery.update', $saleDelivery->id) }}" method="post">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="sale_delivery_date" type="date" class="form-control input-border-bottom"
                                name="sale_delivery_date"
                                value="{{ Session::has('input') ? Session::get('input.sale_delivery_date') : $saleDelivery->sale_delivery_date }}"
                                value="{{ $saleDelivery->sale_delivery_date }}" required>
                            <label for="sale_delivery_date" class="placeholder">Date</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="model_name" type="text" class="form-control input-border-bottom"
                                name="model_name"
                                value="{{ $saleDelivery->sale->stock->unit->model_name }}" placeholder="Unit" readonly>
                            <label for="model_name" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="color" type="text" class="form-control input-border-bottom" name="color"
                                value="{{ $saleDelivery->sale->stock->unit->color->color_name }}" placeholder="Color" readonly>
                            <label for="color" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="year_mc" type="number" class="form-control input-border-bottom" name="year_mc"
                                value="{{ $saleDelivery->sale->stock->unit->year_mc }}" placeholder="Year MC" readonly>
                            <label for="year_mc" class="placeholder"></label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="frame_no" type="text" class="form-control input-border-bottom" name="frame_no"
                                value="{{ $saleDelivery->sale->frame_no }}" placeholder="Frame No." readonly>
                            <label for="frame_no" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="customer_name" type="text" class="form-control input-border-bottom"
                                name="customer_name" value="{{ $saleDelivery->sale->customer_name }}" placeholder="Customer's Name" readonly>
                            <label for="customer_name" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="phone" type="text" class="form-control input-border-bottom" name="phone"
                                value="{{ $saleDelivery->sale->phone }}" placeholder="Phone" readonly>
                            <label for="phone" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="address" type="text" class="form-control input-border-bottom" name="address"
                                value="{{ $saleDelivery->sale->address }}" placeholder="Address" readonly>
                            <label for="address" class="placeholder"></label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="delivery_time" type="time" class="form-control input-border-bottom"
                                name="delivery_time" value="{{ $saleDelivery->delivery_time }}" required>
                            <label for="delivery_time" class="placeholder">Delivery Time *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="arrival_time" type="time" class="form-control input-border-bottom"
                                name="arrival_time" value="{{ $saleDelivery->arrival_time }}">
                            <label for="arrival_time" class="placeholder">Arrival Time</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="main_driver" name="main_driver" value="{{ $saleDelivery->main_driver }}"
                                required>
                            <input id="driver_name" type="text" class="form-control input-border-bottom"
                                name="driver_name" value="{{ $saleDelivery->mainDriver->name }}" data-toggle="modal"
                                data-target=".modalMainDriver" required>
                            <label for="driver_name" class="placeholder">Select Driver *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="backup_driver" name="backup_driver"
                                value="{{ $saleDelivery->backup_driver }}" required>
                            <input id="pic_name" type="text" class="form-control input-border-bottom" name="pic_name"
                                value="{{ $saleDelivery->backupDriver->name }}" data-toggle="modal" data-target=".modalBackupDriver"
                                required>
                            <label for="pic_name" class="placeholder">Select PIC *</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-floating-label">
                            <textarea id="note" type="text" class="form-control input-border-bottom"
                                name="note">{{ $saleDelivery->note }}</textarea>
                            <label for="note" class="placeholder">Note</label>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin: 10px 10px;">
                    <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                    <button type="reset" class="btn btn-default" style="margin-left: 2px;"><i
                            class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('component.modal-main-driver')
@include('component.modal-backup-driver')
