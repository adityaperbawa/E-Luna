<div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
    <strong><i class="fas fa-info-circle me-2"></i>Rincian Permohonan #{{ $permohonan->id }}</strong>
    <button class="btn btn-sm btn-light btnCloseRincian" title="Tutup">
        <i class="fas fa-times"></i>
    </button>
</div>

<div class="card-body p-4 bg-light">
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold text-primary mb-2">Data Tujuan</h6>
                    <p class="mb-1"><strong>Kab/Kota:</strong> {{ $permohonan->tujuan?->kab_kota ?? '-' }}</p>
                    <p class="mb-1"><strong>Instansi:</strong> {{ $permohonan->tujuan?->instansi ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold text-primary mb-2">Informasi Surat</h6>
                    <p class="mb-1"><strong>No Surat:</strong> {{ $permohonan->no_surat }}</p>
                    <p class="mb-1"><strong>Tanggal Surat:</strong> {{ $permohonan->tanggal_surat?->format('d-m-Y') ?? '-' }}</p>
                    <p class="mb-1"><strong>Tahun Surat:</strong> {{ $permohonan->tahun_surat }}</p>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold text-primary mb-2">Keperluan</h6>
                    <p class="mb-1">{{ $permohonan->keperluan ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold text-primary mb-2">Dokumen</h6>
                    @if ($permohonan->dokumen)
                        <a href="{{ Storage::url($permohonan->dokumen) }}"
                           target="_blank"
                           class="btn btn-outline-info btn-sm">
                            <i class="fas fa-download me-1"></i>Unduh Dokumen
                        </a>
                    @else
                        <p class="text-muted mb-0">Tidak ada dokumen</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold text-primary mb-2">Status Data</h6>
                    <p class="mb-1"><strong>Dibuat:</strong> {{ $permohonan->created_at?->format('d-m-Y H:i') }}</p>
                    <p class="mb-1"><strong>Diperbarui:</strong> {{ $permohonan->updated_at?->format('d-m-Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="rincianPermohonanOverlay" class="overlay" style="display: none;">
    <div id="rincianPermohonanContent" class="card w-100 rounded shadow-lg bg-white">
        <!-- Konten rincian AJAX dimuat di sini -->
    </div>
</div>
