function initPengirimanBarang() {
    const $overlay = $('#overlayPilihSurat');
    const openOverlay  = () => { $overlay.fadeIn(150); $('body').css('overflow', 'hidden'); };
    const closeOverlay = () => { $overlay.fadeOut(150); $('body').css('overflow', 'auto'); };

    const swalTop = (opts) => Swal.fire({
        ...opts,
        didOpen: () => $('.swal2-container').css('z-index', 20000)
    });

    // Cek semua
    $('#checkAll').off('click').on('click', function () {
        $('.checkBarang').prop('checked', $(this).prop('checked'));
    });

    // Buka overlay pilih surat
    $('#btnKirimBarang').off('click').on('click', function () {
        const selected = $('.checkBarang:checked');
        if (selected.length === 0) {
            return swalTop({ title:'Peringatan', text:'Pilih minimal satu barang!', icon:'warning' });
        }
        openOverlay();
    });

    // Tutup overlay
    $('#btnCloseOverlay').off('click').on('click', closeOverlay);

    // Proses kirim
$('#btnProsesKirim').off('click').on('click', function () {
    const suratId = $('#pengiriman_id').val() || null; // null kalau kosong

    const barangKirim = [];
    let valid = true;

    $('.checkBarang:checked').each(function () {
        const id = $(this).val();
        const jumlah = parseInt($('.jumlah-kirim[data-id="' + id + '"]').val(), 10);
        const stok = parseInt($(this).closest('tr').find('td:nth-child(3)').text(), 10);

        if (!jumlah || jumlah <= 0) {
            closeOverlay();
            swalTop({ title:'Peringatan', text:`Jumlah kirim untuk barang ID ${id} tidak valid!`, icon:'warning' })
                .then(() => openOverlay());
            valid = false;
            return false;
        }
        if (jumlah > stok) {
            closeOverlay();
            swalTop({ title:'Peringatan', text:`Jumlah kirim melebihi stok untuk barang ID ${id}!`, icon:'warning' })
                .then(() => openOverlay());
            valid = false;
            return false;
        }
        barangKirim.push({ id, jumlah });
    });

    if (!valid || barangKirim.length === 0) return;

    closeOverlay();
    swalTop({
        title: 'Konfirmasi',
        text: 'Yakin ingin mengirim barang?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, kirim',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (!result.isConfirmed) {
            openOverlay();
            return;
        }

        $('#btnProsesKirim').prop('disabled', true);

        $.ajax({
            url: '/pengiriman-barang',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                pengiriman_id: suratId, // Boleh null
                barang_data: barangKirim
            },
            success: function (res) {
                swalTop({ title:'Sukses', text: res.message || 'Pengiriman berhasil disimpan!', icon:'success' })
                    .then(() => {
                        $.get('/pengiriman-barang', function (html) {
                            $('main').html(html);
                            initPengirimanBarang();
                        });
                    });
            },
            error: function (xhr) {
                const errMsg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Terjadi kesalahan';
                swalTop({ title:'Error', text: errMsg, icon:'error' })
                    .then(() => openOverlay());
            },
            complete: function () {
                $('#btnProsesKirim').prop('disabled', false);
            }
        });
    });
});

    $('#tablePengirimanBarang').DataTable({
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: {
                next: "→",
                previous: "←"
            },
            emptyTable: "Tidak ada data tersedia"
        },
        columnDefs: [
            { orderable: false, targets: [0, 3] } // kolom checkbox & jumlah kirim tidak bisa disort
        ]
    });
    function updateSelectedCount() {
        let count = $(".checkBarang:checked").length;
        $("#badgeCount").text(count);
    }

    // Checkbox individual
    $(document).on("change", ".checkBarang", function () {
        updateSelectedCount();
    });

    // Checkbox "Pilih Semua"
    $("#checkAll").on("change", function () {
        $(".checkBarang").prop("checked", $(this).prop("checked"));
        updateSelectedCount();
    });

    // Saat load pertama
    updateSelectedCount();
    
}
