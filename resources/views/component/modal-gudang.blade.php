<div class="modal fade modalGudang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Data Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i style="color: red;" class="fas fa-times"></i>
                    </span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tb-basic-table-position" class="display table table-striped table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>Model</th>
                                <th>Color</th>
                                <th>Year</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Model</th>
                                <th>Color</th>
                                <th>Year</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($unit as $o)
                            <tr data-model_name="{{ $o->model_name }}"
                                data-color="{{ $o->color_name }}"
                                data-year="{{ $o->year_mc }}"
                                data-colorcode="{{ $o->color_code }}"
                                class="klik">
                                <td>{{ $o->model_name }}</td>
                                <td style="background-color: <?php echo $o->color_code ?>50;">
                                    {{ $o->color_name }}
                                </td>
                                <td>
                                    @if($o->year_mc == $yearLast)
                                        <span style="font-style: italic; font-size: 11px; color: crimson;">
                                            {{ $o->year_mc }}
                                        </span>
                                    @else
                                        <span style="font-weight: bold;">
                                            {{ $o->year_mc }}
                                        </span>
                                    @endif
                                </td>
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
            <!-- Modal Footer -->
            <div class="modal-footer">
                <p><strong>SiBisma</strong> v3.0 &copy; CRM Bisma | Est 2019</p>
            </div>
        </div>
    </div>
</div>

@push('after-script')
<script>
    $(document).on('click', '.klik', function (e) {
        let code = $(this).attr('data-colorcode');
        $('#model_name').val($(this).attr('data-model_name'));
        $('#color').val($(this).attr('data-color'));
        $('#year').val($(this).attr('data-year'));
        $('#unit').val($(this).attr('data-model_name'));
        $('.modalGudang').modal('hide');

        $('#color_code').css('background', code);
    });
</script>

<script>
        $('#tb-basic-table-position').DataTable({
            "pageLength": 20,
            "ordering": false
        });

</script>
@endpush
