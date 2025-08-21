<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">
    <div class="card w-100">
        <div class="card-header text-black d-flex justify-content-between align-items-center">
            <h6>Data Penerimaan Logpal</h6>
            <button id="btnTambahPlogpal" class="btn btn-success btn-sm">
                Tambah <i class="fas fa-plus"></i> 
            </button>
        </div>

        <div class="card-body">
            <table id="tablePlogpal" class="table table-bordered table-hover table-sm">
                <thead class="table-secondary">
                    <tr>
                        <th class="text-center">Penerimaan</th>
                        <th class="text-center">No Surat</th>
                        <th class="text-center">Tanggal Surat</th>
                        <th class="text-center">Tanggal Masuk</th>
                        <th class="text-center">Tahun Anggaran</th>
                        <th class="text-center">Pengirim</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ ucfirst($d->penerimaan) }}</td>
                            <td>{{ $d->no_surat_bast ?? '-' }}</td>
                            <td>{{ $d->tanggal_surat ?? '-' }}</td>
                            <td>{{ $d->tanggal_masuk ?? '-' }}</td>
                            <td>{{ $d->usulan?->tahun_anggaran ?? '-' }}</td>
                            <td>{{ $d->nama_pengirim ?? '-' }}</td>
                            <td>
                                <button class="btn btn-sm btn-info btnDokumenPlogpal" data-dokumen="{{ $d->dokumen_bast }}">
                                    DOKUMEN
                                </button>
                                <button class="btn btn-sm btn-success btnRincianPlogpal" data-id="{{ $d->id }}">
                                    RINCIAN
                                </button>
                                <button class="btn btn-sm btn-warning editBtnPlogpal" data-id="{{ $d->id }}">
                                    EDIT
                                </button>
                                <button class="btn btn-sm btn-danger deleteBtnPlogpal" data-id="{{ $d->id }}">
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

<div id="formContainerPlogpal"></div>
<!-- Container Rincian -->
<div id="rincianPlogpalContainer"
    style="display: none; position: fixed; top:0; left:0; width:100%; height:100%; background-color: rgba(0,0,0,0.5); z-index: 9999;">
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="card shadow-lg" style="width: 800px; max-height: 90vh; overflow-y: auto;">
            <!-- Konten akan dimuat via JS -->
            <div id="rincianPlogpalContent"></div>
        </div>
    </div>
</div>