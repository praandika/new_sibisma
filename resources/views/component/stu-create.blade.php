@push('after-css')
<style>
    input[type=date]:required:invalid::-webkit-datetime-edit {
        color: transparent;
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
    @section('button-title','Add New STU')
    @include('component.button-add')
@endpush

<div class="col-md-12" id="dataCreate" style="display: none;">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title">Add New STU</h4>
                </div>
                <div class="col-2">
                    <h4 class="card-title" style="text-align: right; cursor: pointer; color: red;" id="btnCloseCreate">
                        <i class="fas fa-times-circle"></i></h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('stu.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="wrapperInput">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group form-floating-label">
                                <input id="stu_date" type="date" class="form-control input-border-bottom"
                                    name="stu_date" value="{{ old('stu_date') }}" style="text-transform: uppercase;" required>
                                <label for="stu_date" class="placeholder">Date *</label>
                            </div>
                        </div>  
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group form-floating-label">
                                <input id="dealer_code" type="hidden" class="form-control input-border-bottom"
                                    name="dealer_code[]" value="AA0101" style="text-transform: uppercase;" required>
                                <input id="stu" type="number" value="{{ old('stu') }}"
                                    class="form-control input-border-bottom" name="stu[]" style="text-transform: uppercase;" required>
                                <label for="stu" class="placeholder">Bisma Sentral</label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group form-floating-label">
                                <input id="dealer_code" type="hidden" class="form-control input-border-bottom"
                                    name="dealer_code[]" value="AA0102" style="text-transform: uppercase;" required>
                                <input id="stu" type="number" value="{{ old('stu') }}"
                                    class="form-control input-border-bottom" name="stu[]" style="text-transform: uppercase;" required>
                                <label for="stu" class="placeholder">Bisma Cokro</label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group form-floating-label">
                                <input id="dealer_code" type="hidden" class="form-control input-border-bottom"
                                    name="dealer_code[]" value="AA0104" style="text-transform: uppercase;" required>
                                <input id="stu" type="number" value="{{ old('stu') }}"
                                    class="form-control input-border-bottom" name="stu[]" style="text-transform: uppercase;" required>
                                <label for="stu" class="placeholder">Bisma Hasanudin</label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group form-floating-label">
                                <input id="dealer_code" type="hidden" class="form-control input-border-bottom"
                                    name="dealer_code[]" value="AA0105" style="text-transform: uppercase;" required>
                                <input id="stu" type="number" value="{{ old('stu') }}"
                                    class="form-control input-border-bottom" name="stu[]" style="text-transform: uppercase;" required>
                                <label for="stu" class="placeholder">Bisma TTS</label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group form-floating-label">
                                <input id="dealer_code" type="hidden" class="form-control input-border-bottom"
                                    name="dealer_code[]" value="AA0106" style="text-transform: uppercase;" required>
                                <input id="stu" type="number" value="{{ old('stu') }}"
                                    class="form-control input-border-bottom" name="stu[]" style="text-transform: uppercase;" required>
                                <label for="stu" class="placeholder">Bisma Imbo</label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group form-floating-label">
                                <input id="dealer_code" type="hidden" class="form-control input-border-bottom"
                                    name="dealer_code[]" value="AA0107" style="text-transform: uppercase;" required>
                                <input id="stu" type="number" value="{{ old('stu') }}"
                                    class="form-control input-border-bottom" name="stu[]" style="text-transform: uppercase;" required>
                                <label for="stu" class="placeholder">Bisma Mandiri</label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group form-floating-label">
                                <input id="dealer_code" type="hidden" class="form-control input-border-bottom"
                                    name="dealer_code[]" value="AA0108" style="text-transform: uppercase;" required>
                                <input id="stu" type="number" value="{{ old('stu') }}"
                                    class="form-control input-border-bottom" name="stu[]" style="text-transform: uppercase;" required>
                                <label for="stu" class="placeholder">Bisma Supratman</label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group form-floating-label">
                                <input id="dealer_code" type="hidden" class="form-control input-border-bottom"
                                    name="dealer_code[]" value="AA0109" style="text-transform: uppercase;" required>
                                <input id="stu" type="number" value="{{ old('stu') }}"
                                    class="form-control input-border-bottom" name="stu[]" style="text-transform: uppercase;" required>
                                <label for="stu" class="placeholder">Bisma Sunset</label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group form-floating-label">
                                <input id="dealer_code" type="hidden" class="form-control input-border-bottom"
                                    name="dealer_code[]" value="AA0104-01" style="text-transform: uppercase;" required>
                                <input id="stu" type="number" value="{{ old('stu') }}"
                                    class="form-control input-border-bottom" name="stu[]" style="text-transform: uppercase;" required>
                                <label for="stu" class="placeholder">Bisma Dalung</label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group form-floating-label">
                                <input id="dealer_code" type="hidden" class="form-control input-border-bottom"
                                    name="dealer_code[]" value="AA0104F" style="text-transform: uppercase;" required>
                                <input id="stu" type="number" value="{{ old('stu') }}"
                                    class="form-control input-border-bottom" name="stu[]" style="text-transform: uppercase;" required>
                                <label for="stu" class="placeholder">Bisma FSS</label>
                            </div>
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
</script>
@endpush
