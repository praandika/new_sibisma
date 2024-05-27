@section('title','Detail Banner')
@section('page-title','Banner')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('banner.index') }}">Data Banner</a>
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
                    <h4 class="card-title">Detail {{ $banner->model_name }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <a href="{{ route('banner.edit', $banner->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"
                style="color: #000; font-size: 20px; text-decoration: none; font-weight: bold;"><i
                    class="fas fa-edit"></i> Edit</a>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-post card-round">
                        <img class="card-img-top"
                            src="{{ $banner->image == '' ? asset('img/banner/banner.png') : ($banner->image == 'banner.png' ? asset('img/banner/banner.png') : asset('img/banner/'.$banner->image.'')) }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <div class="separator-solid"></div>
                            <h3 class="card-title">
                                <a href="#">
                                    {{ $banner->title }}
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group form-group-default">
                        <label>Title</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $banner->title }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Link</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $banner->link }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Status</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ ucwords($banner->status) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
