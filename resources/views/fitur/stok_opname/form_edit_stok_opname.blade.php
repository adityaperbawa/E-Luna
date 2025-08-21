<div class="card">
    <div class="card-header bg-success text-white">
        Edit Stok Opname
    </div>

    <div class="card-body">
        <form id="formEditStokOpname">
            @csrf
            <input type="hidden" name="id" value="{{ $stok->id }}">
            <div class="mb-3">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ $stok->judul }}" required>
            </div>
            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $stok->tanggal }}" required>
            </div>
            <div class="mb-3">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="4" required>{{ $stok->keterangan }}</textarea>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-1"></i>Update
                </button>
                <button type="button" id="cancelEditStokOpname" class="btn btn-danger">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </button>
            </div>
        </form>
    </div>
</div>