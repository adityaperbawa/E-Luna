@php use Illuminate\Support\Facades\Storage; @endphp
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">
<div id="cardListPermohonan">
<div class="card w-100">
    <div class="card-header text-dark d-flex justify-content-between align-items-center">
        <h6></i>Data Permohonan Kab/Kota</h6>
        <button id="btnTambahPermohonan" class="btn btn-success btn-sm">
            Tambah <i class="fas fa-plus"></i> 
        </button>
    </div>

    <div class="card-body">
        <table id="tabelPermohonan" class="table table-bordered table-hover table-sm">
            <thead class="table-secondary">
                <tr>
                    <th>Kab/Kota</th>
                    <th>No Surat</th>
                    <th>Tanggal Surat</th>
                    <th>Tahun Surat</th>
                    <th>Instansi</th>
                    <th>Keperluan</th>   
                    <th>Dokumen</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($permohonans as $p)
                    <tr>
                        <td>{{ $p->tujuan?->kab_kota ?? '-' }}</td>
                        <td>{{ $p->no_surat }}</td>
                        <td>{{ $p->tanggal_surat?->format('d-m-Y') ?? '-' }}</td>
                        <td>{{ $p->tahun_surat }}</td>
                        <td>{{ $p->tujuan?->instansi ?? '-' }}</td>
                        <td>{{ $p->keperluan ?? '-' }}</td> {{-- ← tampilkan keperluan --}}
                        <td class="text-center">
                            @if ($p->dokumen)
                                <a href="{{ Storage::url($p->dokumen) }}"
                                   target="_blank"
                                   class="btn btn-primary btn-sm">
                                    DOKUMEN
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-primary btnRincianPermohonan"
                                    data-id="{{ $p->id }}">
                                RINCIAN
                            </button>
                            <button class="btn btn-sm btn-warning editBtnPermohonan"
                                    data-id="{{ $p->id }}">
                                EDIT
                            </button>
                            <button class="btn btn-sm btn-danger deleteBtnPermohonan"
                                    data-id="{{ $p->id }}">
                                HAPUS
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</div>
</div>

{{-- Container form (tambah & edit) --}}
<div id="formContainerPermohonan"></div>

{{-- Overlay rincian --}}
<div id="rincianPermohonanOverlay"
     style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,.5);z-index:9999;">
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="card shadow" style="width:800px;max-height:90vh;overflow-y:auto">
            <div id="rincianPermohonanContent"></div>
        </div>
    </div>
</div>
