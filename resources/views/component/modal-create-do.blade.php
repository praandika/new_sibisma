<div class="modal fade" id="modalCreateDo" tabindex="-1"
    role="dialog" aria-labelledby="modalCreateDoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateDoLabel">
                    <i class="fas fa-truck"></i>
                    Create Delivery Order
                </h5>

                <button type="button"
                    class="close"
                    data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form id="formCreateDo">
                @csrf
                <input type="hidden"
                    name="spk_no"
                    id="do_spk_no">

                <div class="modal-body">
                    {{-- LOADING --}}

                    <div id="doLoading"
                        class="text-center py-4">
                        <i class="fas fa-spinner fa-spin fa-2x"></i>
                        <div class="mt-2">
                            Mengambil data penjualan...
                        </div>
                    </div>


                    {{-- CONTENT --}}
                    <div id="doContent" style="display:none;">

                        {{-- DETAIL SALES --}}
                        <div class="card mb-3">
                            <div class="card-header">
                                <strong>
                                    <i class="fas fa-file-invoice"></i>
                                    Detail Penjualan
                                </strong>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>SPK No</label>
                                            <input type="text"
                                                id="do_spk_display"
                                                class="form-control"
                                                readonly>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Jual</label>
                                            <input type="text"
                                                id="do_sale_date"
                                                class="form-control"
                                                readonly>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Customer</label>
                                            <input type="text"
                                                id="do_customer"
                                                class="form-control"
                                                readonly>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>STNK Name</label>
                                            <input type="text"
                                                id="do_stnk_name"
                                                class="form-control"
                                                readonly>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Model</label>
                                            <input type="text"
                                                id="do_model"
                                                class="form-control"
                                                readonly>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Color</label>
                                            <input type="text"
                                                id="do_color"
                                                class="form-control"
                                                readonly>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Year</label>
                                            <input type="text"
                                                id="do_year"
                                                class="form-control"
                                                readonly>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Frame No</label>
                                            <input type="text"
                                                id="do_frame"
                                                class="form-control"
                                                readonly>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Engine No</label>
                                            <input type="text"
                                                id="do_engine"
                                                class="form-control"
                                                readonly>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Alamat Pengiriman</label>
                                            <textarea
                                                id="do_address"
                                                class="form-control"
                                                rows="2"
                                                readonly></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- DELIVERY --}}
                        <div class="card">
                            <div class="card-header">
                                <strong>
                                    <i class="fas fa-shipping-fast"></i>
                                    Delivery
                                </strong>
                            </div>

                            <div class="card-body">
                                {{-- SELF PICKUP --}}
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="do_self_pickup">
                                        <label class="custom-control-label"
                                            for="do_self_pickup">
                                            Ambil Sendiri
                                        </label>
                                    </div>

                                    <input type="hidden"
                                    name="delivery_type"
                                    id="delivery_type"
                                    value="DELIVERY">
                                </div>

                                {{-- DRIVER --}}
                                <div id="driverSection">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Nama Sopir
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                    name="driver_name"
                                                    id="driver_name"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Backup Sopir
                                                </label>
                                                <input type="text"
                                                    name="backup_driver"
                                                    id="backup_driver"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- CATATAN --}}

                                <div id="notesSection"
                                    style="display:none;">
                                    <div class="form-group">
                                        <label>
                                            Catatan
                                        </label>
                                        <textarea
                                            name="notes"
                                            id="do_notes"
                                            class="form-control"
                                            rows="3"
                                            placeholder="Catatan pengambilan..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit"
                        id="btnCreateDo"
                        class="btn btn-success"
                        disabled>
                        <i class="fas fa-truck"></i>
                        Buat DO
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('after-script')
<script>
    $(document).on('change', '#do_self_pickup', function () {

        if ($(this).is(':checked')) {

            // Hide driver
            $('#driverSection').slideUp(200);

            // Kosongkan value
            $('#driver_name').val('');
            $('#backup_driver').val('');

            // Tampilkan catatan
            $('#notesSection').slideDown(200);

        } else {

            // Tampilkan driver
            $('#driverSection').slideDown(200);

            // Sembunyikan catatan
            $('#notesSection').slideUp(200);

            // Kosongkan catatan
            $('#do_notes').val('');

        }

    });
</script>

<script>
    $('#formCreateDo').submit(function (e) {

        e.preventDefault();

        const btn = $('#btnCreateDo');

        btn.prop('disabled', true);

        btn.html(`
            <i class="fas fa-spinner fa-spin"></i>
            Membuat DO...
        `);


        $.ajax({

            url: "{{ route('sale-delivery.store') }}",

            type: "POST",

            data: $(this).serialize(),

            dataType: "json",

            success: function (res) {

                // Tutup modal
                $('#modalCreateDo').modal('hide');


                // Buka halaman PDF DO
                window.open(res.url, '_blank');

                // Kembalikan button
                btn.prop('disabled', false);

                btn.html(`
                    <i class="fas fa-truck"></i>
                    Buat DO
                `);

            },

            error: function (xhr) {

                console.log(xhr.responseJSON);

                let message = 'Gagal membuat Delivery Order.';

                if (
                    xhr.responseJSON &&
                    xhr.responseJSON.message
                ) {
                    message = xhr.responseJSON.message;
                }

                alert(message);


                btn.prop('disabled', false);

                btn.html(`
                    <i class="fas fa-truck"></i>
                    Buat DO
                `);

            }

        });

    });
</script>

<script>
    $('#do_self_pickup').change(function () {

        if ($(this).is(':checked')) {

            $('#delivery_type').val('SELF_PICKUP');

            $('#driverSection').slideUp(200);

            $('#driver_name').val('');
            $('#backup_driver').val('');

            $('#notesSection').slideDown(200);

        } else {

            $('#delivery_type').val('DELIVERY');

            $('#driverSection').slideDown(200);

            $('#notesSection').slideUp(200);

            $('#do_notes').val('');

        }

    });
</script>
@endpush