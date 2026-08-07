{{-- Modal Konfirmasi Cancel --}}
<div class="modal fade" id="modalCancelSpk" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle" style="color:#e0a800;"></i>
                    Konfirmasi Cancel
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Apakah kamu yakin ingin membatalkan SPK <strong id="spkNoCancel"></strong> ini?</p>
                <p class="text-muted" style="font-size:13px;">Tindakan ini tidak bisa dibatalkan setelah diproses.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a href="#" id="btnConfirmCancelSpk" target="_blank" class="btn btn-danger">
                    <i class="fas fa-times"></i> Ya, Cancel
                </a>
            </div>
        </div>
    </div>
</div>