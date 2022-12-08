<div class="modal fade modalPosition" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Select Position</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="basic-table-position" class="display table table-striped table-hover" width="100%" style="text-align: center;">
                        <thead>
                            <tr>
                                <th>Position</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="pilihPosition" data-pos="Branch Head">
                                <td>Branch Head</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Supervisor">
                                <td>Supervisor</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Sales Counter">
                                <td>Sales Counter</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Salesman">
                                <td>Salesman</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Service Advisor">
                                <td>Service Advisor</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Chief Mechanic">
                                <td>Chief Mechanic</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Mechanic">
                                <td>Mechanic</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Mechanic Helper">
                                <td>Mechanic Helper</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Service Counter">
                                <td>Service Counter</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Workshop Head">
                                <td>Workshop Head</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Sparepart Counter">
                                <td>Sparepart Counter</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Cashier">
                                <td>Cashier</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Administration">
                                <td>Administration</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Invoice Admin">
                                <td>Invoice Admin</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Tax Admin">
                                <td>Tax Admin</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Sparepart Admin">
                                <td>Sparepart Admin</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Finance">
                                <td>Finance</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Accounting">
                                <td>Accounting</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Driver">
                                <td>Driver</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Pre Delivery Inspection">
                                <td>Pre Delivery Inspection</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="CRM">
                                <td>CRM</td>
                            </tr>
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
    $(document).on('click', '.pilihPosition', function (e) {
        $('#position').val($(this).attr('data-pos'));
        $('.modalPosition').modal('hide');
    });
</script>
@endpush
