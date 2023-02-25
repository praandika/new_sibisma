@section('title','Salesman SPK')
@push('link-bread')
<li class="nav-item">
    <a href="{{ route('spk.salesman') }}">Home SPK</a>
</li>
@endpush
<div class="col-md-12" data-toggle="modal" data-target=".modalRanking">
    <a href="{{ route('spk.salesman') }}">
        <div class="card card-dark bg-primary-gradient curves-shadow">
            <div class="card-body pb-0">
                <div class="h1 fw-bold float-right"><img src="{{ asset('img/enter.png') }}" alt="enter"></div>
                <h1 class="mb-2">Go to SPK</h1>
            </div>
        </div>
    </a>
</div>