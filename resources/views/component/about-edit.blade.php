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

@section('title','Edit About Us')
@section('page-title','About Us')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('about.index') }}">Data About Us</a>
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
                    <h4 class="card-title">Edit About</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('about.update', $about->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-floating-label">
                            <textarea id="profile" type="text" class="form-control input-border-bottom"
                                name="profile" autofocus required rows="8">{{ $about->profile }}"
                            </textarea>
                            <label for="profile" class="placeholder">Profile</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-floating-label">
                            <textarea id="visi" type="text" class="form-control input-border-bottom"
                                name="visi" autofocus required rows="8">{{ $about->visi }}"
                            </textarea>
                            <label for="visi" class="placeholder">Visi</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-floating-label">
                            <textarea id="misi" type="text" class="form-control input-border-bottom"
                                name="misi" autofocus required rows="8">{{ $about->misi }}"
                            </textarea>
                            <label for="misi" class="placeholder">Misi</label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success" type="submit"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>
