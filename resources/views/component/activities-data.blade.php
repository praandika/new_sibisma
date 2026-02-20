@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Activities')
@section('page-title','Activities')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('activities.index') }}">Data Activities</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Activities This Month</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Activity</th>
                            <th>Date</th>
                            <th>Dealer</th>
                            <th>Prospect</th>
                            <th>Target Sales</th>
                            <th>Note Event</th>
                            <th>Kendala</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Activity</th>
                            <th>Date</th>
                            <th>Dealer</th>
                            <th>Prospect</th>
                            <th>Target Sales</th>
                            <th>Note Event</th>
                            <th>Kendala</th>
                        </tr>
                    </tfoot> 
                    <tbody>
                        @forelse($data as $o)
                        <tr>
                            <td>{{ $o->act_code }}</td>
                            <td>{{ $o->start_date }}</td>
                            <td>{{ $o->dealer->dealer_code }}</td>
                            <td>{{ $o->prospect_cold }}</td>
                            <td>{{ $o->target_sales }}</td>
                            <td>{{ $o->note_event }}</td>
                            <td>{{ $o->kendala }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ route('activities.edit', $o->id) }}" class="btnAction" data-toggle="tooltip"
                                        data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('activities.delete', $o->id) }}" class="btnAction"
                                            data-toggle="tooltip" data-placement="top" title="Delete" style="color:red;"
                                            onclick="return tanya('Yakin hapus activity {{ $o->act_code }}?')"><i
                                                class="fas fa-trash-alt"></i></a>
                                </div>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align: center;">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
