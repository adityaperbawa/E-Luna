@php use Illuminate\Support\Facades\Storage; @endphp
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">
    <div id="cardListBarata">
        <div class="card w-100">
            <div class="card-header text-dark d-flex justify-content-between align-items-center">
                <h6>Data Permohonan Barata</h6>
                <button id="btnTambahPermohonanBarata" class="btn btn-success btn-sm">
                    Tambah <i class="fas fa-plus"></i>
                </button>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-sm table-hover" id="tableBarata">
                    <thead class="table-secondary">
                        <tr class="text-center">
                            <th>Kota</th>
                            <th>Tanggal Kejadian</th>
                            <th>Kejadian</th>
                            <th>No Surat</th>
                            <th>Status</th>
                            <th>Dokumen</th>
                            <th class="text-center" style="width:300px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permohonans as $p)
                            <tr>
                                <td>{{ $p->tujuan?->kab_kota ?? '-' }}</td>
                                <td>{{ $p->tanggal_kejadian?->format('d-m-Y') ?? '-' }}</td>
                                <td>{{ Str::limit($p->kejadian, 30) }}</td>
                                <td>{{ $p->no_surat }}</td>
                                <td>
                                    @php
                                        $badge = [
                                            'disetujui' => 'success',
                                            'ditolak' => 'danger',
                                            null => 'secondary'
                                        ][$p->status] ?? 'secondary';
                                    @endphp
                                    <span class="badge bg-{{ $badge }}">{{ $p->status ?? 'pending' }}</span>
                                </td>
                                <td class="text-center">
                                    @if($p->dokumen)
                                        <a href="{{ asset('storage/' . $p->dokumen) }}" target="_blank"
                                            class="btn btn-primary btn-sm">
                                            DOKUMEN
                                        </a>
                                    @else -
                                    @endif
                                </td>
                                <td class="text-center">
                                    @auth
                                        @if(auth()->user()->role === 'admin' && ($p->status === null || $p->status === 'Belum Diproses'))
                                            <button class="btn btn-sm btn-success btnSetujuBarata" data-id="{{ $p->id }}">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger btnTolakBarata" data-id="{{ $p->id }}">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            <div class="vr mx-2"></div>
                                        @endif
                                    @endauth

                                    <button class="btn btn-sm btn-info btnRincianBarata" data-id="{{ $p->id }}">
                                        RINCIAN
                                    </button>
                                    <button class="btn btn-sm btn-warning editBtnBarata" data-id="{{ $p->id }}">
                                        EDIT
                                    </button>
                                    <button class="btn btn-sm btn-danger deleteBtnBarata" data-id="{{ $p->id }}">
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

    {{-- Form container --}}
    <div id="formContainerBarata"></div>

    {{-- Overlay rincian --}}
    <div id="rincianBarataOverlay"
        style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,.5);z-index:9999">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="card shadow" style="width:800px;max-height:90vh;overflow-y:auto">
                <div id="rincianBarataContent"></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/permohonan_barata.js') }}"></script>
@endpush