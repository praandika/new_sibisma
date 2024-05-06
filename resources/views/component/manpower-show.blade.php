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

@section('title','Detail Manpower')
@section('page-title','Manpower')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('manpower.index') }}">Data Manpower</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Detail</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card card-profile">
        <div class="card-header" style="background-image: url('{{ asset("img/bg-profile-yellow.jpg") }}')">
            <div class="profile-picture">
                <div class="avatar avatar-xl">
                    <img src="{{ asset('img/yamaha-logo.png') }}" class="avatar-img rounded-circle">
                </div>
            </div>
            <a href="{{ route('manpower.edit', $manpower->id) }}" data-toggle="tooltip" data-placement="top"
                title="Edit" style="color: #000; font-size: 20px; text-decoration: none; font-weight: bold;"><i
                    class="fas fa-edit"></i> Edit</a>
        </div>
        <div class="card-body">
            <div class="user-profile text-center">
                <div class="name">
                    {{ $manpower->name }} &nbsp;
                    @if($manpower->status == 'active')
                    <span class="badge badge-pill badge-success"><i class="fas fa-check"></i> On Job</span>
                    @elseif($manpower->status == 'mutation')
                    <span class="badge badge-pill badge-dark"><i class="fas fa-sign-out-alt"></i> Mutation</span>
                    @else
                    <span class="badge badge-pill badge-danger"><i class="fas fa-times"></i> Resign</span>
                    @endif
                </div>
                <div class="job">{{ $manpower->position }} at {{ $manpower->dealer->dealer_name }}</div>
                <div class="desc">Join on {{ \Carbon\Carbon::parse($manpower->join_date)->format('jS F Y') }}</div>
                <div class="desc" style="margin-top: -8px;">Resign on
                    {{ $manpower->resign_date == "" ? '-' : \Carbon\Carbon::parse($manpower->resign_date)->format('jS F Y') }}
                </div>
                <div class="desc" style="margin-top: -8px;">{{ $manpower->address }}</div>
                <div class="social-media">
                    <a class="btn btn-info btn-twitter btn-sm btn-link" href="#">
                        <span class="btn-label just-icon"><i class="fas fa-phone"></i> {{ $manpower->phone }}</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row user-stats text-center">
                <div class="col">
                    <div class="number">Education</div>
                    <div class="title">{{ $manpower->education }}</div>
                </div>
                <div class="col">
                    <div class="number">Birthday</div>
                    <div class="title">{{ \Carbon\Carbon::parse($manpower->birthday)->format('jS F Y') }}</div>
                </div>
                <div class="col">
                    <div class="number">Gender</div>
                    <div class="title">{{ $manpower->gender == 'L' ? 'Male' : 'Female' }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="card card-profile">
        <div class="card-body">
            <div class="user-profile text-center">
                <div class="card card-post card-round col-md-4 offset-md-4">
                    <img class="card-img-top"
                        src="{{ $manpower->image == '' || $manpower->image == 'noimage.jpg' ? asset('img/noimage.jpg') : asset('img/idcard/'.$manpower->image.'') }}"
                        alt="Card image cap">
                    <div class="card-body">
                        <div class="separator-solid"></div>
                        <input type="hidden" value="{{ $manpower->image }}" name="img_prev">
                        <p class="card-category text-info mb-1"><a href="#">File name :
                                {{ $manpower->image == '' ? 'No image available' : $manpower->image }}</a></p>
                        <h3 class="card-title">
                            <a href="#">
                                {{ $manpower->name }}'s Photo
                            </a>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
