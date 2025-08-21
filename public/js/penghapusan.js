function initPenghapusan() {
    // TOMBOL TAMBAH
    $('#btnTambahPenghapusan').on('click', function () {
        $.get('/penghapusan/create', function (res) {
            $('#formContainerPenghapusan').html(res);
            $('#cardListPenghapusan').hide();
        });
    });

    // BATAL TAMBAH
    $(document).off('click', '#cancelTambahPenghapusan')
        .on('click', '#cancelTambahPenghapusan', function () {
            $('#formContainerPenghapusan').html('');
            $('#cardListPenghapusan').show();
        });

    // BATAL EDIT
    $(document).on('click', '#cancelEditPenghapusan', function () {
        $('#formContainerPenghapusan').html('');
        $('#cardListPenghapusan').show();
    });

    // SUBMIT TAMBAH
    $(document).off('submit', '#formTambahPenghapusan')
        .on('submit', '#formTambahPenghapusan', function (e) {
            e.preventDefault();
            $.ajax({
                url: '/penghapusan',
                method: 'POST',
                data: $(this).serialize(),
                success: function (res) {
                    Swal.fire('Berhasil', res.message, 'success');
                    refreshPenghapusan();
                }
            });
        });

    // EDIT
    $(document).on('click', '.editBtnPenghapusan', function () {
        const id = $(this).data('id');
        $.get('/penghapusan/' + id + '/edit', function (res) {
            $('#formContainerPenghapusan').html(res);
            $('#cardListPenghapusan').hide();
        });
    });

     // SUBMIT EDIT
    $(document).off('submit', '#formEditPenghapusan')
        .on('submit', '#formEditPenghapusan', function (e) {
            e.preventDefault();
            const id = $(this).find('input[name="id"]').val();
            $.ajax({
                url: '/penghapusan/' + id,
                method: 'POST',
                data: $(this).serialize(),
                success: function (res) {
                    Swal.fire('Berhasil', res.message, 'success');
                    refreshPenghapusan();
                }
            });
        });

    // DELETE
    $(document).off('click', '.deleteBtnPenghapusan')
        .on('click', '.deleteBtnPenghapusan', function () {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Yakin hapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/penghapusan/' + id,
                        method: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (res) {
                            Swal.fire('Berhasil', res.message, 'success');
                            refreshPenghapusan();
                        }
                    });
                }
            });
        });

        function initDataTablePenghapusan() {
    $('#tablePenghapusan').DataTable({
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
            { orderable: false, targets: [4] } // Kolom aksi tidak bisa di-sort
        ]
    });
}

// Pastikan dipanggil saat data siap
$(document).ready(function () {
    initDataTablePenghapusan();
});

}

function refreshPenghapusan() {
    $.get('/penghapusan', function (res) {
        $('main').html(res);
        initPenghapusan();
    });
}
