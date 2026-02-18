<div class="modal fade modalMove" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Moving Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i style="color: red;" class="fas fa-times"></i>
                    </span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form action="{{ route('warehouse.move', $id) }}" method="post">
                    @csrf()
                    <input type="hidden" name="old" value="{{ $gudang }}">
                    <label for="new" class="placeholder">Pindah ke:</label>
                    <select class="form-control"
                        name="new" value="{{ old('new') }}" required>
                        @foreach($dataGudang as $o)
                        <option value="{{ $o->name }}">{{ $o->name }} {{ $gudang == $o->name ? '(Saat Ini)' : '' }}</option>
                        @endforeach
                    </select>
                    <br>

                    <button class="btn btn-primary"><i class="fa fa-arrow-right"></i>&nbsp;&nbsp;Move</button>
                </form>
            </div>
            <!-- Modal Footer -->
            @include('component.modal-footer')
        </div>
    </div>
</div>
