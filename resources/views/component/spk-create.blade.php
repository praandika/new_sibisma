@push('after-css')
<style>
    input[type=date]:required:invalid::-webkit-datetime-edit {
        color: transparent;
    }
    input[type=date]:focus::-webkit-datetime-edit {
        color: black !important;
    }
    ::-webkit-input-placeholder { /* WebKit browsers */
        text-transform: none;
    }
    :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
        text-transform: none;
    }
    ::-moz-placeholder { /* Mozilla Firefox 19+ */
        text-transform: none;
    }
    :-ms-input-placeholder { /* Internet Explorer 10+ */
        text-transform: none;
    }
    ::placeholder { /* Recent browsers */
        text-transform: none;
    }
</style>
@endpush

@section('title','Create SPK')
@section('page-title','SPK')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('spk.index') }}">Data SPK</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Create</a>
</li>
@endpush

<div class="col-md-12" id="dataCreate">
    <div class="card">
        <div class="card-header">
            <span id="color_code" style="
                width: 10px; height: 50%; 
                display: inline-block;
                position: absolute;
                left: 0px;
                top: 0px;">
            </span>
            <div class="row">
                <h4 class="card-title">Create SPK</h4>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('spk.store')}}" method="post" id="form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="spk_date">Date *</label>
                            <input id="spk_date" type="date" class="form-control form-control-sm"
                                name="spk_date" value="{{ $today }}" required readonly>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="customer_name">Customer Name</label>
                            <input id="customer_name" type="text" class="form-control form-control-sm" name="customer_name" value="{{ old('customer_name') }}" style="text-transform: uppercase;"
                                data-toggle="modal"
                                data-target=".modalProspect" required>
                            <button id="btnSyncProspect"
                                style="
                                    border: none;
                                    cursor: pointer;
                                    background-color: #65eb89;
                                    border-radius: 0 0 10px 10px;
                                ">
                                <i class="fas fa-sync"></i> Update
                            </button>

                            <span id="syncInfo" class="ml-3 text-success font-weight-bold"></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="model_name">Motor</label>
                            <input id="model_name" type="text" class="form-control form-control-sm" name="model_name" value="{{ old('model_name') }}" style="text-transform: uppercase;" required maxlength="100">
                            <span id="stockStatus"></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="frame_no">Frame No</label>
                            <input id="frame_no" type="text" class="form-control form-control-sm" name="frame_no" value="{{ old('frame_no') }}" style="text-transform: uppercase;" required maxlength="100">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="engine_no">Engine No</label>
                            <input id="engine_no" type="text" class="form-control form-control-sm" name="engine_no" value="{{ old('engine_no') }}" style="text-transform: uppercase;" required maxlength="100">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="color">Faktur Color</label>
                            <input id="color" type="text" class="form-control form-control-sm" name="color" value="{{ old('color') }}" style="text-transform: uppercase;" required maxlength="100">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="year">Year MC</label>
                            <input id="year" type="text" class="form-control form-control-sm" name="year" value="{{ old('year') }}" style="text-transform: uppercase;" required maxlength="100">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="address_shipment">Pengiriman Address</label>
                            <input id="address_shipment" type="text" class="form-control form-control-sm" name="address_shipment" value="{{ old('address_shipment') }}" style="text-transform: uppercase;" required maxlength="100">
                        </div>
                    </div>

                    <div class="col-md-3" style="margin-top: 12px;">
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#uploadKtp" aria-expanded="false" aria-controls="uploadKtp" style="font-weight: bold;">
                            Upload / Take an ID-KTP photo
                        </button>
                        <div class="collapse" id="uploadKtp">
                            <div class="card card-body">
                                <div class="form-group form-floating-label">
                                    <input id="picture" type="file" class="form-control input-border-bottom" name="picture"
                                        value="{{ old('picture') }}">
                                    <label for="picture" class="placeholder" style="
                                    background-color: forestgreen; 
                                    color: #ffffff !important; 
                                    font-weight: bold;
                                    width: 200px; 
                                    padding-left: 20px; 
                                    padding-right: 20px;
                                    padding-top: 10px; 
                                    border-radius: 5px;
                                    position: absolute;
                                    top: 20px;
                                    cursor: pointer;"><i class="fa fa-upload"></i>&nbsp;&nbsp;Upload File</label>
                                </div>

                                <div class="form-group form-floating-label" style="position: relative;">
                                    <input id="photo" type="file" accept="image/*" capture="user"
                                        class="form-control input-border-bottom" name="photo"
                                        value="{{ old('photo') }}">
                                    <label for="photo" class="placeholder" style="
                                background-color: teal; 
                                color: #ffffff !important; 
                                font-weight: bold;
                                width: 200px; 
                                padding-left: 20px; 
                                padding-right: 20px;
                                padding-top: 10px; 
                                border-radius: 5px;
                                position: absolute;
                                top: 20px;
                                cursor: pointer;"><i class="fa fa-camera"></i>&nbsp;&nbsp;Take a Photo</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Update</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

@include('component.modal-prospect')
@include('component.modal-frame')

@push('after-script')
<script>

    $('#on_hand').keypress(function(e){
        e.preventDefault();
    });

    $('#on_hand').keydown(function(e){
        e.preventDefault();
    });

    // Custom Upload File
    $(document).ready(function () {
        $("#picture").change(function () {
            filename = this.picture[0].name;
            console.log(filename);
        });
    });

    // Custom Upload File
    $(document).ready(function () {
        $("#photo").change(function () {
            filename = this.photo[0].name;
            console.log(filename);
        });
    });
</script>

<script>
    // Check Stock
    function checkStock(model, color)
    {
        console.log("Model dikirim:", model)
        console.log("Warna dikirim:", color)

        $.get('/spk-checkstock',{
            model:model,
            color:color
        },function(res){

            console.log(res);
            console.log("ready =", res.ready);

            if(res.ready){
                console.log("READY")

                loadFrameModal(res.data);

                $('.modalFrame').modal('show');

            }else{

                $('#frame_no').val('');
                $('#frame_no').prop('disabled',true);

                $('#year').val('');
                $('#year').prop('disabled',true);

                $('#engine_no').val('');
                $('#engine_no').prop('disabled',true);

                $('#color').val('');
                $('#color').prop('disabled',true);
                

                $('#stockStatus')
                    .html('<span class="badge badge-warning">INDENT</span>');
            }

        });
    }
</script>

<script>
    $('#btnSyncProspect').click(function(){

        $('#btnSyncProspect').prop('disabled', true);

        $('#syncInfo').html(
            '<i class="fas fa-spinner fa-spin"></i> Synchronizing...'
        );

        $.ajax({

            url: "{{ route('dpack.manual-prospect') }}",

            type: "POST",

            data: {
                _token: "{{ csrf_token() }}"
            },

            success: function(res){

                $('#btnSyncProspect').prop('disabled', false);

                $('#syncInfo').html(
                    '<span class="badge badge-success">' +
                    res.new_data +
                    ' Prospect baru</span>'
                );

                loadLogs();

            },

            error:function(){

                $('#btnSyncProspect').prop('disabled', false);

                $('#syncInfo').html(
                    '<span class="badge badge-danger">Sync gagal</span>'
                );

            }

        });

    }); 
</script>
@endpush
