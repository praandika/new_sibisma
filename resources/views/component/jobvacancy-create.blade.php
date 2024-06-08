@push('button')
@section('button-title','Add New Job Vacancy')
@include('component.button-add')
@endpush

<div class="col-md-12" id="dataCreate" @if(Session::has('display')) style="display: block;" @else style="display: none;"
    @endif>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title">Add New Job Vacancy</h4>
                </div>
                <div class="col-2">
                    <h4 class="card-title" style="text-align: right; cursor: pointer; color: red;" id="btnCloseCreate">
                        <i class="fas fa-times-circle"></i></h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('jobvacancy.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-floating-label">
                            <input id="title" type="text" class="form-control input-border-bottom" name="title"
                                value="{{ old('title') }}" autofocus required>
                            <label for="title" class="placeholder">Title</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group form-floating-label">
                            <select class="form-control input-border-bottom" id="category" name="category"
                                style="text-transform: uppercase;" required>
                                <option value=""></option>
                                <option value="sales">Sales</option>
                                <option value="counter">Counter</option>
                                <option value="mekanik">Mekanik</option>
                                <option value="admin">Admin</option>
                                <option value="sopir">Sopir</option>
                                <option value="other">Other</option>
                            </select>
                            <label for="category" class="placeholder">Select Category</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-floating-label">
                            <textarea id="jobdesc" type="text" class="form-control input-border-bottom" name="jobdesc"
                                value="{{ old('jobdesc') }}" required></textarea>
                            <label for="jobdesc" class="placeholder">Jobdesc</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-floating-label">
                            <textarea id="qualification" type="text" class="form-control input-border-bottom"
                                name="qualification" value="{{ old('qualification') }}" required></textarea>
                            <label for="qualification" class="placeholder">Qualification</label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

@push('after-script')
<script>
    $(document).ready(function () {
        $('#btnCreate').click(function () {
            $(this).css('display', 'none');
            $('#dataCreate').fadeIn();
        });

        $('#btnCloseCreate').click(function () {
            $('#dataCreate').css('display', 'none');
            $('#btnCreate').fadeIn();
        });
    });

</script>
@endpush
