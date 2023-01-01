@push('after-css')
<style>
    :root{
        --bg-gold: #d68c0b;
        --bg-blue: #270082;
        --bg-tosca: #24A19C;
        --bg-olive: #519259;
        --bg-red-heart: #B91646;
    }
    .widget-stock{
        position: absolute;
        top: 0;
        right: 0;
        z-index: 9;

        background-color: var(--bg-red-heart);
        color: #fff;
        padding: 5px 12px;
        text-align: center;
        border-radius: 0 3px 0 40px;

        box-shadow: -8px 6px 8px -8px rgba(54, 54, 54, 0.5);
        -webkit-box-shadow: -8px 6px 8px -8px rgba(54, 54, 54, 0.5);
        -moz-box-shadow: -8px 6px 8px -8px rgba(54, 54, 54, 0.5);
    }
</style>
@endpush
@if(Auth::user()->access == 'master')
<span class="widget-stock" id="widgetStock" data-toggle="modal" data-target=".modalWidget"><p style="font-size: 10px; cursor:pointer;">Stocks <br> <strong style="font-size: 22px;">{{ $stock }}</strong></p></span>
@else
<span class="widget-stock"><p style="font-size: 10px;">Stocks <br> <strong style="font-size: 22px;">{{ $stock }}</strong></p></span>
@endif

@if(Auth::user()->access == 'master')
<!-- Modal -->
<div class="modal fade modalWidget" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Stock Summary</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i style="color: red;" class="fas fa-times"></i>
                    </span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tb-basic-datatables" class="display table table-striped table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Dealer Name</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Code</th>
                                <th>Dealer Name</th>
                                <th>Stock</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($data as $o)
                                <td>{{ $o->dealer_code }}</td>
                                <td>{{ $o->dealer_name }}</td>
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
            <!-- Modal Footer -->
            <div class="modal-footer">
                <p><strong>SiBisma</strong> v3.0 &copy; CRM Bisma | Est 2019</p>
            </div>
        </div>
    </div>
</div>

<!-- END Modal -->
@endif