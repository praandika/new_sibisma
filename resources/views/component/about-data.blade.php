@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','About Us')
@section('page-title','About Us')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('jobvacancy.index') }}">Data About Us</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">About Us Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Profile</th>
                            <th>Visi</th>
                            <th>Misi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Profile</th>
                            <th>Visi</th>
                            <th>Misi</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($data as $o)
                        <tr>
                            <td>{{ $o->profile }}</td>
                            <td>{{ $o->visi }}</td>
                            <td>{{ $o->misi }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ route('about.show', $o->id) }}" class="btnAction" data-toggle="tooltip"
                                        data-placement="top" title="Detail" style="color:orange;"><i
                                            class="fa fa-eye"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('about.edit', $o->id) }}" class="btnAction" data-toggle="tooltip"
                                        data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('about.delete', $o->id) }}" class="btnAction"
                                            data-toggle="tooltip" data-placement="top" title="Delete" style="color:red;"
                                            onclick="return tanya('Yakin hapus job vacancy {{ $o->title }}?')"><i
                                                class="fas fa-trash-alt"></i></a>
                                </div>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align: center;">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
