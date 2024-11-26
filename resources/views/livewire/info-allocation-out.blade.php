@push('after-css')
<style>
    :root{
        --bg-gold: #d68c0b;
        --bg-blue: #133E87;
        --bg-tosca: #24A19C;
        --bg-olive: #519259;
        --bg-red-heart: #B91646;
        --bg-purple: #432E54;
        --bg-green: #1F4529;
        --bg-latte: #A66E38;
        --bg-cofee: #705C53;
        --bg-dark-cofee: #3B3030;
        --bg-orange: #EB8317;
    }
    .widget-sold{
        position: absolute;
        top: 0;
        right: 90px;
        z-index: 9;

        background-color: var(--bg-red-heart);
        color: #fff;
        padding: 1px 12px;
        text-align: center;
        border-radius: 0 0 40px 40px;

        box-shadow: -8px 6px 8px -8px rgba(54, 54, 54, 0.5);
        -webkit-box-shadow: -8px 6px 8px -8px rgba(54, 54, 54, 0.5);
        -moz-box-shadow: -8px 6px 8px -8px rgba(54, 54, 54, 0.5);
    }
</style>
@endpush
<span class="widget-sold"><p style="font-size: 10px; cursor:pointer;">&nbsp;&nbsp; Sold &nbsp;&nbsp; <span style="display: block; margin-top: -5px;">{{ \Carbon\Carbon::parse($thisMonth)->format('M Y') }}</span> <strong style="font-size: 22px;">{{ number_format($data,0) }}</strong></p></span>