function initInputPengiriman () {
    const csrf = $('meta[name="csrf-token"]').attr('content');

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': csrf } });

    function reloadList () {
        $.get('/input_pengiriman', function (res) {
            $('main').html(res);
            initInputPengiriman();
        });
    }

    // ---------------- Tambah ----------------
    $('#btnTambahPengiriman').on('click', function () {
        $.get('/input_pengiriman/create', function (res) {
            $('#formContainerPengiriman').html(res);
            $('#cardListPengiriman').hide();
            $('html,body').animate({ scrollTop: 0 }, 300);
            bindFormTambah();
        });
    });

    function bindFormTambah () {
        $('#formTambahPengiriman').on('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            $.ajax({
                url: '/input_pengiriman',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend () {
                    Swal.showLoading();
                },
                success (r) {
                    Swal.fire('Berhasil', r.message, 'success');
                    reloadList();
                },
                error (xhr) {
                    Swal.fire('Gagal', xhr.responseJSON?.message || 'Terjadi kesalahan', 'error');
                }
            });
        });

        $('.btnKembaliPengiriman').on('click', function () {
            $('#formContainerPengiriman').empty();
            $('#cardListPengiriman').show();
        });
    }

    // ---------------- Edit ----------------
    $('.editBtnPengiriman').on('click', function () {
        const id = $(this).data('id');
        $.get(`/input_pengiriman/${id}/edit`, function (res) {
            $('#formContainerPengiriman').html(res);
            $('#cardListPengiriman').hide();
            $('html,body').animate({ scrollTop: 0 }, 300);
            bindFormEdit(id);
        });
    });

    function bindFormEdit (id) {
        $('#formEditPengiriman').on('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            $.ajax({
                url: `/input_pengiriman/${id}`,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend () {
                    Swal.showLoading();
                },
                success (r) {
                    Swal.fire('Berhasil', r.message, 'success');
                    reloadList();
                },
                error (xhr) {
                    Swal.fire('Gagal', xhr.responseJSON?.message || 'Terjadi kesalahan', 'error');
                }
            });
        });

        $('.btnKembaliPengiriman').on('click', function () {
            $('#formContainerPengiriman').empty();
            $('#cardListPengiriman').show();
        });
    }

    // ---------------- Hapus ----------------
    $('.deleteBtnPengiriman').on('click', function () {
        const id = $(this).data('id');

        Swal.fire({
            icon: 'warning',
            title: 'Hapus data?',
            text: 'Tindakan ini tidak dapat dibatalkan!',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then(res => {
            if (res.isConfirmed) {
                $.ajax({
                    url: `/input_pengiriman/${id}`,
                    method: 'DELETE',
                    beforeSend () { Swal.showLoading(); },
                    success (r) {
                        Swal.fire('Berhasil', r.message, 'success');
                        reloadList();
                    },
                    error (xhr) {
                        Swal.fire('Gagal', xhr.responseJSON?.message || 'Terjadi kesalahan', 'error');
                    }
                });
            }
        });
    });

    // ---------------- Rincian ----------------
    $('.btnRincianPengiriman').on('click', function () {
        const id = $(this).data('id');
        $('#rincianPengirimanContent').html('<div class="p-4 text-center">Loading...</div>');
        $('#rincianPengirimanOverlay').fadeIn('fast');

        $.get(`/input_pengiriman/${id}`, function (res) {
            $('#rincianPengirimanContent').html(res);
            $('.btnCloseRincianPengiriman').on('click', () => $('#rincianPengirimanOverlay').fadeOut('fast'));
        });
    });

    $('#rincianPengirimanOverlay').on('click', function (e) {
        if (e.target.id === 'rincianPengirimanOverlay') $(this).fadeOut('fast');
    });

    $(document).ready(function () {
    $('#tablePengiriman').DataTable({
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            zeroRecords: "Tidak ditemukan data yang cocok",
            paginate: {
                next: "→",
                previous: "←"
            }
        },
        columnDefs: [
            { orderable: false, targets: [6] } // kolom "Aksi" tidak bisa di-sort
        ]
    });
});

}
