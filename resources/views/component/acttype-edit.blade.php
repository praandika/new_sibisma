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

@section('title','Edit Type Activity')
@section('page-title','Type Activity')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('acttype.index') }}">Data Type Activity</a>
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
                <div class="col-12">
                    <h4 class="card-title">Edit Type Activity</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('acttype.update', $acttype->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-floating-label">
                            <input id="type_activity" type="text" class="form-control input-border-bottom" name="type_activity" value="{{ $acttype->type_activity }}" required>
                            <label for="type_activity" class="placeholder">Type Activity</label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success" type="submit"><i class="fa fa-check"></i>&nbsp;&nbsp;Update</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>
