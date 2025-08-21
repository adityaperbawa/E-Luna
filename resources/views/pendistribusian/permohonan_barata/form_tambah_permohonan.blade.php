<div class="card shadow">
    <div class="card-header bg-success text-white fw-bold">
        <i class="fas fa-plus-circle me-2"></i>Tambah Data Barata
    </div>

    <div class="card-body">
        <form id="formTambahBarata" enctype="multipart/form-data">
            @csrf
            <div class="row">
                {{-- Kolom Kiri --}}
                <div class="col-md-6">
                    {{-- Kota --}}
                    <div class="mb-3">
                        <label class="form-label">Kota</label>
                        <select name="tujuan_id" id="selectKabKota" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            @foreach($tujuans as $t)
                                <option value="{{ $t->id }}" data-instansi="{{ $t->instansi }}">
                                    {{ $t->kab_kota }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Instansi --}}
                    <div class="mb-3">
                        <label class="form-label">Instansi</label>
                        <input type="text" id="instansiView" class="form-control" readonly>
                    </div>

                    {{-- Tanggal Kejadian --}}
                    <div class="mb-3">
                        <label class="form-label">Tanggal Kejadian</label>
                        <input type="date" name="tanggal_kejadian" class="form-control" required>
                    </div>
                </div>

                {{-- Kolom Kanan --}}
                <div class="col-md-6">
                    {{-- Kejadian --}}
                    <div class="mb-3">
                        <label class="form-label">Kejadian</label>
                        <input type="text" name="kejadian" class="form-control" required>
                    </div>

                   {{-- No Surat --}}
<div class="mb-3">
    <label class="form-label">No Surat</label>
    <input type="text" name="no_surat" class="form-control" 
           placeholder="Bandungkab/VII/2024" required>
</div>

<style>
    input[name="no_surat"]::placeholder {
        color: #aaa;        /* abu-abu muda */
        opacity: 1;
        font-size: 0.8rem;  /* sedikit lebih kecil */
        font-style: italic; /* opsional */
    }
</style>


                    {{-- Dokumen --}}
                    <div class="mb-3">
                        <label class="form-label">Upload Dokumen</label>
                        <input type="file" name="dokumen" id="dokumen" class="form-control">
                    </div>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-success me-2">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
                <button type="button" class="btn btn-danger btnKembaliBarata">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </button>
            </div>
        </form>
    </div>
</div>
