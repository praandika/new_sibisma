
@section('title','Warehouse Entry')
@section('page-title','Warehouse')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('warehouse.index') }}">{{ $dealerName }}</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Entry</a>
</li>
@endpush

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
                <div class="col-10">
                    <h4 class="card-title">
                        <span style="font-weight: bold;">{{ $gudang }}</span>
                        <div style="font-size: 14px;"> {{ $firstName }} - {{ $code }}</div>
                    </h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('warehouse.store') }}" method="post">
                @csrf
                <input type="hidden" name="code" value="{{ $code }}">
                <input type="hidden" name="pic" value="{{ $firstName }}">
                <input type="hidden" name="gudang" value="{{ $gudang }}">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="allocation_date" type="date" class="form-control input-border-bottom"
                                name="allocation_date" value="{{ $today }}" required>
                            <label for="allocation_date" class="placeholder">Date * (m/d/Y)</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label" style="background-color: #3c91fa50 ;">
                            <input id="model_name" type="text" class="form-control input-border-bottom"
                                name="model_name" value="{{ old('model_name') }}" data-toggle="modal"
                                data-target=".modalData" style="text-transform: uppercase;" required>
                            <label for="model_name" class="placeholder">Select Unit</label>
                        </div>
                    </div>
                </div>
                <span id="color" style="display: inline-block; margin-left: 10px; margin-top: -5px; font-size: 11px; background-color: grey; padding: 0px 10px; color: white; "></span>
                <span id="year_mc" style="display: inline-block; margin-left: 10px; margin-top: -5px; font-size: 11px; background-color: grey; padding: 0px 10px; color: white; "></span>
                <hr>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label" style="background-color: #fad43c50 ;">
                            <input id="engine_no" type="text" class="form-control input-border-bottom" name="engine_no" value="{{ old('engine_no') }}"
                                style="text-transform: uppercase;" required>
                            <label for="engine_no" class="placeholder">Engine No <span style="color: red;">*</span></label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="frame_no" type="text" class="form-control input-border-bottom" name="frame_no" value="{{ old('frame_no') }}"
                                style="text-transform: uppercase;" required>
                            <label for="frame_no" class="placeholder">Frame No (opsional)</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="dealer_code" name="dealer_code" value="{{ $dc }}" required> 
                                <input id="dealer_name" type="hidden" class="form-control input-border-bottom"
                                    name="dealer_name" value="{{ $dealerName }}" style="text-transform: uppercase;" readonly required>
                            </div>
                    </div>
                </div>

                <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
            </form>
        </div>
    </div>
</div>

@section('modal-title','Data Unit')
@include('component.modal-data')
