@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Log')
@section('page-title','Log')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('log') }}">Data Log</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Log Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="{{ route('log.deleteall') }}" method="post">
                    @csrf
                    <button class="btn btn-danger btn-round btnDelAll"
                        onclick="return tanya('Yakin hapus data terpilih?')"
                        style="margin-bottom: 10px; display: none;"><i class="far fa-trash-alt"></i> Selected</button>
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input checkData" type="checkbox" id="checkAll">
                                            <span class="form-check-sign">User</span>
                                        </label>
                                    </div>
                                </th>
                                <th>Activity</th>
                                <th>Timestamps</th>
                            </tr>
                        </thead>
                        <tfoot>
                        <tr>
                                <th>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input checkData" type="checkbox" id="checkAll">
                                            <span class="form-check-sign">User</span>
                                        </label>
                                    </div>
                                </th>
                                <th>Activity</th>
                                <th>Timestamps</th>
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
                                            <span class="form-check-sign">{{ $o->user->first_name }}</span>
                                        </label>
                                    </div>
                                </td>
                                <td>{{ $o->activity }}</td>
                                <td>{{ $o->created_at->timezone('Asia/Makassar')->toDateTimeString() }}</td>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" style="text-align: center;">No data available</td>
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
