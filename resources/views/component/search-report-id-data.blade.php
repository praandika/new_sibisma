@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

    table a:hover {
        text-decoration: none;
        font-weight: bold;
    }

</style>
@endpush

@section('title','Stock History')
@section('page-title','Stock History')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('report.search-id') }}">Search Report Data</a>
</li>
@endpush

@push('button')
    @section('button-title','Send Report')
    @include('component.button-history')
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <livewire:widget-stock-qty>
                <h4 class="card-title">Search Report Data {{ $rid }}</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="multi-filter-select" class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Dealer</th>
                            <th>First Stock</th>
                            <th>In Stock</th>
                            <th>Out Stock</th>
                            <th>Sale Stock</th>
                            <th>Last Stock</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Date</th>
                            <th>Dealer</th>
                            <th>First Stock</th>
                            <th>In Stock</th>
                            <th>Out Stock</th>
                            <th>Sale Stock</th>
                            <th>Last Stock</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($data as $o)
                        <tr>
                            <td>
                                <a href="{{ Auth::user()->dealer_code == 'group' ? url('report/'.$o->dealer->dealer_code.'/'.$o->history_date) : route('report.send-report', $o->history_date) }}"   data-toggle="tooltip"
                                data-placement="top"
                                title="Show details">{{ \Carbon\Carbon::parse($o->history_date)->isoFormat('ddd, D-MM-Y') }}
                                </a>
                            </td>
                            <td>{{ $o->dealer->dealer_name }}</td>
                            <td>{{ $o->first_stock }}</td>
                            <td>{{ $o->in_qty }}</td>
                            <td>{{ $o->out_qty }}</td>
                            <td>{{ $o->sale_qty }}</td>
                            <td>{{ $o->last_stock }}</td>
                            <td>{{ $o->createdBy->first_name }}</td>
                            <td>{{ $o->updatedBy->first_name }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" style="text-align: center;">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
