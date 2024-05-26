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

@section('title','Detail About Us')
@section('page-title','About Us')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('about.index') }}">Data About Us</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Detail</a>
</li>
@endpush

<div class="col-md-8">
    <div class="form-group form-group-default">
        <label>Profile</label>
        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $about->profile }}</p>
    </div>

    <div class="form-group form-group-default">
        <label>Visi</label>
        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $about->visi }}</p>
    </div>

    <div class="form-group form-group-default">
        <label>Misi</label>
        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $about->misi }}</p>
    </div>
</div>
