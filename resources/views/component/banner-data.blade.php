@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Banner')
@section('page-title','Banner')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('banner.index') }}">Data Banner</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Banner Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="multi-filter-select" class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Link</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th width="120">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Link</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th width="120">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($data as $o)
                        <tr>
                            <td>{{ $o->title }}</td>
                            <td>{{ $o->link }}</td>
                            <td>
                                <img src="{{ asset('img/banner/'.$o->image.'') }}" alt="{{ $o->title }}" width="200px">
                            </td>
                            <td>{{ $o->status  }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ route('banner.show', $o->id) }}" class="btnAction" data-toggle="tooltip"
                                        data-placement="top" title="Detail" style="color:orange;"><i
                                            class="fa fa-eye"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('banner.edit', $o->id) }}" class="btnAction" data-toggle="tooltip"
                                        data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('banner.delete', $o->id) }}" class="btnAction" data-toggle="tooltip"
                                        data-placement="top" title="Delete" style="color:red;"
                                        onclick="return tanya('Yakin hapus banner {{ $o->name }}?')"><i
                                            class="fas fa-trash-alt"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ url('banner/change/'.$o->id.'/'.$o->status.'') }}" class="btnAction" data-toggle="tooltip"
                                        data-placement="top"
                                        title="{{ $o->status == 'active' ? 'Active' : 'Archive' }}">

                                        @if($o->status == 'active') 
                                        <i class="fas fa-toggle-on" style="color:#007bff;"></i>
                                        @else
                                        <i class="fas fa-toggle-off" style="color:grey;"></i>
                                        @endif
                                    </a>
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
