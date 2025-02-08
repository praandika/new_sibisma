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
    <a href="#">{{ $o->status }}</a>
</li>
@endpush

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
                    <h4 class="card-title">{{ $o->model_name }}</h4>
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
                                                <p style="font-size: 11px; font-weight: bold;" class="card-title">{{ $o->color }}</p>
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
                                                <p style="font-size: 11px; font-weight: bold;" class="card-title">{{ $o->gudang }}</p>
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
                                                <p style="font-size: 11px; font-weight: bold;" class="card-title">{{ $o->year_mc }}</p>
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
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $o->in_date }}
                        </p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Engine No.</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $o->engine_no }}
                        </p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Frame No.</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $o->frame_no }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Penanggung Jawab</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $o->pic }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach