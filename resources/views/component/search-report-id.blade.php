<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('report.search-id') }}" method="get">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search Report ID" aria-label=""
                                    aria-describedby="basic-addon1" name="rid">
                                <div class="input-group-prepend">
                                    <button class="btn btn-default" type="submit" data-toggle="tooltip"
                                        data-placement="top" title="Search"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
