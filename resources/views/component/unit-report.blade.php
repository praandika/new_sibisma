@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Unit Report')
@section('page-title','Unit Report')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('report.unit') }}">Unit Report</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Unit Report</h4>
        </div>
        <div class="card-body">
            <!-- Content -->
        </div>
    </div>
</div>
