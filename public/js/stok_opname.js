function initStokOpname() {
    // Hapus semua binding sebelumnya
    $(document).off('.stokOpname');

    // TOMBOL TAMBAH
    $(document).on('click.stokOpname', '#btnTambahStokOpname', function () {
        $.get('/stok_opname/create', function (res) {
            $('#formContainerStokOpname').html(res);
            $('#cardListStokOpname').hide();
        });
    });

    // BATAL TAMBAH
    $(document).on('click.stokOpname', '#cancelTambahStokOpname', function () {
        $('#formContainerStokOpname').html('');
        $('#cardListStokOpname').show();
    });

    // BATAL EDIT
    $(document).on('click.stokOpname', '#cancelEditStokOpname', function () {
        $('#formContainerStokOpname').html('');
        $('#cardListStokOpname').show();
    });

    // SUBMIT TAMBAH
    $(document).on('submit.stokOpname', '#formTambahStokOpname', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/stok_opname',
            method: 'POST',
            data: $(this).serialize(),
            success: function (res) {
                Swal.fire('Berhasil', res.message, 'success');
                refreshStokOpname();
            }
        });
    });

    // EDIT
    $(document).on('click.stokOpname', '.editBtnStokOpname', function () {
        const id = $(this).data('id');
        $.get('/stok_opname/' + id + '/edit', function (res) {
            $('#formContainerStokOpname').html(res);
            $('#cardListStokOpname').hide();
        });
    });

    // SUBMIT EDIT
    $(document).on('submit.stokOpname', '#formEditStokOpname', function (e) {
        e.preventDefault();
        const id = $(this).find('input[name="id"]').val();
        $.ajax({
            url: '/stok_opname/' + id,
            method: 'POST',
            data: $(this).serialize(),
            success: function (res) {
                Swal.fire('Berhasil', res.message, 'success');
                refreshStokOpname();
            }
        });
    });

    // DELETE
    $(document).on('click.stokOpname', '.deleteBtnStokOpname', function () {
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
                    url: '/stok_opname/' + id,
                    method: 'DELETE',
                    data: { _token: $('meta[name="csrf-token"]').attr('content') },
                    success: function (res) {
                        Swal.fire('Berhasil', res.message, 'success');
                        refreshStokOpname();
                    }
                });
            }
        });
    });
        $(document).ready(function () {
            $('#tableStokOpname').DataTable({
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    paginate: {
                        next: "→",
                        previous: "←"
                    },
                    zeroRecords: "Tidak ada data yang cocok",
                    infoEmpty: "Menampilkan 0 dari 0 data",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                },
                columnDefs: [
                    { orderable: false, targets: [4] } // kolom aksi tidak bisa disort
                ]
            });
        });

}

function refreshStokOpname() {
    $.get('/stok_opname', function (res) {
        $('main').html(res);
        initStokOpname();
    });
}
