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

@section('title','Photo Manpower')
@section('page-title','Photo')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('idcard.index') }}">Data ID Card</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Photo</a>
</li>
@endpush

<div class="col-md-12">
    @foreach($data as $o)
    <div class="card card-profile">
        <div class="card-header" style="background-image: url('{{ asset("img/bg-profile-yellow.jpg") }}')">
            <div class="profile-picture">
                <div class="avatar avatar-xl">
                    <img src="{{ $o->image == '' || $o->image == null || $o->image == 'noimage.jpg' ? asset('img/yamaha-logo.png') : asset('img/idcard/'.$o->image.'') }}" class="avatar-img rounded-circle">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="user-profile text-center">
                    <div class="name">
                        {{ $o->name }} &nbsp;
                        @if($o->status == 'active')
                        <span class="badge badge-pill badge-success"><i class="fas fa-check"></i> On Job</span>
                        @elseif($o->status == 'mutation')
                        <span class="badge badge-pill badge-dark"><i class="fas fa-sign-out-alt"></i> Mutation</span>
                        @else
                        <span class="badge badge-pill badge-danger"><i class="fas fa-times"></i> Resign</span>
                        @endif
                    </div>
                    <div class="job">{{ $o->position }} at {{ $o->dealer->dealer_name }}</div>
                    <div class="desc">Join on {{ \Carbon\Carbon::parse($o->join_date)->format('jS F Y') }}</div>
                    <div class="desc" style="margin-top: -8px;">Resign on
                        {{ $o->resign_date == "" ? '-' : \Carbon\Carbon::parse($o->resign_date)->format('jS F Y') }}
                    </div>
                    <div class="desc" style="margin-top: -8px;">{{ $o->address }}</div>
                    <div class="social-media">
                        <a class="btn btn-info btn-twitter btn-sm btn-link" href="#">
                            <span class="btn-label just-icon"><i class="fas fa-phone"></i> {{ $o->phone }}</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="user-profile text-center">
                    <div class="card card-post card-round col-md-4 offset-md-4">
                        <img class="card-img-top"
                            src="{{ $o->image == '' || $o->image == 'noimage.jpg' ? asset('img/noimage.jpg') : asset('img/idcard/'.$o->image.'') }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <div class="separator-solid"></div>
                            <input type="hidden" value="{{ $o->image }}" name="img_prev">

                            @if($o->image == 'noimage.jpg' || $o->image == '' || $o->image == null)
                            <p>Photo is not Available</p>
                            @else
                            <p class="card-category text-info mb-1"><a href="{{ $o->image == 'noimage.jpg' ? '#' : asset('img/idcard/'.$o->image.'') }}" download>Download</a></p>
                            @endif
                            <h3 class="card-title">
                                <a href="#">
                                    {{ $o->name }}'s Photo
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row user-stats text-center">
                <div class="col">
                    <div class="number">Education</div>
                    <div class="title">{{ $o->education }}</div>
                </div>
                <div class="col">
                    <div class="number">Birthday</div>
                    <div class="title">{{ \Carbon\Carbon::parse($o->birthday)->format('jS F Y') }}</div>
                </div>
                <div class="col">
                    <div class="number">Gender</div>
                    <div class="title">{{ $o->gender == 'L' ? 'Male' : 'Female' }}</div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
