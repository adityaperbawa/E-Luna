<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">
<div id="cardListPengiriman">
    <div class="card w-100">
        <div class="card-header text-dark d-flex justify-content-between align-items-center">
            <h6>Data Pengiriman</h6>
            <button id="btnTambahPengiriman" class="btn btn-success btn-sm">
                Tambah <i class="fas fa-plus"></i> 
            </button>
        </div>

        <div class="card-body">
            <table id="tablePengiriman" class="table table-bordered table-sm table-hover">
                <thead class="table-secondary">
                    <tr class="text-center">
                        <th>No</th>
                        <th>No Surat</th>
                        <th>Tgl Surat</th>
                        <th>Tgl Pengiriman</th>
                        <th>Thn Anggaran</th>
                        <th>Tujuan</th>
                        <th class="text-center" style="width:200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengirimen as $i => $p)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $p->no_surat }}</td>
                            <td>{{ $p->tanggal_surat?->format('d-m-Y') }}</td>
                            <td>{{ $p->tanggal_pengiriman?->format('d-m-Y') }}</td>
                            <td>{{ $p->tahun }}</td>
                            <td>
                                {{ $p->tujuan?->instansi }}<br>
                                <small class="text-muted">{{ $p->tujuan?->alamat }}</small>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-info btnRincianPengiriman" data-id="{{ $p->id }}">
                                    RINCIAN
                                </button>
                                <button class="btn btn-sm btn-warning editBtnPengiriman" data-id="{{ $p->id }}">
                                    EDIT
                                </button>
                                <button class="btn btn-sm btn-danger deleteBtnPengiriman" data-id="{{ $p->id }}">
                                    HAPUS
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="formContainerPengiriman"></div>

{{-- Rincian Overlay --}}
<div id="rincianPengirimanOverlay"
    style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,.5);z-index:9999">
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="card shadow" style="width:800px;max-height:90vh;overflow-y:auto">
            <div id="rincianPengirimanContent"></div>
        </div>
    </div>
</div>
</div>

@push('scripts')
    <script src="{{ asset('js/input_pengiriman.js') }}"></script>
@endpush
