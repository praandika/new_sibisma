<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Dealer Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive" wire:ignore>
                <table id="multi-filter-select" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Dealer Name</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Dealer Name</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($data as $o)
                        <tr>
                            <td>{{ $o->dealer_name }}</td>
                            <td>{{ $o->address }}</td>
                            <td>{{ $o->phone }}</td>
                            <td>{{ $o->createdBy->first_name }}</td>
                            <td>{{ $o->updatedBy->first_name }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
