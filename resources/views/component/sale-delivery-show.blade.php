@section('title','Detail Sale Delivery')
@section('page-title','Sale Delivery')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('sale-delivery.index') }}">Data Sale Delivery</a>
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
                    <h4 class="card-title">Detail {{ $saleDelivery->sale->frame_no }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <a href="{{ route('sale-delivery.edit', $saleDelivery->id) }}" data-toggle="tooltip" data-placement="top"
                title="Edit" style="color: #000; font-size: 20px; text-decoration: none; font-weight: bold;"><i
                    class="fas fa-edit"></i> Edit</a>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-post card-round">
                        <img class="card-img-top"
                            src="{{ $saleDelivery->sale->stock->unit->image == '' ? asset('img/nopict.jpg') : asset('img/motorcycle/'.$saleDelivery->sale->stock->unit->image.'') }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <div class="separator-solid"></div>
                            <h3 class="card-title">
                                <a href="#">
                                    {{ $saleDelivery->sale->stock->unit->model_name }}
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-group-default">
                        <label>Delivery Date</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">
                            {{ \Carbon\Carbon::parse($saleDelivery->sale_delivery_date)->format('j M Y') }}</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Delivery Time</label>
                                <p type="text" class="form-control" style="margin-bottom: -4px;">
                                    {{ $saleDelivery->delivery_time == null ? 'N/A' : $saleDelivery->delivery_time }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Arrival Time</label>
                                <p type="text" class="form-control" style="margin-bottom: -4px;">
                                    {{ $saleDelivery->arrival_time == null ? 'N/A' : $saleDelivery->arrival_time }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Model Name</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">
                            {{ $saleDelivery->sale->stock->unit->model_name }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Frame No.</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">
                            {{  $saleDelivery->sale->frame_no  }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Note</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">
                            {{ $saleDelivery->note }}</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group form-group-default">
                        <label>To Customer</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">
                            {{ $saleDelivery->sale->customer_name }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Address</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">
                            {{ $saleDelivery->sale->address }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Phone</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">
                            {{ $saleDelivery->sale->phone }}</p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Driver</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">
                            {{ $saleDelivery->mainDriver->name }}
                        </p>
                    </div>

                    <div class="form-group form-group-default">
                        <label>PIC</label>
                        <p type="text" class="form-control" style="margin-bottom: -4px;">
                            {{ $saleDelivery->backupDriver->name }}</p>
                    </div>
                </div>

                

            </div>
        </div>
    </div>
</div>
