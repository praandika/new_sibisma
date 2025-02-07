@section('title','Edit Warehouse Name')
@section('page-title','Warehouse Name')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('warehousename.index') }}">Data Warehouse Name</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Edit</a>
</li>
@endpush

<div class="col-md-12" id="dataCreate">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title">Edit Warehouse Name</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            @foreach($data as $o)
            <form action="{{ route('warehousename.update', $o->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group form-floating-label">
                            <input id="name" type="text" class="form-control input-border-bottom"
                                name="name" value="{{ $o->name }}" autofocus required>
                            <label for="name" class="placeholder">Location</label>
                        </div>

                        <div class="form-group form-floating-label">
                            <input id="address" type="text" class="form-control input-border-bottom"
                                name="address" value="{{ $o->address }}" autofocus required>
                            <label for="address" class="placeholder">Address</label>
                        </div>

                        <div class="row" style="margin: 10px 10px;">
                            <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Update</button>
                            <button type="reset" class="btn btn-default" style="margin-left: 2px;"><i
                                    class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
                        </div>

                    </div>
                </div>
            </form>
            @endforeach
        </div>
    </div>
</div>
