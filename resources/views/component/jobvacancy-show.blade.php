@push('after-css')
<style>
    input[type=date]:required:invalid::-webkit-datetime-edit {
        color: transparent;
    }

    input[type=date]:focus::-webkit-datetime-edit {
        color: black !important;
    }

</style>
@endpush

@section('title','Detail Job Vacancy')
@section('page-title','Job Vacancy')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('jobvacancy.index') }}">Data Job Vacancy</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Detail</a>
</li>
@endpush

<div class="col-md-8">
    <div class="form-group form-group-default">
        <label>Title</label>
        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $jobvacancy->title }}</p>
    </div>

    <div class="form-group form-group-default">
        <label>Category</label>
        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $jobvacancy->category }}</p>
    </div>

    <div class="form-group form-group-default">
        <label>Qualification</label>
        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $jobvacancy->qualification }}</p>
    </div>

    <div class="form-group form-group-default">
        <label>Jobdesc</label>
        <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $jobvacancy->jobdesc }}
        </p>
    </div>
</div>
