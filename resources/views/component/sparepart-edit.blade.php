@section('title','Edit Sparepart')
@section('page-title','Sparepart')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('sparepart.index') }}">Data Sparepart</a>
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
                    <h4 class="card-title">Edit Sparepart {{ $sparepart->parts_name }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('sparepart.update', $sparepart->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-post card-round">
                            <img class="card-img-top"
                                src="{{ $sparepart->image == '' ? asset('img/nopict.jpg') : asset('img/sparepart/'.$sparepart->image.'') }}"
                                alt="Card image cap">
                            <div class="card-body">
                                <div class="separator-solid"></div>
                                <input type="hidden" value="{{ $sparepart->image }}" name="img_prev">
                                <p class="card-category text-info mb-1"><a href="#">File name :
                                        {{ $sparepart->image == '' ? 'No image available' : $sparepart->image }}</a></p>
                                <h3 class="card-title">
                                    <a href="#">
                                        {{ $sparepart->model_name }}
                                    </a>
                                </h3>
                                <p></p>
                                <a href="javascript:void(0);" class="btn btn-primary btn-rounded btn-sm" id="btnImage" style="color: #fff;">{{ $sparepart->image == '' ? 'Add Image' : 'Change Image'}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group form-floating-label">
                            <input id="parts_name" type="text" class="form-control input-border-bottom"
                                name="parts_name" value="{{ $sparepart->parts_name }}" autofocus required>
                            <label for="parts_name" class="placeholder">Sparepart Name</label>
                        </div>

                        <div class="form-group form-floating-label">
                            <select class="form-control input-border-bottom" id="category" name="category" required>
                                <option value="{{ $sparepart->category }}">{{ $sparepart->category }}</option>
                                <option disabled></option>
                                <option value="ygp">Yamaha Genuine Parts</option>
                                <option value="yamalube">Yamalube</option>
                                <option value="helmet">Helmet</option>
                            </select>
                            <label for="category" class="placeholder">Select Category</label>
                        </div>

                        <div class="form-group form-floating-label">
                            <input id="price" type="text" class="form-control input-border-bottom" name="price"
                                value="{{ $sparepart->price }}" required>
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
