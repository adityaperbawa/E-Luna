<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Tambah Lokasi Barang</h5>
        </div>
        <div class="card-body">
            <form id="formTambahLokasiBarang">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="gudang_id" class="form-label">Blok Gudang</label>
                        <select class="form-select" name="gudang_id" id="gudang_id" required>
                            <option value="">-- Pilih Blok Gudang --</option>
                            @foreach ($gudangs as $gudang)
                                <option value="{{ $gudang->id }}">{{ $gudang->blok }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="kategoriFilter" class="form-label">Filter Kategori</label>
                        <select class="form-select" id="kategoriFilter">
                            <option value="">-- Tampilkan Semua --</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Pilih Barang</label>
                    <div class="table-responsive border rounded" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-sm table-bordered align-middle mb-0">
                            <thead class="table-light sticky-top" style="top: 0; z-index: 1;">
                                <tr class="text-center">
                                    <th><input type="checkbox" id="checkAllBarang"></th>
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th>Stok</th>
                                    <th>Satuan</th>
                                    <th>Stok Disimpan</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody id="listBarang">
                                @forelse ($barangs as $barang)
                                    <tr data-kategori="{{ $barang->kategori_id }}">
                                        <td class="text-center align-middle">
                                            <input type="checkbox" name="barangs[{{ $barang->id }}][id]" value="{{ $barang->id }}">
                                        </td>
                                        <td>{{ $barang->kode_barang }}</td>
                                        <td>{{ $barang->nama_barang }}</td>
                                        <td class="text-center">{{ $barang->stok }}</td>
                                        <td class="text-center">{{ $barang->satuan }}</td>
                                        <td style="width: 150px;">
                                            <input type="number" name="barangs[{{ $barang->id }}][stok]" class="form-control form-control-sm" min="1">
                                        </td>
                                        <td style="width: 200px;">
                                            <input type="text" name="barangs[{{ $barang->id }}][catatan]" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Tidak ada data barang.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                    <button type="button" id="btnBatalTambahLokasi" class="btn btn-danger">
                        <i class="bi bi-x-circle me-1"></i> Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
