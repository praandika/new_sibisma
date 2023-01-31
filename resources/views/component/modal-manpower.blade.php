<div class="modal fade modalManpower" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Select Manpower</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tb-basic-table-manpower" class="display table table-striped table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Gender</th>
                                @if(Auth::user()->dealer_code == 'group')
                                <td>Dealer</td>
                                @endif

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Gender</th>
                                @if(Auth::user()->dealer_code == 'group')
                                <td>Dealer</td>
                                @endif
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($manpower as $o)
                            <tr data-id="{{ $o->id_manpower }}" data-name="{{ $o->name }}" data-position="{{ $o->position }}" data-gender="{{ $o->gender == 'L' ? 'Laki-Laki' : 'Perempuan' }}" class="pilihManpower">
                                <td>{{ $o->name }}</td>
                                <td>{{ $o->position }}</td>
                                <td>{{ $o->gender == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                @if(Auth::user()->dealer_code == 'group')
                                <td>{{ $o->dealer_code }}</td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ Auth::user()->access == 'master' ? '4' : '3' }}" style="text-align: center;">No data available</td>
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
        $(document).on('click', '.pilihManpower', function (e) {
            $('#manpower_id').val($(this).attr('data-id'));
            $('#manpower').val($(this).attr('data-name'));
            $('.modalManpower').modal('hide');
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#tb-basic-table-manpower').DataTable({
                "pageLength": 20,
                "ordering": false
            })
        });
    </script>
@endpush
