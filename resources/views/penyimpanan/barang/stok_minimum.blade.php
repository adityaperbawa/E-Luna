<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container mt-4">
    <div class="card w-100">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Pengaturan Stok Minimum</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-sm" id="tabelStokMinimum">
                <thead class="table-secondary">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Stok Sekarang</th>
                        <th>Stok Minimum</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangs as $i => $barang)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->stok }}</td>
                            <td>
                                <input type="number" class="form-control form-control-sm stok-minimum-input" 
                                       data-id="{{ $barang->id }}" value="{{ $barang->stok_minimum }}">
                            </td>
                            <td>
                                <button class="btn btn-primary btn-sm simpanStokMinimum" data-id="{{ $barang->id }}">
                                    Simpan
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    @if(count($barangs) === 0)
                        <tr><td colspan="5" class="text-center">Tidak ada data barang.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
