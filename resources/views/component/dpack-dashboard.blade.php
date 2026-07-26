@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Dpack Connection')
@section('page-title','Dpack Connection')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('dpack.index') }}">Dpack Connection</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Syncronation Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="multi-filter-select" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Connection</th>
                            <th>Date</th>
                            <th>Dealer Code</th>
                            <th>Status</th>
                            <th>Total Data</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Connection</th>
                            <th>Date</th>
                            <th>Dealer Code</th>
                            <th>Status</th>
                            <th>Total Data</th>
                            <th>Message</th>
                        </tr>
                    </tfoot>
                    <tbody id="tbodyLog">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('after-script')
<script>
    function loadLogs() {

        $.ajax({
            url: "{{ route('dpack.log') }}",
            type: "GET",
            dataType: "json",
            success: function (data) {

                let html = '';

                $.each(data, function (i, row) {

                    let status = '';

                    if (row.status == 'SUCCESS') {
                        status = `
                        <span class="badge badge-success">
                            <i class="fas fa-check-circle"></i> Success
                        </span>`;

                    } else if (row.status == 'WARNING') {
                                status = `
                        <span class="badge badge-warning">
                            <i class="fas fa-exclamation-triangle"></i> Warning
                        </span>`;

                    } else {
                                status = `
                        <span class="badge badge-danger">
                            <i class="fas fa-times-circle"></i> Failed
                        </span>`;
                    }

                    html += `
                        <tr>
                            <td>${row.command}</td>
                            <td>${row.started_at}</td>
                            <td>${row.dealer_code}</td>
                            <td class="text-center">${status}</td>
                            <td class="text-center">${row.total_data}</td>
                            <td>${row.message}</td>
                        </tr>
                    `;

                });

                $('#tbodyLog').html(html);

            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });

    }

    // Load pertama kali
    loadLogs();

    // Refresh tiap 5 detik
    setInterval(loadLogs, 5000);

</script>
@endpush
