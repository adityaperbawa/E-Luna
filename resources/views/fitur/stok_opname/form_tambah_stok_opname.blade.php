<div class="card">
    <div class="card-header bg-success text-white">
         Tambah Stok Opname
    </div>

    <div class="card-body">
        <form id="formTambahStokOpname">
            @csrf
            <div class="mb-3">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="4" required></textarea>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-1"></i>Simpan
                </button>
                <button type="button" id="cancelTambahStokOpname" class="btn btn-danger">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </button>
            </div>
        </form>
    </div>
</div>
