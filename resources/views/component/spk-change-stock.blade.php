@push('after-css')
<style>
    input[type=date]:required:invalid::-webkit-datetime-edit {
        color: transparent;
    }

    input[type=date]:focus::-webkit-datetime-edit {
        color: black !important;
    }

    ::-webkit-input-placeholder {
        /* WebKit browsers */
        text-transform: none;
    }

    :-moz-placeholder {
        /* Mozilla Firefox 4 to 18 */
        text-transform: none;
    }

    ::-moz-placeholder {
        /* Mozilla Firefox 19+ */
        text-transform: none;
    }

    :-ms-input-placeholder {
        /* Internet Explorer 10+ */
        text-transform: none;
    }

    ::placeholder {
        /* Recent browsers */
        text-transform: none;
    }

    input {
        background-color: #fffbeb !important;
    }

    .star {
        color: red;
    }

</style>
@endpush

@section('title','Request Stock SPK')
@section('page-title','Request Stock SPK')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('dashboard') }}">Dashboard</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Approve Request Stock</a>
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
            <div class="row" style="padding-left: 20px;">
                <h4 class="card-title">Request Stock SPK</h4>
            </div>
            <div class="row" style="padding-left: 20px;">
                <div style="font-size: 12px; font-weight: bold;">{{ $spk_no }}</div>
            </div>
            <div class="row" style="padding-left: 20px;">
                <div style="font-size: 12px;">from Dealer: {{ $dealer_code }}</div>
            </div>
        </div>

        <!-- START FORM -->
        <div class="card-body">
            @foreach($spk as $o)
            <form action="{{ route('spk.process-change-stock', [
                'spk_no' => $o->spk_no,
                'dealer_code' => $o->dealer_code
                ]) }}" method="post" id="form" enctype="multipart/form-data">
                @csrf

                <!-- HIDE CARD -->
                <div id="fieldForm">
                    <div class="row">
                        <!-- MODEL MOTOR -->
                        <div class="col-md-3">
                            <div class="card card-dark bg-primary-gradient bubble-shadow">
                                <div class="form-group">
                                    <label for="model_name" style="color: white !important;">Motor <span
                                            class="star">*</span></label>
                                    <span id="stockStatus">
                                        @if($o->order_status == 'INDENT')
                                        <span class="badge badge-warning">INDENT</span>
                                        @elseif($o->order_status == 'READY')
                                        <span class="badge badge-success">READY</span>
                                        @else
                                        <span class="badge badge-danger">EMPTY</span>
                                        @endif
                                    </span>
                                    <input id="model_name" type="text" class="form-control form-control-sm"
                                        name="model_name" value="{{ $o->model_name }}"
                                        style="text-transform: uppercase; cursor: pointer;" data-toggle="modal"
                                        data-target=".modalChangeStock" required readonly>

                                    <span id="frameStatus" style="color: white; font-size: 12px; font-weight: bold;">
                                        {{ $o->frame_no }}
                                    </span>
                                    <div>
                                        <span id="engineStatus" style="color: white; font-size: 12px;">
                                            {{ $o->engine_no }}
                                        </span>
                                        <span id="colorStatus"
                                            style="color: white; font-size: 12px; font-weight: bold;">
                                            {{ $o->faktur_color }}
                                        </span>
                                        <span id="yearStatus" style="color: white; font-size: 12px;">
                                            {{ $o->year_mc }}
                                        </span>
                                    </div>
                                    
                                    <!-- DEALER NAME STOCK -->
                                    <input id="dealer_name" type="hidden" class="form-control form-control-sm"
                                        name="dealer_name" value="{{ $o->dealer_name }}"
                                        style="text-transform: uppercase;" required readonly>

                                    <!-- FRAME NO -->
                                    <input id="frame_no" type="hidden" class="form-control form-control-sm"
                                        name="frame_no" value="{{ $o->frame_no }}"
                                        style="text-transform: uppercase;" required readonly>
                                    
                                    <!-- ENGINE NO -->
                                    <input id="engine_no" type="hidden" class="form-control form-control-sm"
                                        name="engine_no" value="{{ $o->engine_no }}"
                                        style="text-transform: uppercase;" required readonly>

                                    <!-- COLOR -->
                                    <input id="color" type="hidden" class="form-control form-control-sm"
                                        name="color" value="{{ $o->color }}"
                                        style="text-transform: uppercase;" required readonly>

                                    <!-- YEAR -->
                                    <input id="year" type="hidden" class="form-control form-control-sm"
                                        name="year" value="{{ $o->year }}"
                                        style="text-transform: uppercase;" required readonly>

                                    <!-- PRICE -->
                                    <input id="price" type="hidden" class="form-control form-control-sm"
                                        name="price" value="{{ $o->price }}"
                                        style="text-transform: uppercase;" required readonly>

                                    <!-- REQUEST FROM DEALER CODE ? -->
                                    <input id="point_code" type="hidden" class="form-control form-control-sm"
                                        name="point_code" value="{{ $dealer_code }}"
                                        style="text-transform: uppercase;" required readonly>

                                    <input type="hidden" id="model_name_filter" value="{{ $model }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="col-md-12" style="margin-left: -15px;">
                    <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Approve Stock</button>
                </div>

            </form>
            <!-- END FORM -->
            @endforeach
        </div>
    </div>

    @include('component.modal-change-stock')

    
