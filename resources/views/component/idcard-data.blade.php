@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','ID Card')
@section('page-title','ID Card')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('idcard.index') }}">Data ID Card</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">ID Card {{ $dealer }} - Total {{ $total }} - (ID Card: {{ $idCardYes }})</h4>
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
                            <th>Photo</th>
                            <th width="120">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Dealer</th>
                            <th>Contact</th>
                            <th>Position</th>
                            <th>Photo</th>
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
                            <td><i class="fas fa-image" style="color: {{ $o->image == '' || $o->image == 'noimage.jpg' ? 'grey;' : '#00cc14;' }} font-size: 20px;"></i></td>
                            <td>
                                <div class="form-button-action">
                                    @if($o->image == '' || $o->image == 'noimage.jpg')
                                    <a href="#" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="No Photo Available" style="color: grey;"><i
                                            class="fas fa-download"></i></a>
                                    @else
                                    <a href="{{ asset('img/idcard/'.$o->image.'') }}" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Download" style="color: #00cc14" download><i
                                            class="fas fa-download"></i></a>
                                    @endif
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('idcard.show', $o->id) }}" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Detail"
                                        style="color:orange;"><i class="fa fa-eye"></i></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ url('idcard/change/'.$o->id.'/'.$o->idcard.'') }}" class="btnAction" data-toggle="tooltip"
                                        data-placement="top"
                                        title="{{ $o->idcard == '1' ? 'Active' : 'None' }}">

                                        @if($o->idcard == '1') 
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
                            <td colspan="8" style="text-align: center;">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
