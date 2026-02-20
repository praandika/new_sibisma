@push('after-css')
<style>
    input[type=date]:required:invalid::-webkit-datetime-edit {
        color: transparent;
    }

    input[type=date]:focus::-webkit-datetime-edit {
        color: black !important;
    }

</style>
@endpush

@section('title','Add Detail Activity')
@section('page-title','Activity')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('activities.index') }}">Data Activity</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Add Detail</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title">Add Detail Activity</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('activities.detail-store', $o->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group form-floating-label">
                            <input id="target_sales" type="text" class="form-control input-border-bottom" name="target_sales" value="{{ $o->target_sales }}" required>
                            <label for="target_sales" class="placeholder">Target Sales</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group form-floating-label">
                            <input id="prospect_cold" type="text" class="form-control input-border-bottom" name="prospect_cold" value="{{ $o->prospect_cold }}" required>
                            <label for="prospect_cold" class="placeholder">Prospect Cold</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group form-floating-label">
                            <input id="prospect_warm" type="text" class="form-control input-border-bottom" name="prospect_warm" value="{{ $o->prospect_warm }}" required>
                            <label for="prospect_warm" class="placeholder">Prospect Warm</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group form-floating-label">
                            <input id="prospect_hot" type="text" class="form-control input-border-bottom" name="prospect_hot" value="{{ $o->prospect_hot }}" required>
                            <label for="prospect_hot" class="placeholder">Prospect Hot</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group form-floating-label">
                            <input id="prospect_hot" type="text" class="form-control input-border-bottom" name="prospect_hot" value="{{ $o->prospect_hot }}" required>
                            <label for="prospect_hot" class="placeholder">Prospect Hot</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group form-floating-label">
                            <input id="prospect_hot" type="text" class="form-control input-border-bottom" name="prospect_hot" value="{{ $o->prospect_hot }}" required>
                            <label for="prospect_hot" class="placeholder">Prospect Hot</label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success" type="submit"><i class="fa fa-check"></i>&nbsp;&nbsp;Update</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>
