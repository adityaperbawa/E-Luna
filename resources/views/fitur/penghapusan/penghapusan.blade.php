<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">
<div id="cardListPenghapusan">
    <div class="card w-100">
        <div class="card-header text-dark d-flex justify-content-between align-items-center">
            <h6></i>Data Penghapusan</h6>
            <button id="btnTambahPenghapusan" class="btn btn-success btn-sm">
                Tambah <i class="fas fa-plus"></i> 
            </button>
        </div>

        <div class="card-body">
            <table id="tablePenghapusan" class="table table-bordered table-sm table-hover">
                <thead class="table-secondary">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th class="text-center" style="width:180px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penghapusans as $i => $p)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $p->judul }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $p->keterangan }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning editBtnPenghapusan" data-id="{{ $p->id }}">
                                    EDIT
                                </button>
                                <button class="btn btn-sm btn-danger deleteBtnPenghapusan" data-id="{{ $p->id }}">
                                    HAPUS
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<div id="formContainerPenghapusan"></div>

{{-- Rincian Overlay --}}
<div id="rincianPenghapusanOverlay"
    style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,.5);z-index:9999">
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="card shadow" style="width:800px;max-height:90vh;overflow-y:auto">
            <div id="rincianPenghapusanContent"></div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/penghapusan.js') }}"></script>
@endpush
