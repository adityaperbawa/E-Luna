<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">
<div class="card w-100">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0">Data Sumber</h6>
        <button class="btn btn-success btn-sm" id="btnTambahSumber">
            Tambah <i class="bi bi-plus-lg"></i> 
        </button>
    </div>

    <div class="card-body">
        <div id="formTambahSumberContainer"></div>

        <div id="tabelSumberWrapper" class="table-responsive">
            <table id="tabelSumber" class="table table-bordered table-hover table-sm">
                <thead class="table-secondary">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Sumber</th>
                        <th class="text-center">Kode</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sumbers as $sumber)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $sumber->nama_sumber }}</td>
                            <td>{{ $sumber->kode }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm editBtnSumber" data-id="{{ $sumber->id }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-danger btn-sm deleteBtnSumber" data-id="{{ $sumber->id }}">
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