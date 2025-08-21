<div class="card border-info">
    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
        <strong><i class="fas fa-truck me-2"></i>Rincian Pengiriman #{{ $pengiriman->id }}</strong>
        <button class="btn btn-light btn-sm btnCloseRincianPengiriman"><i class="fas fa-times"></i></button>
    </div>

    <div class="card-body">
        <div class="row g-3">

            {{-- Informasi Surat --}}
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-3">
                        <h6 class="text-muted">No Surat</h6>
                        <p class="mb-0 fw-bold">{{ $pengiriman->no_surat }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-3">
                        <h6 class="text-muted">Tgl Surat</h6>
                        <p class="mb-0 fw-bold">{{ $pengiriman->tanggal_surat->format('d-m-Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-3">
                        <h6 class="text-muted">Tgl Pengiriman</h6>
                        <p class="mb-0 fw-bold">{{ $pengiriman->tanggal_pengiriman->format('d-m-Y') }}</p>
                    </div>
                </div>
            </div>

            {{-- Tujuan --}}
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-3">
                        <h6 class="text-muted">Tujuan</h6>
                        <p class="mb-0 fw-bold">{{ $pengiriman->tujuan?->instansi }} - {{ $pengiriman->tujuan?->alamat }}</p>
                    </div>
                </div>
            </div>

            {{-- Lokasi Tujuan dan Tahun --}}
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-3">
                        <h6 class="text-muted">Lokasi Tujuan</h6>
                        <p class="mb-0 fw-bold">{{ $pengiriman->lokasi_tujuan }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-3">
                        <h6 class="text-muted">Tahun</h6>
                        <p class="mb-0 fw-bold">{{ $pengiriman->tahun }}</p>
                    </div>
                </div>
            </div>

            {{-- Dokumen --}}
            @foreach ($dokumens as $field => $label)
                <div class="col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-3">
                            <h6 class="text-muted">{{ $label }}</h6>
                            @if ($pengiriman->$field)
                                <a href="{{ Storage::url($pengiriman->$field) }}" target="_blank" class="fw-bold text-decoration-none">
                                    <i class="fas fa-file-alt me-1"></i>Lihat File
                                </a>
                            @else
                                <p class="mb-0 text-muted fst-italic">Tidak tersedia</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Created & Updated --}}
            <div class="col-md-6">
                <div class="card shadow-sm border-0 bg-light">
                    <div class="card-body p-3">
                        <h6 class="text-muted">Dibuat</h6>
                        <p class="mb-0 fw-bold">{{ $pengiriman->created_at->format('d-m-Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm border-0 bg-light">
                    <div class="card-body p-3">
                        <h6 class="text-muted">Diperbarui</h6>
                        <p class="mb-0 fw-bold">{{ $pengiriman->updated_at->format('d-m-Y H:i') }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
