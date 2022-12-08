@if(Auth::user()->dealer_code == 'group')
@push('button')
    @section('button-title','Add New Dealer')
    @include('component.button-add')
@endpush
@endif

<div class="col-md-12" id="dataCreate" @if(Session::has('display')) style="display: block;" @else style="display: none;" @endif>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title">Add New Dealer</h4>
                </div>
                <div class="col-2">
                    <h4 class="card-title" style="text-align: right; cursor: pointer; color: red;" id="btnCloseCreate"><i class="fas fa-times-circle"></i></h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('dealer.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="dealer_code" type="text"
                                class="form-control input-border-bottom @if(session()->has('message')) is-invalid @endif"
                                name="dealer_code" value="{{ old('dealer_code') }}" autofocus required>
                            <label for="dealer_code" class="placeholder">Dealer Code</label>
                            
                            @if(session()->has('message'))
                            <span class="invalid-feedback">
                                <strong>{{ session('message') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="dealer_name" type="text" class="form-control input-border-bottom"
                                name="dealer_name" value="{{ old('dealer_name') }}" required>
                            <label for="dealer_name" class="placeholder">Dealer Name</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="phone" type="text" class="form-control input-border-bottom"
                                name="phone" value="{{ old('phone') }}" required>
                            <label for="phone" class="placeholder">Phone</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-floating-label">
                            <input id="phone2" type="number" class="form-control input-border-bottom"
                                name="phone2" value="{{ old('phone2') }}" required>
                            <label for="phone2" class="placeholder">Whatsapp</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-floating-label">
                            <input id="address" type="text" class="form-control input-border-bottom"
                                name="address" value="{{ old('address') }}" required>
                            <label for="address" class="placeholder">Address</label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

@push('after-script')
    <script>
        $(document).ready(function(){
            $('#btnCreate').click(function(){
                $(this).css('display','none');
                $('#dataCreate').fadeIn();
            });

            $('#btnCloseCreate').click(function(){
                $('#dataCreate').css('display','none');
                $('#btnCreate').fadeIn();
            });
        });
    </script>

    <script>
        $("#phone2").on("input", function() {
            if (/^0/.test(this.value)) {
                this.value = this.value.replace(/^0/, "")
            }
        })
    </script>
@endpush
