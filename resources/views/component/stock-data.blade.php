@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Stock')
@section('page-title','Stock')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('stock.index') }}">Data Stock</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <livewire:widget-stock-qty>
            <h4 class="card-title">Stock Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="{{ route('stock.deleteall') }}" method="post">
                    @csrf
                    @if(Auth::user()->access == 'master')
                    <button class="btn btn-danger btn-round btnDelAll"
                        onclick="return tanya('Yakin hapus data terpilih?')"
                        style="margin-bottom: 10px; display: none;"><i class="far fa-trash-alt"></i> Selected</button>
                    @endif
                    <table id="basic-datatables" class="display table table-striped table-hover"
                        width="100%">
                        <thead>
                            <tr>
                                <th width="120%">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input checkData" type="checkbox" id="checkAll">
                                            <span class="form-check-sign">Model Name</span>
                                        </label>
                                    </div>
                                </th>
                                <th>Category</th>
                                <th>Color</th>
                                <th>Year</th>
                                <th>Qty</th>
                                <th>Dealer</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th width="120">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th width="120%">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input checkData" type="checkbox" id="checkAll">
                                            <span class="form-check-sign">Model Name</span>
                                        </label>
                                    </div>
                                </th>
                                <th>Category</th>
                                <th>Color</th>
                                <th>Year</th>
                                <th>Qty</th>
                                <th>Dealer</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th width="120">Action</th>
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
                                            <span class="form-check-sign">{{ $o->unit->model_name }}</span>
                                        </label>
                                    </div>
                                </td>
                                <td>{{ $o->unit->category }}</td>
                                <td style="background-color: <?php echo $o->unit->color->color_code ?>50 ;">
                                    {{ $o->unit->color->color_name }}
                                </td>
                                <td>{{ $o->unit->year_mc }}</td>
                                <td @if($o->qty == 0) style="background-color: maroon; color: #fff;" @endif>{{ $o->qty }}</td>
                                <td>{{ $o->dealer->dealer_name }}</td>
                                <td>{{ $o->createdBy->first_name }}</td>
                                <td>{{ $o->updatedBy->first_name }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{ route('stock.show', $o->id) }}" class="btnAction"
                                            data-toggle="tooltip" data-placement="top" title="Detail"
                                            style="color:orange;"><i class="fa fa-eye"></i></a>
                                        <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="{{ route('stock.delete', $o->id) }}" class="btnAction"
                                            data-toggle="tooltip" data-placement="top" title="Delete" style="color:red;"
                                            onclick="return tanya('Yakin hapus stock {{ $o->unit->model_name }} {{ $o->unit->color->color_name }}?')"><i
                                                class="fas fa-trash-alt"></i></a> -->
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" style="text-align: center;">No data available</td>
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
