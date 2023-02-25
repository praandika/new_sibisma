<div class="modal fade modalUser" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Select User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="basic-datatables-user" class="display table table-striped table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>First Name</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>First Name</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($user as $o)
                            <tr data-id="{{ $o->id }}" data-name="{{ $o->first_name }}" class="pilihUser">
                                <td>{{ $o->id }}</td>
                                <td>{{ $o->username }}</td>
                                <td>{{ $o->first_name }}</td>
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
    $(document).on('click', '.pilihUser', function (e) {
        $('#user_id').val($(this).attr('data-id'));
        $('#userName').val($(this).attr('data-name'));
        $('.modalUser').modal('hide');
    });

    $(document).ready(function () {
        $('#basic-datatables-user').DataTable({
            "pageLength": 20
        });
    });
</script>
@endpush
