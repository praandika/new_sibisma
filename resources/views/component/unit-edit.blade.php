@section('title','Edit Unit')
@section('page-title','Unit')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('unit.index') }}">Data Unit</a>
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
                    <h4 class="card-title">Edit Unit {{ $unit->model_name }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('unit.update', $unit->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-post card-round">
                            <img class="card-img-top"
                                src="{{ $unit->image == '' ? asset('img/nopict.jpg') : asset('img/motorcycle/'.$unit->image.'') }}"
                                alt="Card image cap">
                            <div class="card-body">
                                <div class="separator-solid"></div>
                                <input type="hidden" value="{{ $unit->image }}" name="img_prev">
                                <p class="card-category text-info mb-1"><a href="#">File name :
                                        {{ $unit->image == '' ? 'No image available' : $unit->image }}</a></p>
                                <h3 class="card-title">
                                    <a href="#">
                                        {{ $unit->model_name }}
                                    </a>
                                </h3>
                                <p></p>
                                <a href="javascript:void(0);" class="btn btn-primary btn-rounded btn-sm" id="btnImage" style="color: #fff;">{{ $unit->image == '' ? 'Add Image' : 'Change Image'}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group form-floating-label">
                            <input id="model_name" type="text" class="form-control input-border-bottom"
                                name="model_name" value="{{ $unit->model_name }}" autofocus required>
                            <label for="model_name" class="placeholder">Model Name</label>
                        </div>

                        <div class="form-group form-floating-label">
                            <select class="form-control input-border-bottom" id="category" name="category" required>
                                <option value="{{ $unit->category }}">{{ $unit->category }}</option>
                                <option disabled></option>
                                <option value="Classy">Classy</option>
                                <option value="Moped">Moped</option>
                                <option value="Matic">Matic</option>
                                <option value="Maxi">Maxi</option>
                                <option value="Sport">Sport</option>
                                <option value="Off Road">Off Road</option>
                                <option value="CBU">CBU</option>
                            </select>
                            <label for="category" class="placeholder">Select Category</label>
                        </div>

                        <div class="form-group form-floating-label">
                            <select class="form-control input-border-bottom" id="color_id" name="color_id" required>
                                <option value="{{ $unit->color_id }}">{{ $unit->color->color_name }}</option>
                                <option disabled></option>
                                @foreach($color as $o)
                                <option value="{{ $o->id }}">{{ $o->color_name }}</option>
                                @endforeach
                            </select>
                            <label for="color_id" class="placeholder">Select Color</label>
                        </div>

                        <div class="form-group form-floating-label">
                            <input id="year_mc" type="number" class="form-control input-border-bottom" name="year_mc"
                                value="{{ $unit->year_mc }}" required>
                            <label for="year_mc" class="placeholder">Year MC</label>
                        </div>

                        <div class="form-group form-floating-label">
                            <input id="price" type="number" class="form-control input-border-bottom" name="price"
                                value="{{ $unit->price }}" required>
                            <label for="price" class="placeholder">Price</label>
                        </div>

                        <div class="form-group form-floating-label" style="display: none;" id="formImage">
                            <input id="image" type="file" class="form-control input-border-bottom" name="image">
                            <label for="image" class="placeholder">Image (optional)</label>

                            <span class="badge badge-warning">
                                <strong style="color: black;">format required: jpg | jpeg | png</strong>
                            </span>
                        </div>

                        <div class="row" style="margin: 10px 10px;">
                            <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                            <button type="reset" class="btn btn-default" style="margin-left: 2px;"><i
                                    class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('after-script')
<script>
    $('#btnImage').on('click', function () {
        $('#formImage').css('display', 'block');
        $('#formImage').addClass('fadeInBawah');
    });
</script>
@endpush
