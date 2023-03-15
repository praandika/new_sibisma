@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Manpower')
@section('page-title','Manpower')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('manpower.index') }}">Data Manpower</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Manpower Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="multi-filter-select" class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Dealer</th>
                            <th>Contact</th>
                            <th>Position</th>
                            <th>System User</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th width="120">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Dealer</th>
                            <th>Contact</th>
                            <th>Position</th>
                            <th>System User</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th width="120">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($data as $o)
                        <tr>
                            <td @if($o->gender == 'L') style="background-color: #76b2e380;" @else style="background-color: pink;" @endif>
                                <span style="position: relative;">
                                    <span style="
                                    width: 55px; 
                                    height: 12px; 
                                    background-color: #ffffff; 
                                    display: inline-block; 
                                    position: absolute; 
                                    top: -20px; 
                                    left: -25px; 
                                    border-radius: 0 0 15px 0;">
                                    <span 
                                    @if($o->status == 'resign')
                                        style="font-size: 10px; font-weight: bold; position: relative; color: crimson; top: -7px; left: 5px;"
                                    @elseif($o->status == 'mutation')
                                        style="font-size: 10px; font-weight: bold; position: relative; color: dodgerblue; top: -7px; left: 5px;"
                                    @else
                                        style="font-size: 10px; font-weight: bold; position: relative; color: seagreen; top: -7px; left: 5px;"
                                    @endif>
                                        {{ $o->status }}
                                    </span>
                                </span>
                                <span>
                                    {{ $o->name }}
                                </span>
                            </td>
                            <td>{{ $o->dealer->dealer_name }}</td>
                            <td>{{ $o->phone }}</td>
                            <td>{{ $o->position }}</td>
                            <td style="{{ $o->system_user == 'Yes' ? 'color:blue; font-weight:bold;' : 'color:grey;' }}" >{{ $o->system_user }}</td>
                            <td>{{ $o->createdBy->first_name }}</td>
                            <td>{{ $o->updatedBy->first_name }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ route('manpower.show', $o->id) }}" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Detail"
                                        style="color:orange;"><i class="fa fa-eye"></i></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('manpower.edit', $o->id) }}" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Edit"><i
                                            class="fas fa-edit"></i></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('manpower.delete', $o->id) }}" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Delete" style="color:red;"
                                        onclick="return tanya('Yakin hapus manpower {{ $o->name }}?')"><i
                                            class="fas fa-trash-alt"></i></a>
                                </div>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" style="text-align: center;">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
