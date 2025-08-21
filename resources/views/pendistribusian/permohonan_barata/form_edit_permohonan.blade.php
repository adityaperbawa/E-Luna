<div class="card shadow">
    <div class="card-header bg-success text-white fw-bold">
        <i class="fas fa-edit me-2"></i>Edit Data Barata
    </div>

    <div class="card-body">
        <form id="formEditBarata" data-id="{{ $permohonan->id }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="row">
                {{-- Kolom Kiri --}}
                <div class="col-md-6">
                    {{-- Kota --}}
                    <div class="mb-3">
                        <label class="form-label">Kab/Kota</label>
                        <select name="tujuan_id" id="selectKabKota" class="form-select" required>
                            <option value="">-- Pilih Kab/Kota --</option>
                            @foreach($tujuans as $t)
                                <option value="{{ $t->id }}"
                                        data-instansi="{{ $t->instansi }}"
                                        {{ $permohonan->tujuan_id == $t->id ? 'selected' : '' }}>
                                    {{ $t->kab_kota }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Instansi --}}
                    <div class="mb-3">
                        <label class="form-label">Instansi</label>
                        <input type="text" id="instansiView" class="form-control"
                               value="{{ $permohonan->tujuan?->instansi }}" readonly
                               placeholder="Instansi otomatis terisi">
                    </div>

                    {{-- Tanggal Kejadian --}}
                    <div class="mb-3">
                        <label class="form-label">Tanggal Kejadian</label>
                        <input type="date" name="tanggal_kejadian" class="form-control"
                               value="{{ $permohonan->tanggal_kejadian->toDateString() }}" required>
                    </div>
                </div>

                {{-- Kolom Kanan --}}
                <div class="col-md-6">
                    {{-- Kejadian --}}
                    <div class="mb-3">
                        <label class="form-label">Kejadian</label>
                        <input type="text" name="kejadian" class="form-control"
                               value="{{ $permohonan->kejadian }}" required
                               placeholder="Masukkan deskripsi kejadian">
                    </div>

                    {{-- No Surat --}}
<div class="mb-3">
    <label class="form-label">No Surat</label>
    <input type="text" name="no_surat" class="form-control"
           value="{{ $permohonan->no_surat }}" required
           placeholder="Bandungkab/VII/2024">
</div>

<style>
    input[name="no_surat"]::placeholder {
        color: #aaa;        /* abu-abu muda */
        opacity: 1;
        font-size: 0.8rem;  /* lebih kecil */
        font-style: italic; /* opsional */
    }
</style>


                    {{-- Dokumen --}}
                    <div class="mb-3">
                        <label class="form-label">Unggah Dokumen Baru (Opsional)</label>
                        <input type="file" name="dokumen" id="dokumen" class="form-control"
                               accept=".pdf,.jpg,.jpeg,.png">
                        @if($permohonan->dokumen)
                            <div class="mt-2">
                                <small class="text-muted">
                                    Dokumen lama:
                                    <a href="{{ Storage::url($permohonan->dokumen) }}" target="_blank">Lihat</a>
                                </small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-success me-2">
                    <i class="fas fa-save me-1"></i> Update
                </button>
                <button type="button" class="btn btn-danger btnKembaliBarata">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </button>
            </div>
        </form>
    </div>
</div>
