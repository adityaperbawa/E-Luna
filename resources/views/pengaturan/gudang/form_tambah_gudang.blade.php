<div class="card w-100">
    <div class="card-header bg-success text-white">
        <i class="fas fa-plus me-2"></i>Tambah Gudang
    </div>
    <div class="card-body">
        <form id="formTambahGudang">
            @csrf
            <div class="mb-3">
                <label>Blok</label>
                <input type="text" name="blok" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Kategori</label>
                <select name="kategori_id" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mt-4 d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save me-1"></i> Simpan
            </button>
            <button type="button" class="btn btn-danger btnKembaliGudang">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </button>
            </div>
        </form>
    </div>
</div>