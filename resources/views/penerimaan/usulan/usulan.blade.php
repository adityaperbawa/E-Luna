<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">
<div class="card w-100">
    <div class="card-header text-black d-flex justify-content-between align-items-center">
        <h6>Data Usulan Logpal</h6>
        <button id="btnTambahUsulan" class="btn btn-success btn-sm">
            Tambah <i class="fas fa-plus"></i> 
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm" id="tableUsulan">
                <thead class="table-secondary">
                    <tr>
                        <th class="text-center">No Surat</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Tahun</th>
                        <th class="text-center">Sumber</th>
                        <th class="text-center">Dokumen</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usulanLogpals as $usulan)
                        <tr>
                            <td>{{ $usulan->no_surat }}</td>
                            <td>{{ $usulan->tanggal_surat }}</td>
                            <td>{{ $usulan->tahun_anggaran }}</td>
                            <td>{{ $usulan->sumberData->nama_sumber ?? '-' }}</td>
                            <td>
                                <a href="{{ asset('uploads/dokumen/' . $usulan->dokumen) }}" target="_blank" class="btn btn-sm btn-info">
                                    DOKUMEN
                                </a>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning editBtnUsulan" data-id="{{ $usulan->id }}">
                                    EDIT
                                </button>
                                <button class="btn btn-sm btn-danger deleteBtnUsulan" data-id="{{ $usulan->id }}">
                                    HAPUS
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

<div id="formContainerUsulan"></div>
