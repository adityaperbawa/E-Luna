<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">
<div id="cardListStokOpname">
    <div class="card w-100">
        <div class="card-header text-dark d-flex justify-content-between align-items-center">
            <h6></i>Data Stok Opname</h6>
            <button id="btnTambahStokOpname" class="btn btn-success btn-sm">
                Tambah <i class="fas fa-plus"></i> 
            </button>
        </div>

        <div class="card-body">
            <table id="tableStokOpname" class="table table-bordered table-sm table-hover">
                <thead class="table-secondary">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th class="text-center" style="width:150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($stokOpnames as $i => $s)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $s->judul }}</td>
                            <td>{{ \Carbon\Carbon::parse($s->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $s->keterangan }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning editBtnStokOpname" data-id="{{ $s->id }}">
                                   EDIT
                                </button>
                                <button class="btn btn-sm btn-danger deleteBtnStokOpname" data-id="{{ $s->id }}">
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

<div id="formContainerStokOpname"></div>

@push('scripts')
    <script src="{{ asset('js/stok_opname.js') }}"></script>
@endpush
