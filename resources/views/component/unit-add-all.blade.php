@section('title','Add All Unit')
@section('page-title','Add All Unit')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('report.adjust') }}">Add All Unit</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title">Add All Unit</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('unit.add-all-unit-store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input type="hidden" id="dealer_id" name="dealer_id" value="{{ old('dealer_id') }}"
                                required>
                            <input id="dealer_name" name="dealer_name" type="text"
                                class="form-control input-border-bottom" data-toggle="modal" data-target=".modalDealer"
                                value="{{ old('dealer_name') }}" required>
                            <label for="dealer_name" class="placeholder">Select Dealer</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="year_mc" name="year_mc" type="text" class="form-control input-border-bottom"
                                data-toggle="modal" data-target=".modalYearMC" value="{{ old('year_mc') }}" required>
                            <label for="year_mc" class="placeholder">Select Year MC</label>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin: 10px 10px;">
                    <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Add</button>
                </div>
            </form>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <table id="multi-filter-select" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Dealer Code</th>
                                <th>Dealer Name</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Dealer Code</th>
                                <th>Dealer Name</th>
                                <th>Stock</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @php($no = 1)
                            @forelse($data as $o)
                            <tr>
                                <td>{{ $o->code }}</td>
                                <td>{{ $o->dealer }}</td>
                                <td>{{ $o->stock }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" style="text-align: center;">No data available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Year MC -->
<div class="modal fade modalYearMC" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Select Year MC</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="display table table-striped table-hover" width="100%" style="text-align: center;">
                        <tbody>
                            @forelse($tahunUnit as $o)
                            <tr class="pilihYearMC" data-year-mc="{{ $o->year_mc }}">
                                <td>{{ $o->year_mc }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="1">No data available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <p><strong>SiBisma</strong> v3.0 &copy; CRM Bisma | Est 2019</p>
            </div>
        </div>
    </div>
</div>

@push('after-script')
<script>
    $(document).on('click', '.pilihYearMC', function (e) {
        $('#year_mc').val($(this).attr('data-year-mc'));
        $('.modalYearMC').modal('hide');
    });
</script>
@endpush

<!-- END Modal Year MC -->

<livewire:modal-dealer />


