function initPengguna() {
    // Tombol Tambah
    $(document).off('click', '#btnTambahPengguna').on('click', '#btnTambahPengguna', function () {
        $.get('/pengguna/form', function (form) {
            $('main').html(form);
        });
    });

    // Simpan Tambah
    $(document).off('submit', '#formTambahPengguna').on('submit', '#formTambahPengguna', function (e) {
        e.preventDefault();
        let btn = $(this).find('button[type=submit]');
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');

        $.ajax({
            url: '/pengguna/store',
            method: 'POST',
            data: $(this).serialize(),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function () {
                Swal.fire('Berhasil!', 'Pengguna berhasil ditambahkan.', 'success');
                $('#loadDataPengguna').trigger('click');
            },
            error: function (xhr) {
                Swal.fire('Gagal!', 'Gagal menambahkan pengguna.', 'error');
            },
            complete: function () {
                btn.prop('disabled', false).text('Simpan');
            }
        });
    });

    // Edit
    $(document).off('click', '.editBtnPengguna').on('click', '.editBtnPengguna', function () {
        $.get(`/pengguna/${$(this).data('id')}/edit`, function (form) {
            $('main').html(form);
        });
    });

    // Simpan Edit
    $(document).off('submit', '#formEditPengguna').on('submit', '#formEditPengguna', function (e) {
        e.preventDefault();
        const id = $(this).find('[name="id"]').val();
        const btn = $(this).find('button[type=submit]');
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Memproses...');

        $.ajax({
            url: `/pengguna/${id}`,
            method: 'PUT',
            data: $(this).serialize(),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function () {
                Swal.fire('Berhasil!', 'Data pengguna berhasil diperbarui.', 'success');
                $('#loadDataPengguna').trigger('click');
            },
            error: function () {
                Swal.fire('Gagal!', 'Gagal memperbarui pengguna.', 'error');
            },
            complete: function () {
                btn.prop('disabled', false).text('Simpan Perubahan');
            }
        });
    });

    // Hapus
    $(document).off('click', '.deleteBtnPengguna').on('click', '.deleteBtnPengguna', function () {
        const id = $(this).data('id');

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data pengguna yang dihapus tidak bisa dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/pengguna/${id}`,
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function () {
                        Swal.fire('Terhapus!', 'Pengguna berhasil dihapus.', 'success');
                        $('#loadDataPengguna').trigger('click');
                    },
                    error: function () {
                        Swal.fire('Gagal!', 'Gagal menghapus pengguna.', 'error');
                    }
                });
            }
        });
    });

    // Tombol Kembali
    $(document).off('click', '.btnKembaliPengguna').on('click', '.btnKembaliPengguna', function () {
        $('#loadDataPengguna').trigger('click');
    });

    function initTabelPengguna() {
    if ($.fn.DataTable.isDataTable('#tabelPengguna')) {
        $('#tabelPengguna').DataTable().destroy();
    }

    $('#tabelPengguna').DataTable({
        language: {
            "search": "Cari:",
            "lengthMenu": "Tampilkan _MENU_ entri",
            "zeroRecords": "Data tidak ditemukan",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "infoEmpty": "Tidak ada data tersedia",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": '→',
                "previous": "←"
            }
        },
        responsive: true,
        autoWidth: false,
        ordering: true // aktifkan sorting
    });
}

// Panggil fungsi saat dokumen siap
$(document).ready(function () {
    initTabelPengguna();
});

}
