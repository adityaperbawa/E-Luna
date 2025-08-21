<div class="card shadow-sm border-0 w-100">
    <div class="card-header bg-success text-white">
        <h6 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Edit Data Sumber</h6>
    </div>
    <div class="card-body">
        <form id="formEditSumber">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $sumber->id }}">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nama_sumber" class="form-label">Nama Sumber</label>
                    <input type="text" id="nama_sumber" name="nama_sumber" value="{{ $sumber->nama_sumber }}" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="kode" class="form-label">Kode</label>
                    <input type="text" id="kode" name="kode" value="{{ $sumber->kode }}" class="form-control" required>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle me-1"></i> Update
                </button>
                <button type="button" class="btn btn-danger btnKembaliSumber">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </button>
            </div>
        </form>
    </div>
</div>
