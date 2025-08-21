<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Edit Permohonan</h5>
        </div>
        <div class="card-body">
            <form id="formEditPermohonan" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    {{-- Kolom Kiri --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="selectKabKota" class="form-label">Kab/Kota</label>
                            <select name="tujuan_id" id="selectKabKota" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                @foreach ($tujuans as $t)
                                    <option value="{{ $t->id }}"
                                            data-instansi="{{ $t->instansi }}"
                                            {{ $permohonan->tujuan_id == $t->id ? 'selected' : '' }}>
                                        {{ $t->kab_kota }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="instansiView" class="form-label">Instansi</label>
                            <input type="text" id="instansiView" class="form-control"
                                   value="{{ $permohonan->tujuan?->instansi }}" readonly>
                        </div>

                       <div class="mb-3">
    <label for="no_surat" class="form-label">No Surat</label>
    <input type="text" name="no_surat" id="no_surat" class="form-control"
           value="{{ $permohonan->no_surat }}"
           placeholder="BAST/0151/PB.04.01/BPBD-DARLOG/I/2024" required>
</div>

<style>
    #no_surat::placeholder {
        color: #aaa;        /* abu-abu muda */
        opacity: 1;
        font-size: 0.8rem;  /* lebih kecil */
        font-style: italic; /* opsional */
    }
</style>


                        <div class="mb-3">
                            <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
                            <input type="date" name="tanggal_surat" id="tanggal_surat" class="form-control"
                                   value="{{ $permohonan->tanggal_surat?->toDateString() ?? '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="tahun_surat" class="form-label">Tahun Surat</label>
                            <input type="number" name="tahun_surat" id="tahun_surat" class="form-control"
                                   value="{{ $permohonan->tahun_surat }}" min="2000" max="{{ now()->year }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="keperluan" class="form-label">Keperluan Surat</label>
                            <input type="text" name="keperluan" id="keperluan" class="form-control"
                                   value="{{ $permohonan->keperluan }}" required>
                        </div>
                    </div>

                    {{-- Kolom Kanan --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="dokumen" class="form-label">Ganti Dokumen (kosongkan jika tidak diganti)</label>
                            <input type="file" name="dokumen" id="dokumen" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            @if ($permohonan->dokumen)
                                <small class="text-muted">
                                    Dokumen lama: <a href="{{ Storage::url($permohonan->dokumen) }}" target="_blank">Lihat</a>
                                </small>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                    <button type="button" class="btn btn-danger btnKembaliPermohonan">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
