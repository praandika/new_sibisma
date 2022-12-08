@section('title','Detail Stock')
@section('page-title','Stock')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('stock.index') }}">Data Stock</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Detail</a>
</li>
@endpush

<div class="col-md-12" id="dataCreate">
    <div class="card">
        <div class="card-header">
            <span style="background-color: <?php echo $stock->unit->color->color_code ?>;
        width: 10px; height: 50%; 
        display: inline-block;
        position: absolute;
        left: 0px;
        top: 0px;"></span>
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title">Detail {{ $stock->unit->model_name }}</h4>
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
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-motorcycle"
                                                    style="color: <?php echo ($stock->unit->color->color_code == '#FFFFFF') || ($stock->unit->color->color_code == '#ffffff') || ($stock->unit->color->color_code == '#fff') || ($stock->unit->color->color_code == 'white') ? '#000' : $stock->unit->color->color_code ?>;"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Stocks</p>
                                                <h4 class="card-title">{{ $stock->qty }}<span class="card-category">
                                                        Unit(s)</span></h4>
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
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-tint" style="color: <?php echo ($stock->unit->color->color_code == '#FFFFFF') || ($stock->unit->color->color_code == '#ffffff') || ($stock->unit->color->color_code == '#fff') || ($stock->unit->color->color_code == 'white') ? '#000' : $stock->unit->color->color_code ?>;"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Other Colors</p>
                                                @if($otherColors->count() <= 1)
                                                    <p class="card-category">No other color</p>
                                                @else
                                                    @forelse($otherColors as $o)
                                                    <span class="card-category" style="background-color: <?php echo $o->unit->color->color_code ?>50; padding: 5px; display: <?php echo $o->unit->color->color_name == $stock->unit->color->color_name ? 'none' : 'inline-block' ?>; transform: skewX(-12deg); font-size: 10px; margin-bottom: 3px;">{{ $o->unit->color->color_name }}</span>
                                                    @empty
                                                    <p class="card-category">No other color</p>
                                                    @endforelse
                                                @endif
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
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-warehouse"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Other Dealers</p>
                                                @if($otherDealers->count() <= 1)
                                                    <p class="card-category">No other dealer</p>
                                                @else
                                                    @forelse($otherDealers as $o)
                                                    <span class="card-category" style="display: <?php echo $o->dealer->dealer_name == $stock->dealer->dealer_name ? 'none' : 'block' ?>;">- {{ $o->dealer->dealer_name }}</span>
                                                    @empty
                                                    <p class="card-category">No other dealer</p>
                                                    @endforelse
                                                @endif
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
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-cogs"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Other Assembly Year</p>
                                                @if($otherYears->count() <= 1)
                                                    <p class="card-category">No other assembly year</p>
                                                @else
                                                    @forelse($otherYears as $o)
                                                    <span class="card-category" style="display: <?php echo $o->unit->year_mc == $stock->unit->year_mc ? 'none' : 'block' ?>;">- {{ $o->unit->year_mc }}</span>
                                                    @empty
                                                    <p class="card-category">No other assembly year</p>
                                                    @endforelse
                                                @endif
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
                <div class="col-md-4">
                    <div class="card card-post card-round">
                        <img class="card-img-top"
                            src="{{ $stock->unit->image == '' ? asset('img/nopict.jpg') : asset('img/motorcycle/'.$stock->unit->image.'') }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <div class="separator-solid"></div>
                            <input type="hidden" value="{{ $stock->unit->image }}" name="img_prev">
                            <!-- <p class="card-category text-info mb-1"><a href="#">File name :
                                    {{ $stock->unit->image == '' ? 'No image available' : $stock->unit->image }}</a></p> -->
                            <h3 class="card-title">
                                <a href="#">
                                    {{ $stock->unit->model_name }}
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group form-group-default">
                        <label>Model Name</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $stock->unit->model_name }}
                        </p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Category</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $stock->unit->category }}
                        </p>
                    </div>

                    <div class="form-group form-group-default"
                        style="background-color: <?php echo $stock->unit->color->color_code ?>50;">
                        <label>Color</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">
                            {{ $stock->unit->color->color_name }}
                        </p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Year MC</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $stock->unit->year_mc }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Price</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">Rp
                            {{  number_format($stock->unit->price, 0, ',','.')  }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Contact {{ $stock->dealer->dealer_name }}</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">
                            <a href="https://wa.me/{{ $stock->dealer->phone2 }}?text=_Pesan%20dari%20sibisma_%0AStok%20*{{ $stock->unit->model_name }}%20{{ $stock->unit->color->color_name }}*%20masih%20ada?@if($stock->unit->image == 'noimage.jpg' || $stock->unit->image == '')%0ATerimakasih @else%0ACheck%20detail:%0A%0Ahttps://sibisma.yamahabismagroup.com/public/search/{{ $stock->unit->image }} @endif" class="btnAction" data-toggle="tooltip"
                            data-placement="top" title="Ask to Branch Head" style="color:green; text-decoration:none; font-weight: bold;" target="_blank"><i
                            class="fab fa-whatsapp"></i> {{ $stock->dealer->phone2 }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
