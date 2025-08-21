<div class="card shadow-sm border-0 w-100">
    <div class="card-header bg-success text-white">
        <h6 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Kategori</h6>
    </div>
    <div class="card-body">
        <form id="formEditKategori">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $kategori->id }}">
            
            <div class="mb-3">
                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{ $kategori->nama_kategori }}" required>
            </div>

            <div class="mb-3">
                <label for="kode" class="form-label">Kode</label>
                <input type="text" class="form-control" id="kode" name="kode" value="{{ $kategori->kode }}" required>
            </div>

            <div class="mt-4 d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle me-1"></i> Simpan Perubahan
                </button>
                <button type="button" class="btn btn-danger btnKembaliKategori">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </button>
            </div>
        </form>
    </div>
</div>
