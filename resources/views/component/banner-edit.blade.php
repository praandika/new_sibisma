@section('title','Edit Banner')
@section('page-title','Banner')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('banner.index') }}">Data Banner</a>
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
                    <h4 class="card-title">Edit Banner {{ $banner->title }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('banner.update', $banner->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-post card-round">
                            <img class="card-img-top"
                                src="{{ $banner->image == '' ? asset('img/banner/banner.png') : asset('img/banner/'.$banner->image.'') }}"
                                alt="Card image cap">
                            <div class="card-body">
                                <div class="separator-solid"></div>
                                <input type="hidden" value="{{ $banner->image }}" name="img_prev">
                                <p class="card-category text-info mb-1"><a href="#">File name :
                                        {{ $banner->image == '' ? 'No image available' : $banner->image }}</a></p>
                                <h3 class="card-title">
                                    <a href="#">
                                        {{ $banner->title }}
                                    </a>
                                </h3>
                                <p></p>
                                <a href="javascript:void(0);" class="btn btn-primary btn-rounded btn-sm" id="btnImage" style="color: #fff;">{{ $banner->image == '' ? 'Add Image' : 'Change Image'}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="title" type="text" class="form-control input-border-bottom"
                                name="title" value="{{ $banner->title }}" autofocus required>
                            <label for="title" class="placeholder">Title</label>
                        </div>
                        <div class="form-group form-floating-label">
                            <input id="link" type="text" class="form-control input-border-bottom"
                                name="link" value="{{ $banner->link }}" autofocus required>
                            <label for="link" class="placeholder">Link</label>
                        </div>

                        <div class="form-group form-floating-label">
                            <select class="form-control input-border-bottom" id="status" name="status" required>
                                <option value="{{ $banner->status }}">{{ ucwords($banner->status) }}</option>
                                <option disabled></option>
                                <option value="active">Active</option>
                                <option value="archive">Archive</option>
                            </select>
                            <label for="status" class="placeholder">Select Color</label>
                        </div>

                        <div class="form-group form-floating-label" style="display: none;" id="formImage">
                            <input id="image" type="file" class="form-control input-border-bottom" name="image">
                            <label for="image" class="placeholder">Image</label>

                            <span class="badge badge-warning">
                                <strong style="color: black;">format required: jpg | jpeg | png</strong>
                            </span>
                        </div>

                        <div class="row" style="margin: 10px 10px;">
                            <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Update</button>
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
