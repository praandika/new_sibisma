<div class="modal fade modalMainDriver" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Select Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="display table table-striped table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>Manpower's Name</th>
                                @if(Auth::user()->dealer_code == 'group')
                                <th>Dealer</th>
                                @endif
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Position</th>
                                <th>Manpower's Name</th>
                                @if(Auth::user()->dealer_code == 'group')
                                <th>Dealer</th>
                                @endif
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($manpower as $o)
                            <tr data-id="{{ $o->id }}"
                                data-name="{{ $o->name }}" class="pilihMainDriver">
                                <td>{{ $o->position }}</td>
                                <td>{{ $o->name }}</td>
                                @if(Auth::user()->dealer_code == 'group')
                                <td>{{ $o->dealer->dealer_code }}</td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                            @if(Auth::user()->dealer_code == 'group')
                                <td colspan="3" style="text-align: center;">No data available</td>
                            @else
                                <td colspan="2" style="text-align: center;">No data available</td>
                            @endif
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal Footer -->
            @include('component.modal-footer')
        </div>
    </div>
</div>

@push('after-script')
<script>
    $(document).on('click', '.pilihMainDriver', function (e) {
        $('#main_driver').val($(this).attr('data-id'));
        $('#driver_name').val($(this).attr('data-name'));
        $('.modalMainDriver').modal('hide');
    });
</script>
@endpush
