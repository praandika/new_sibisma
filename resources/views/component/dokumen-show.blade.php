@section('title','Detail Dokumen')
@section('page-title','Dokumen')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('document.index') }}">Data Dokumen</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Detail</a>
</li>
@endpush

<div class="col-md-12" id="dataCreate">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title">Detail | {{$document->sale->customer_name}}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <a href="{{ route('document.edit', $document->id) }}" data-toggle="tooltip" data-placement="top"
                title="Edit" style="color: #000; font-size: 20px; text-decoration: none; font-weight: bold;"><i
                    class="fas fa-edit"></i> Edit</a>
            <form action="{{ route('document.update', $document->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-group-default">
                            <label>NIK</label>
                            <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $document->sale->nik }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-group-default">
                            <label>Customer Name</label>
                            <p type="text" class="form-control" style="margin-bottom: -4px;">
                                {{ $document->sale->customer_name }}</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-group-default">
                            <label>Phone</label>
                            <p type="text" class="form-control" style="margin-bottom: -4px;">
                                {{ $document->sale->phone }}</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-group-default">
                            <label>Alamat</label>
                            <p type="text" class="form-control" style="margin-bottom: -4px;">
                                {{ $document->sale->address }}</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-group-default">
                            <label>Frame Number</label>
                            <p type="text" class="form-control" style="margin-bottom: -4px;">
                                {{ $document->sale->frame_no }}</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-group-default">
                            <label>Engine Number</label>
                            <p type="text" class="form-control" style="margin-bottom: -4px;">
                                {{ $document->sale->engine_no }}</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-group-default">
                            <label>Leasing</label>
                            <p type="text" class="form-control" style="margin-bottom: -4px;">
                                {{ $document->sale->leasing->leasing_name }}</p>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group form-group-default">
                            <label>STCK</label>
                            <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $document->stck }}</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-group-default">
                            <label>STCK STATUS</label>
                            <p type="text" class="form-control" style="margin-bottom: -4px;">
                                {{ $document->stck_status }}</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-group-default">
                            <label>STNK</label>
                            <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $document->stnk }}</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-group-default">
                            <label>STNK STATUS</label>
                            <p type="text" class="form-control" style="margin-bottom: -4px;">
                                {{ $document->stnk_status }}</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-group-default">
                            <label>BKPB</label>
                            <p type="text" class="form-control" style="margin-bottom: -4px;">{{ $document->bpkb }}</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-group-default">
                            <label>BPKB STATUS</label>
                            <p type="text" class="form-control" style="margin-bottom: -4px;">
                                {{ $document->bpkb_status }}</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-group-default">
                            <label>Document Note</label>
                            <p type="text" class="form-control" style="margin-bottom: -4px;">
                                {{ $document->document_note }}</p>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>
