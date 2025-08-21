<div class="card w-100">
    <div class="card-header bg-success text-white">
        Tambah Usulan Logistik & Peralatan
    </div>
    <div class="card-body">
        <form id="formTambahUsulan" enctype="multipart/form-data">
            @csrf
          <div class="mb-3">
    <label for="no_surat" class="form-label">No. Surat</label>
    <input type="text" class="form-control" name="no_surat" required 
           placeholder="2698/PB.04.01/Darlog">
</div>

<style>
    ::placeholder {
        color: #999;      /* lebih terang/samar */
        opacity: 1;       /* pastikan tidak terlalu pudar */
        font-style: italic; /* opsional, biar beda dengan input teks biasa */
    }
</style>

            <div class="mb-3">
                <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
                <input type="date" class="form-control" name="tanggal_surat" required>
            </div>

            <div class="mb-3">
                <label for="tahun_anggaran" class="form-label">Tahun Anggaran</label>
                <input type="text" class="form-control" name="tahun_anggaran" required>
            </div>

            <div class="mb-3">
                <label for="sumber_id" class="form-label">Sumber</label>
                <select name="sumber_id" class="form-select" required>
                    <option value="">-- Pilih Sumber --</option>
                    @foreach ($sumbers as $sumber)
                        <option value="{{ $sumber->id }}">{{ $sumber->nama_sumber }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="dokumen" class="form-label">Dokumen</label>
                <input type="file" name="dokumen" class="form-control" required>
            </div>

            <div class="mt-4 d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
                <button type="button" class="btn btn-danger btnKembaliUsulan">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </button>
            </div>
        </form>
    </div>
</div>
