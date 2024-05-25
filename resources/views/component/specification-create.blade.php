@push('after-css')
<style>
    ::-webkit-input-placeholder {
        /* WebKit browsers */
        text-transform: none;
    }

    :-moz-placeholder {
        /* Mozilla Firefox 4 to 18 */
        text-transform: none;
    }

    ::-moz-placeholder {
        /* Mozilla Firefox 19+ */
        text-transform: none;
    }

    :-ms-input-placeholder {
        /* Internet Explorer 10+ */
        text-transform: none;
    }

    ::placeholder {
        /* Recent browsers */
        text-transform: none;
    }

</style>
@endpush

@push('button')
@section('button-title','Add New Specification')
@include('component.button-add')
@endpush

<div class="col-md-12" id="dataCreate" @if(Session::has('display')) style="display: block;" @else style="display: none;"
    @endif>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title">Add New Specification</h4>
                </div>
                <div class="col-2">
                    <h4 class="card-title" style="text-align: right; cursor: pointer; color: red;" id="btnCloseCreate">
                        <i class="fas fa-times-circle"></i></h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('specification.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <input id="model_name" type="text" class="form-control input-border-bottom" name="model_name" data-toggle="modal"
                            data-target=".modalSpec"
                            placeholder="Choose Model"
                            value="{{ old('model_name') }}" required>
                    </div>
                </div>
                <br>
                <br>
                <h2>Mesin</h2>
                <div class="wrapperInput">
                    <div class="row inputan">
                        <div class="col-md-4">
                            <div class="form-group form-floating-label">
                                <input id="mesin_title" type="text" class="form-control input-border-bottom"
                                    name="mesin_title[]" value="{{ old('mesin_title') }}"
                                 required>
                                <label for="mesin_title" class="placeholder">Mesin Title</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group form-floating-label">
                                <input id="mesin_spec" type="text" class="form-control input-border-bottom"
                                    name="mesin_spec[]" value="{{ old('mesin_spec') }}"
                                 required>
                                <label for="mesin_spec" class="placeholder">Mesin Specification</label>
                            </div>
                        </div>

                        <div class="col-md-2" style="padding: 0px 20px;">
                            <button id="addRow" class="btn btn-secondary" style="text-align: right; margin-left: 2px;"><i
                            class="fas fa-plus"></i>&nbsp;&nbsp;Add Row</button>
                        </div>
                    </div>
                </div>

                <br>
                <br>
                <h2>Rangka</h2>
                <div class="wrapperInput2">
                    <div class="row inputan2">
                        <div class="col-md-4">
                            <div class="form-group form-floating-label">
                                <input id="rangka_title" type="text" class="form-control input-border-bottom"
                                    name="rangka_title[]" value="{{ old('rangka_title') }}"
                                 required>
                                <label for="rangka_title" class="placeholder">Rangka Title</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group form-floating-label">
                                <input id="rangka_spec" type="text" class="form-control input-border-bottom"
                                    name="rangka_spec[]" value="{{ old('rangka_spec') }}"
                                 required>
                                <label for="rangka_spec" class="placeholder">Rangka Specification</label>
                            </div>
                        </div>

                        <div class="col-md-2" style="padding: 0px 20px;">
                            <button id="addRow2" class="btn btn-secondary" style="text-align: right; margin-left: 2px;"><i
                            class="fas fa-plus"></i>&nbsp;&nbsp;Add Row</button>
                        </div>
                    </div>
                </div>

                <br>
                <br>
                <h2>Dimensi</h2>
                <div class="wrapperInput3">
                    <div class="row inputan3">
                        <div class="col-md-4">
                            <div class="form-group form-floating-label">
                                <input id="dimensi_title" type="text" class="form-control input-border-bottom"
                                    name="dimensi_title[]" value="{{ old('dimensi_title') }}"
                                 required>
                                <label for="dimensi_title" class="placeholder">Dimensi Title</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group form-floating-label">
                                <input id="dimensi_spec" type="text" class="form-control input-border-bottom"
                                    name="dimensi_spec[]" value="{{ old('dimensi_spec') }}"
                                 required>
                                <label for="dimensi_spec" class="placeholder">Dimensi Specification</label>
                            </div>
                        </div>

                        <div class="col-md-2" style="padding: 0px 20px;">
                            <button id="addRow3" class="btn btn-secondary" style="text-align: right; margin-left: 2px;"><i
                            class="fas fa-plus"></i>&nbsp;&nbsp;Add Row</button>
                        </div>
                    </div>
                </div>

                <br>
                <br>
                <h2>Kelistrikan</h2>
                <div class="wrapperInput4">
                    <div class="row inputan4">
                        <div class="col-md-4">
                            <div class="form-group form-floating-label">
                                <input id="kelistrikan_title" type="text" class="form-control input-border-bottom"
                                    name="kelistrikan_title[]" value="{{ old('kelistrikan_title') }}"
                                 required>
                                <label for="kelistrikan_title" class="placeholder">Kelistrikan Title</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group form-floating-label">
                                <input id="kelistrikan_spec" type="text" class="form-control input-border-bottom"
                                    name="kelistrikan_spec[]" value="{{ old('kelistrikan_spec') }}"
                                 required>
                                <label for="kelistrikan_spec" class="placeholder">Kelistrikan Specification</label>
                            </div>
                        </div>

                        <div class="col-md-2" style="padding: 0px 20px;">
                            <button id="addRow4" class="btn btn-secondary" style="text-align: right; margin-left: 2px;"><i
                            class="fas fa-plus"></i>&nbsp;&nbsp;Add Row</button>
                        </div>
                    </div>
                </div>

                <br>
                <br>
                <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                <button type="reset" class="btn btn-default"><i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</button>
            </form>
        </div>
    </div>
</div>

@section('modal-title','Data Unit')
@include('component.modal-spec')

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

    // Add dynamic field function mesin
    $(document).ready(function () {
        let field = `
            <div class="row inputan">
                <div class="col-md-4">
                    <div class="form-group form-floating-label">
                        <input id="mesin_title" type="text" class="form-control input-border-bottom"
                                    name="mesin_title[]" value="{{ old('mesin_title') }}" required>
                        <label for="mesin_title" class="placeholder">Mesin Title</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group form-floating-label">
                        <input id="mesin_spec" type="text" value="{{ old('mesin_spec') }}"
                                    class="form-control input-border-bottom" name="mesin_spec[]"
                                    value="{{ old('mesin_spec') }}" required>
                        <label for="mesin_spec" class="placeholder">Mesin Specification</label>
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

        $('.wrapperInput').on('click', '.removeRow', function (e) {
            e.preventDefault();
            $(this).parents('.inputan').fadeOut(function () {
                $(this).remove();
            });
        });
    });

    // Add dynamic field function rangka
    $(document).ready(function () {
        let field2 = `
            <div class="row inputan2">
                <div class="col-md-4">
                    <div class="form-group form-floating-label">
                        <input id="rangka_title" type="text" class="form-control input-border-bottom"
                                    name="rangka_title[]" value="{{ old('rangka_title') }}" required>
                        <label for="rangka_title" class="placeholder">Rangka Title</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group form-floating-label">
                        <input id="rangka_spec" type="text" value="{{ old('rangka_spec') }}"
                                    class="form-control input-border-bottom" name="rangka_spec[]"
                                    value="{{ old('rangka_spec') }}" required>
                        <label for="rangka_spec" class="placeholder">Rangka Specification</label>
                    </div>
                </div>

                <div class="col-md-2" style="padding: 0px 20px;">
                    <button class="removeRow2" style="
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
        $('#addRow2').on('click', function () {
            $('.wrapperInput2').append(field2).hide().fadeIn();
        });

        $('.wrapperInput2').on('click', '.removeRow2', function (e) {
            e.preventDefault();
            $(this).parents('.inputan2').fadeOut(function () {
                $(this).remove();
            });
        });
    });

    // Add dynamic field function dimensi
    $(document).ready(function () {
        let field3 = `
            <div class="row inputan3">
                <div class="col-md-4">
                    <div class="form-group form-floating-label">
                        <input id="dimensi_title" type="text" class="form-control input-border-bottom"
                                    name="dimensi_title[]" value="{{ old('dimensi_title') }}" required>
                        <label for="dimensi_title" class="placeholder">Dimensi Title</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group form-floating-label">
                        <input id="dimensi_spec" type="text" value="{{ old('dimensi_spec') }}"
                                    class="form-control input-border-bottom" name="dimensi_spec[]"
                                    value="{{ old('dimensi_spec') }}" required>
                        <label for="dimensi_spec" class="placeholder">Dimensi Specification</label>
                    </div>
                </div>

                <div class="col-md-2" style="padding: 0px 20px;">
                    <button class="removeRow3" style="
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
        $('#addRow3').on('click', function () {
            $('.wrapperInput3').append(field3).hide().fadeIn();
        });

        $('.wrapperInput3').on('click', '.removeRow3', function (e) {
            e.preventDefault();
            $(this).parents('.inputan3').fadeOut(function () {
                $(this).remove();
            });
        });
    });

    // Add dynamic field function kelistrikan
    $(document).ready(function () {
        let field4 = `
            <div class="row inputan4">
                <div class="col-md-4">
                    <div class="form-group form-floating-label">
                        <input id="kelistrikan_title" type="text" class="form-control input-border-bottom"
                                    name="kelistrikan_title[]" value="{{ old('kelistrikan_title') }}" required>
                        <label for="kelistrikan_title" class="placeholder">Kelistrikan Title</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group form-floating-label">
                        <input id="kelistrikan_spec" type="text" value="{{ old('kelistrikan_spec') }}"
                                    class="form-control input-border-bottom" name="kelistrikan_spec[]"
                                    value="{{ old('kelistrikan_spec') }}" required>
                        <label for="kelistrikan_spec" class="placeholder">Kelistrikan Specification</label>
                    </div>
                </div>

                <div class="col-md-2" style="padding: 0px 20px;">
                    <button class="removeRow4" style="
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
        $('#addRow4').on('click', function () {
            $('.wrapperInput4').append(field4).hide().fadeIn();
        });

        $('.wrapperInput4').on('click', '.removeRow4', function (e) {
            e.preventDefault();
            $(this).parents('.inputan4').fadeOut(function () {
                $(this).remove();
            });
        });
    });
</script>
@endpush
