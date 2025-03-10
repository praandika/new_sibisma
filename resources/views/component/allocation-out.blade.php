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

    a.btnAction {
        font-size: 20px;
    }
</style>
@endpush

@section('title','Allocation Out')
@section('page-title','Allocation Out')

@push('button')
    @include('component.button-search')
@endpush

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('allocation.out') }}">Data Allocation Out</a>
</li>
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
                    <h4 class="card-title">Allocation Out</h4>
                </div>
                <div class="col-2">
                    <h4 class="card-title" style="text-align: right; cursor: pointer; color: red;" id="btnCloseCreate">
                        <i class="fas fa-times-circle"></i></h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('allocation.storeout') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="allocation_date" type="date" class="form-control input-border-bottom"
                                name="allocation_date" value="{{ old('allocation_date') }}" autofocus required>
                            <label for="allocation_date" class="placeholder">Date *</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input type="hidden" name="id" id="id_allocation">
                            <input id="model_name" type="text" class="form-control input-border-bottom"
                                name="model_name" value="{{ old('model_name') }}" data-toggle="modal"
                                data-target=".modalData" style="text-transform: uppercase;" required>
                            <label for="model_name" class="placeholder">Select Allocation</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="color" type="text" class="form-control input-border-bottom" name="color"
                            value="{{ old('color') }}" placeholder="Color" style="text-transform: uppercase;">
                            <label for="color" class="placeholder"></label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="frame_no" type="text" class="form-control input-border-bottom" name="frame_no" value="{{ old('frame_no') }}"
                                style="text-transform: uppercase;" required>
                            <label for="frame_no" class="placeholder">Frame No*</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="engine_no" type="text" class="form-control input-border-bottom" name="engine_no" value="{{ old('engine_no') }}"
                                style="text-transform: uppercase;" required>
                            <label for="engine_no" class="placeholder">Engine No*</label>
                        </div>
                    </div>

                    @if(Auth::user()->access == 'master')
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="dealer_code" name="dealer_code" value="{{ old('dealer_code') }}" required>
                                <input id="dealer" type="text" class="form-control input-border-bottom"
                                    name="dealer" value="{{ old('dealer') }}" data-toggle="modal"
                                    data-target=".modalDealer" style="text-transform: uppercase;" required>
                                <label for="dealer" class="placeholder">Dealer *</label>
                            </div>
                    </div>
                    @else
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="dealer_code" name="dealer_code" value="{{ $dealerCode }}" required>
                                <input id="dealer_name" type="text" class="form-control input-border-bottom"
                                    name="dealer_name" value="{{ $dealerName }}" style="text-transform: uppercase;" required>
                                <label for="dealer_name" class="placeholder">Dealer *</label>
                            </div>
                    </div>
                    @endif
                </div>

                <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">

        <livewire:widget-allocation>
        <livewire:info-allocation-in>
        <livewire:info-allocation-out>
                <h4 class="card-title">Allocation Out Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Date Out</th>
                            <th>Model Name</th>
                            <th>Color</th>
                            <th>Frame No</th>
                            <th>Engine No</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Date Out</th>
                            <th>Model Name</th>
                            <th>Color</th>
                            <th>Frame No</th>
                            <th>Engine No</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($data as $o)
                        <tr>
                            <td>{{ $o->allocation_out_date }}</td>
                            <td>{{ $o->model_name }}</td>
                            <td>{{ $o->color }}</td>
                            <td>{{ $o->frame_no }}</td>
                            <td>{{ $o->engine_no }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ url('allocation-out/'.$o->out_status.'/'.$o->id.'') }}"
                                        class="btnAction" data-toggle="tooltip" data-placement="top" title="Delete"
                                        style="color:crimson;"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center;">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@section('modal-title','Data Allocation')
@include('component.modal-data')

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
