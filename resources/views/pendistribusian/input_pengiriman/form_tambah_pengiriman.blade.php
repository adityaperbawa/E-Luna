<form id="formTambahPengiriman" enctype="multipart/form-data">
    @csrf
    <div class="card mt-3 shadow">
        <div class="card-header bg-success text-white">
            <strong><i class="fas fa-truck me-2"></i>Form Tambah Pengiriman</strong>
        </div>

        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">No Surat</label>
                    <input type="text" name="no_surat" class="form-control"
                        placeholder="BAST/0151/PB.04.01/BPBD-DARLOG/1/2024" required>
                </div>

                <style>
                    input[name="no_surat"]::placeholder {
                        color: #aaa;
                        /* abu-abu muda */
                        opacity: 1;
                        font-style: italic;
                        /* opsional */
                        font-size: 0.7rem;
                        /* kecil sesuai permintaan */
                    }
                </style>

                <div class="col-md-3">
                    <label class="form-label">Tanggal Surat</label>
                    <input type="date" name="tanggal_surat" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tanggal Pengiriman</label>
                    <input type="date" name="tanggal_pengiriman" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tujuan</label>
                    <select name="tujuan_id" class="form-select" required>
                        <option value="">- Pilih -</option>
                        @foreach($tujuans as $t)
                            <option value="{{ $t->id }}">{{ $t->instansi }} - {{ $t->alamat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Lokasi Tujuan</label>
                    <select name="lokasi_tujuan" class="form-select" required>
                        <option value="sama">Sama</option>
                        <option value="tidak sama">Tidak Sama</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Tahun</label>
                    <input type="number" name="tahun" class="form-control" required>
                </div>
            </div>

            <hr class="my-4">
            <h6 class="fw-bold mb-3">Dokumen Pendukung</h6>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">BAST Prov ke Kab/Kota</label>
                    <input type="file" name="bast" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Delivery Order</label>
                    <input type="file" name="do" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">No WA</label>
                    <input type="file" name="nowa" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">STNK</label>
                    <input type="file" name="stnk" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">SIM Driver</label>
                    <input type="file" name="sim_driver" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Foto Kendaraan</label>
                    <input type="file" name="foto_kendaraan" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Foto/Video Unloading</label>
                    <input type="file" name="unloading" class="form-control">
                </div>
            </div>
        </div>

        <div class="card-footer text-end">
            <button type="submit" class="btn btn-success me-2">
                <i class="fas fa-save me-1"></i> Simpan
            </button>
            <button type="button" class="btn btn-danger btnKembaliPengiriman">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </button>
        </div>
    </div>
</form>