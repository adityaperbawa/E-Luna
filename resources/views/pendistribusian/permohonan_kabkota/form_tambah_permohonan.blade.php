<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Tambah Permohonan Baru</h5>
        </div>
        <div class="card-body">
            <form id="formTambahPermohonan" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="selectKabKota" class="form-label">Kab/Kota</label>
                            <select name="tujuan_id" id="selectKabKota" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                @foreach ($tujuans as $t)
                                    <option value="{{ $t->id }}" data-instansi="{{ $t->instansi }}">
                                        {{ $t->kab_kota }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="instansiView" class="form-label">Instansi</label>
                            <input type="text" name="instansi_view" id="instansiView" class="form-control" readonly>
                        </div>
<div class="mb-3">
    <label for="no_surat" class="form-label">No Surat <span class="text-danger">*</span></label>
    <input type="text" name="no_surat" id="no_surat" class="form-control" 
           placeholder="BAST/0151/PB.04.01/BPBD-DARLOG/1/2024" required>
</div>

<style>
    #no_surat::placeholder {
        color: #aaa;        /* abu-abu muda */
        opacity: 1;
        font-style: italic; /* opsional */
        font-size: 0.7rem; /* lebih kecil dari default */
    }
</style>

                        <div class="mb-3">
                            <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
                            <input type="date" name="tanggal_surat" id="tanggal_surat" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="tahun_surat" class="form-label">Tahun Surat</label>
                            <input type="number" name="tahun_surat" id="tahun_surat" class="form-control"
                                   min="2000" max="{{ now()->year }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="keperluan" class="form-label">Keperluan / Tujuan</label>
                            <textarea name="keperluan" id="keperluan" class="form-control" rows="4" required>{{ old('keperluan', $permohonan->keperluan ?? '') }}</textarea>
                        </div>
                    </div>

                    {{-- Kolom Kanan --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="dokumen" class="form-label">Dokumen (PDF/JPG/PNG) <span class="text-danger">*</span></label>
                            <input type="file" name="dokumen" id="dokumen" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-danger btnKembaliPermohonan">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
