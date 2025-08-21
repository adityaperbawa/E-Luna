function initBukuharianPenerimaan() {
    // DataTable Surat
    $('#tabelSurat').DataTable({
        responsive: true,
        language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json' }
    });

    // DataTable Barang
    $('#tabelBarang').DataTable({
        responsive: true,
        language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json' }
    });

    // Klik tombol detail -> tampilkan overlay
    $(document).off('click', '.detailPenerimaan').on('click', '.detailPenerimaan', function () {
        const id = $(this).data('id');
        $.get(`/pelaporan/penerimaan/${id}/detail`, function (res) {
            $('#detailPenerimaanContent').html(res);
            $('#detailPenerimaanContainer').fadeIn();
            $('main').addClass('blurred'); // opsional: kasih efek blur
        });
    });

    // Tutup detail
    $(document).off('click', '.btnTutupDetailPenerimaan').on('click', '.btnTutupDetailPenerimaan', function () {
        $('#detailPenerimaanContainer').fadeOut(function () {
            $('#detailPenerimaanContent').html('');
        });
        $('main').removeClass('blurred');
    });
}
