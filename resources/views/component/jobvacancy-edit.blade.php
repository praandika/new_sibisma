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

@section('title','Edit Job Vacancy')
@section('page-title','Job Vacancy')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('jobvacancy.index') }}">Data Job Vacancy</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Edit</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title">Edit {{ $jobvacancy->name }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('jobvacancy.update', $jobvacancy->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-floating-label">
                            <input id="title" type="text" class="form-control input-border-bottom"
                                name="title" value="{{ $jobvacancy->title }}" autofocus required>
                            <label for="title" class="placeholder">Title</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group form-floating-label">
                            <select class="form-control input-border-bottom" id="category" name="category" required>
                                <option value="{{ $jobvacancy->category }}">{{ $jobvacancy->category }}</option>
                                <option disabled></option>
                                <option value="sales">Sales</option>
                                <option value="counter">Counter</option>
                                <option value="mekanik">Mekanik</option>
                                <option value="admin">Admin</option>
                                <option value="supir">Supir</option>
                                <option value="other">Other</option>
                            </select>
                            <label for="category" class="placeholder">Select Category</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group form-floating-label">
                            <textarea id="jobdesc" type="text" class="form-control input-border-bottom"
                                name="jobdesc" required>{{ $jobvacancy->jobdesc }}</textarea>
                            <label for="jobdesc" class="placeholder">Jobdesc</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group form-floating-label">
                            <input id="qualification" type="text" class="form-control input-border-bottom"
                                name="qualification" value="{{ $jobvacancy->qualification }}" required>
                            <label for="qualification" class="placeholder">Qualification</label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success" type="submit"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>
