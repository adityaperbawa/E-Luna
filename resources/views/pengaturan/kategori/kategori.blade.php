<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6>Data Kategori</h6>
            <button class="btn btn-success btn-sm" id="btnTambahKategori">
                Tambah <i class="fas fa-plus"></i> 
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm" id="tabelKategori">
                    <thead class="table-secondary">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Kode</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategoris as $k => $kategori)
                        <tr>
                            <td class="text-center">{{ $k + 1 }}</td>
                            <td>{{ $kategori->kode }}</td>
                            <td>{{ $kategori->nama_kategori }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm editBtnKategori" data-id="{{ $kategori->id }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-danger btn-sm deleteBtnKategori" data-id="{{ $kategori->id }}">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
