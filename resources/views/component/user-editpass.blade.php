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
    <a href="#">Change Password</a>
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
        </div>
        <div class="card-body">
            @foreach($data as $o)
            <div class="user-profile text-center">
                <div class="name">
                    {{ $o->name }} &nbsp; 
                    @if($o->status == 'active')
                        <span class="badge badge-pill badge-success"><i class="fas fa-check"></i> Active</span>
                    @else
                        <span class="badge badge-pill badge-danger"><i class="fas fa-times"></i> Inactive</span>
                    @endif
                </div>
                <div class="job">{{ $o->username }}</div>
                <div class="desc">{{ $o->email }}</div>
                <div class="desc" style="margin-top: -8px;">Dealer access : {{ $o->dealer_code }}</div>
                <div class="desc" style="margin-top: -8px;">Access : {{ $o->access }}</div>
            </div>

            <form action="{{ route('user.updatepass', $o->id) }}" method="post">
                @csrf
                    <div class="row justify-content-md-center">
                        <div class="col-md-4">
                            <div class="form-group form-floating-label">
                                <input id="oldpass" type="password" class="form-control input-border-bottom"
                                    name="oldpass" autofocus required>
                                <label for="oldpass" class="placeholder">Old Password *</label>
                                <input type="hidden" name="pass" value="{{ $o->password }}">
                                <input type="hidden" name="id" value="{{ $o->id }}">
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-md-center">
                        <div class="col-md-4">
                            <div class="form-group form-floating-label">
                                <input id="newpass" type="password" class="form-control input-border-bottom"
                                    name="newpass" autofocus required>
                                <label for="newpass" class="placeholder">New Password *</label>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-check"></i>&nbsp;&nbsp;Change</button>
                </form>
            @endforeach
        </div>
    </div>
</div>
