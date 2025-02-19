@section('title','Info Unit')
@section('page-title','Unit')

@push('link-bread')
@foreach($data as $o)
<li class="nav-item">
    <a href="{{ route('warehouse.index') }}">{{ $o->code }}</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">
        @if($o->status == 'In Stock')
        <span style="padding: 5px 10px; background-color: #346eeb">
        {{ $o->status }}
        </span>
        @elseif($o->status == 'Move')
        <span style="padding: 5px 10px; background-color: #02ba3f">
        {{ $o->status }}
        </span>
        @else
        <span style="padding: 5px 10px; background-color: #eb4034">
        {{ $o->status }}
        </span>
        @endif
    </a>
</li>
@endpush

@push('after-css')
<style>
    .pulse {
        animation: pulse-animation 1s infinite;
    }

    @keyframes pulse-animation {
        0% {
            box-shadow: 0 0 0 0px rgba(235, 64, 52, 0.2);
        }
        100% {
            box-shadow: 0 0 0 20px rgba(0, 0, 0, 0);
        }
    }
</style>
@endpush

@if($o->status == 'In Stock' || $o->status == 'Move')
<div class="col-md-12" style="position: fixed; right: 0px; bottom: 300px; z-index: 999; width: 80px;">
    <a href="{{ route('warehouse.sell',$id) }}">
        <div style="
        width: 80px; 
        height: 60px; 
        background-color: #eb4034; 
        border-radius: 20px 10px 10px 20px; 
        margin-bottom: 20px;" 
        class="pulse">
            <span style="font-weight: bold; color: #fff; display: inline-block; padding-top: 18px; padding-left: 15px;">Sell</span>
        </div>
    </a>
    <div style="
    width: 80px; 
    height: 60px; 
    background-color: #346eeb; 
    border-radius: 20px 10px 10px 20px; 
    -webkit-box-shadow: -5px 6px 32px -16px rgba(0,0,0,0.75);
    -moz-box-shadow: -5px 6px 32px -16px rgba(0,0,0,0.75);
    box-shadow: -5px 6px 32px -16px rgba(0,0,0,0.75);" 
    data-toggle="modal"
    data-target=".modalMove">
        <span style="font-weight: bold; color: #fff; display: inline-block; padding-top: 18px; padding-left: 15px;">Move</span>
    </div>
</div>
@endif

<div class="col-md-12" id="dataCreate">
    <div class="card">
        <div class="card-header">
            <span style="background-color: <?php echo $o->color_code ?>;
        width: 10px; height: 50%; 
        display: inline-block;
        position: absolute;
        left: 0px;
        top: 0px;"></span>
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title" style="font-weight: bold;">{{ $o->model_name }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="row row-card-no-pd">
                        <div class="col-sm-6 col-md-6">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-tint"
                                                    style="color: <?php echo ($o->color_code == '#FFFFFF') || ($o->color_code == '#fff') || ($o->color_code == 'white') ? '#000' : $o->color_code ?>;"></i>
                                            </div>
                                        </div>
                                        <div class="col-9 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Color</p>
                                                <p style="font-size: 15px; font-weight: bold;" class="card-title">{{ $o->color_name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-warehouse"
                                                    style="color: <?php echo ($o->color_code == '#FFFFFF') || ($o->color_code == '#fff') || ($o->color_code == 'white') ? '#000' : $o->color_code ?>;"></i>
                                            </div>
                                        </div>
                                        <div class="col-9 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Gudang</p>
                                                <p style="font-size: 15px; font-weight: bold;" class="card-title">{{ $o->gudang }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-cogs"
                                                    style="color: <?php echo ($o->color_code == '#FFFFFF') || ($o->color_code == '#fff') || ($o->color_code == 'white') ? '#000' : $o->color_code ?>;"></i>
                                            </div>
                                        </div>
                                        <div class="col-9 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Tahun Kendaraan</p>
                                                <p style="font-size: 15px; font-weight: bold;" class="card-title">{{ $o->year_mc }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group form-group-default">
                        <label>Tanggal Masuk</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ \Carbon\Carbon::parse($o->in_date)->isoFormat('dddd, D MMMM Y') }}
                        </p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Engine No.</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $o->engine_no }}
                        </p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Frame No.</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $o->frame_no == '' ? 'N/A' : $o->frame_no }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Penanggung Jawab</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $o->pic }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Note</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $o->note }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@include('component.modal-move')