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

@section('title','Detail User')
@section('page-title','User')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('user.index') }}">Data User</a>
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
        <div class="card-header" style="background-image: url('{{ asset("img/bg-profile.jpg") }}')">
            <div class="profile-picture">
                <div class="avatar avatar-xl">
                    <img src="{{ asset('img/yamaha-logo.png') }}" class="avatar-img rounded-circle">
                </div>
            </div>
            <a href="{{ route('user.edit', $user->id) }}" data-toggle="tooltip" data-placement="top" title="Edit" style="color: #fff; font-size: 20px; text-decoration: none; font-weight: bold;"><i class="fas fa-edit"></i> Edit</a>
        </div>
        <div class="card-body">
            <div class="user-profile text-center">
                <div class="name">
                    {{ $user->name }} &nbsp; 
                    @if($user->status == 'active')
                        <span class="badge badge-pill badge-success"><i class="fas fa-check"></i> Active</span>
                    @else
                        <span class="badge badge-pill badge-danger"><i class="fas fa-times"></i> Inactive</span>
                    @endif
                </div>
                <div class="job">{{ $user->username }}</div>
                <div class="desc">{{ $user->email }}</div>
                <div class="desc" style="margin-top: -8px;">Dealer access : {{ $user->dealer_code }}</div>
                <div class="desc" style="margin-top: -8px;">Access : {{ $user->access }}</div>
            </div>
        </div>
    </div>
</div>
