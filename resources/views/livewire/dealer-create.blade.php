<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add New Dealer</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="dealerCreate" method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="inputFloatingLabel" type="text"
                                class="form-control input-border-bottom @if(session()->has('message')) is-invalid @endif"
                                name="dealer_code" wire:model="dealer_code" autofocus required>
                            <label for="inputFloatingLabel" class="placeholder">Dealer Code</label>
                            
                            @if(session()->has('message'))
                            <span class="invalid-feedback">
                                <strong>{{ session('message') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="inputFloatingLabel" type="text" class="form-control input-border-bottom"
                                name="dealer_name" wire:model="dealer_name" required>
                            <label for="inputFloatingLabel" class="placeholder">Dealer Name</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-floating-label">
                            <input id="inputFloatingLabel" type="text" class="form-control input-border-bottom"
                                name="phone" wire:model="phone" required>
                            <label for="inputFloatingLabel" class="placeholder">Phone</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-floating-label">
                            <input id="inputFloatingLabel" type="text" class="form-control input-border-bottom"
                                name="address" wire:model="address" required>
                            <label for="inputFloatingLabel" class="placeholder">Address</label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
            </form>
        </div>
    </div>
</div>
