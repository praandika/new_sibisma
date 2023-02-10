@if(Route::is('spk.filter'))
<div class="col-md-12" id="dataFilter">
@else
<div class="col-md-12" id="dataFilter" @if(Session::has('display')) style="display: block;" @else style="display: none;" @endif>
@endif
    <div class="card" style="background-color: #1b6cb2;">
        <div class="card-header">
            <div class="form-group">
            <form action="{{ route('spk.filter') }}" method="get">
                <div class="row">
                    <!-- FORM -->
                    
                        <div class="col-md-4">
                            <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Select Unit" aria-label=""
                                        aria-describedby="basic-addon1" name="unitName"
                                        data-toggle="modal" 
                                        data-target=".modalUnit"
                                        id="unitName">
                                    <input type="hidden" name="unit" id="unit">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Select Color" aria-label=""
                                        aria-describedby="basic-addon1" name="colorName"
                                        data-toggle="modal" 
                                        data-target=".modalColor"
                                        id="colorName">
                                    <input type="hidden" name="color" id="color">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Select Payment Method" aria-label=""
                                    aria-describedby="basic-addon1" name="paymentMethod" 
                                    data-toggle="modal"
                                    data-target=".modalPaymentMethodSearch"
                                    id="paymentMethod" style="text-transform: capitalize;">
                                <div class="input-group-prepend">
                                    <button class="btn btn-warning" type="submit" data-toggle="tooltip" data-placement="top" title="Search"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    
                    <!-- END FORM -->
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

@include('component.modal-payment-method-search')
@include('component.modal-unit')
@include('component.modal-color')