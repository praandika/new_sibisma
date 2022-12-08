@section('title','Edit Branch Delivery')
@section('page-title','Branch Delivery')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('branch-delivery.index') }}">Data Branch Delivery</a>
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
                    <h4 class="card-title">Edit Branch Delivery {{ $branchDelivery->out->frame_no }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('branch-delivery.update', $branchDelivery->id) }}" method="post">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="branch_delivery_date" type="date" class="form-control input-border-bottom"
                                name="branch_delivery_date"
                                value="{{ Session::has('input') ? Session::get('input.branch_delivery_date') : $branchDelivery->branch_delivery_date }}"
                                value="{{ $branchDelivery->branch_delivery_date }}" required>
                            <label for="branch_delivery_date" class="placeholder">Date</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="model_name" type="text" class="form-control input-border-bottom"
                                name="model_name"
                                value="{{ $branchDelivery->out->stock->unit->model_name }}" placeholder="Unit" readonly>
                            <label for="model_name" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="color" type="text" class="form-control input-border-bottom" name="color"
                                value="{{ $branchDelivery->out->stock->unit->color->color_name }}" placeholder="Color" readonly>
                            <label for="color" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="year_mc" type="number" class="form-control input-border-bottom" name="year_mc"
                                value="{{ $branchDelivery->out->stock->unit->year_mc }}" placeholder="Year MC" readonly>
                            <label for="year_mc" class="placeholder"></label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="frame_no" type="text" class="form-control input-border-bottom" name="frame_no"
                                value="{{ $branchDelivery->out->frame_no }}" placeholder="Frame No." readonly>
                            <label for="frame_no" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="dealer_name" type="text" class="form-control input-border-bottom"
                                name="dealer_name" value="{{ $branchDelivery->out->dealer->dealer_name }}" placeholder="Dealer's Name" readonly>
                            <label for="dealer_name" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="phone" type="text" class="form-control input-border-bottom" name="phone"
                                value="{{ $branchDelivery->out->dealer->phone }}" placeholder="Phone" readonly>
                            <label for="phone" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="address" type="text" class="form-control input-border-bottom" name="address"
                                value="{{ $branchDelivery->out->dealer->address }}" placeholder="Address" readonly>
                            <label for="address" class="placeholder"></label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="delivery_time" type="time" class="form-control input-border-bottom"
                                name="delivery_time" value="{{ $branchDelivery->delivery_time }}" required>
                            <label for="delivery_time" class="placeholder">Delivery Time *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="arrival_time" type="time" class="form-control input-border-bottom"
                                name="arrival_time" value="{{ $branchDelivery->arrival_time }}">
                            <label for="arrival_time" class="placeholder">Arrival Time</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="main_driver" name="main_driver" value="{{ $branchDelivery->main_driver }}"
                                required>
                            <input id="driver_name" type="text" class="form-control input-border-bottom"
                                name="driver_name" value="{{ $branchDelivery->mainDriver->name }}" data-toggle="modal"
                                data-target=".modalMainDriver" required>
                            <label for="driver_name" class="placeholder">Select Driver *</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="backup_driver" name="backup_driver"
                                value="{{ $branchDelivery->backup_driver }}" required>
                            <input id="pic_name" type="text" class="form-control input-border-bottom" name="pic_name"
                                value="{{ $branchDelivery->backupDriver->name }}" data-toggle="modal" data-target=".modalBackupDriver"
                                required>
                            <label for="pic_name" class="placeholder">Select PIC *</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-floating-label">
                            <textarea id="note" type="text" class="form-control input-border-bottom"
                                name="note">{{ $branchDelivery->note }}</textarea>
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
