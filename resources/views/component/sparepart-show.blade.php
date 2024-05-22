@section('title','Detail Sparepart')
@section('page-title','Sparepart')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('sparepart.index') }}">Data Sparepart</a>
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
                    <h4 class="card-title">Detail {{ $sparepart->model_name }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <a href="{{ route('sparepart.edit', $sparepart->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"
                style="color: #000; font-size: 20px; text-decoration: none; font-weight: bold;"><i
                    class="fas fa-edit"></i> Edit</a>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-post card-round">
                        <img class="card-img-top"
                            src="{{ $sparepart->image == '' ? asset('img/sparepart/noimage.jpg') : ($sparepart->image == 'noimage' ? asset('img/sparepart/noimage.jpg') : asset('img/sparepart/'.$sparepart->image.'')) }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <div class="separator-solid"></div>
                            <h3 class="card-title">
                                <a href="#">
                                    {{ $sparepart->model_name }}
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group form-group-default">
                        <label>Model Parts</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $sparepart->parts_name }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Category</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $sparepart->category }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Price</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">Rp
                            {{ $sparepart->price }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
