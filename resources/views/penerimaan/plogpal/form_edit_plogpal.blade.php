<div class="card w-100 shadow">
    <div class="card-header bg-success text-white">
        <i class="fas fa-edit me-2"></i> Edit Data Penerimaan LogPal
    </div>
    <div class="card-body">
        <form id="formEditPlogpal" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $data->id }}">

            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Penerimaan</label>
                        <select name="penerimaan" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="logistik" {{ old('penerimaan', $data->penerimaan) == 'logistik' ? 'selected' : '' }}>Logistik</option>
                            <option value="peralatan" {{ old('penerimaan', $data->penerimaan) == 'peralatan' ? 'selected' : '' }}>Peralatan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rencana Penerimaan (Opsional)</label>
                        <select name="usulan_id" class="form-control">
                            <option value="">-- Pilih --</option>
                            @foreach ($usulans as $u)
                                <option value="{{ $u->id }}" {{ old('usulan_id', $data->usulan_id) == $u->id ? 'selected' : '' }}>
                                    {{ $u->no_surat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
    <label class="form-label">No Surat BAST</label>
    <input type="text" name="no_surat_bast" class="form-control" 
           value="{{ old('no_surat_bast', $data->no_surat_bast) }}"
           placeholder="BA.126/BNPB/OJLP/LP.01.03/11/2023">
</div>

<style>
    input[name="no_surat_bast"]::placeholder {
        color: #aaa;        /* abu-abu muda */
        opacity: 1;
        font-style: italic; /* opsional */
        font-size: 0.7rem;  /* biar lebih kecil */
    }
</style>


                    <div class="mb-3">
                        <label class="form-label">Tanggal Surat</label>
                        <input type="date" name="tanggal_surat" class="form-control" value="{{ old('tanggal_surat', $data->tanggal_surat) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" class="form-control" value="{{ old('tanggal_masuk', $data->tanggal_masuk) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Pengirim</label>
                        <input type="text" name="nama_pengirim" class="form-control" value="{{ old('nama_pengirim', $data->nama_pengirim) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No Whatsapp</label>
                        <input type="text" name="no_whatsapp" class="form-control" value="{{ old('no_whatsapp', $data->no_whatsapp) }}">
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
                            @if (!empty($data->$name))
                                <small class="d-block mt-1">
                                    <a href="{{ asset('uploads/plogpal/' . $data->$name) }}" target="_blank">
                                        <i class="fas fa-file-alt me-1"></i> Lihat file lama
                                    </a>
                                </small>
                            @endif
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
