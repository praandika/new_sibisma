<div class="col-md-4" data-toggle="modal" data-target=".modalRanking">
    <div class="card card-dark bg-info-gradient curves-shadow">
        <div class="card-body pb-0">
            <div class="h1 fw-bold float-right"><img src="{{ asset('img/1st.png') }}" alt="1st"></div>
            @foreach($rank1 as $o)
            <h2 class="mb-2">{{ $o->qty }} Unit</h2>
            <p>{{ $o->dealer_name }}</p>
            @endforeach
        </div>
    </div>
</div>

<div class="col-md-4" data-toggle="modal" data-target=".modalRanking">
    <div class="card card-dark bg-info-gradient skew-shadow">
        <div class="card-body pb-0">
            <div class="h1 fw-bold float-right"><img src="{{ asset('img/2nd.png') }}" alt="1st"></div>
            @foreach($rank2 as $o)
            <h2 class="mb-2">{{ $o->qty }} Unit</h2>
            <p>{{ $o->dealer_name }}</p>
            @endforeach
        </div>
    </div>
</div>

<div class="col-md-4" data-toggle="modal" data-target=".modalRanking">
    <div class="card card-dark bg-info-gradient">
        <div class="card-body pb-0">
            <div class="h1 fw-bold float-right"><img src="{{ asset('img/3rd.png') }}" alt="1st"></div>
            @foreach($rank3 as $o)
            <h2 class="mb-2">{{ $o->qty }} Unit</h2>
            <p>{{ $o->dealer_name }}</p>
            @endforeach
        </div>
    </div>
</div>
