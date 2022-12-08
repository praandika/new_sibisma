@push('after-css')
<style>
    input[type="color"] {
        -webkit-appearance: none;
        border: none;
        height: 50px !important;
    }
    input[type="color"]::-webkit-color-swatch-wrapper {
        padding: 0;
    }
    input[type="color"]::-webkit-color-swatch {
        border: none;
    }
</style>
@endpush

@section('title','Edit Color')
@section('page-title','Color')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('color.index') }}">Data Color</a>
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
                    <h4 class="card-title">Edit Color {{ $color->color_name }} {{ $color->color_code }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('color.update', $color->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="wrapperInput">
                    <div class="row inputan">
                        <div class="col-md-6">
                            <div class="form-group form-floating-label">
                                <input id="color_name" type="text" class="form-control input-border-bottom"
                                    name="color_name" value="{{ $color->color_name }}" required>
                                <label for="color_name" class="placeholder">Color Name</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group form-floating-label">
                                <input id="color_code" type="color" class="form-control input-border-bottom"
                                    name="color_code" value="{{ $color->color_code }}" required>
                                <label for="color_code" class="placeholder">Select Color</label>
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
