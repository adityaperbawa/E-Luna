<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h6 class="mb-0">Form Tambah Kategori</h6>
        </div>
        <div class="card-body">
            <form id="formTambahKategori">
                @csrf
                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" required>
                </div>
                <div class="mb-3">
                    <label for="kode" class="form-label">Kode</label>
                    <input type="text" class="form-control" name="kode" id="kode" required>
                </div>
                <div class="mt-4 d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-danger btnKembaliKategori">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
