<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Edit Lokasi Barang</h5>
        </div>
        <div class="card-body">
            <form id="formEditLokasiBarang">
                @csrf
                <input type="hidden" name="id" value="{{ $lokasi->id }}">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="gudang_id" class="form-label">Blok Gudang</label>
                        <select class="form-select" name="gudang_id" id="gudang_id" required>
                            <option value="">-- Pilih Blok Gudang --</option>
                            @foreach ($gudangs as $gudang)
                                <option value="{{ $gudang->id }}" {{ $gudang->id == $lokasi->gudang_id ? 'selected' : '' }}>
                                    {{ $gudang->blok }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="barang_id" class="form-label">Barang</label>
                        <select name="barang_id" id="barang_id" class="form-select" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->id }}" {{ $barang->id == $lokasi->barang_id ? 'selected' : '' }}>
                                    {{ $barang->nama_barang }} ({{ $barang->kode_barang }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="stok" class="form-label">Stok Disimpan</label>
                        <input type="number" id="stok" class="form-control" name="stok" value="{{ $lokasi->stok }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="catatan" class="form-label">Catatan</label>
                        <input type="text" id="catatan" class="form-control" name="catatan" value="{{ $lokasi->catatan }}">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="bi bi-pencil-square me-1"></i> Update
                    </button>
                    <button type="button" class="btn btn-danger" id="btnBatalEditLokasi">
                        <i class="bi bi-x-circle me-1"></i> Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
