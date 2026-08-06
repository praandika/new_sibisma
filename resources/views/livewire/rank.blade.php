<div class="col-sm-6 col-md-4" data-toggle="modal" data-target=".modalRanking">
    <div class="card card-stats card-round">
        <div class="card-body ">
            <div class="row">
                <div class="col-5">
                    <div class="icon-big text-center">
                        <img src="{{ asset('img/rank1.png') }}" alt="1st">
                    </div>
                </div>
                <div class="col-7 col-stats">
                    <div class="numbers">
                        <p class="card-category">Rank 1</p>
                        @foreach($rank1 as $o)
                        <h4 class="card-title">{{ $o->qty }} Unit</h4>
                        <p class="card-category">{{ $o->dealer_name }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-6 col-md-4" data-toggle="modal" data-target=".modalRanking">
    <div class="card card-stats card-round">
        <div class="card-body ">
            <div class="row">
                <div class="col-5">
                    <div class="icon-big text-center">
                        <img src="{{ asset('img/rank2.png') }}" alt="2nd">
                    </div>
                </div>
                <div class="col-7 col-stats">
                    <div class="numbers">
                        <p class="card-category">Rank 2</p>
                        @foreach($rank2 as $o)
                        <h4 class="card-title">{{ $o->qty }} Unit</h4>
                        <p class="card-category">{{ $o->dealer_name }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-6 col-md-4" data-toggle="modal" data-target=".modalRanking">
    <div class="card card-stats card-round">
        <div class="card-body">
            <div class="row">
                <div class="col-5">
                    <div class="icon-big text-center">
                        <img src="{{ asset('img/rank3.png') }}" alt="3rd">
                    </div>
                </div>
                <div class="col-7 col-stats">
                    <div class="numbers">
                        <p class="card-category">Rank 3</p>
                        @foreach($rank3 as $o)
                        <h4 class="card-title">{{ $o->qty }} Unit</h4>
                        <p class="card-category">{{ $o->dealer_name }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>