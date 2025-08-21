<div class="card w-100">
    <div class="card-header bg-success text-white">
        <i class="fas fa-edit me-2"></i>Edit Tujuan
    </div>
    <div class="card-body">
        <form id="formEditTujuan">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $tujuan->id }}">
            <div class="mb-3">
                <label for="kab_kota" class="form-label">Kab/Kota</label>
                <input type="text" name="kab_kota" value="{{ $tujuan->kab_kota }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="instansi" class="form-label">Instansi</label>
                <input type="text" name="instansi" value="{{ $tujuan->instansi }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" required>{{ $tujuan->alamat }}</textarea>
            </div>
            <div class="mt-4 d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle me-1"></i>Simpan Perubahan
                </button>
                <button type="button" class="btn btn-danger btnKembaliTujuan">
                    <i class="bi bi-arrow-left me-1"></i>Batal
                </button>
            </div>
        </form>
    </div>
</div>