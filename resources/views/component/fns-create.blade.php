@section('title','Faktur & Service')
@section('page-title','Faktur & Service')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('report.stock-history') }}">Data Stock History</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Edit</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title">Add Faktur & Service | {{ $stockHistory->dealer_code }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group form-floating-label">
                        <input id="date" type="text" class="form-control input-border-bottom"
                            value="{{ $stockHistory->history_date }}" required>
                        <label for="date" class="placeholder">Date</label>
                    </div>
                </div>
            </div>
            <form action="{{ route('stock-history.update', $stockHistory->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-floating-label">
                            <input id="faktur" type="number" class="form-control input-border-bottom" name="faktur"
                                value="{{ old('faktur') }}" required>
                            <label for="faktur" class="placeholder">Faktur</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group form-floating-label">
                            <input id="service" type="number" class="form-control input-border-bottom" name="service"
                                required>
                            <label for="service" class="placeholder">Service</label>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin: 10px 10px;">
                    <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                    <button type="reset" class="btn btn-default" style="margin-left: 2px;"><i
                            class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
