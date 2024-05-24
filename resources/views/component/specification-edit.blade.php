@section('title','Edit Specification')
@section('page-title','Specification')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('specification.index') }}">Data Specification</a>
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
                    <h4 class="card-title">Edit Specification {{ $specification->model_name }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('specification.update', $specification->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-floating-label">
                            <textarea name="mesin" id="mesin" class="form-control input-border-bottom" required>{{ $specification->mesin }}
                                </textarea>
                            <label for="mesin" class="placeholder">Mesin Data</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-floating-label">
                            <textarea name="rangka" id="rangka" class="form-control input-border-bottom" required>{{ $specification->rangka }}
                                </textarea>
                            <label for="rangka" class="placeholder">Rangka Data</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-floating-label">
                            <textarea name="dimensi" id="dimensi" class="form-control input-border-bottom" required>{{ $specification->dimensi }}
                                </textarea>
                            <label for="dimensi" class="placeholder">Dimensi Data</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-floating-label">
                            <textarea name="kelistrikan" id="kelistrikan" class="form-control input-border-bottom"
                                required>{{ $specification->kelistrikan }}
                                </textarea>
                            <label for="kelistrikan" class="placeholder">Kelistrikan Data</label>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin: 10px 10px;">
                    <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Update</button>
                    <button type="reset" class="btn btn-default" style="margin-left: 2px;"><i
                            class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
