@section('title','Detail Specification')
@section('page-title','Specification')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('specification.index') }}">Data Specification</a>
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
                    <h4 class="card-title">Detail {{ $specification->model_name }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <a href="{{ route('specification.edit', $specification->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"
                style="color: #000; font-size: 20px; text-decoration: none; font-weight: bold;"><i
                    class="fas fa-edit"></i> Edit</a>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group form-group-default">
                        <label>Model Name</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $specification->model_name }}</p>
                    </div>

                    <h1>Mesin</h1>
                    @foreach($mesin as $oTitle => $oSpec)
                    <div class="form-group form-group-default">
                        <label>{{ $oTitle }}</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $oSpec }}</p>
                    </div>
                    @endforeach

                    <h1>Rangka</h1>
                    @foreach($rangka as $oTitle => $oSpec)
                    <div class="form-group form-group-default">
                        <label>{{ $oTitle }}</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $oSpec }}</p>
                    </div>
                    @endforeach

                    <h1>Dimensi</h1>
                    @foreach($dimensi as $oTitle => $oSpec)
                    <div class="form-group form-group-default">
                        <label>{{ $oTitle }}</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $oSpec }}</p>
                    </div>
                    @endforeach

                    <h1>Kelistrikan</h1>
                    @foreach($kelistrikan as $oTitle => $oSpec)
                    <div class="form-group form-group-default">
                        <label>{{ $oTitle }}</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $oSpec }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
