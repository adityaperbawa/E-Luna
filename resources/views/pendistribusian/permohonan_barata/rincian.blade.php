<div class="card-header bg-info text-dark d-flex justify-content-between align-items-center">
    <strong>Rincian Permohonan #{{ $permohonan->id }}</strong>
    <button class="btn btn-outline-secondary btn-sm btnCloseRincianBarata">
        <i class="fas fa-times"></i>
    </button>
</div>

<div class="card-body">
    <div class="row g-3">
        <!-- KOTA -->
        <div class="col-md-6">
            <div class="card shadow-sm border">
                <div class="card-body p-2">
                    <small class="text-muted">Kota</small>
                    <h6 class="mb-0">{{ $permohonan->tujuan?->kab_kota ?? '-' }}</h6>
                </div>
            </div>
        </div>

        <!-- INSTANSI -->
        <div class="col-md-6">
            <div class="card shadow-sm border">
                <div class="card-body p-2">
                    <small class="text-muted">Instansi</small>
                    <h6 class="mb-0">{{ $permohonan->tujuan?->instansi ?? '-' }}</h6>
                </div>
            </div>
        </div>

        <!-- TANGGAL KEJADIAN -->
        <div class="col-md-6">
            <div class="card shadow-sm border">
                <div class="card-body p-2">
                    <small class="text-muted">Tanggal Kejadian</small>
                    <h6 class="mb-0">{{ $permohonan->tanggal_kejadian->format('d-m-Y') }}</h6>
                </div>
            </div>
        </div>

        <!-- KEJADIAN -->
        <div class="col-md-6">
            <div class="card shadow-sm border">
                <div class="card-body p-2">
                    <small class="text-muted">Kejadian</small>
                    <h6 class="mb-0">{{ $permohonan->kejadian }}</h6>
                </div>
            </div>
        </div>

        <!-- NO SURAT -->
        <div class="col-md-6">
            <div class="card shadow-sm border">
                <div class="card-body p-2">
                    <small class="text-muted">No Surat</small>
                    <h6 class="mb-0">{{ $permohonan->no_surat }}</h6>
                </div>
            </div>
        </div>

        <!-- STATUS -->
        <div class="col-md-6">
            <div class="card shadow-sm border">
                <div class="card-body p-2">
                    <small class="text-muted">Status</small>
                    <h6 class="mb-0">
                        @php
                            $status = strtolower($permohonan->status);
                            $statusClass = $status === 'setuju' ? 'text-success' : ($status === 'tidak' || $status === 'ditolak' ? 'text-danger' : 'text-muted');
                        @endphp
                        <span class="{{ $statusClass }}">{{ ucfirst($permohonan->status ?? 'Pending') }}</span>
                    </h6>
                </div>
            </div>
        </div>

        <!-- CREATED AT -->
        <div class="col-md-6">
            <div class="card shadow-sm border">
                <div class="card-body p-2">
                    <small class="text-muted">Dibuat</small>
                    <h6 class="mb-0">{{ $permohonan->created_at->format('d-m-Y H:i') }}</h6>
                </div>
            </div>
        </div>

        <!-- UPDATED AT -->
        <div class="col-md-6">
            <div class="card shadow-sm border">
                <div class="card-body p-2">
                    <small class="text-muted">Diperbarui</small>
                    <h6 class="mb-0">{{ $permohonan->updated_at->format('d-m-Y H:i') }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
