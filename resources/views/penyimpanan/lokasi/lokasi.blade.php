<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">
    <div class="card w-100">
        <div class="card-header text-black d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Data Lokasi Barang</h6>
            <button class="btn btn-success btn-sm" id="btnTambahLokasiBarang">
                Tambah <i class="fas fa-plus"></i> 
            </button>
        </div>
        <div class="card-body">
            <!-- Alert catatan opsional -->
            <div class="alert alert-info py-2 px-3 small" role="alert">
                <i class="fas fa-info-circle me-2"></i>
                Data lokasi barang berdasarkan pengaturan stok pada gudang masing-masing.
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-sm table-hover" id="tabelLokasi">
                    <thead class="table-secondary text-center">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Blok</th>
                            <th class="text-center">Kode Barang</th>
                            <th class="text-center">Nama Barang</th>
                            <th class="text-center">Stok</th>
                            <th class="text-center">Satuan</th>
                            <th class="text-center">Catatan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lokasis as $i => $lokasi)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ $lokasi->gudang->blok ?? '-' }}</td>
                                <td>{{ $lokasi->barang->kode_barang ?? '-' }}</td>
                                <td>{{ $lokasi->barang->nama_barang ?? '-' }}</td>
                                <td class="text-center">{{ $lokasi->stok }}</td>
                                <td class="text-center">{{ $lokasi->barang->satuan ?? '-' }}</td>
                                <td>{{ $lokasi->catatan ?? '-' }}</td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm btnEditLokasi" data-id="{{ $lokasi->id }}">
                                        EDIT
                                    </button>
                                    <button class="btn btn-danger btn-sm btnHapusLokasi" data-id="{{ $lokasi->id }}">
                                        HAPUS
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                        @if(count($lokasis) === 0)
                            <tr>
                                <td colspan="8" class="text-center">Data lokasi barang belum tersedia.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
