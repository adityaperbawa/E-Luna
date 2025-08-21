<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">
    <div class="card w-100">
        <div class="card-header text-black d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Data Barang</h6>
            <button class="btn btn-success btn-sm" id="btnTambahBarang">
                Tambah <i class="fas fa-plus"></i> 
            </button>
        </div>
        <div class="card-body">
            <!-- Teks peringatan -->
            <div class="alert alert-warning py-2 px-3 small" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Catatan:</strong> Garis <span class="bg-danger px-2 rounded text-white">merah</span> pada list menandakan stok
                kurang dari batas minimum.
            </div>
            <table id="tabelBarang" class="table table-bordered table-sm table-hover">
                <thead class="table-secondary">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Kode Barang</th>
                        <th class="text-center">Nama Barang</th>
                        <th class="text-center">Sumber</th>
                        <th class="text-center">Kategori</th>
                        <th class="text-center">Tahun</th>
                        <th class="text-center">Stok</th>
                        <th class="text-center">Satuan</th>
                        <th class="text-center">Harga (Rp)</th>
                        <th class="text-center">Total (Rp)</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangs as $i => $barang)
                       <tr class="{{ $barang->stok < $barang->stok_minimum ? 'table-danger' : '' }}">
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $barang->kode_barang }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->sumber->nama_sumber ?? '-' }}</td>
                            <td>{{ $barang->kategori->nama_kategori ?? '-' }}</td>
                            <td>{{ $barang->tahun_anggaran }}</td>
                            <td>{{ $barang->stok }}</td>
                            <td>{{ $barang->satuan }}</td>
                            <td>Rp{{ number_format($barang->harga, 0, ',', '.') }}</td>
                            <td>Rp{{ number_format($barang->total, 0, ',', '.') }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm editBtnBarang" data-id="{{ $barang->id }}">
                                    EDIT
                                </button>
                                <button class="btn btn-danger btn-sm deleteBtnBarang" data-id="{{ $barang->id }}">
                                    HAPUS
                                </button>
                            </td>
                        </tr>
                    @endforeach

                    @if(count($barangs) === 0)
                        <tr>
                            <td colspan="12" class="text-center">Data barang belum tersedia.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>