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
        
        <livewire:widget-allocation>
        <livewire:info-allocation-in>
        <livewire:info-allocation-out>
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
                            <th>SPV</th>
                            <th>Display</th>
                            <th>Prospect</th>
                            <th>Target Sales</th>
                            <th>Salesman Deal</th>
                            <th>Unit Deal</th>
                            <th>Note Event</th>
                            <th>Kendala</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Activity</th>
                            <th>Date</th>
                            <th>Dealer</th>
                            <th>SPV</th>
                            <th>Display</th>
                            <th>Prospect</th>
                            <th>Target Sales</th>
                            <th>Salesman Deal</th>
                            <th>Unit Deal</th>
                            <th>Note Event</th>
                            <th>Kendala</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($data as $o)
                        <tr>
                            <td>{{ $o->allocation_date }}</td>
                            <td style="background-color: #51925930; font-weight: bold;">&Darr;&nbsp;&nbsp;{{ $o->entry }}</td>
                            <td>{{ $o->dealer_code }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ url('allocation/'.$o->allocation_date.'/'.$o->dealer_code.'') }}"
                                        class="btnAction" data-toggle="tooltip" data-placement="top" title="Detail"
                                        style="color:orange;"><i class="fa fa-eye"></i></a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align: center;">No allocation today</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
