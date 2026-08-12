@push('after-css')
<style>
    .spk-detail-card {
        border-radius: 10px;
    }

    .detail-label {
        color: #999;
        font-size: 12px;
        display: block;
    }

    .detail-value {
        font-weight: 600;
        font-size: 14px;
    }

    .credit-status {
        font-size: 12px;
        padding: 5px 10px;
        border-radius: 20px;
    }

    /* =========================
    CREDIT TIMELINE
    ========================= */

    .credit-timeline {
        position: relative;
        width: 100%;
        margin: 30px auto;
        padding: 10px 0;
    }

    /* GARIS TENGAH */
    .credit-timeline::before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 50%;
        width: 3px;
        background: #ddd;
        transform: translateX(-50%);
    }

    /* ITEM */
    .timeline-item {
        position: relative;
        width: 100%;
        min-height: 100px;
        margin-bottom: 30px;
    }

    /* TITIK DI TENGAH */
    .timeline-dot {
        position: absolute;
        left: 50%;
        top: 10px;

        width: 20px;
        height: 20px;

        border-radius: 50%;
        border: 3px solid #fff;

        transform: translateX(-50%);

        z-index: 2;

        box-shadow: 0 0 0 2px #ddd;
    }

    /* WARNA STATUS */

    .timeline-dot.survey {
        background: #ffc107;
    }

    .timeline-dot.acc {
        background: #28a745;
    }

    .timeline-dot.reject {
        background: #dc3545;
    }

    .timeline-dot.cancel {
        background: #6c757d;
    }


    /* =========================
    CONTENT
    ========================= */

    .timeline-content {
        width: calc(50% - 40px);

        background: #f8f9fa;
        border-radius: 8px;

        padding: 12px 15px;

        border: 1px solid #eee;

        position: relative;
    }


    /* ITEM GANJIL → KIRI */

    .timeline-item:nth-child(odd) .timeline-content {
        margin-right: auto;
    }


    /* ITEM GENAP → KANAN */

    .timeline-item:nth-child(even) .timeline-content {
        margin-left: auto;
    }


    /* =========================
    PANAH KE GARIS
    ========================= */

    .timeline-item:nth-child(odd) .timeline-content::after {
        content: '';

        position: absolute;

        right: -10px;
        top: 15px;

        width: 18px;
        height: 18px;

        background: #f8f9fa;

        border-top: 1px solid #eee;
        border-right: 1px solid #eee;

        transform: rotate(45deg);
    }


    .timeline-item:nth-child(even) .timeline-content::after {
        content: '';

        position: absolute;

        left: -10px;
        top: 15px;

        width: 18px;
        height: 18px;

        background: #f8f9fa;

        border-left: 1px solid #eee;
        border-bottom: 1px solid #eee;

        transform: rotate(45deg);
    }


    /* STATUS */

    .timeline-status {
        font-weight: bold;
        font-size: 14px;
    }

    .timeline-date {
        font-size: 11px;
        color: #999;
    }

    .timeline-reason {
        margin-top: 7px;
        font-size: 13px;
    }

</style>
@endpush


@section('title','History Credit')
@section('page-title','History Credit')


@push('link-bread')
<li class="nav-item">
    <a href="{{ route('spk.index') }}">
        Data SPK
    </a>
</li>

<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>

<li class="nav-item">
    <a href="#">
        History Credit
    </a>
</li>
@endpush

<div class="col-md-12">

    {{-- ========================= --}}
    {{-- DETAIL SPK --}}
    {{-- ========================= --}}

    <div class="card spk-detail-card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title mb-1">
                        Detail SPK
                    </h4>
                    <small class="text-muted">
                        {{ $spk->spk_no }}
                    </small>
                </div>

                {{-- UPDATE STATUS --}}
                @if($spk->payment_method == 'CREDITCARD')
                    <button type="button"
                        class="btn btn-primary btn-round"
                        data-toggle="modal"
                        data-target="#modalStatusCredit">

                        <i class="fas fa-sync-alt mr-1"></i>
                        Update Status Kredit
                    </button>
                @endif
            </div>
        </div>


        <div class="card-body">
            <div class="row">

                {{-- CUSTOMER --}}
                <div class="col-md-3 mb-3">
                    <span class="detail-label">
                        Customer
                    </span>
                    <span class="detail-value">
                        {{ $spk->order_name ?: '-' }}
                    </span>
                </div>


                {{-- PEMOHON --}}
                <div class="col-md-3 mb-3">
                    <span class="detail-label">
                        Pemohon
                    </span>
                    <span class="detail-value">
                        {{ $spk->pemohon_name ?: '-' }}
                    </span>
                </div>


                {{-- SPK --}}
                <div class="col-md-3 mb-3">
                    <span class="detail-label">
                        SPK No
                    </span>
                    <span class="detail-value">
                        {{ $spk->spk_no }}
                    </span>
                </div>


                {{-- TANGGAL --}}
                <div class="col-md-3 mb-3">
                    <span class="detail-label">
                        Tanggal SPK
                    </span>
                    <span class="detail-value">
                        {{ $spk->spk_date ?: '-' }}
                    </span>
                </div>


                {{-- MODEL --}}
                <div class="col-md-3 mb-3">
                    <span class="detail-label">
                        Model
                    </span>
                    <span class="detail-value">
                        {{ $spk->model_name ?: '-' }}
                    </span>
                </div>


                {{-- FRAME --}}
                <div class="col-md-3 mb-3">
                    <span class="detail-label">
                        Frame No
                    </span>
                    <span class="detail-value">
                        {{ $spk->frame_no ?: '-' }}
                    </span>
                </div>


                {{-- LEASING --}}
                <div class="col-md-3 mb-3">
                    <span class="detail-label">
                        Leasing
                    </span>
                    <span class="detail-value">
                        {{ $spk->leasing ?: '-' }}
                    </span>
                </div>

                {{-- STATUS --}}
                <div class="col-md-3 mb-3">
                    <span class="detail-label">
                        Status Kredit
                    </span>

                    @php
                    $status = strtolower($spk->credit_status ?? '');
                    @endphp

                    @if($status == 'acc')

                    <span class="badge badge-success credit-status">
                        ACC
                    </span>

                    @elseif($status == 'survey')

                    <span class="badge badge-warning credit-status">
                        SURVEY
                    </span>

                    @elseif($status == 'reject')

                    <span class="badge badge-danger credit-status">
                        REJECT
                    </span>

                    @elseif($status == 'cancel')

                    <span class="badge badge-dark credit-status">
                        CANCEL
                    </span>

                    @else

                    <span class="badge badge-light credit-status">
                        {{ $spk->credit_status ?: 'BELUM ADA' }}
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- ========================= --}}
    {{-- TIMELINE --}}
    {{-- ========================= --}}

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                <i class="fas fa-history mr-1"></i>
                Timeline History Credit
            </h4>
        </div>


        <div class="card-body">
            @if($history->count())
            <div class="credit-timeline">

                @foreach($history as $item)

                @php
                $status = strtolower($item->credit_status ?? '');

                $dotClass = in_array($status, [
                'survey',
                'acc',
                'reject',
                'cancel'
                ])
                ? $status
                : 'cancel';
                @endphp


                <div class="timeline-item">
                    {{-- DOT --}}
                    <div class="timeline-dot {{ $dotClass }}"></div>

                    <div class="timeline-content">
                        <div class="d-flex justify-content-between">
                            <div>
                                @if($status == 'survey')
                                <span class="badge badge-warning">
                                    SURVEY
                                </span>
                                @elseif($status == 'acc')
                                <span class="badge badge-success">
                                    ACC
                                </span>
                                @elseif($status == 'reject')
                                <span class="badge badge-danger">
                                    REJECT
                                </span>
                                @elseif($status == 'cancel')
                                <span class="badge badge-secondary">
                                    CANCEL
                                </span>
                                @else
                                <span class="badge badge-light">
                                    {{ strtoupper($item->credit_status) }}
                                </span>
                                @endif
                            </div>

                            <div class="timeline-date">
                                {{ \Carbon\Carbon::parse($item->update_date)->format('d M Y') }}
                            </div>
                        </div>


                        {{-- REASON --}}
                        @if($item->reason)
                        <div class="timeline-reason">
                            <strong>Alasan:</strong>
                            {{ $item->reason }}
                        </div>
                        @endif


                        {{-- SALESMAN --}}
                        @if($item->spk->manpower)
                        <div class="timeline-date mt-2">
                            Salesman: {{ $item->spk->manpower }}
                        </div>
                        @endif

                        {{-- USER --}}
                        @if($item->user->username)
                        <div class="timeline-date mt-2">
                            <i class="fas fa-user mr-1"></i>
                            Updated by: {{ $item->user->username }}
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @else

            <div class="text-center py-5 text-muted">
                <i class="fas fa-history fa-2x mb-3"></i>
                <br>
                Belum ada history credit.
            </div>
            @endif

        </div>
    </div>
</div>

<!-- MODAL UPDATE STATUS CREDIT -->
<div class="modal fade"
    id="modalStatusCredit"
    tabindex="-1"
    role="dialog"
    aria-labelledby="modalStatusCreditLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">

        <div class="modal-content">

            {{-- HEADER --}}
            <div class="modal-header">

                <h5 class="modal-title" id="modalStatusCreditLabel">
                    <i class="fas fa-credit-card mr-1"></i>
                    Update Status Kredit
                </h5>

                <button type="button"
                    class="close"
                    data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>


            {{-- FORM --}}
            <form action="{{ route('spk.credit-status-update', $spk->spk_no) }}"
                method="POST"
                id="formCreditStatus">

                @csrf

                <div class="modal-body">

                    {{-- SPK --}}
                    <div class="form-group">

                        <label>
                            SPK No
                        </label>

                        <input type="text"
                            class="form-control"
                            value="{{ $spk->spk_no }}"
                            readonly>

                    </div>


                    {{-- CURRENT STATUS --}}
                    <div class="form-group">

                        <label>
                            Status Saat Ini
                        </label>

                        <input type="text"
                            class="form-control"
                            value="{{ strtoupper($spk->credit_status ?: '-') }}"
                            readonly>

                    </div>


                    {{-- STATUS BARU --}}
                    <div class="form-group">

                        <label for="creditStatus">

                            Status Kredit

                            <span class="text-danger">
                                *
                            </span>

                        </label>

                        <select class="form-control"
                            id="creditStatus"
                            name="credit_status"
                            required>

                            <option value="">
                                -- Pilih Status --
                            </option>

                            <option value="SURVEY">
                                Survey
                            </option>

                            <option value="ACC">
                                ACC
                            </option>

                            <option value="REJECT">
                                Reject
                            </option>

                            <option value="CANCEL">
                                Cancel
                            </option>

                        </select>

                    </div>


                    {{-- REASON --}}
                    <div class="form-group"
                        id="creditReasonSection"
                        style="display:none;">

                        <label for="creditReason">

                            Alasan

                            <span class="text-danger">
                                *
                            </span>

                        </label>

                        <textarea
                            class="form-control"
                            id="creditReason"
                            name="reason"
                            rows="3"
                            placeholder="Masukkan alasan Reject / Cancel"></textarea>

                    </div>


                    <div class="alert alert-info mb-0">

                        <i class="fas fa-info-circle mr-1"></i>

                        Perubahan status akan disimpan ke
                        <strong>SPK</strong> dan dicatat ke
                        <strong>History Credit</strong>.

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="modal-footer">

                    <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">

                        Batal

                    </button>

                    <button type="submit"
                        class="btn btn-primary"
                        id="btnUpdateCredit">

                        <i class="fas fa-save mr-1"></i>

                        Update

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@push('after-script')

<script>

$(document).ready(function () {

    $('#creditStatus').on('change', function () {

        const status = $(this).val();

        if (status === 'REJECT' || status === 'CANCEL') {

            // TAMPILKAN ALASAN
            $('#creditReasonSection').slideDown(200);

            $('#creditReason')
                .val('')
                .prop('required', true);

        } else {

            // HIDE ALASAN
            $('#creditReasonSection').slideUp(200);

            // KOSONGKAN VALUE
            $('#creditReason')
                .val('')
                .prop('required', false);

        }

    });


    // RESET MODAL SAAT DITUTUP
    $('#modalStatusCredit').on('hidden.bs.modal', function () {

        $('#creditStatus').val('');

        $('#creditReason')
            .val('')
            .prop('required', false);

        $('#creditReasonSection').hide();

    });

});

</script>

@endpush