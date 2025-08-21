function initTujuan() {
    // Tombol Tambah
    $(document).off('click', '#btnTambahTujuan').on('click', '#btnTambahTujuan', function () {
        $.get('/tujuan/form', function (form) {
            $('main').html(form);
        });
    });

    // Simpan Tambah
    $(document).off('submit', '#formTambahTujuan').on('submit', '#formTambahTujuan', function (e) {
        e.preventDefault();
        const btn = $(this).find('button[type=submit]');
        btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: '/tujuan/store',
            method: 'POST',
            data: $(this).serialize(),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function () {
                Swal.fire('Berhasil', 'Tujuan berhasil ditambahkan!', 'success');
                $('#loadDataTujuan').trigger('click');
            },
            error: function () {
                Swal.fire('Gagal', 'Gagal menambahkan tujuan.', 'error');
            },
            complete: function () {
                btn.prop('disabled', false).text('Simpan');
            }
        });
    });

    // Tombol Edit
    $(document).off('click', '.editBtnTujuan').on('click', '.editBtnTujuan', function () {
        $.get(`/tujuan/${$(this).data('id')}/edit`, function (form) {
            $('main').html(form);
        });
    });

    // Simpan Edit
    $(document).off('submit', '#formEditTujuan').on('submit', '#formEditTujuan', function (e) {
        e.preventDefault();
        const id = $(this).find('[name="id"]').val();
        const btn = $(this).find('button[type=submit]');
        btn.prop('disabled', true).text('Memproses...');

        $.ajax({
            url: `/tujuan/${id}`,
            method: 'PUT',
            data: $(this).serialize(),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function () {
                Swal.fire('Berhasil', 'Tujuan berhasil diperbarui!', 'success');
                $('#loadDataTujuan').trigger('click');
            },
            error: function () {
                Swal.fire('Gagal', 'Gagal memperbarui tujuan.', 'error');
            },
            complete: function () {
                btn.prop('disabled', false).text('Simpan Perubahan');
            }
        });
    });

    // Tombol Hapus
    $(document).off('click', '.deleteBtnTujuan').on('click', '.deleteBtnTujuan', function () {
        const id = $(this).data('id');

        Swal.fire({
            title: 'Hapus Tujuan?',
            text: 'Data yang dihapus tidak bisa dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/tujuan/${id}`,
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function () {
                        Swal.fire('Terhapus!', 'Data tujuan berhasil dihapus.', 'success');
                        $('#loadDataTujuan').trigger('click');
                    },
                    error: function () {
                        Swal.fire('Gagal', 'Gagal menghapus data.', 'error');
                    }
                });
            }
        });
    });

    // Tombol Kembali
    $(document).off('click', '.btnKembaliTujuan').on('click', '.btnKembaliTujuan', function () {
        $('#loadDataTujuan').trigger('click');
    });

$(document).ready(function () {
    $('#tableTujuan').DataTable({
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: {
                next: "→",
                previous: "←"
            }
        },
        columnDefs: [
            { orderable: false, targets: [4] } // kolom aksi tidak bisa disort
        ]
    });
});
}
