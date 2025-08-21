<div class="card w-100">
    <div class="card-header bg-success text-white">
        <i class="fas fa-edit me-2"></i>Edit Gudang
    </div>
    <div class="card-body">
        <form id="formEditGudang">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $gudang->id }}">
            
            <div class="mb-3">
                <label>Blok</label>
                <input type="text" name="blok" class="form-control" value="{{ $gudang->blok }}" required>
            </div>
            
            <div class="mb-3">
                <label>Kategori</label>
                <select name="kategori_id" class="form-control" required>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" @if($kategori->id == $gudang->kategori_id) selected @endif>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3" required>{{ $gudang->keterangan }}</textarea>
            </div>
             <div class="mt-4 d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle me-1"></i> Simpan Perubahan
            </button>
            <button type="button" class="btn btn-danger btnKembaliGudang">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </button>
            </div>
        </form>
    </div>
</div>
