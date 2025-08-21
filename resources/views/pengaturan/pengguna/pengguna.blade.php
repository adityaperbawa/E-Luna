<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">
<div class="card shadow-sm w-100">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h6 class="mb-0">Data Pengguna</h6>
        <button class="btn btn-success btn-sm" id="btnTambahPengguna">
            Tambah <i class="bi bi-plus-lg"></i>
        </button>

    </div>

    <div class="card-body">
        <div id="formTambahPenggunaContainer"></div>
        <div id="tabelPenggunaWrapper" class="table-responsive">
            <table id="tabelPengguna" class="table table-bordered table-hover table-sm">
                <thead class="table-secondary">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Jabatan</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->jabatan ?? '-' }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning editBtnPengguna" data-id="{{ $user->id }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger deleteBtnPengguna" data-id="{{ $user->id }}">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Tidak ada data pengguna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>