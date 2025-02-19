@section('title','Code Generator')
@section('page-title','Code Generator')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('warehouse.index') }}">{{ $dealerName }}</a>
</li>
@endpush

@push('after-css')
<style>
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
                    <h4 class="card-title">Generate Code</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('warehouse.generating') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="dealer" type="text" class="form-control input-border-bottom"
                                name="dealer" value="{{ $dealer }}" style="text-transform: uppercase;" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="model_name" name="model_name" value="{{ old('model_name') }}" required>
                            <input type="hidden" id="color" name="color" value="{{ old('color') }}" required>
                            <input type="hidden" id="year" name="year" value="{{ old('year') }}" required>
                            <input id="unit" type="text" class="form-control input-border-bottom"
                                name="unit" data-toggle="modal"
                                data-target=".modalGudang" value="{{ old('unit') }}" style="text-transform: uppercase;" required>
                            <label for="baris" class="placeholder">Pilih Unit *</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="baris" type="number" class="form-control input-border-bottom"
                                name="baris" value="{{ old('baris') }}" style="text-transform: uppercase;" required>
                            <label for="baris" class="placeholder">Jumlah QR *</label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Generate</button>
            </form>
        </div>
    </div>
</div>

@include('component.modal-gudang')
