@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Allocation')
@section('page-title','Allocation')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('allocation.index') }}">Data Allocation</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
        
        <livewire:widget-allocation>
        <livewire:info-allocation-in>
        <livewire:info-allocation-out>
                <h4 class="card-title">Allocation Today</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Total Unit</th>
                            <th>Dealer Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Date</th>
                            <th>Total Unit</th>
                            <th>Dealer Code</th>
                            <th>Action</th>
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
