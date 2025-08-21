<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0">Form Tambah Barang</h6>
                </div>

                <div class="card-body px-4">
                    <form id="formTambahBarang">
                        @csrf

                        <!-- Sumber & Kategori -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Sumber</label>
                                <select class="form-control" name="sumber_id" id="sumber_id" required>
                                    <option value="">-- Pilih Sumber --</option>
                                    @foreach($sumbers as $sumber)
                                        <option value="{{ $sumber->id }}" data-kode="{{ $sumber->kode }}">
                                            {{ $sumber->nama_sumber }} ({{ $sumber->kode }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kategori</label>
                                <select class="form-control" name="kategori_id" id="kategori_id" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" data-kode="{{ $kategori->kode }}">
                                            {{ $kategori->nama_kategori }} ({{ $kategori->kode }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Kode Level -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Kode Level 3</label>
                                <input type="text" class="form-control kode-level" name="kode_3" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kode Level 4</label>
                                <input type="text" class="form-control kode-level" name="kode_4" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kode Level 5</label>
                                <input type="text" class="form-control kode-level" name="kode_5" required>
                            </div>
                        </div>

                        <!-- Preview Kode -->
                        <div class="mb-3">
                            <label class="form-label">Preview Kode Barang</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">Kode</span>
                                <input type="text" id="previewKodeBarang" class="form-control bg-white fw-bold text-success" readonly>
                            </div>
                            <input type="hidden" name="kode_barang" id="kode_barang_final">
                        </div>

                        <!-- Nama Barang -->
                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang" required>
                        </div>

                        <!-- Tahun & Satuan -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tahun Anggaran</label>
                                <input type="number" class="form-control" name="tahun_anggaran" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Satuan</label>
                                <input type="text" class="form-control" name="satuan" required>
                            </div>
                        </div>

                        <!-- Stok & Harga -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Stok</label>
                                <input type="number" class="form-control" name="stok" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Harga (Rp)</label>
                                <input type="number" class="form-control" name="harga" required>
                            </div>
                        </div>

                        <!-- Tanggal Kadaluwarsa -->
                        <div class="mb-3">
                            <label class="form-label">Tanggal Kadaluwarsa <small class="text-muted">(opsional)</small></label>
                            <input type="date" class="form-control" name="tanggal_kadaluwarsa">
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success me-2">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                            <button type="button" class="btn btn-danger" id="btnBatalBarang">
                                <i class="fas fa-times me-1"></i> Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
