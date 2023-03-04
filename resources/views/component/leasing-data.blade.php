@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Leasing')
@section('page-title','Leasing')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('leasing.index') }}">Data Leasing</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Leasing Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="{{ route('leasing.deleteall') }}" method="post">
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
                                            <span class="form-check-sign">Leasing Code</span>
                                        </label>
                                    </div>
                                </th>
                                <th>Leasing Name</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th width="70">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input checkData" type="checkbox" id="checkAll">
                                            <span class="form-check-sign">Leasing Code</span>
                                        </label>
                                    </div>
                                </th>
                                <th>Leasing Name</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th width="70">Action</th>
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
                                            <span class="form-check-sign">{{ $o->leasing_code }}</span>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <span style="position: relative;">
                                        <span style="
                                        width: 80px; 
                                        height: 12px; 
                                        background-color: #32a852; 
                                        display: inline-block; 
                                        position: absolute; 
                                        top: -20px; 
                                        left: -25px; 
                                        border-radius: 0 0 15px 0;">
                                        <span style="font-size: 10px; font-weight: bold; position: relative; color: #e3fae9; top: -7px; left: 5px;">
                                            {{ ucwords($o->leasing_category) }}
                                        </span>
                                    </span>
                                    <span>
                                        {{ $o->leasing_name }}
                                    </span>
                                </td>
                                <td>{{ $o->createdBy->first_name }}</td>
                                <td>{{ $o->updatedBy->first_name }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{ route('leasing.edit', $o->id) }}" class="btnAction"
                                            data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                class="fas fa-edit"></i></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="{{ route('leasing.delete', $o->id) }}" class="btnAction"
                                            data-toggle="tooltip" data-placement="top" title="Delete" style="color:red;"
                                            onclick="return tanya('Yakin hapus leasing {{ $o->leasing_name }}?')"><i
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
