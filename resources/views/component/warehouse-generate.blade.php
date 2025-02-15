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
                            <input type="hidden" id="gudang_id" name="gudang_id" value="{{ old('gudang_id') }}" required>
                            <input id="gudang_name" type="text" class="form-control input-border-bottom"
                                name="gudang_name" data-toggle="modal"
                                data-target=".modalGudang" value="{{ old('gudang_name') }}" style="text-transform: uppercase;" required>
                            <label for="baris" class="placeholder">Pilih Gudang *</label>
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
