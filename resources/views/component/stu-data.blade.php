@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','STU')
@section('page-title','STU')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('stu.index') }}">Data STU</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">STU Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="{{ route('stu.deleteall') }}" method="post">
                    @csrf
                    <button class="btn btn-danger btn-round btnDelAll"
                        onclick="return tanya('Yakin hapus data terpilih?')"
                        style="margin-bottom: 10px; display: none;"><i class="far fa-trash-alt"></i> Selected</button>
                    <table id="multi-filter-select" class="display table table-striped table-hover"
                        width="100%">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input checkData" type="checkbox" id="checkAll">
                                            <span class="form-check-sign">Tanggal</span>
                                        </label>
                                    </div>
                                </th>
                                <th>Dealer Code</th>
                                <th>Dealer Name</th>
                                <th>STU</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input checkData" type="checkbox" id="checkAll">
                                            <span class="form-check-sign">Tanggal</span>
                                        </label>
                                    </div>
                                </th>
                                <th>Dealer Code</th>
                                <th>Dealer Name</th>
                                <th>STU</th>
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
                                            <span class="form-check-sign">{{ $o->stu_date }}</span>
                                        </label>
                                    </div>
                                </td>
                                <td>{{ $o->dealer_code }}</td>
                                <td>{{ $o->dealer_name }}</td>
                                <td>{{ $o->stu }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{ route('stu.edit', $o->id) }}" class="btnAction"
                                            data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                class="fas fa-edit"></i></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="{{ route('stu.delete', $o->id) }}" class="btnAction"
                                            data-toggle="tooltip" data-placement="top" title="Delete" style="color:red;"
                                            onclick="return tanya('Yakin hapus stu {{ $o->dealer_code }} tgl {{ $o->stu_date }}?')"><i
                                                class="fas fa-trash-alt"></i></a>
                                    </div>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center;">No data available</td>
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
