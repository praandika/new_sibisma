@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','ID Card')
@section('page-title','ID Card')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('idcard.index') }}">Data ID Card</a>
</li>
@endpush

@foreach($data as $o)
<div class="col-md-2">
    <a href="{{ route('idcard.data',$o->id) }}" style="text-decoration: none;">
        <div class="card">
            <div class="card-header bg-primary-gradient skew-shadow">
                <h4 class="card-title" style="color: #fff;">{{ $o->dealer_code }}</h4>
            </div>
            <div class="card-body">
                <p style="color: black; font-weight:bold;">
                    {{ $o->dealer_name }}
                </p style="color: black;">
            </div>
        </div>
    </a>
</div>
@endforeach
