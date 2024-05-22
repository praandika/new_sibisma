@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Sparepart')
@section('page-title','Sparepart')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('sparepart.index') }}">Data Sparepart</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Sparepart Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="{{ route('sparepart.deleteall') }}" method="post">
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
                                            <span class="form-check-sign">Parts Name</span>
                                        </label>
                                    </div>
                                </th>
                                <th>Category</th>
                                <th>Price (Rp)</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th width="120">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                        <tr>
                                <th>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input checkData" type="checkbox" id="checkAll">
                                            <span class="form-check-sign">Parts Name</span>
                                        </label>
                                    </div>
                                </th>
                                <th>Category</th>
                                <th>Price (Rp)</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th width="120">Action</th>
                        </tfoot>
                        <tbody>
                            @forelse($data as $o)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input checkData" type="checkbox" name="pilih[]"
                                                value="{{ $o->id }}">
                                            <span class="form-check-sign">{{ $o->parts_name }}</span>
                                        </label>
                                    </div>
                                </td>
                                <td>{{ $o->category }}</td>
                                <td>Rp{{ $o->price }}</td>
                                <td>{{ $o->createdBy->first_name }}</td>
                                <td>{{ $o->updatedBy->first_name }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{ route('sparepart.show', $o->id) }}" class="btnAction"
                                            data-toggle="tooltip" data-placement="top" title="Detail"
                                            style="color:orange;"><i class="fa fa-eye"></i></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="{{ route('sparepart.edit', $o->id) }}" class="btnAction"
                                            data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                class="fas fa-edit"></i></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="{{ route('sparepart.delete', $o->id) }}" class="btnAction"
                                            data-toggle="tooltip" data-placement="top" title="Delete" style="color:red;"
                                            onclick="return tanya('Yakin hapus {{ $o->parts_name }}?')"><i
                                                class="fas fa-trash-alt"></i></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="#" class="btnAction"
                                            data-toggle="tooltip" data-placement="top" title="Image" @if($o->image == 'noimage.jpg') style="color: grey;" @else style="color: #00cc14;" @endif>
                                            <i class="fa fa-image"></i></a>
                                    </div>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" style="text-align: center;">No data available</td>
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
