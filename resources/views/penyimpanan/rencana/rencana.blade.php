<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center text-black">
            <h6 class="mb-0">Data Rencana Alokasi</h6>
            <div>
                <button type="button" id="btnTambahRencana" class="btn btn-success btn-sm ms-2">
                    <i class="fas fa-plus me-1"></i> Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabelRencana" class="table table-bordered table-hover align-middle">
                    <thead class="table-secondary">
                        <tr class="text-center">
                            <th style="cursor:pointer" class="sortable">No</th>
                            <th style="cursor:pointer" class="sortable">No Surat</th>
                            <th style="cursor:pointer" class="sortable">Tanggal</th>
                            <th style="cursor:pointer" class="sortable">Tahun</th>
                            <th>Dokumen</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $i => $item)
                                        <tr>
                                            <td class="text-center">{{ $i + 1 }}</td>
                                            <td>{{ $item->no_surat }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                            <td class="text-center">{{ $item->tahun }}</td>
                                            <td class="text-center">
                                                <a href="{{ asset('storage/' . $item->dokumen) }}" target="_blank"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-file-alt me-1"></i> Lihat
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                @if ($item->status === 'disetujui')
                                                    <span class="badge bg-success">Disetujui</span>
                                                @elseif ($item->status === 'ditolak')
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @else
                                                    <span class="badge bg-secondary">Belum Diproses</span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                @auth
                                                    @if(auth()->user()->role === 'admin')
                                                        @if($item->status === null || $item->status === 'belum_diproses')
                                                            <div class="btn-group gap-1 align-items-center" role="group">
                                                                <button class="btn btn-sm btn-success btnSetujuRencana" data-id="{{ $item->id }}"
                                                                    title="Setujui">
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                                <button class="btn btn-sm btn-danger btnTolakRencana" data-id="{{ $item->id }}"
                                                                    title="Tolak">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                                <div class="vr mx-2"></div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endauth

                                                <button class="btn btn-sm btn-warning btnEditRencana" data-id="{{ $item->id }}"
                                                    title="Edit">
                                                    EDIT
                                                </button>
                                                <button class="btn btn-sm btn-danger btnHapusRencana" data-id="{{ $item->id }}"
                                                    title="Hapus">
                                                    HAPUS
                                                </button>
                            </div>
                            </td>
                            </tr>
                        @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada data.</td>
                </tr>
            @endforelse
            </tbody>
            </table>
        </div>
    </div>
</div>
</div>