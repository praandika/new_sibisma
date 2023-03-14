@push('after-css')
<style>
    input[type="color"] {
        -webkit-appearance: none;
        border: none;
        height: 50px !important;
    }
    input[type="color"]::-webkit-color-swatch-wrapper {
        padding: 0;
    }
    input[type="color"]::-webkit-color-swatch {
        border: none;
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

@push('button')
    @section('button-title','Add New Color')
    @include('component.button-add')
@endpush

<div class="col-md-12" id="dataCreate" style="display: none;">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title">Add New Color</h4>
                </div>
                <div class="col-2">
                    <h4 class="card-title" style="text-align: right; cursor: pointer; color: red;" id="btnCloseCreate">
                        <i class="fas fa-times-circle"></i></h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('color.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="wrapperInput">
                    <div class="row inputan">
                        <div class="col-md-4">
                            <div class="form-group form-floating-label">
                                <input id="color_name" type="text" class="form-control input-border-bottom"
                                    name="color_name[]" value="{{ old('color_name') }}" style="text-transform: uppercase;" required>
                                <label for="color_name" class="placeholder">Color Name</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group form-floating-label">
                                <input id="color_faktur" type="text" class="form-control input-border-bottom"
                                    name="color_faktur[]" value="{{ old('color_faktur') }}" style="text-transform: uppercase;" required>
                                <label for="color_faktur" class="placeholder">Color Faktur</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group form-floating-label">
                                <input id="color_code" type="color" value="#000000"
                                    class="form-control input-border-bottom" name="color_code[]" style="text-transform: uppercase;" required>
                                <label for="color_code" class="placeholder">Select Color</label>
                            </div>
                        </div>

                        <div class="col-md-2" style="padding: 0px 20px;">
                            
                        </div>
                    </div>
                </div>

                <div class="row" style="margin: 10px 10px;">
                    <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                    <button type="reset" class="btn btn-default" style="margin-left: 2px;"><i
                            class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
                    <button id="addRow" class="btn btn-secondary" style="text-align: right; margin-left: 2px;"><i
                            class="fas fa-plus"></i>&nbsp;&nbsp;Add Row</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('after-script')
<script>
    $(document).ready(function () {
        $('#btnCreate').click(function () {
            $(this).css('display', 'none');
            $('#dataCreate').fadeIn();
        });

        $('#btnCloseCreate').click(function () {
            $('#dataCreate').css('display', 'none');
            $('#btnCreate').fadeIn();
        });
    });

    // Add dynamic field function
    $(document).ready(function () {
        let field = `
            <div class="row inputan">
                <div class="col-md-6">
                    <div class="form-group form-floating-label">
                        <input id="color_name" type="text" class="form-control input-border-bottom"
                                    name="color_name[]" value="{{ old('color_name') }}" style="text-transform: uppercase;" required>
                        <label for="color_name" class="placeholder">Color Name</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group form-floating-label">
                        <input id="color_code" type="color" value="#000000"
                                    class="form-control input-border-bottom" name="color_code[]"
                                    value="{{ old('color_code') }}" style="text-transform: uppercase;" required>
                        <label for="color_code" class="placeholder">Select Color</label>
                    </div>
                </div>

                <div class="col-md-2" style="padding: 0px 20px;">
                    <button class="removeRow" style="
                                border: none;
                                outline: none;
                                background-color: white;
                                color: red;
                                cursor: pointer;
                                padding: 10px;
                                margin: 0px 5px;
                                width: 97%;
                                height: 100%;
                                font-size: 15px;
                                "><span style="border: 1px solid red; padding: 10px;"><i class="fas fa-times"></i> Remove</span></button>
                </div>
            </div>
            `
        $('#addRow').on('click', function () {
            $('.wrapperInput').append(field).hide().fadeIn();
        });

        $('.wrapperInput').on('click', '.removeRow', function(e){
            e.preventDefault();
            $(this).parents('.inputan').fadeOut(function(){
                $(this).remove();
            });
        });
    });

</script>
@endpush
