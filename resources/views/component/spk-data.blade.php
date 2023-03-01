@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }
    .td-group .main-data{
        font-weight: bold;
    }
    .td-group .secondary-data{
        font-size: 12px;
        display: block;
    }
</style>
@endpush

@section('title','SPK')
@section('page-title','SPK')

@push('link-bread')
<li class="nav-item">
    <a href="{{ Auth::user()->access == 'salesman' ? route('spk.salesman') : route('spk.index') }}">Data SPK</a>
</li>
@endpush

@if(Auth::user()->access != 'salesman')
    @push('button')
        @include('component.button-filter')
    @endpush
@endif

@include('component.filter-box')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <livewire:widget-stock-qty>
            <h4 class="card-title">SPK Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables-spk" class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Date</th>
                            <th>SPK No</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Unit</th>
                            <th>Salesman</th>
                            @if(Auth::user()->dealer_code == 'group')
                                <th>Dealer</th>
                            @endif
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Status</th>
                            <th>Date</th>
                            <th>SPK No</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Unit</th>
                            <th>Salesman</th>
                            @if(Auth::user()->dealer_code == 'group')
                                <th>Dealer</th>
                            @endif
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php($no = 1)
                        @forelse($data as $o)
                        <tr>
                            <td @if($o->order_status == 'indent') style="color:crimson;" @else style="color:green;" @endif>
                                <div class="td-group">
                                    <span class="main-data">{{ ucwords($o->order_status) }}</span>
                                    <span class="secondary-data">
                                        <span class="status-1">{{ ucwords($o->credit_status) }}</span>
                                        <span class="status-2">{{ ucwords($o->payment_method) }}</span>
                                    </span>
                                </div>
                            </td>
                            <td>{{ $o->spk_date }}</td>
                            <td>
                                @if($o->sale_status == 'pending')
                                <span style="position: relative;">
                                    <span style="
                                    width: 50px; 
                                    height: 12px; 
                                    background-color: pink; 
                                    display: inline-block; 
                                    position: absolute; 
                                    top: -20px; 
                                    left: -25px; 
                                    border-radius: 0 0 15px 0;">
                                    <span style="font-size: 10px; font-weight: bold; position: relative; color: crimson; top: -7px; left: 5px;">
                                        pending
                                    </span>
                                </span>
                                @else
                                <span style="position: relative;">
                                    <span style="
                                    width: 50px; 
                                    height: 12px; 
                                    background-color: #cfffd5; 
                                    display: inline-block; 
                                    position: absolute; 
                                    top: -20px; 
                                    left: -25px; 
                                    border-radius: 0 0 15px 0;">
                                    <span style="font-size: 10px; font-weight: bold; position: relative; color: seagreen; top: -7px; left: 5px;">
                                        sold 
                                    </span>
                                </span>
                                @endif
                                    <span>
                                        {{ $o->spk_no }}
                                    </span>
                                </span>
                            </td>
                            <td>{{ $o->order_name }}</td>
                            <td>{{ $o->spk_phone }}</td>
                            <td style="background-color: <?php echo $o->color_code ?>50 ;">{{ $o->model_name }}</td>
                            <td>{{ $o->salesman }}</td>
                            @if(Auth::user()->dealer_code == 'group')
                                <td>{{ $o->dealer_code }}</td>
                            @endif
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ route('spk.get', $o->spk_no) }}" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Show" style="color:orange;"><i
                                            class="fas fa-eye"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('spk.edit', $o->id_spk) }}" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Edit"><i
                                            class="fas fa-edit"></i></a>
                                    @if($o->sale_status == 'pending')
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="{{ route('spk.delete', $o->id_spk) }}" class="btnAction"
                                            data-toggle="tooltip" data-placement="top" title="Delete" style="color:red;"
                                            onclick="return tanya('Yakin hapus SPK {{ $o->spk_no }} {{ $o->order_name }}?')"><i
                                                class="fas fa-trash-alt"></i></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ Auth::user()->dealer_code == 'group' ? '9' : '8' }}" style="text-align: center;">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('after-script')
<script>
    $(document).ready(function () {
        $('#basic-datatables-spk').DataTable({
            "pageLength": 20,
            "ordering": false
        });
    });
</script>
@endpush