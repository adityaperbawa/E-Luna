<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-4">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarFilters">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarFilters">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Dropdown Sumber -->
                <!-- <li class="nav-item dropdown me-3">
                    <a class="nav-link dropdown-toggle" href="#" id="sumberDropdown" role="button"
                        data-bs-toggle="dropdown">
                        Sumber
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" data-value="APBD">APBD</a></li>
                        <li><a class="dropdown-item" href="#" data-value="APBN">APBN</a></li>
                        <li><a class="dropdown-item" href="#" data-value="Donasi">Donasi</a></li>
                    </ul>

                </li> -->
                <!-- Dropdown Jenis Bantuan -->
                <!-- <li class="nav-item dropdown me-3">
                    <a class="nav-link dropdown-toggle" href="#" id="jenisDropdown" role="button"
                        data-bs-toggle="dropdown">
                        Jenis Bantuan
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Logistik</a></li>
                        <li><a class="dropdown-item" href="#">Peralatan</a></li>
                        <li><a class="dropdown-item" href="#">Lainnya</a></li>
                    </ul>
                </li> -->
                <!-- Dropdown Tahun -->
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="tahunDropdown" role="button"
                        data-bs-toggle="dropdown">
                        Tahun Anggaran
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">2024</a></li>
                        <li><a class="dropdown-item" href="#">2025</a></li>
                    </ul>
                </li> -->
            </ul>
        </div>
    </div>
</nav>

<!-- Card Dashboard -->
<div class="container">
    <div id="cardListDashboard" class="row g-4">
        <!-- Penerimaan -->
        <div class="col-md-4">
            <div class="card shadow h-100">
                <div class="card-header bg-white fw-bold">Penerimaan</div>
                <div class="card-body text-center">
                    <p>Usulan Logpal: <span class="badge bg-primary">{{ $usulanLogpalCount }}</span></p>
                    <p>Logistik: <span class="badge bg-success">{{ $penerimaanLogistik }}</span></p>
                    <p>Peralatan: <span class="badge bg-warning text-dark">{{ $penerimaanPeralatan }}</span></p>
                    <canvas id="chartPenerimaan"></canvas>
                </div>
            </div>
        </div>

        <!-- Penyimpanan -->
        <div class="col-md-4">
            <div class="card shadow h-100">
                <div class="card-header bg-white fw-bold">Penyimpanan</div>
                <div class="card-body text-center">
                    <p>Total Stok: <span class="badge bg-info text-dark">{{ $totalStok }}</span></p>
                    <p>Total Harga: <span
                            class="badge bg-secondary">Rp{{ number_format($totalHarga, 0, ',', '.') }}</span>
                    </p>
                    <p>Kadaluwarsa < 1 bln: <span class="badge bg-danger">{{ $stokExpSoon->count() }}</span></p>
                    <canvas id="chartPenyimpanan"></canvas>
                </div>
            </div>
        </div>

        <!-- Pendistribusian -->
        <div class="col-md-4">
            <div class="card shadow h-100">
                <div class="card-header bg-white fw-bold">Pendistribusian</div>
                <div class="card-body text-center">
                    <p>Surat Permohonan: <span class="badge bg-primary">{{ $permohonanCount }}</span></p>
                    <p>Surat Pengiriman: <span class="badge bg-success">{{ $suratPengiriman }}</span></p>
                    <p>Total Kirim Barang: <span class="badge bg-warning text-dark">{{ $totalKirimBarang }}</span></p>
                    <p>Total Harga Kirim: <span
                            class="badge bg-secondary">Rp{{ number_format($totalHargaKirim, 0, ',', '.') }}</span></p>
                    <canvas id="chartDistribusi"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dataset Hidden -->
<div id="chartData" data-usulan="{{ $usulanLogpalCount ?? 0 }}" data-logistik="{{ $penerimaanLogistik ?? 0 }}"
    data-peralatan="{{ $penerimaanPeralatan ?? 0 }}" data-totalstok="{{ $totalStok ?? 0 }}"
    data-expsoon="{{ $stokExpSoon->count() ?? 0 }}" data-permohonan="{{ $permohonanCount ?? 0 }}"
    data-pengiriman="{{ $suratPengiriman ?? 0 }}" data-kirim="{{ $totalKirimBarang ?? 0 }}">
</div>