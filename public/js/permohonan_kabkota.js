function initPermohonanKabKota () {

    /* ---------- CSRF ---------- */
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    /* ---------- Elemen utama ---------- */
    const $listCard = $('#cardListPermohonan');          // bungkus tabel list
    const $formBox  = $('#formContainerPermohonan');

    const hideList  = () => $listCard.hide();
    const showList  = () => $listCard.show();

    /* ---------- Reload list ---------- */
    function reloadList () {
        $.get('/permohonan_kabkota').done(html => {
            $('main').html(html);        // ganti konten utama
            initPermohonanKabKota();     // re‑attach handler
        });
    }

    /* =========================================================
     *  Tambah
     * ======================================================= */
    $('#btnTambahPermohonan')
        .off('click')
        .on('click', () => {
            $.get('/permohonans/create').done(html => {
                $formBox.html(html);
                hideList();
                $('html,body').scrollTop(0);

                // bind: pilih kab/kota -> isi instansi
                $('#selectKabKota').off().on('change', function () {
                    $('#instansiView').val($(this).find(':selected').data('instansi') || '');
                });

                // submit tambah
                $('#formTambahPermohonan').off('submit').on('submit', function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: '/permohonans',
                        method: 'POST',
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        beforeSend () { Swal.showLoading(); },
                        success  (r) { Swal.fire('Berhasil', r.message, 'success'); reloadList(); },
                        error    (x) { Swal.fire('Gagal', x.responseJSON?.message||'Error', 'error'); }
                    });
                });

                // tombol kembali
                $('.btnKembaliPermohonan').off('click').on('click', () => {
                    $formBox.empty();
                    showList();
                });
            });
        });

    /* =========================================================
     *  Edit
     * ======================================================= */
    $('.editBtnPermohonan')
        .off('click')
        .on('click', function () {
            const id = $(this).data('id');
            $.get(`/permohonans/${id}/edit`).done(html => {
                $formBox.html(html);
                hideList();
                $('html,body').scrollTop(0);

                $('#selectKabKota').trigger('change').off().on('change', function () {
                    $('#instansiView').val($(this).find(':selected').data('instansi') || '');
                });

                $('#formEditPermohonan').off('submit').on('submit', function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: `/permohonans/${id}`,
                        method: 'POST',                    // _method=PUT di Blade
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        beforeSend () { Swal.showLoading(); },
                        success  (r) { Swal.fire('Berhasil', r.message, 'success'); reloadList(); },
                        error    (x) { Swal.fire('Gagal', x.responseJSON?.message||'Error', 'error'); }
                    });
                });

                $('.btnKembaliPermohonan').off('click').on('click', () => {
                    $formBox.empty();
                    showList();
                });
            });
        });

    /* =========================================================
     *  Delete
     * ======================================================= */
    $('.deleteBtnPermohonan')
        .off('click')
        .on('click', function () {
            const id = $(this).data('id');
            Swal.fire({icon:'warning',title:'Hapus data?',showCancelButton:true})
                .then(r => {
                    if (!r.isConfirmed) return;
                    $.ajax({
                        url:`/permohonans/${id}`,
                        method:'DELETE',
                        beforeSend () { Swal.showLoading(); },
                        success (r){ Swal.fire('Berhasil',r.message,'success'); reloadList(); },
                        error   (x){ Swal.fire('Gagal',x.responseJSON?.message||'Error','error'); }
                    });
                });
        });

    /* =========================================================
 *  Rincian Permohonan
 * ======================================================= */
$('.btnRincianPermohonan')
    .off('click')
    .on('click', function () {
        const id = $(this).data('id');
        $('#rincianPermohonanContent').html('<div class="p-4 text-center">Loading…</div>');
        $('#rincianPermohonanOverlay').fadeIn('fast');

        $.get(`/permohonans/${id}`).done(html => {
            $('#rincianPermohonanContent').html(html);

            // Event tutup tombol setelah HTML dimuat
            $('.btnCloseRincian').off('click').on('click', () => {
                $('#rincianPermohonanOverlay').fadeOut('fast');
            });
        });
    });

// Tutup jika klik luar overlay
$('#rincianPermohonanOverlay')
    .off('click')
    .on('click', function (e) {
        if (e.target.id === 'rincianPermohonanOverlay') {
            $(this).fadeOut('fast');
        }
    });

    $(document).ready(function () {
        $('#tabelPermohonan').DataTable({
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
                { orderable: false, targets: [6, 7] } // kolom Dokumen & Aksi tidak bisa disort
            ]
        });
    });
}
