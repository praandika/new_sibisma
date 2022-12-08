@section('title','Adjust Report')
@section('page-title','Adjust Report')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('report.adjust') }}">Adjust Report</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title">Adjust Report</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('report.adjust-store') }}" method="post">
                @csrf
                @if(Auth::user()->dealer_code == 'group')
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                        <input type="hidden" id="dealer_code" name="dealer_code" value="{{ old('dealer_code') }}" required>
                            <input id="dealer_name" name="dealer_name" type="text" class="form-control input-border-bottom" data-toggle="modal"
                                data-target=".modalDealer" value="{{ old('dealer_name') }}"
                                required>
                            <label for="dealer_name" class="placeholder">Select Dealer</label>
                        </div>
                    </div>
                </div>
                @else
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                        <input type="hidden" id="dealer_code" name="dealer_code" value="{{ $dc }}" required>
                            <input id="dealer_name" name="dealer_name" type="text" class="form-control input-border-bottom" value="{{ $dealer_name }}"
                                required readonly>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="date" name="date" type="date" class="form-control input-border-bottom" value="{{ $today }}"
                                required>
                            <label for="date" class="placeholder">Date</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="faktur" type="number" class="form-control input-border-bottom" name="faktur"
                                value="0" required>
                            <label for="faktur" class="placeholder">Faktur</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="service" type="number" class="form-control input-border-bottom" name="service"
                            value="0" required>
                            <label for="service" class="placeholder">Service</label>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin: 10px 10px;">
                    <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                    <button type="reset" class="btn btn-default" style="margin-left: 2px;"><i
                            class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if(Auth::user()->dealer_code == 'group')
<livewire:modal-dealer/>
@endif
