<div class="card w-100 shadow">
    <div class="card-header bg-success text-white">
        <i class="fas fa-plus me-2"></i> Tambah Data Penerimaan LogPal
    </div>
    <div class="card-body">
        <form id="formTambahPlogpal" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Penerimaan</label>
                        <select name="penerimaan" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="logistik">Logistik</option>
                            <option value="peralatan">Peralatan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rencana Penerimaan (Opsional)</label>
                        <select name="usulan_id" class="form-control">
                            <option value="">-- Pilih --</option>
                            @foreach ($usulans as $u)
                                <option value="{{ $u->id }}">{{ $u->no_surat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
    <label class="form-label">No Surat BAST</label>
    <input type="text" name="no_surat_bast" class="form-control" 
           placeholder="BA.126/BNPB/OJLP/LP.01.03/11/2025">
</div>

<style>
    input::placeholder {
        color: #aaa;       /* abu-abu muda */
        opacity: 1;        /* jangan terlalu pudar */
        font-style: italic; /* opsional biar beda dari teks input */
    }
</style>


                    <div class="mb-3">
                        <label class="form-label">Tanggal Surat</label>
                        <input type="date" name="tanggal_surat" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Pengirim</label>
                        <input type="text" name="nama_pengirim" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No Whatsapp</label>
                        <input type="text" name="no_whatsapp" class="form-control">
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    @foreach ([
                        'dokumen_bast' => 'Dokumen BAST',
                        'delivery_order' => 'Delivery Order',
                        'stnk' => 'STNK',
                        'sim_driver' => 'SIM Driver',
                        'foto_kendaraan' => 'Foto Kendaraan',
                        'foto_unloading' => 'Foto / Video Unloading'
                    ] as $name => $label)
                        <div class="mb-3">
                            <label class="form-label">{{ $label }}</label>
                            <input type="file" name="{{ $name }}" class="form-control">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-success me-2">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
                <button type="button" class="btn btn-danger btnKembaliPlogpal">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </button>
            </div>
        </form>
    </div>
</div>
