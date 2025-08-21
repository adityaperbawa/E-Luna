<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Data Tujuan</h6>
            <button id="btnTambahTujuan" class="btn btn-success btn-sm">
            Tambah <i class="fas fa-plus"></i> 
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tableTujuan" class="table table-bordered table-hover table-sm">
                    <thead class="table-secondary">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Kab/Kota</th>
                            <th class="text-center">Instansi</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tujuans as $tujuan)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $tujuan->kab_kota }}</td>
                                <td>{{ $tujuan->instansi }}</td>
                                <td>{{ $tujuan->alamat }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning editBtnTujuan" data-id="{{ $tujuan->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger deleteBtnTujuan" data-id="{{ $tujuan->id }}">
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
</div>
