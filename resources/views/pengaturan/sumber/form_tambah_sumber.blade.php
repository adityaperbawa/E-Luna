<div class="card shadow w-100">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">Form Tambah Sumber</h5>
    </div>
    <div class="card-body">
        <form id="formTambahSumber" action="{{ route('sumber.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_sumber" class="form-label">Nama Sumber</label>
                <input type="text" name="nama_sumber" id="nama_sumber" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="kode" class="form-label">Kode</label>
                <input type="text" name="kode" id="kode" class="form-control" required>
            </div>
            <div class="mt-4 d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <button type="button" class="btn btn-danger btnKembaliSumber">
                    <i class="bi bi-arrow-left-circle"></i> Kembali
                </button>
            </div>
        </form>
    </div>
</div>
