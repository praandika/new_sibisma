<!-- Chart's container -->
<div class="col-sm-4">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Top Selling</h5>
                    <div class="card-category">{{ $dealerName }}</div>
                </div>
                <div class="col-md-6">
                    <div class="card-title" style="text-align: right; cursor: pointer; color: #ffffff;"
                            data-toggle="modal" data-target=".modalTopSelling">
                        <span class="bg-primary-gradient bubble-shadow" style="
                            padding: 10px; 
                            border-radius: 4px; 
                            box-shadow: -7px 12px 17px -3px rgba(0,0,0,0.29);
                            -webkit-box-shadow: -7px 12px 17px -3px rgba(0,0,0,0.29);
                            -moz-box-shadow: -7px 12px 17px -3px rgba(0,0,0,0.29);">
                            <i class="fa fa-eye"></i> See All
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="topProductChart" style="height: 300px;"></div>
        </div>
    </div>
</div>

<!-- MODAL -->
<div class="modal fade modalTopSelling" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Top Selling</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Bisma Group -->
                <a data-toggle="collapse" href="#bismaGroupSell" role="button" aria-expanded="false"
                    aria-controls="bismaGroupSell" style="text-decoration: none;">
                    <div class="card-header bg-primary-gradient skew-shadow">
                        <h4 class="card-title" style="color: #fff;">Bisma Group</h4>
                    </div>
                </a>

                <div class="card card-body">
                    <div class="collapse show" id="bismaGroupSell" style="margin-top: 10px; margin-bottom: 10px;">
                        @forelse($bismaGroup as $o)
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="{{ asset('img/motorcycle/'.$o->image.'') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ml-2">
                                <h6 class="fw-bold mb-1">{{ $o->model_name }}</h6>
                                <small class="text-muted">{{ $o->category }}</small>
                            </div>
                            <div class="d-flex ml-auto align-items-center">
                                <h3 class="text-info fw-bold">{{ $o->sum_qty }}</h3>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        @empty
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="{{ asset('img/yamaha-pic.jpg') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ml-2">
                                <h6 class="fw-bold mb-1">Model Name</h6>
                                <small class="text-muted">No Data Available</small>
                            </div>
                            <div class="d-flex ml-auto align-items-center">
                                <h3 class="text-info fw-bold">0</h3>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        @endif
                    </div>
                </div>
                <!-- END Bisma Group -->

                <!-- Bisma Sentral -->
                <a data-toggle="collapse" href="#bismaSentralSell" role="button" aria-expanded="false"
                    aria-controls="bismaSentralSell" style="text-decoration: none;">
                    <div class="card-header bg-dark-gradient skew-shadow">
                        <h4 class="card-title" style="color: #fff;">Bisma Sentral</h4>
                    </div>
                </a>

                <div class="card card-body">
                    <div class="collapse show" id="bismaSentralSell" style="margin-top: 10px; margin-bottom: 10px;">
                        @forelse($aa0101 as $o)
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="{{ asset('img/motorcycle/'.$o->image.'') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ml-2">
                                <h6 class="fw-bold mb-1">{{ $o->model_name }}</h6>
                                <small class="text-muted">{{ $o->category }}</small>
                            </div>
                            <div class="d-flex ml-auto align-items-center">
                                <h3 class="text-info fw-bold">{{ $o->sum_qty }}</h3>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        @empty
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="{{ asset('img/yamaha-pic.jpg') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ml-2">
                                <h6 class="fw-bold mb-1">Model Name</h6>
                                <small class="text-muted">No Data Available</small>
                            </div>
                            <div class="d-flex ml-auto align-items-center">
                                <h3 class="text-info fw-bold">0</h3>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        @endif
                    </div>
                </div>
                <!-- END Bisma Sentral -->

                <!-- Bisma Cokro -->
                <a data-toggle="collapse" href="#bismaCokroSell" role="button" aria-expanded="false"
                    aria-controls="bismaCokroSell" style="text-decoration: none;">
                    <div class="card-header bg-dark-gradient skew-shadow">
                        <h4 class="card-title" style="color: #fff;">Bisma Cokro</h4>
                    </div>
                </a>

                <div class="card card-body">
                    <div class="collapse show" id="bismaCokroSell" style="margin-top: 10px; margin-bottom: 10px;">
                        @forelse($aa0102 as $o)
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="{{ asset('img/motorcycle/'.$o->image.'') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ml-2">
                                <h6 class="fw-bold mb-1">{{ $o->model_name }}</h6>
                                <small class="text-muted">{{ $o->category }}</small>
                            </div>
                            <div class="d-flex ml-auto align-items-center">
                                <h3 class="text-info fw-bold">{{ $o->sum_qty }}</h3>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        @empty
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="{{ asset('img/yamaha-pic.jpg') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ml-2">
                                <h6 class="fw-bold mb-1">Model Name</h6>
                                <small class="text-muted">No Data Available</small>
                            </div>
                            <div class="d-flex ml-auto align-items-center">
                                <h3 class="text-info fw-bold">0</h3>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        @endif
                    </div>
                </div>
                <!-- END Bisma Cokro -->

                <!-- Bisma Hasanudin -->
                <a data-toggle="collapse" href="#bismaHasanudinSell" role="button" aria-expanded="false"
                    aria-controls="bismaHasanudinSell" style="text-decoration: none;">
                    <div class="card-header bg-dark-gradient skew-shadow">
                        <h4 class="card-title" style="color: #fff;">Bisma Hasanudin</h4>
                    </div>
                </a>

                <div class="card card-body">
                    <div class="collapse show" id="bismaHasanudinSell" style="margin-top: 10px; margin-bottom: 10px;">
                        @forelse($aa0104 as $o)
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="{{ asset('img/motorcycle/'.$o->image.'') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ml-2">
                                <h6 class="fw-bold mb-1">{{ $o->model_name }}</h6>
                                <small class="text-muted">{{ $o->category }}</small>
                            </div>
                            <div class="d-flex ml-auto align-items-center">
                                <h3 class="text-info fw-bold">{{ $o->sum_qty }}</h3>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        @empty
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="{{ asset('img/yamaha-pic.jpg') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ml-2">
                                <h6 class="fw-bold mb-1">Model Name</h6>
                                <small class="text-muted">No Data Available</small>
                            </div>
                            <div class="d-flex ml-auto align-items-center">
                                <h3 class="text-info fw-bold">0</h3>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        @endif
                    </div>
                </div>
                <!-- END Bisma Hasanudin -->

                <!-- Bisma TTS -->
                <a data-toggle="collapse" href="#bismaTTSSell" role="button" aria-expanded="false" aria-controls="bismaTTSSell"
                    style="text-decoration: none;">
                    <div class="card-header bg-dark-gradient skew-shadow">
                        <h4 class="card-title" style="color: #fff;">Bisma TTS</h4>
                    </div>
                </a>

                <div class="card card-body">
                    <div class="collapse show" id="bismaTTSSell" style="margin-top: 10px; margin-bottom: 10px;">
                        @forelse($aa0105 as $o)
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="{{ asset('img/motorcycle/'.$o->image.'') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ml-2">
                                <h6 class="fw-bold mb-1">{{ $o->model_name }}</h6>
                                <small class="text-muted">{{ $o->category }}</small>
                            </div>
                            <div class="d-flex ml-auto align-items-center">
                                <h3 class="text-info fw-bold">{{ $o->sum_qty }}</h3>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        @empty
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="{{ asset('img/yamaha-pic.jpg') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ml-2">
                                <h6 class="fw-bold mb-1">Model Name</h6>
                                <small class="text-muted">No Data Available</small>
                            </div>
                            <div class="d-flex ml-auto align-items-center">
                                <h3 class="text-info fw-bold">0</h3>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        @endif
                    </div>
                </div>
                <!-- END Bisma TTS -->

                <!-- Bisma Imbo -->
                <a data-toggle="collapse" href="#bismaImboSell" role="button" aria-expanded="false"
                    aria-controls="bismaImboSell" style="text-decoration: none;">
                    <div class="card-header bg-dark-gradient skew-shadow">
                        <h4 class="card-title" style="color: #fff;">Bisma Imbo</h4>
                    </div>
                </a>

                <div class="card card-body">
                    <div class="collapse show" id="bismaImboSell" style="margin-top: 10px; margin-bottom: 10px;">
                        @forelse($aa0106 as $o)
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="{{ asset('img/motorcycle/'.$o->image.'') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ml-2">
                                <h6 class="fw-bold mb-1">{{ $o->model_name }}</h6>
                                <small class="text-muted">{{ $o->category }}</small>
                            </div>
                            <div class="d-flex ml-auto align-items-center">
                                <h3 class="text-info fw-bold">{{ $o->sum_qty }}</h3>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        @empty
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="{{ asset('img/yamaha-pic.jpg') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ml-2">
                                <h6 class="fw-bold mb-1">Model Name</h6>
                                <small class="text-muted">No Data Available</small>
                            </div>
                            <div class="d-flex ml-auto align-items-center">
                                <h3 class="text-info fw-bold">0</h3>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        @endif
                    </div>
                </div>
                <!-- END Bisma Imbo -->

                <!-- Bisma Mandiri -->
                <a data-toggle="collapse" href="#bismaMandiriSell" role="button" aria-expanded="false"
                    aria-controls="bismaMandiriSell" style="text-decoration: none;">
                    <div class="card-header bg-dark-gradient skew-shadow">
                        <h4 class="card-title" style="color: #fff;">Bisma Mandiri</h4>
                    </div>
                </a>

                <div class="card card-body">
                    <div class="collapse show" id="bismaMandiriSell" style="margin-top: 10px; margin-bottom: 10px;">
                        @forelse($aa0107 as $o)
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="{{ asset('img/motorcycle/'.$o->image.'') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ml-2">
                                <h6 class="fw-bold mb-1">{{ $o->model_name }}</h6>
                                <small class="text-muted">{{ $o->category }}</small>
                            </div>
                            <div class="d-flex ml-auto align-items-center">
                                <h3 class="text-info fw-bold">{{ $o->sum_qty }}</h3>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        @empty
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="{{ asset('img/yamaha-pic.jpg') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ml-2">
                                <h6 class="fw-bold mb-1">Model Name</h6>
                                <small class="text-muted">No Data Available</small>
                            </div>
                            <div class="d-flex ml-auto align-items-center">
                                <h3 class="text-info fw-bold">0</h3>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        @endif
                    </div>
                </div>
                <!-- END Bisma Mandiri -->

                <!-- Bisma Supratman -->
                <a data-toggle="collapse" href="#bismaSupratmanSell" role="button" aria-expanded="false"
                    aria-controls="bismaSupratmanSell" style="text-decoration: none;">
                    <div class="card-header bg-dark-gradient skew-shadow">
                        <h4 class="card-title" style="color: #fff;">Bisma Supratman</h4>
                    </div>
                </a>

                <div class="card card-body">
                    <div class="collapse show" id="bismaSupratmanSell" style="margin-top: 10px; margin-bottom: 10px;">
                        @forelse($aa0108 as $o)
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="{{ asset('img/motorcycle/'.$o->image.'') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ml-2">
                                <h6 class="fw-bold mb-1">{{ $o->model_name }}</h6>
                                <small class="text-muted">{{ $o->category }}</small>
                            </div>
                            <div class="d-flex ml-auto align-items-center">
                                <h3 class="text-info fw-bold">{{ $o->sum_qty }}</h3>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        @empty
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="{{ asset('img/yamaha-pic.jpg') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ml-2">
                                <h6 class="fw-bold mb-1">Model Name</h6>
                                <small class="text-muted">No Data Available</small>
                            </div>
                            <div class="d-flex ml-auto align-items-center">
                                <h3 class="text-info fw-bold">0</h3>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        @endif
                    </div>
                </div>
                <!-- END Bisma Supratman -->

                <!-- Bisma Sunset Road -->
                <a data-toggle="collapse" href="#bismaSunsetRoadSell" role="button" aria-expanded="false"
                    aria-controls="bismaSunsetRoadSell" style="text-decoration: none;">
                    <div class="card-header bg-dark-gradient skew-shadow">
                        <h4 class="card-title" style="color: #fff;">Bisma Sunset Road</h4>
                    </div>
                </a>

                <div class="card card-body">
                    <div class="collapse show" id="bismaSunsetRoadSell" style="margin-top: 10px; margin-bottom: 10px;">
                        @forelse($aa0109 as $o)
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="{{ asset('img/motorcycle/'.$o->image.'') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ml-2">
                                <h6 class="fw-bold mb-1">{{ $o->model_name }}</h6>
                                <small class="text-muted">{{ $o->category }}</small>
                            </div>
                            <div class="d-flex ml-auto align-items-center">
                                <h3 class="text-info fw-bold">{{ $o->sum_qty }}</h3>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        @empty
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="{{ asset('img/yamaha-pic.jpg') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ml-2">
                                <h6 class="fw-bold mb-1">Model Name</h6>
                                <small class="text-muted">No Data Available</small>
                            </div>
                            <div class="d-flex ml-auto align-items-center">
                                <h3 class="text-info fw-bold">0</h3>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        @endif
                    </div>
                </div>
                <!-- END Bisma Sunset Road -->

                <!-- Bisma Dalung -->
                <a data-toggle="collapse" href="#bismaDalungSell" role="button" aria-expanded="false"
                    aria-controls="bismaDalungSell" style="text-decoration: none;">
                    <div class="card-header bg-dark-gradient skew-shadow">
                        <h4 class="card-title" style="color: #fff;">Bisma Dalung</h4>
                    </div>
                </a>

                <div class="card card-body">
                    <div class="collapse show" id="bismaDalungSell" style="margin-top: 10px; margin-bottom: 10px;">
                        @forelse($aa010401 as $o)
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="{{ asset('img/motorcycle/'.$o->image.'') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ml-2">
                                <h6 class="fw-bold mb-1">{{ $o->model_name }}</h6>
                                <small class="text-muted">{{ $o->category }}</small>
                            </div>
                            <div class="d-flex ml-auto align-items-center">
                                <h3 class="text-info fw-bold">{{ $o->sum_qty }}</h3>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        @empty
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="{{ asset('img/yamaha-pic.jpg') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ml-2">
                                <h6 class="fw-bold mb-1">Model Name</h6>
                                <small class="text-muted">No Data Available</small>
                            </div>
                            <div class="d-flex ml-auto align-items-center">
                                <h3 class="text-info fw-bold">0</h3>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        @endif
                    </div>
                </div>
                <!-- END Bisma Dalung -->

                <!-- Bisma FSS -->
                <a data-toggle="collapse" href="#bismaFSSSell" role="button" aria-expanded="false" aria-controls="bismaFSSSell"
                    style="text-decoration: none;">
                    <div class="card-header bg-dark-gradient skew-shadow">
                        <h4 class="card-title" style="color: #fff;">Bisma FSS</h4>
                    </div>
                </a>

                <div class="card card-body">
                    <div class="collapse show" id="bismaFSSSell" style="margin-top: 10px; margin-bottom: 10px;">
                        @forelse($aa0104F as $o)
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="{{ asset('img/motorcycle/'.$o->image.'') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ml-2">
                                <h6 class="fw-bold mb-1">{{ $o->model_name }}</h6>
                                <small class="text-muted">{{ $o->category }}</small>
                            </div>
                            <div class="d-flex ml-auto align-items-center">
                                <h3 class="text-info fw-bold">{{ $o->sum_qty }}</h3>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        @empty
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="{{ asset('img/yamaha-pic.jpg') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ml-2">
                                <h6 class="fw-bold mb-1">Model Name</h6>
                                <small class="text-muted">No Data Available</small>
                            </div>
                            <div class="d-flex ml-auto align-items-center">
                                <h3 class="text-info fw-bold">0</h3>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        @endif
                    </div>
                </div>
                <!-- END Bisma FSS -->

            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <p><strong>SiBisma</strong> v3.0 &copy; CRM Bisma | Est 2019</p>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL -->

@push('after-script')
<script>
    const chartTopProduct = new Chartisan({
        el: '#topProductChart',
        url: '@chart("top_product_chart")',
        hooks: new ChartisanHooks()
            .legend({
                position: 'bottom'
            })
            .datasets('pie')
            .axis(false)
            .tooltip(true)
    });
</script>
@endpush


