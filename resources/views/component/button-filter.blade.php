<button class="btn btn-primary btn-round" id="btnFilter" @if(Session::has('display')) style="margin-bottom: 20px; display: none;" @else style="margin-bottom: 20px; display: block;" @endif><i class="fa fa-filter"></i>&nbsp;&nbsp; <strong>Filter</strong> </button>

@push('after-script')
<script>
    $(document).ready(function () {
        $('#btnFilter').click(function () {
            $(this).css('display', 'none');
            $('#dataFilter').fadeIn();
        });

        $('#btnCloseCreate').click(function () {
            $('#dataFilter').css('display', 'none');
            $('#btnFilter').fadeIn();
        });
    });

</script>
@endpush