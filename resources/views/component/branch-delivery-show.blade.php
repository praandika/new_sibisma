@section('title','Detail Branch Delivery')
@section('page-title','Branch Delivery')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('branch-delivery.index') }}">Data Branch Delivery</a>
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
            @include('component.widget-delivery-status')
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title">Detail {{ $branchDelivery->out->frame_no }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <a href="{{ route('branch-delivery.edit', $branchDelivery->id) }}" data-toggle="tooltip"
                data-placement="top" title="Edit"
                style="color: #000; font-size: 20px; text-decoration: none; font-weight: bold;"><i
                    class="fas fa-edit"></i> Edit</a>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-post card-round">
                        <img class="card-img-top"
                            src="{{ $branchDelivery->out->stock->unit->image == '' ? asset('img/nopict.jpg') : asset('img/motorcycle/'.$branchDelivery->out->stock->unit->image.'') }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <div class="separator-solid"></div>
                            <h3 class="card-title">
                                <a href="#">
                                    {{ $branchDelivery->out->stock->unit->model_name }}
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-group-default">
                        <label>Delivery Date</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">
                            {{ \Carbon\Carbon::parse($branchDelivery->branch_delivery_date)->format('j M Y') }}</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Delivery Time</label>
                                <p type="text" class="form-control" style="margin-bottom: -4px;">
                                    {{ $branchDelivery->delivery_time }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Arrival Time</label>
                                <p type="text" class="form-control" style="margin-bottom: -4px;">
                                    {{ $branchDelivery->arrival_time == null ? 'N/A' : $branchDelivery->arrival_time }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Model Name</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">
                            {{ $branchDelivery->out->stock->unit->model_name }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Frame No.</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">
                            {{  $branchDelivery->out->frame_no  }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Note</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">
                            {{ $branchDelivery->note }}</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group form-group-default">
                        <label>To Dealer</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">
                            {{ $branchDelivery->out->dealer->dealer_name }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Address</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">
                            {{ $branchDelivery->out->dealer->address }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Phone</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">
                            {{ $branchDelivery->out->dealer->phone }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Driver</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">
                            {{ $branchDelivery->mainDriver->name }}
                        </p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>PIC</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">
                            {{ $branchDelivery->backupDriver->name }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
