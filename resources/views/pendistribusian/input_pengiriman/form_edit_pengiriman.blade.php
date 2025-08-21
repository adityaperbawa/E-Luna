<form id="formEditPengiriman" enctype="multipart/form-data">
    @csrf
    <div class="card mt-3 shadow">
        <div class="card-header bg-success text-white">
            <strong><i class="fas fa-edit me-2"></i>Edit Pengiriman</strong>
        </div>

        <div class="card-body">
            <input type="hidden" name="id" value="{{ $pengiriman->id }}">
            <div class="row g-3">
                <div class="col-md-6">
    <label class="form-label">No Surat</label>
    <input type="text" name="no_surat" 
           value="{{ $pengiriman->no_surat }}" 
           class="form-control" 
           placeholder="BAST/0151/PB.04.01/BPBD-DARLOG/1/2024" 
           required>
</div>

<style>
    input[name="no_surat"]::placeholder {
        color: #aaa;        /* abu-abu muda agar tidak terlalu tajam */
        opacity: 1;
        font-size: 0.8rem;  /* lebih kecil dari teks biasa */
        font-style: italic; /* opsional */
    }
</style>

                <div class="col-md-3">
                    <label class="form-label">Tanggal Surat</label>
                    <input type="date" name="tanggal_surat" value="{{ $pengiriman->tanggal_surat->format('Y-m-d') }}" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tanggal Pengiriman</label>
                    <input type="date" name="tanggal_pengiriman" value="{{ $pengiriman->tanggal_pengiriman->format('Y-m-d') }}" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tujuan</label>
                    <select name="tujuan_id" class="form-select" required>
                        @foreach($tujuans as $t)
                            <option value="{{ $t->id }}" {{ $pengiriman->tujuan_id == $t->id ? 'selected' : '' }}>
                                {{ $t->instansi }} - {{ $t->alamat }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Lokasi Tujuan</label>
                    <select name="lokasi_tujuan" class="form-select" required>
                        <option value="sama" {{ $pengiriman->lokasi_tujuan == 'sama' ? 'selected' : '' }}>Sama</option>
                        <option value="tidak sama" {{ $pengiriman->lokasi_tujuan == 'tidak sama' ? 'selected' : '' }}>Tidak Sama</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tahun</label>
                    <input type="number" name="tahun" value="{{ $pengiriman->tahun }}" class="form-control" required>
                </div>
            </div>

            <hr class="my-4">
            <h6 class="fw-bold mb-3">Dokumen (kosongkan jika tidak ingin mengubah)</h6>

            <div class="row g-3">
                @foreach($dokumens as $field => $label)
                    <div class="col-md-6">
                        <label class="form-label">{{ $label }}</label>
                        @if ($pengiriman->$field)
                            <div class="mb-1">
                                <a href="{{ asset('storage/' . $pengiriman->$field) }}" target="_blank" class="text-decoration-underline">
                                    Lihat File Sebelumnya
                                </a>
                            </div>
                        @endif
                        <input type="file" name="{{ $field }}" class="form-control">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="card-footer text-end">
            <button type="submit" class="btn btn-success me-2">
                <i class="fas fa-save me-1"></i> Update
            </button>
            <button type="button" class="btn btn-danger btnKembaliPengiriman">
                <i class="fas fa-times me-1"></i> Batal
            </button>
        </div>
    </div>
</form>
