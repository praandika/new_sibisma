@section('title','Salesman SPK')
@push('link-bread')
<li class="nav-item">
    <a href="{{ route('spk.salesman') }}">Home SPK</a>
</li>
@endpush
<div class="col-md-12">
    <a href="{{ route('spk.salesman') }}">
        <div class="card card-dark bg-primary-gradient curves-shadow">
            <div class="card-body pb-0">
                <div class="h1 fw-bold float-right"><img src="{{ asset('img/enter.png') }}" alt="enter"></div>
                <h1 class="mb-2">Go to SPK</h1>
            </div>
        </div>
    </a>
</div>
<div class="col-md-12">
    <div style="text-align: center;">
        <p>Need any help? or found any bugs?</p>
        <a href="https://wa.me/6281246571421?text=`Pesan%20dari%20sibisma`%0AHi,%20saya%20ingin%20bantuan%20mengenai%20sistem%20SPK%20Salesman" target="_blank">
            <button class="btn btn-danger"><i class="fab fa-whatsapp"></i>
                &nbsp;&nbsp;Contact Developer
            </button>
        </a>
    </div>
</div>