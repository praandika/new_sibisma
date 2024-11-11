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
                                <th>Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="pilihPosition" data-pos="Branch Head" data-cat="SAL">
                                <td>Branch Head</td>
                                <td>SAL</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Supervisor" data-cat="SAL">
                                <td>Supervisor</td>
                                <td>SAL</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Sales Counter" data-cat="SAL">
                                <td>Sales Counter</td>
                                <td>SAL</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Salesman" data-cat="SAL">
                                <td>Salesman</td>
                                <td>SAL</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Service Advisor" data-cat="SVC">
                                <td>Service Advisor</td>
                                <td>SVC</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Chief Mechanic" data-cat="SVC">
                                <td>Chief Mechanic</td>
                                <td>SVC</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Mechanic" data-cat="SVC">
                                <td>Mechanic</td>
                                <td>SVC</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Mechanic Helper" data-cat="SVC">
                                <td>Mechanic Helper</td>
                                <td>SVC</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Service Counter" data-cat="SVC">
                                <td>Service Counter</td>
                                <td>SVC</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Workshop Head" data-cat="SVC">
                                <td>Workshop Head</td>
                                <td>SVC</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Sparepart Counter" data-cat="SP">
                                <td>Sparepart Counter</td>
                                <td>SP</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Sparepart Admin" data-cat="SP">
                                <td>Sparepart Admin</td>
                                <td>SP</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Sparepart Warehouse" data-cat="SP">
                                <td>Sparepart Warehouse</td>
                                <td>SP</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Cashier" data-cat="ADMIN">
                                <td>Cashier</td>
                                <td>ADMIN</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Administration" data-cat="ADMIN">
                                <td>Administration</td>
                                <td>ADMIN</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Invoice Admin" data-cat="ADMIN">
                                <td>Invoice Admin</td>
                                <td>ADMIN</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Tax Admin" data-cat="ADMIN">
                                <td>Tax Admin</td>
                                <td>ADMIN</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Finance" data-cat="ADMIN">
                                <td>Finance</td>
                                <td>ADMIN</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Accounting" data-cat="ADMIN">
                                <td>Accounting</td>
                                <td>ADMIN</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Call Center" data-cat="ADMIN">
                                <td>Call Center</td>
                                <td>ADMIN</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Driver" data-cat="OPT">
                                <td>Driver</td>
                                <td>OPT</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="Pre Delivery Inspection" data-cat="OPT">
                                <td>Pre Delivery Inspection</td>
                                <td>OPT</td>
                            </tr>
                            <tr class="pilihPosition" data-pos="CRM" data-cat="CRM">
                                <td>CRM</td>
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
        $('#category').val($(this).attr('data-cat'));
        $('.modalPosition').modal('hide');
    });
</script>
@endpush
