<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6>Data Gudang</h6>
            <button id="btnTambahGudang" class="btn btn-success btn-sm">
                Tambah <i class="fas fa-plus"></i>
            </button>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-sm" id="tableGudang">
                <thead class="table-secondary">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">QR Code</th>
                        <th class="text-center">Blok</th>
                        <th class="text-center">Kategori</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gudangs as $gudang)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ urlencode($gudang->qr_code) }}"
                                    width="50" alt="QR Code">
                            </td>
                            <td>{{ $gudang->blok }}</td>
                            <td>{{ $gudang->kategori->nama_kategori ?? '-' }}</td>
                            <td>{{ $gudang->keterangan }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning editBtnGudang" data-id="{{ $gudang->id }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger deleteBtnGudang" data-id="{{ $gudang->id }}">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>