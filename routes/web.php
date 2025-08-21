<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SumberController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TujuanController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\UsulanLogpalController;
use App\Http\Controllers\PLogpalController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokKadaluwarsaController;
use App\Http\Controllers\LokasiBarangController;
use App\Http\Controllers\RencanaAlokasiController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\PermohonanBarataController;
use App\Http\Controllers\InputPengirimanController;
use App\Http\Controllers\PenghapusanController;
use App\Http\Controllers\StokOpnameController;
use App\Http\Controllers\PengirimanBarangController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PersediaanController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect('/login');
});
// Login routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// HAK AKSES
Route::middleware('auth')->group(function () {

    // Berpindah Halaman
    Route::get('/home', function () {
        return view('home'); // atau nama blade yang sesuai
    })->name('home');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    // MENU PENERIMAAN

    //GRUP USULAN
    Route::get('/usulan', [UsulanLogpalController::class, 'index']);
    Route::get('/usulan/form', function () {
        $sumbers = \App\Models\Sumber::all();
        return view('penerimaan.usulan.form_tambah_usulan', compact('sumbers'));
    });
    Route::get('/usulan/form/edit/{id}', function ($id) {
        $usulan = \App\Models\UsulanLogpal::findOrFail($id);
        $sumbers = \App\Models\Sumber::all();
        return view('penerimaan.usulan.form_edit_usulan', compact('usulan', 'sumbers'));
    });
    Route::post('/usulan', [UsulanLogpalController::class, 'store']);
    Route::get('/usulan/{id}/edit', [UsulanLogpalController::class, 'edit']);
    Route::post('/usulan/{id}', [UsulanLogpalController::class, 'update']);
    Route::delete('/usulan/{id}', [UsulanLogpalController::class, 'destroy']);
    // GRUP PENERIMAAN LOGPAL
    Route::prefix('plogpal')->group(function () {
        Route::get('/', [PLogpalController::class, 'index'])->name('plogpal.index');
        Route::get('/create', [PLogpalController::class, 'create'])->name('plogpal.create');
        Route::post('/', [PLogpalController::class, 'store'])->name('plogpal.store');
        Route::get('/{id}/edit', [PLogpalController::class, 'edit'])->name('plogpal.edit');
        Route::post('/{id}', [PLogpalController::class, 'update'])->name('plogpal.update');
        Route::delete('/{id}', [PLogpalController::class, 'destroy'])->name('plogpal.destroy');
        Route::get('/{id}/rincian', [PLogpalController::class, 'rincian'])->name('plogpal.rincian');

    });

    // MENU PENYIMPANAN

    // GRUP STOK K
    Route::prefix('barang')->group(function () {
        Route::get('stok-kadaluwarsa', [StokKadaluwarsaController::class, 'index']);
        Route::get('stok-kadaluwarsa/{id}', [StokKadaluwarsaController::class, 'show']);
        Route::post('stok-kadaluwarsa/{id}/status', [StokKadaluwarsaController::class, 'storeStatus']);
        Route::get('stok-kadaluwarsa/{id}/status', [StokKadaluwarsaController::class, 'showStatus']);
    });
    //GRUP STOK M
    Route::get('/stok-minimum', [BarangController::class, 'stokMinimumView']);
    Route::post('/stok-minimum/update', [BarangController::class, 'updateStokMinimum']);

    // GRUP BARANG
    Route::get('/barang', [BarangController::class, 'index']);
    Route::get('/barang/create', [BarangController::class, 'create']);
    Route::post('/barang', [BarangController::class, 'store']);
    Route::get('/barang/{id}/edit', [BarangController::class, 'edit']);
    Route::post('/barang/{id}', [BarangController::class, 'update']);
    Route::delete('/barang/{id}', [BarangController::class, 'destroy']);
    // GRUP Penentuan Lokasi Barang
    Route::prefix('lokasi')->group(function () {
        Route::get('/', [LokasiBarangController::class, 'index'])->name('lokasi.index');
        Route::get('/create', [LokasiBarangController::class, 'create'])->name('lokasi.create');
        Route::post('/', [LokasiBarangController::class, 'store'])->name('lokasi.store');

        Route::get('/{id}/edit', [LokasiBarangController::class, 'edit'])->name('lokasi.edit');
        Route::post('/{id}', [LokasiBarangController::class, 'update'])->name('lokasi.update');
        Route::delete('/{id}', [LokasiBarangController::class, 'destroy'])->name('lokasi.destroy');

        Route::get('/kategori/{kategori_id}/barang', [LokasiBarangController::class, 'getBarangByKategori'])->name('lokasi.barang.byKategori');
    });

    // GRUP RENCANA ALOKASI
    Route::prefix('rencana')->group(function () {
        Route::get('/', [RencanaAlokasiController::class, 'index'])->name('rencana.index');
        Route::get('/create', [RencanaAlokasiController::class, 'create'])->name('rencana.create');
        Route::post('/', [RencanaAlokasiController::class, 'store'])->name('rencana.store');
        Route::get('/{id}/edit', [RencanaAlokasiController::class, 'edit'])->name('rencana.edit');
        Route::post('/{id}', [RencanaAlokasiController::class, 'update'])->name('rencana.update');
        Route::post('/{id}/status', [RencanaAlokasiController::class, 'setStatus'])->name('rencana.status');
        Route::delete('/{id}', [RencanaAlokasiController::class, 'destroy'])->name('rencana.destroy');
    });

    // MENU PENDISTRIBUSIAN
// KAB/KOTA
    Route::get('/permohonan_kabkota', [PermohonanController::class, 'index'])->name('permohonan_kabkota');

    // resource CRUD – index dikecualikan karena sudah di‑alias di atas
    Route::resource('permohonans', PermohonanController::class)
        ->except('index')
        ->parameters(['permohonans' => 'permohonan']);
    // BARATA
    Route::prefix('permohonan_barata')->group(function () {
        Route::get('/', [PermohonanBarataController::class, 'index']);
        Route::get('/create', [PermohonanBarataController::class, 'create']);
        Route::post('/', [PermohonanBarataController::class, 'store']);
        Route::get('/{id}/edit', [PermohonanBarataController::class, 'edit']);
        Route::put('/{id}', [PermohonanBarataController::class, 'update']);
        Route::delete('/{id}', [PermohonanBarataController::class, 'destroy']);
        Route::get('/{id}', [PermohonanBarataController::class, 'show']);

        // Setuju / Tolak
        Route::post('/{id}/setuju', [PermohonanBarataController::class, 'setuju']);
        Route::post('/{id}/tolak', [PermohonanBarataController::class, 'tolak']);
        Route::post('/{id}/status', [PermohonanBarataController::class, 'updateStatus'])->name('permohonan_barata.status');
    });
    // Pengiriman
    Route::prefix('input_pengiriman')->controller(InputPengirimanController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::post('/', 'store');
        Route::get('/{id}/edit', 'edit');
        Route::post('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
        Route::get('/{id}', 'show');
    });

    // Pengiriman Barang

    Route::get('/pengiriman-barang', [PengirimanBarangController::class, 'index']);
    Route::post('/pengiriman-barang', [PengirimanBarangController::class, 'store']);

    // MENU PELAPORAN
    Route::get('/pelaporan/penerimaan', [PenerimaanController::class, 'index']);
    Route::get('/pelaporan/penerimaan/{id}/detail', [PenerimaanController::class, 'detail'])->name('penerimaan.detail');

    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran.index');
    Route::get('/pengeluaran/detail/{id}', [PengeluaranController::class, 'show'])->name('pengeluaran.detail');
    Route::get('/pengeluaran/barang-tanpa-surat', [PengeluaranController::class, 'barangTanpaSurat'])
        ->name('pengeluaran.barang.tanpaSurat');

    Route::get('/persediaan', [PersediaanController::class, 'index'])->name('persediaan.index');


    // MENU PENGATURAN
// GRUP PENGGUNA
    Route::prefix('pengguna')->name('pengguna.')->group(function () {
        Route::get('/pengaturan/pengguna', [UserController::class, 'index'])->name('index');
        Route::get('/partial', [UserController::class, 'partial'])->name('partial');
        Route::get('/form', [UserController::class, 'form'])->name('form');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    });
    // GRUP SUMBER
    Route::prefix('sumber')->name('sumber.')->group(function () {
        Route::get('/', [SumberController::class, 'index'])->name('index');
        Route::get('/partial', [SumberController::class, 'partial'])->name('partial');
        Route::get('/form', [SumberController::class, 'form'])->name('form');
        Route::post('/store', [SumberController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [SumberController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SumberController::class, 'update'])->name('update');
        Route::delete('/{id}', [SumberController::class, 'destroy'])->name('destroy');
    });
    // GRUP KATEGORI
    Route::prefix('kategori')->name('kategori.')->group(function () {
        Route::get('/', [KategoriController::class, 'index'])->name('index');
        Route::get('/partial', [SumberController::class, 'partial'])->name('partial');
        Route::get('/form', [KategoriController::class, 'form'])->name('form');
        Route::post('/store', [KategoriController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [KategoriController::class, 'edit'])->name('edit');
        Route::put('/{id}', [KategoriController::class, 'update'])->name('update');
        Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('destroy');
    });
    //GRUP TUJUAN
    Route::prefix('tujuan')->group(function () {
        Route::get('/', [TujuanController::class, 'index']);
        Route::get('/form', [TujuanController::class, 'create']);
        Route::post('/store', [TujuanController::class, 'store']);
        Route::get('/{id}/edit', [TujuanController::class, 'edit']);
        Route::put('/{id}', [TujuanController::class, 'update']);
        Route::delete('/{id}', [TujuanController::class, 'destroy']);
    });
    //GRUP GUDANG
    Route::get('/gudang', [GudangController::class, 'index'])->name('gudang.index');
    Route::get('/gudang/form', [GudangController::class, 'create'])->name('gudang.create');
    Route::post('/gudang/store', [GudangController::class, 'store'])->name('gudang.store');
    Route::get('/gudang/{id}/edit', [GudangController::class, 'edit'])->name('gudang.edit');
    Route::put('/gudang/{id}', [GudangController::class, 'update'])->name('gudang.update');
    Route::delete('/gudang/{id}', [GudangController::class, 'destroy'])->name('gudang.destroy');

    // MENU FITUR
// Penghapusan
    Route::get('/penghapusan', [PenghapusanController::class, 'index']);
    Route::get('/penghapusan/create', [PenghapusanController::class, 'create']);
    Route::post('/penghapusan', [PenghapusanController::class, 'store']);
    Route::get('/penghapusan/{id}/edit', [PenghapusanController::class, 'edit']);
    Route::post('/penghapusan/{id}', [PenghapusanController::class, 'update']);
    Route::delete('/penghapusan/{id}', [PenghapusanController::class, 'destroy']);
    Route::get('/penghapusan/{id}', [PenghapusanController::class, 'show']);
    // Stok Opname
    Route::prefix('stok_opname')->group(function () {
        Route::get('/', [StokOpnameController::class, 'index']);
        Route::get('/create', [StokOpnameController::class, 'create']);
        Route::post('/', [StokOpnameController::class, 'store']);
        Route::get('/{id}/edit', [StokOpnameController::class, 'edit']);
        Route::post('/{id}', [StokOpnameController::class, 'update']);
        Route::delete('/{id}', [StokOpnameController::class, 'destroy']);
    });

});




