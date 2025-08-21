<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Form Tambah Tujuan</h5>
        </div>
        <div class="card-body">
            <form id="formTambahTujuan">
                @csrf
                <div class="mb-3">
                    <label for="kab_kota" class="form-label">Kab/Kota</label>
                    <input type="text" name="kab_kota" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="instansi" class="form-label">Instansi</label>
                    <input type="text" name="instansi" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mt-4 d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-danger btnKembaliTujuan">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
