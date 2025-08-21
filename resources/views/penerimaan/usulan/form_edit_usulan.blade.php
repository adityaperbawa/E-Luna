<div class="card w-100">
    <div class="card-header bg-success text-white">
        <i class="fas fa-edit me-2"></i>Edit Usulan Logistik
    </div>
    <div class="card-body">
        <form id="formEditUsulan" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $usulan->id }}">

            <div class="mb-3">
    <label>No. Surat</label>
    <input type="text" name="no_surat" class="form-control" 
           placeholder="2698/PB.04.01/Darlog" value="{{ $usulan->no_surat }}" required>
</div>

<style>
    input[name="no_surat"]::placeholder {
        color: #aaa;        /* abu-abu muda */
        opacity: 1;
        font-style: italic; /* opsional */
        font-size: 0.7rem;  /* lebih kecil */
    }
</style>


            <div class="mb-3">
                <label>Tanggal Surat</label>
                <input type="date" name="tanggal_surat" class="form-control" value="{{ $usulan->tanggal_surat }}" required>
            </div>

            <div class="mb-3">
                <label>Tahun Anggaran</label>
                <input type="text" name="tahun_anggaran" class="form-control" value="{{ $usulan->tahun_anggaran }}" required>
            </div>

            <div class="mb-3">
                <label>Sumber</label>
                <select name="sumber_id" class="form-control" required>
                    @foreach ($sumbers as $sumber)
                        <option value="{{ $sumber->id }}" {{ $usulan->sumber == $sumber->id ? 'selected' : '' }}>
                            {{ $sumber->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Ganti Dokumen (Opsional)</label>
                <input type="file" name="dokumen" class="form-control">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengganti</small>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-1"></i>Simpan Perubahan
                </button>
                <button type="button" class="btn btn-danger btnKembaliUsulan">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </button>
            </div>
        </form>
    </div>
</div>
