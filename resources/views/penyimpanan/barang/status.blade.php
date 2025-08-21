<div class="card shadow-sm">
    <div class="card-header bg-success text-white">
        <strong><i class="fas fa-clipboard-list me-2"></i>Catat Keterangan Barang</strong>
    </div>
    <div class="card-body">
        <form id="formStatusKadaluwarsa">
            @csrf
            <div class="mb-3">
                <textarea name="status" id="status" class="form-control" rows="4"
                    placeholder="Tuliskan status atau kondisi barang..." required>{{ $barang->status }}</textarea>
            </div>
            <div class="d-flex justify-content-end gap-2 px-3">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
                <button type="button" class="btn btn-danger btnTutupDetailKadaluwarsa">
                    <i class="fas fa-times me-1"></i> Tutup
                </button>
            </div>
        </form>
    </div>
</div>