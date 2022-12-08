@section('title','Edit Leasing')
@section('page-title','Leasing')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('leasing.index') }}">Data Leasing</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Edit</a>
</li>
@endpush

<div class="col-md-12" id="dataCreate">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title">Edit Leasing {{ $leasing->leasing_name }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('leasing.update', $leasing->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="wrapperInput">
                    <div class="row inputan">
                        <div class="col-md-6">
                            <div class="form-group form-floating-label">
                                <input id="leasing_code" type="text" class="form-control input-border-bottom"
                                    name="leasing_code" value="{{ $leasing->leasing_code }}" required>
                                <label for="leasing_code" class="placeholder">Leasing Code</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group form-floating-label">
                                <input id="leasing_name" type="text" class="form-control input-border-bottom"
                                    name="leasing_name" value="{{ $leasing->leasing_name }}" required>
                                <label for="leasing_name" class="placeholder">Leasing Name</label>
                            </div>
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
