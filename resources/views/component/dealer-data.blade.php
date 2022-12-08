@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Dealer')
@section('page-title','Dealer')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('dealer.index') }}">Data Dealer</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Dealer Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="{{ route('dealer.deleteall') }}" method="post">
                    @csrf
                    <button class="btn btn-danger btn-round btnDelAll"
                        onclick="return tanya('Yakin hapus data terpilih?')"
                        style="margin-bottom: 10px; display: none;"><i class="far fa-trash-alt"></i> Selected</button>
                    <table id="multi-filter-select" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input checkData" type="checkbox" id="checkAll">
                                            <span class="form-check-sign">Dealer Name</span>
                                        </label>
                                    </div>
                                </th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Whatsapp</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                @if(Auth::user()->dealer_code == 'group')
                                <th width="70">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input checkData" type="checkbox" id="checkAll">
                                            <span class="form-check-sign">Dealer Name</span>
                                        </label>
                                    </div>
                                </th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Whatsapp</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                @if(Auth::user()->dealer_code == 'group')
                                <th width="70">Action</th>
                                @endif
                            </tr>
                        </tfoot>
                        <tbody>
                            @php($no = 1)
                            @forelse($data as $o)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input checkData" type="checkbox" name="pilih[]"
                                                value="{{ $o->id }}">
                                            <span class="form-check-sign">{{ $o->dealer_name }}</span>
                                        </label>
                                    </div>
                                </td>
                                <td>{{ $o->address }}</td>
                                <td>{{ $o->phone }}</td>
                                <td>{{ $o->phone2 }}</td>
                                <td>{{ $o->createdBy->first_name }}</td>
                                <td>{{ $o->updatedBy->first_name }}</td>
                                @if(Auth::user()->dealer_code == 'group')
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{ route('dealer.edit', $o->id) }}" class="btnAction"
                                            data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                class="fas fa-edit"></i></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="{{ route('dealer.delete', $o->id) }}" class="btnAction"
                                            data-toggle="tooltip" data-placement="top" title="Delete" style="color:red;"
                                            onclick="return tanya('Yakin hapus dealer {{ $o->dealer_name }}?')"><i
                                                class="fas fa-trash-alt"></i></a>
                                    </div>
                                </td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ Auth::user()->dealer_code == 'group' ? '6' : '7' }}" style="text-align: center;">No data available</td>
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
