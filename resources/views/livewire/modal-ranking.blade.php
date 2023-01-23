<div class="modal fade modalRanking" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Sales Ranking</h5>
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
                                <th>Rank</th>
                                <th>Dealer</th>
                                <th>Sales</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Rank</th>
                                <th>Dealer</th>
                                <th>Sales</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @php($no = 1)
                            @foreach($rankData as $o)
                            <tr>
                                <th>Rank {{ $no++ }}</th>
                                <td>{{ $o->dealer_name }}</td>
                                <td>{{ $o->qty }} Unit</td>
                            </tr>
                            @endforeach
                            <tr>
                                <th>Total</th>
                                <td>Bisma Group</td>
                                <td>{{ $total }} Unit</td>
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
