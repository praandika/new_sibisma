@section('title','Edit Dealer')
@section('page-title','Dealer')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('dealer.index') }}">Data Dealer</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Edit</a>
</li>
@endpush

<div class="col-md-12" id="dealerCreate">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Dealer {{ $dealer->dealer_code }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('dealer.update',$dealer->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="dealer_name" type="text" class="form-control input-border-bottom"
                                name="dealer_name" value="{{ $dealer->dealer_name }}" autofocus required>
                            <label for="dealer_name" class="placeholder">Dealer Name</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="phone" type="text" class="form-control input-border-bottom"
                                name="phone" value="{{ $dealer->phone }}" required>
                            <label for="phone" class="placeholder">Phone</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="phone2" type="number" class="form-control input-border-bottom"
                                name="phone2" value="{{ $dealer->phone2 }}" required>
                            <label for="phone2" class="placeholder">Whatsapp</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="address" type="text" class="form-control input-border-bottom"
                                name="address" value="{{ $dealer->address }}" required>
                            <label for="address" class="placeholder">Address</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-post card-round">
                            <img class="card-img-top"
                                src="{{ $dealer->image == '' ? asset('img/nopict.jpg') : asset('img/dealer/'.$dealer->image.'') }}"
                                alt="Card image cap">
                            <div class="card-body">
                                <div class="separator-solid"></div>
                                <input type="hidden" value="{{ $dealer->image }}" name="img_prev">
                                <p class="card-category text-info mb-1"><a href="#">File name :
                                        {{ $dealer->image == '' ? 'No image available' : $dealer->image }}</a></p>
                                <h3 class="card-title">
                                    <a href="#">
                                        {{ $dealer->dealer_name }}
                                    </a>
                                </h3>
                                <p></p>
                                <a href="javascript:void(0);" class="btn btn-primary btn-rounded btn-sm" id="btnImage" style="color: #fff;">{{ $dealer->image == '' ? 'Add Image' : 'Change Image'}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-floating-label" style="display: none;" id="formImage">
                            <input id="image" type="file" class="form-control input-border-bottom" name="image">
                            <label for="image" class="placeholder">Image (optional)</label>

                            <span class="badge badge-warning">
                                <strong style="color: black;">format required: jpg | jpeg | png</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success" type="submit"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

@push('after-script')
    <script>
        $("#phone2").on("input", function() {
            if (/^0/.test(this.value)) {
                this.value = this.value.replace(/^0/, "")
            }
        })
    </script>
    <script>
    $('#btnImage').on('click', function () {
        $('#formImage').css('display', 'block');
        $('#formImage').addClass('fadeInBawah');
    });
</script>
@endpush
