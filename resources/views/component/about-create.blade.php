@push('button')
@section('button-title','Add New About Us')
@include('component.button-add')
@endpush

<div class="col-md-12" id="dataCreate" @if(Session::has('display')) style="display: block;" @else style="display: none;"
    @endif>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title">Add New About Us</h4>
                </div>
                <div class="col-2">
                    <h4 class="card-title" style="text-align: right; cursor: pointer; color: red;" id="btnCloseCreate">
                        <i class="fas fa-times-circle"></i></h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('about.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-floating-label">
                            <textarea id="profile" type="text" class="form-control input-border-bottom" name="profile"
                                value="{{ old('profile') }}" autofocus required rows="8"></textarea>
                            <label for="profile" class="placeholder">Profile</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-floating-label">
                            <textarea id="visi" type="text" class="form-control input-border-bottom" name="visi"
                                value="{{ old('visi') }}" autofocus required rows="8"></textarea>
                            <label for="visi" class="placeholder">Visi</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-floating-label">
                            <textarea id="misi" type="text" class="form-control input-border-bottom" name="misi"
                                value="{{ old('misi') }}" autofocus required rows="8"></textarea>
                            <label for="misi" class="placeholder">Misi</label>
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
