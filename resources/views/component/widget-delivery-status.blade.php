@push('after-css')
<style>
    .widget-delivery-status{
        position: absolute;
        top: 0;
        right: 0;
        z-index: 9;

        padding: 5px 12px;
        text-align: center;
        border-radius: 0 3px 0 20px;

        box-shadow: -8px 6px 8px -8px rgba(8, 11, 63, 0.8);
        -webkit-box-shadow: -8px 6px 8px -8px rgba(8, 11, 63, 0.8);
        -moz-box-shadow: -8px 6px 8px -8px rgba(8, 11, 63, 0.8);
    }
</style>
@endpush
<span class="widget-delivery-status">
    <p style="font-size: 12px; font-weight: bold;">
        @if(Route::is('sale-delivery.*'))
            {{ ucfirst($saleDelivery->status) }}
        @elseif(Route::is('branch-delivery.*'))
            {{ ucfirst($branchDelivery->status) }}
        @else
            No data
        @endif
    </p>
</span>

@push('after-script')
    @if(Route::is('sale-delivery.*'))
        @if($saleDelivery->status == 'prepared')
        <script>
            $('.widget-delivery-status').css({
                'background-color' : '#f7af1e',
                'color' : '#000',
            });
        </script>
        @elseif($saleDelivery->status == 'on the way')
        <script>
            $('.widget-delivery-status').css({
                'background-color' : '#02079e',
                'color' : '#fff',
            });
        </script>
        @elseif($saleDelivery->status == 'has arrived')
        <script>
            $('.widget-delivery-status').css({
                'background-color' : '#008705',
                'color' : '#fff',
            });
        </script>
        @else
        <script>
            $('.widget-delivery-status').css({
                'background-color' : '#595959',
                'color' : '#fff',
            });
        </script>
        @endif

    @elseif(Route::is('branch-delivery.*'))
        @if($branchDelivery->status = 'prepared')
        <script>
            $('.widget-delivery-status').css({
                'background-color' : '#f7af1e',
                'color' : '#000',
            });
        </script>
        @elseif($branchDelivery->status = 'on the way')
        <script>
            $('.widget-delivery-status').css({
                'background-color' : '#02079e',
                'color' : '#fff',
            });
        </script>
        @elseif($branchDelivery->status = 'has arrived')
        <script>
            $('.widget-delivery-status').css({
                'background-color' : '#008705',
                'color' : '#fff',
            });
        </script>
        @else
        <script>
            $('.widget-delivery-status').css({
                'background-color' : '#595959',
                'color' : '#fff',
            });
        </script>
        @endif
    @else
        <script>
            $('.widget-delivery-status').css({
                'background-color' : '#595959',
                'color' : '#fff',
            });
        </script>
    @endif
@endpush
