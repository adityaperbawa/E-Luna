function updateDateTime() {
    const now = new Date();

    const optionsDate = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = now.toLocaleDateString('id-ID', optionsDate);

    const formattedTime = now.toLocaleTimeString('id-ID');

    const el = document.getElementById('date-time');
    if (el) {
        el.textContent = `${formattedDate} | ${formattedTime}`;
    }
}

// Jalankan saat pertama kali DOM siap
$(document).ready(function () {
    // Jalankan 1x saat load
    updateDateTime();

    // Update tiap detik
    setInterval(updateDateTime, 1000);

     $('#toggleDashboard').on('click', function (e) {
        e.preventDefault();
        $.get('/dashboard', function (res) {
            $('main').html(res);
            if (typeof initDashboard === 'function') initDashboard();
        });
    });
     // Toggle submenu Penerimaan
    $('#togglePenerimaan').on('click', function () {
        $('#penerimaanList').toggleClass('show');
    });

     // Load data usulan logpal
    $('#loadDataUsulanLogpal').on('click', function (e) {
        e.preventDefault();
        $.get('/usulan', function (res) {
            $('main').html(res);
            if (typeof initUsulanLogpal === 'function') initUsulanLogpal();
        });
    });
     // Load data P Logpal
    $('#loadDataPenerimaanLogpal').on('click', function (e) {
    e.preventDefault();
    $.get('/plogpal', function (res) {
        $('main').html(res);
        if (typeof initPlogpal === 'function') initPlogpal();
    });
});

// Toggle submenu Penyimpanan
    $('#togglePenyimpanan').on('click', function () {
        $('#penyimpananList').toggleClass('show');
    });
    
    $('#loadDataBarang').on('click', function (e) {
        e.preventDefault();
        $.get('/barang', function (res) {
            $('main').html(res);
            if (typeof initBarang === 'function') initBarang();
        });
    });
    
    $('#loadDataStokMinimum').on('click', function (e) {
    e.preventDefault();
    $.get('/stok-minimum', function (res) {
        $('main').html(res);
        if (typeof initStokMinimum === 'function') initStokMinimum();
    });
});
    
    $('#loadDataStokKadaluwarsa').on('click', function (e) {
    e.preventDefault();
    $.get('/barang/stok-kadaluwarsa', function (res) {
        $('main').html(res);
        if (typeof initStokKadaluwarsa === 'function') initStokKadaluwarsa();
    });
});
    $('#loadDataLokasiBarang').on('click', function (e) {
    e.preventDefault();
    $.get('/lokasi', function (res) {
        $('main').html(res);
        if (typeof initLokasiBarang === 'function') initLokasiBarang();
    });
});
    $('#loadDataRencanaAlokasi').on('click', function (e) {
    e.preventDefault();
    $.get('/rencana', function (res) {
        $('main').html(res);
        if (typeof initRencanaAlokasi === 'function') initRencanaAlokasi();
    });
});

// Toggle submenu Pendistribusian
    $('#togglePendistribusian').on('click', function () {
        $('#pendistribusianList').toggleClass('show');
    });
// Load data permohonan kab/kota
    $('#loadDataPermohonanKabKota').on('click', function (e) {
        e.preventDefault();
        $.get('/permohonan_kabkota', function (res) {
            $('main').html(res);
            if (typeof initPermohonanKabKota === 'function') initPermohonanKabKota();
        });
    });
// Load data permohonan Barata
    $('#loadDataPermohonanBarata').on('click', function (e) {
        e.preventDefault();
        $.get('/permohonan_barata', function (res) {
            $('main').html(res);
            if (typeof initPermohonanBarata === 'function') initPermohonanBarata();
        });
    });
// Load data pengiriman
    $('#loadDataInputPengiriman').on('click', function (e) {
        e.preventDefault();
        $.get('/input_pengiriman', function (res) {
            $('main').html(res);
            if (typeof initInputPengiriman === 'function') initInputPengiriman();
        });
    });

    // Pengiriman Barang
    $('#loadDataPengirimanBarang').on('click', function (e) {
        e.preventDefault();
        $.get('/pengiriman-barang', function (res) {
            $('main').html(res);
            if (typeof initPengirimanBarang === 'function') initPengirimanBarang();
        });
    });
   
    // Toggle submenu Pelaporan
    $('#togglePelaporan').on('click', function () {
        $('#pelaporanList').toggleClass('show');
    });
// Load data Penerimaan
    $('#loadPenerimaan').on('click', function (e) {
        e.preventDefault();
        $.get('/pelaporan/penerimaan', function (res) {
            $('main').html(res);
            if (typeof initBukuharianPenerimaan === 'function') initBukuharianPenerimaan();
        });
    });
    // Load data Pengeluaran
    $('#loadPengeluaran').on('click', function (e) {
        e.preventDefault();
        $.get('/pengeluaran', function (res) {
            $('main').html(res);
            if (typeof initBukuharianPengeluaran === 'function') initBukuharianPengeluaran();
        });
    });
    // Load data Persediaan
    $('#loadPersediaan').on('click', function (e) {
        e.preventDefault();
        $.get('/persediaan', function (res) {
            $('main').html(res);
            if (typeof initBukuharianPersediaan === 'function') initBukuharianPersediaan();
        });
    });

    // Toggle submenu Pengaturan
    $('#togglePengaturan').on('click', function () {
        $('#pengaturanList').toggleClass('show');
    });

    // Load data pengguna
    $('#loadDataPengguna').on('click', function (e) {
        e.preventDefault();
        $.get('/pengguna/partial', function (res) {
            $('main').html(res);
            if (typeof initPengguna === 'function') initPengguna();
        });
    });

    // Load data sumber
    $('#loadDataSumber').on('click', function (e) {
        e.preventDefault();
        $.get('/sumber/partial', function (res) {
            $('main').html(res);
            if (typeof initSumber === 'function') initSumber();
        });
    });
    $('#loadDataKategori').on('click', function (e) {
    e.preventDefault();
    $.get('/kategori', function (res) {
        $('main').html(res);
        if (typeof initKategori === 'function') initKategori();
    });
});
$('#loadDataTujuan').on('click', function (e) {
    e.preventDefault();
    $.get('/tujuan', function (res) {
        $('main').html(res);
        if (typeof initTujuan === 'function') initTujuan();
    });
});
$('#loadDataGudang').on('click', function (e) {
    e.preventDefault();
    $.get('/gudang', function (res) {
        $('main').html(res);
        if (typeof initGudang === 'function') initGudang();
    });
});

// Toggle submenu fitur
    $('#toggleFitur').on('click', function () {
        $('#fiturList').toggleClass('show');
    });

    // Load data penghapusan
    $('#loadDataPenghapusan').on('click', function (e) {
        e.preventDefault();
        $.get('/penghapusan', function (res) {
            $('main').html(res);
            if (typeof initPenghapusan === 'function') initPenghapusan();
        });
    });
    // Load data Stok Opname
    $('#loadDataStokOpname').on('click', function (e) {
        e.preventDefault();
        $.get('/stok_opname', function (res) {
            $('main').html(res);
            if (typeof initStokOpname === 'function') initStokOpname();
        });
    });

});