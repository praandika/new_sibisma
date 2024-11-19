@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Report Allocation')
@section('page-title','Report Allocation')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('allocation.report') }}">Data Report Allocation</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Report Allocation</a>
</li>
@endpush

