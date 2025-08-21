<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0">Form Edit Barang</h6>
                </div>

                <div class="card-body px-4">
                    <form id="formEditBarang" data-id="{{ $barang->id }}">
                        @csrf

                        <!-- Sumber & Kategori -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Sumber</label>
                                <select class="form-control" name="sumber_id" id="sumber_id" required>
                                    @foreach($sumbers as $sumber)
                                        <option value="{{ $sumber->id }}" data-kode="{{ $sumber->kode }}"
                                            {{ $sumber->id == $barang->sumber_id ? 'selected' : '' }}>
                                            {{ $sumber->nama_sumber }} ({{ $sumber->kode }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kategori</label>
                                <select class="form-control" name="kategori_id" id="kategori_id" required>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" data-kode="{{ $kategori->kode }}"
                                            {{ $kategori->id == $barang->kategori_id ? 'selected' : '' }}>
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
                                <input type="text" class="form-control kode-level" name="kode_3" value="{{ $barang->kode_3 }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kode Level 4</label>
                                <input type="text" class="form-control kode-level" name="kode_4" value="{{ $barang->kode_4 }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kode Level 5</label>
                                <input type="text" class="form-control kode-level" name="kode_5" value="{{ $barang->kode_5 }}" required>
                            </div>
                        </div>

                        <!-- Preview Kode -->
                        <div class="mb-3">
                            <label class="form-label">Preview Kode Barang</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">Kode</span>
                                <input type="text" id="previewKodeBarang" class="form-control bg-white fw-bold text-success" readonly value="{{ $barang->kode_barang }}">
                            </div>
                            <input type="hidden" name="kode_barang" id="kode_barang_final" value="{{ $barang->kode_barang }}">
                        </div>

                        <!-- Nama Barang -->
                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang" value="{{ $barang->nama_barang }}" required>
                        </div>

                        <!-- Tahun & Satuan -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tahun Anggaran</label>
                                <input type="number" class="form-control" name="tahun_anggaran" value="{{ $barang->tahun_anggaran }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Satuan</label>
                                <input type="text" class="form-control" name="satuan" value="{{ $barang->satuan }}" required>
                            </div>
                        </div>

                        <!-- Stok & Harga -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Stok</label>
                                <input type="number" class="form-control" name="stok" value="{{ $barang->stok }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Harga (Rp)</label>
                                <input type="number" class="form-control" name="harga" value="{{ $barang->harga }}" required>
                            </div>
                        </div>

                        <!-- Tanggal Kadaluwarsa -->
                        <div class="mb-3">
                            <label class="form-label">Tanggal Kadaluwarsa <small class="text-muted">(opsional)</small></label>
                            <input type="date" class="form-control" name="tanggal_kadaluwarsa" value="{{ $barang->tanggal_kadaluwarsa }}">
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success me-2">
                                <i class="fas fa-sync-alt me-1"></i> Update
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
