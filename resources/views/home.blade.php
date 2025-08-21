<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>E-luna</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="{{ asset('storage/dashboard/user.png') }}" type="image/png" />
    <!-- Bootstrap CSS Only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .sidebar {
            width: 240px;
            min-height: calc(100vh - 60px);
            background-color: #d55a00;
        }

        .sidebar a {
            color: white;
            font-size: 0.9rem;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #c04a00;
            border-radius: 4px;
        }

        .sidebar a i {
            width: 20px;
        }

        .header {
            background-color: #d55a00;
            color: white;
            height: 60px;
            display: flex;
            align-items: center;
        }

        .header-logo-box {
            background-color: white;
            padding: 1rem;
            margin-right: 1rem;
            display: flex;
            align-items: center;
            width: 240px;
        }

        .header-logo-box img {
            height: 50px;
            width: 170px;
            object-fit: contain;
        }

        main {
            padding: 1rem;
            background-size: 800px;
            background-repeat: no-repeat;
            background-position: center center;
            background-color: #fff;
            min-height: 80vh;
            position: relative;
        }

        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .submenu.show {
            max-height: 400px;
        }
    </style>
</head>

<body class="bg-white text-dark">

    <!-- Header -->
    <header class="header">
        <div class="header-logo-box">
            <img src="/storage/dashboard/eluna-logo.jpeg" alt="E-luna logo">
        </div>
        <!-- Refresh Icon -->
        <a href="{{ route('home') }}" class="text-decoration-none text-white ms-3 me-3">
            <i class="fas fa-sync-alt fa-1x"></i>
        </a>
        <span class="small">E-luna - Elektronik Logistik untuk bencana</span>
        <!-- Jam di kiri -->
        <div class="d-flex align-items-center ms-auto me-3 gap-3">
            <p id="date-time" class="mb-0 text-white" style="font-weight: bold; font-size: 0.8rem;"></p>

            <!-- Dropdown profil -->
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="/storage/dashboard/user.png" alt="User" width="32" height="32" class="rounded-circle">
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                    <li class="dropdown-item text-muted small">
                        <strong>{{ Auth::user()->role ?? 'Guest' }}</strong> |
                        <span style="color: green; font-weight: bold;">Online</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </li>
                </ul>
            </div>
        </div>

    </header>
    <!-- Layout -->
    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="sidebar">
            <nav class="mb-3 mt-1">
                <a href="#" id="toggleDashboard" class="d-flex align-items-center justify-content-between">
                    <span>
                        <i class="fa-solid fa-bolt"></i> Dashboard
                    </span>
                </a>
            </nav>
            <nav class="mt-1">
                <a href="#" id="togglePenerimaan" class="d-flex align-items-center justify-content-between">
                    <span>
                        <i class="fa-solid fa-folder me-2"></i> Penerimaan
                    </span>
                    <i class="fa-solid fa-arrows-up-down"></i>
                </a>
                <ul id="penerimaanList" class="submenu list-unstyled mt-1 ms-3">
                    <li><a href="#" id="loadDataUsulanLogpal"><i class="fa-solid fa-file me-2"></i> Usulan Logpal</a>
                    </li>
                    <li><a href="#" id="loadDataPenerimaanLogpal"><i class="fa-solid fa-file me-2"></i> Penerimaan
                            Logpal</a></li>
                </ul>
            </nav>
            <nav class="mt-1">
                <a href="#" id="togglePenyimpanan" class="d-flex align-items-center justify-content-between">
                    <span>
                        <i class="fa-solid fa-folder me-2"></i> Penyimpanan
                    </span>
                    <i class="fa-solid fa-arrows-up-down"></i>
                </a>
                <ul id="penyimpananList" class="submenu list-unstyled mt-1 ms-3">
                    <li><a href="#" id="loadDataBarang"><i class="fa-solid fa-file me-2"></i> Data Barang</a>
                    </li>
                    <li><a href="#" id="loadDataStokMinimum"><i class="fa-solid fa-file me-2"></i> Stok Minimum</a>
                    </li>
                    <li><a href="#" id="loadDataStokKadaluwarsa"><i class="fa-solid fa-file me-2"></i> Stok
                            Kadaluwarsa</a>
                    </li>
                    <li><a href="#" id="loadDataLokasiBarang"><i class="fa-solid fa-file me-2"></i> Penentuan Lokasi</a>
                    </li>
                    <li><a href="#" id="loadDataRencanaAlokasi"><i class="fa-solid fa-file me-2"></i> Rencana
                            Alokasi</a>
                    </li>
                </ul>
            </nav>
            <nav class="mt-1">
                <a href="#" id="togglePendistribusian" class="d-flex align-items-center justify-content-between">
                    <span>
                        <i class="fa-solid fa-folder me-2"></i> Pendistribusian
                    </span>
                    <i class="fa-solid fa-arrows-up-down"></i>
                </a>
                <ul id="pendistribusianList" class="submenu list-unstyled mt-1 ms-3">
                    <li><a href="#" id="loadDataPermohonanKabKota"><i class="fa-solid fa-file me-2"></i> Permohonan
                            Kab/Kota</a>
                    </li>
                    <li><a href="#" id="loadDataPermohonanBarata"><i class="fa-solid fa-file me-2"></i> Permohonan
                            Barata</a>
                    </li>
                    <li><a href="#" id="loadDataInputPengiriman"><i class="fa-solid fa-file me-2"></i> Input
                            Pengiriman</a>
                    </li>
                    <li><a href="#" id="loadDataPengirimanBarang"><i class="fa-solid fa-file me-2"></i> Pengiriman
                            Barang</a>
                    </li>
                </ul>
            </nav>
            <nav class="mt-1">
                <a href="#" id="togglePelaporan" class="d-flex align-items-center justify-content-between">
                    <span>
                        <i class="fa-solid fa-folder me-2"></i> Pelaporan
                    </span>
                    <i class="fa-solid fa-arrows-up-down"></i>
                </a>
                <ul id="pelaporanList" class="submenu list-unstyled mt-1 ms-3">
                    <li><a href="#" id="loadPenerimaan"><i class="fa-solid fa-file me-2"></i> Buku Harian
                            Penerimaan</a>
                    </li>
                    <li><a href="#" id="loadPengeluaran"><i class="fa-solid fa-file me-2"></i> Buku Harian
                            Pengeluaran</a>
                    </li>
                    <li><a href="#" id="loadPersediaan"><i class="fa-solid fa-file me-2"></i> Buku Induk
                            Persediaan</a>
                    </li>
                </ul>
            </nav>
            <nav class="mt-1">
                <a href="#" id="togglePengaturan" class="d-flex align-items-center justify-content-between">
                    <span>
                        <i class="fas fa-cogs me-2"></i> Pengaturan
                    </span>
                    <i class="fa-solid fa-arrows-up-down"></i>
                </a>
                <ul id="pengaturanList" class="submenu list-unstyled mt-1 ms-3">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <li><a href="#" id="loadDataPengguna"><i class="fas fa-user me-2"></i> Pengguna</a></li>
                        @endif
                    @endauth
                    <li><a href="#" id="loadDataSumber"><i class="fas fa-database me-2"></i> Sumber</a></li>
                    <li><a href="#" id="loadDataKategori"><i class="fas fa-table-cells me-2"></i> Kategori</a></li>
                    <li><a href="#" id="loadDataTujuan"><i class="fas fa-map-marker-alt me-2"></i> Tujuan</a></li>
                    <li><a href="#" id="loadDataGudang"><i class="fas fa-warehouse me-2"></i> Gudang</a></li>
                </ul>
            </nav>
            <!-- <nav class="mt-1">
                <a href="#" id="toggleFitur" class="d-flex align-items-center justify-content-between">
                    <span>
                        <i class="fas fa-cogs me-2"></i> Fitur
                    </span>
                    <i class="fa-solid fa-arrows-up-down"></i>
                </a>
                <ul id="fiturList" class="submenu list-unstyled mt-1 ms-3">
                    <li><a href="#" id="loadDataPenghapusan"><i class="fa-solid fa-eraser"></i> Penghapusan</a></li>
                    <li><a href="#" id="loadDataStokOpname"><i class="fa-solid fa-note-sticky"></i> Stok Opname</a></li>
                </ul>
            </nav> -->
        </aside>
        <!-- Main Content -->
        <main id="mainContent"
            class="flex-grow-1 d-flex flex-column justify-content-center align-items-center position-relative overflow-hidden">

            <!-- Background blur image -->
            <div id="welcomeBackground" style="position: absolute;
               top: 0; left: 0; right: 0; bottom: 0;
               background: url('/storage/dashboard/bg-bpbd.png') no-repeat center center;
               background-size: 600px;
               filter: blur(1px);
               opacity: 0.5;
               z-index: 0;">
            </div>
        </main>
    </div>
    <!-- Modal Konfirmasi Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="logoutModalLabel"><i class="fas fa-sign-out-alt me-2"></i>Konfirmasi
                        Logout</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin logout dari sistem?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Ya, Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (wajib untuk DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script src="{{ asset('js/dashboard.js') }}"></script>
    <!-- Penerimaan -->
    <script src="{{ asset('js/usulan_logpal.js') }}"></script>
    <script src="{{ asset('js/plogpal.js') }}"></script>
    <!-- Penyimpanan -->
    <script src="{{ asset('js/barang.js') }}"></script>
    <script src="{{ asset('js/stok_minimum.js') }}"></script>
    <script src="{{ asset('js/stok_kadaluwarsa.js') }}"></script>
    <script src="{{ asset('js/lokasi_barang.js') }}"></script>
    <script src="{{ asset('js/rencana.js') }}"></script>
    <!-- Pendistribusian -->
    <script src="{{ asset('js/permohonan_kabkota.js') }}"></script>
    <script src="{{ asset('js/permohonan_barata.js') }}"></script>
    <script src="{{ asset('js/input_pengiriman.js') }}"></script>
    <script src="{{ asset('js/pengiriman_barang.js') }}"></script>
     <!-- Pelaporan -->
    <script src="{{ asset('js/penerimaan.js') }}"></script>
    <script src="{{ asset('js/pengeluaran.js') }}"></script>
    <script src="{{ asset('js/persediaan.js') }}"></script>
    <!-- Pengaturan -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/pengguna.js') }}"></script>
    <script src="{{ asset('js/sumber.js') }}"></script>
    <script src="{{ asset('js/kategori.js') }}"></script>
    <script src="{{ asset('js/tujuan.js') }}"></script>
    <script src="{{ asset('js/gudang.js') }}"></script>
    <!-- Fitur -->
    <script src="{{ asset('js/penghapusan.js') }}"></script>
    <script src="{{ asset('js/stok_opname.js') }}"></script>
    <!-- Pelaporan -->


    @if(session('success_title') && session('success_user'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    toast: true,
                    position: 'top',
                    icon: 'success',
                    html: `
                                                                            <div style="text-align: center;">
                                                                                <strong>{{ session('success_title') }}</strong><br>
                                                                                <span>{{ session('success_user') }}</span>
                                                                            </div>
                                                                        `,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            });
        </script>
    @endif



</body>

</html>