@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Job Vacancy')
@section('page-title','Job Vacancy')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('jobvacancy.index') }}">Data Job Vacancy</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Job Vacancy Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Qualification</th>
                            <th>Jobdesc</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Qualification</th>
                            <th>Jobdesc</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($data as $o)
                        <tr>
                            <td>{{ $o->title }}</td>
                            <td>{{ $o->category }}</td>
                            <td>{{ $o->qualification }}</td>
                            <td>{{ $o->jobdesc }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ route('jobvacancy.show', $o->id) }}" class="btnAction" data-toggle="tooltip"
                                        data-placement="top" title="Detail" style="color:orange;"><i
                                            class="fa fa-eye"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('jobvacancy.edit', $o->id) }}" class="btnAction" data-toggle="tooltip"
                                        data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('jobvacancy.delete', $o->id) }}" class="btnAction"
                                            data-toggle="tooltip" data-placement="top" title="Delete" style="color:red;"
                                            onclick="return tanya('Yakin hapus job vacancy {{ $o->title }}?')"><i
                                                class="fas fa-trash-alt"></i></a>
                                </div>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center;">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
