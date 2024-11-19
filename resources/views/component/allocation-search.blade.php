@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Search Allocation')
@section('page-title','Search Allocation')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('allocation.index') }}">Data Search Allocation</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Search Allocation</a>
</li>
@endpush
<!-- SEARCH -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="form-group">
                <!-- FORM -->
                <form action="{{ route('allocation.search') }}" method="get">
                    <div class="row">
                        <div class="col-md-4">

                            <div class="input-group">
                                <input type="date" class="form-control" placeholder="" aria-label=""
                                    aria-describedby="basic-addon1" name="start"
                                    value="{{ $start != null ? $start : null }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="date" class="form-control" placeholder="" aria-label=""
                                    aria-describedby="basic-addon1" name="end" value="{{ $end != null ? $end : null }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search Frame No." aria-label=""
                                    aria-describedby="basic-addon1" name="frame"
                                    value="{{ $frame != null ? $frame : null }}">
                                <div class="input-group-prepend">
                                    <button class="btn btn-default" type="submit" data-toggle="tooltip"
                                        data-placement="top" title="Search"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
                <!-- END FORM -->
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <livewire:widget-stock-qty>
                <h4 class="card-title">Search Allocation {{ $start }} to {{ $end }} | {{ $frame }}</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="multi-filter-select" class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Model Name</th>
                            <th>Color</th>
                            <th>Frame No</th>
                            <th>Engine No</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Model Name</th>
                            <th>Color</th>
                            <th>Frame No</th>
                            <th>Engine No</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php($no = 1)
                        @forelse($data as $o)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $o->model_name }}</td>
                            <td>{{ $o->color }}</td>
                            <td>{{ $o->frame_no }}</td>
                            <td>{{ $o->engine_no }}</td>
                            <td style="
                                {{ $o->out_status == 'yes' ? 'background-color: #B9164650;' : 'background-color: #51925950;' }}
                            ">{{ $o->out_status == 'yes' ? 'Sold' : 'In Stock' }}</td>
                            <td>
                                <div class="form-button-action">
                                    @if(Session::has('date'))
                                    <a href="{{ route('allocation.delete', 
                                    [
                                                    'id' => $o->id,
                                                    'date' => session('date'),
                                                    'dealer' => session('dealer')
                                                ]) }}" class="btnAction" data-toggle="tooltip" data-placement="top"
                                        title="Delete" style="color:red;"
                                        onclick="return tanya('Yakin hapus allocation {{ $o->model_name }} {{ $o->frame_no }}?')"><i
                                            class="fas fa-trash-alt"></i></a>
                                    @else
                                    <a href="{{ route('allocation.delete', 
                                    [
                                                    'id' => $o->id,
                                                    'date' => $o->allocation_date,
                                                    'dealer' => $o->dealer_code
                                                ]) }}" class="btnAction" data-toggle="tooltip" data-placement="top"
                                        title="Delete" style="color:red;"
                                        onclick="return tanya('Yakin hapus allocation {{ $o->model_name }} {{ $o->frame_no }}?')"><i
                                            class="fas fa-trash-alt"></i></a>
                                    @endif
                                </div>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align: center;">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
