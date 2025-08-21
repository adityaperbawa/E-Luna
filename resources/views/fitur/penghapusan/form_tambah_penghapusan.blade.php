<div class="card">
    <div class="card-header bg-success text-white">
        <i class="fas fa-plus me-2"></i>Tambah Data Penghapusan
    </div>
    <div class="card-body">
        <form id="formTambahPenghapusan">
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
                <textarea name="keterangan" rows="4" class="form-control" required></textarea>
            </div>
            <div class="text-end mt-4">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save me-1"></i>Simpan
            </button>
            <button type="button" id="cancelTambahPenghapusan" class="btn btn-danger">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </button>
            </div>
        </form>
    </div>
</div>
