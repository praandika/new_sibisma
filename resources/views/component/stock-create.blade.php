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

@push('button')
    @if(Auth::user()-> access != 'salesman')
        @section('button-title','Add New Stock')
        @include('component.button-add')
    @endif
    @include('component.button-print')
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
                    <h4 class="card-title">Add New Stock</h4>
                </div>
                <div class="col-2">
                    <h4 class="card-title" style="text-align: right; cursor: pointer; color: red;" id="btnCloseCreate">
                        <i class="fas fa-times-circle"></i></h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('stock.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="unit_id" name="unit_id" value="{{ old('unit_id') }}" required>
                            <input id="model_name" type="text" class="form-control input-border-bottom"
                                name="model_name" value="{{ old('model_name') }}" data-toggle="modal"
                                data-target=".modalData" style="text-transform: uppercase;" required>
                            <label for="model_name" class="placeholder">Select Unit</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="color" type="text" class="form-control input-border-bottom" name="color"
                            value="{{ old('color') }}" placeholder="Color" style="text-transform: uppercase;">
                            <label for="color" class="placeholder"></label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="year_mc" type="number" class="form-control input-border-bottom" name="year_mc" value="{{ old('year_mc') }}"
                                placeholder="Year MC" style="text-transform: uppercase;">
                            <label for="year_mc" class="placeholder"></label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @if(Auth::user()->access == 'master')
                    <div class="col-md-8">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="dealer_id" name="dealer_id" value="{{ old('dealer_id') }}" required>
                                <input id="dealer_name" type="text" class="form-control input-border-bottom"
                                    name="dealer_name" value="{{ old('dealer_name') }}" data-toggle="modal"
                                    data-target=".modalDealer" style="text-transform: uppercase;" required>
                                <label for="dealer_name" class="placeholder">Select Dealer *</label>
                            </div>
                    </div>
                    @else
                    <div class="col-md-8">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="dealer_id" name="dealer_id" value="{{ $dealerId }}" required>
                                <input id="dealer_name" type="text" class="form-control input-border-bottom"
                                    name="dealer_name" value="{{ $dealerName }}" style="text-transform: uppercase;" required>
                                <label for="dealer_name" class="placeholder">Select Dealer *</label>
                            </div>
                    </div>
                    @endif

                    <!-- <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="qty" type="number" class="form-control input-border-bottom"
                                name="qty" value="{{ old('qty') }}" placeholder="Qty (optional)">
                            <label for="qty" class="placeholder"></label>
                        </div>
                    </div> -->
                </div>

                <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

@section('modal-title','Data Unit')
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
