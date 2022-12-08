@push('after-css')
<style>
    ::-webkit-input-placeholder { /* WebKit browsers */
        text-transform: none;
    }
    :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
        text-transform: none;
    }
    ::-moz-placeholder { /* Mozilla Firefox 19+ */
        text-transform: none;
    }
    :-ms-input-placeholder { /* Internet Explorer 10+ */
        text-transform: none;
    }
    ::placeholder { /* Recent browsers */
        text-transform: none;
    }
</style>
@endpush

@push('button')
    @section('button-title','Add New Unit')
    @include('component.button-add')
@endpush

<div class="col-md-12" id="dataCreate" @if(Session::has('display')) style="display: block;" @else style="display: none;" @endif>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title">Add New Unit</h4>
                </div>
                <div class="col-2">
                    <h4 class="card-title" style="text-align: right; cursor: pointer; color: red;" id="btnCloseCreate">
                        <i class="fas fa-times-circle"></i></h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('unit.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="model_name" type="text" class="form-control input-border-bottom"
                                name="model_name" value="{{ old('model_name') }}" style="text-transform: uppercase;" autofocus required>
                            <label for="model_name" class="placeholder">Model Name</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <select class="form-control input-border-bottom" id="category" name="category"
                            style="text-transform: uppercase;" required>
                                <option value=""></option>
                                <option value="Moped">Moped</option>
                                <option value="Matic">Matic</option>
                                <option value="Maxi">Maxi</option>
                                <option value="Sport">Sport</option>
                                <option value="Naked Bike">Naked Bike</option>
                                <option value="Off Road">Off Road</option>
                                <option value="CBU">CBU</option>
                            </select>
                            <label for="category" class="placeholder">Select Category</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <select class="form-control input-border-bottom" id="color_id" name="color_id"
                            style="text-transform: uppercase;" required>
                                <option value=""></option>
                                @foreach($color as $o)
                                <option value="{{ $o->id }}">{{ $o->color_name }}</option>
                                @endforeach
                            </select>
                            <label for="color_id" class="placeholder">Select Color</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="address" type="number" class="form-control input-border-bottom"
                                name="year_mc" value="{{ old('year_mc') }}" style="text-transform: uppercase;" required>
                            <label for="year_mc" class="placeholder">Year MC</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="price" type="number" class="form-control input-border-bottom"
                                name="price" value="{{ old('price') }}" style="text-transform: uppercase;" required>
                            <label for="price" class="placeholder">Price</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="image" type="file" class="form-control input-border-bottom"
                                name="image" value="{{ old('image') }}">
                            <label for="image" class="placeholder">Image (optional)</label>

                            <span class="invalid-feedback">
                                <strong>format required: jpg|jpeg|png</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

@push('after-script')
<script>
    $(document).ready(function () {
        $('#btnCreate').click(function () {
            $(this).css('display', 'none');
            $('#dataCreate').fadeIn();
        });

        $('#btnCloseCreate').click(function () {
            $('#dataCreate').css('display', 'none');
            $('#btnCreate').fadeIn();
        });
    });

</script>
@endpush
