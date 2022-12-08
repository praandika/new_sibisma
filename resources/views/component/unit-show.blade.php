@section('title','Detail Unit')
@section('page-title','Unit')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('unit.index') }}">Data Unit</a>
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
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title">Detail {{ $unit->model_name }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <a href="{{ route('unit.edit', $unit->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"
                style="color: #000; font-size: 20px; text-decoration: none; font-weight: bold;"><i
                    class="fas fa-edit"></i> Edit</a>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-post card-round">
                        <img class="card-img-top"
                            src="{{ $unit->image == '' ? asset('img/motorcycle/noimage.jpg') : ($unit->image == 'noimage' ? asset('img/motorcycle/noimage.jpg') : asset('img/motorcycle/'.$unit->image.'')) }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <div class="separator-solid"></div>
                            <h3 class="card-title">
                                <a href="#">
                                    {{ $unit->model_name }}
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group form-group-default">
                        <label>Model Name</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $unit->model_name }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Category</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $unit->category }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Color</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $unit->color->color_name }}
                        </p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Year MC</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $unit->year_mc }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Price</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">Rp
                            {{  number_format($unit->price, 0, ',','.')  }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
