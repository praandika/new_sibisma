@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','User')
@section('page-title','User')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('user.index') }}">Data User</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">User Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="{{ route('user.deleteall') }}" method="post">
                    @csrf
                    <button class="btn btn-danger btn-round btnDelAll"
                        onclick="return tanya('Yakin hapus data terpilih?')"
                        style="margin-bottom: 10px; display: none;"><i class="far fa-trash-alt"></i> Selected</button>
                    <table id="basic-datatables" class="display table table-striped table-hover"
                        width="100%">
                        <thead>
                            <tr>
                                <th width="120%">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input checkData" type="checkbox" id="checkAll">
                                            <span class="form-check-sign">Username</span>
                                        </label>
                                    </div>
                                </th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Dealer</th>
                                <th>Access</th>
                                <th>Status</th>
                                <th>Mode</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th width="120%">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input checkData" type="checkbox" id="checkAll">
                                            <span class="form-check-sign">Username</span>
                                        </label>
                                    </div>
                                </th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Dealer</th>
                                <th>Access</th>
                                <th>Status</th>
                                <th>Mode</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($data as $o)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input checkData" type="checkbox" name="pilih[]"
                                                value="{{ $o->id }}">
                                            <span class="form-check-sign">{{ $o->username }}</span>
                                        </label>
                                    </div>
                                </td>
                                <td>{{ $o->name }}</td>
                                <td>{{ $o->email }}</td>
                                <td>{{ $o->dealer_code }}</td>
                                <td>{{ $o->access }}</td>
                                <td>
                                    <a href="{{ url('user/change/'.$o->id.'/'.$o->status.'') }}" class="btnAction" data-toggle="tooltip"
                                        data-placement="top"
                                        title="{{ $o->status == 'active' ? 'Active' : 'Inactive' }}"
                                        onclick="return tanya(`Anda akan mengubah status user menjadi {{ $o->status == 'inactive' ? 'Active' : 'Inactive' }}, lanjutkan?`)">

                                        @if($o->status == 'active') 
                                        <i class="fas fa-toggle-on" style="color:green;"></i>
                                        @else
                                        <i class="fas fa-toggle-off" style="color:grey;"></i>
                                        @endif
                                    </a>
                                </td>
                                <td>{{ $o->crud }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{ route('user.show', $o->id) }}"
                                            class="btnAction"
                                            data-toggle="tooltip" data-placement="top" title="Detail"
                                            style="color:orange;"><i class="fa fa-eye"></i></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="{{ route('user.edit', $o->id) }}"
                                            class="btnAction"
                                            data-toggle="tooltip" data-placement="top" title="Edit"><i
                                            class="fas fa-edit"></i></a>
                                    </div>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" style="text-align: center;">No data available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <button class="btn btn-danger btn-round btnDelAll"
                        onclick="return tanya('Yakin hapus data terpilih?')" style="display: none;"><i
                            class="far fa-trash-alt"></i> Selected</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('after-script')
<script>
    $('#checkAll').click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    $('.checkData').on('click', function () {
        $count = $('.checkData:checked').length;
        if ($count > 0) {
            $('.btnDelAll').css('display', 'block');
            $('.btnDelAll').addClass('fadeInBawah');
        } else {
            $('.btnDelAll').css('display', 'none');
        }
    });

</script>
@endpush
