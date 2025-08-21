function initSumber() {
    // Tombol Tambah
    $(document).off('click', '#btnTambahSumber').on('click', '#btnTambahSumber', function () {
        $.get('/sumber/form', function (form) {
            $('main').html(form);
        });
    });

    // Simpan Tambah
    $(document).off('submit', '#formTambahSumber').on('submit', '#formTambahSumber', function (e) {
        e.preventDefault();
        const btn = $(this).find('button[type=submit]');
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');

        $.ajax({
            url: '/sumber/store',
            method: 'POST',
            data: $(this).serialize(),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function () {
                Swal.fire('Berhasil!', 'Sumber berhasil ditambahkan.', 'success');
                $('#loadDataSumber').trigger('click');
            },
            error: function () {
                Swal.fire('Gagal!', 'Gagal menambahkan sumber.', 'error');
            },
            complete: function () {
                btn.prop('disabled', false).text('Simpan');
            }
        });
    });

    // Tombol Edit
    $(document).off('click', '.editBtnSumber').on('click', '.editBtnSumber', function () {
        $.get(`/sumber/${$(this).data('id')}/edit`, function (form) {
            $('main').html(form);
        });
    });

    // Simpan Edit
    $(document).off('submit', '#formEditSumber').on('submit', '#formEditSumber', function (e) {
        e.preventDefault();
        const id = $(this).find('[name="id"]').val();
        const btn = $(this).find('button[type=submit]');
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Memproses...');

        $.ajax({
            url: `/sumber/${id}`,
            method: 'PUT',
            data: $(this).serialize(),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function () {
                Swal.fire('Berhasil!', 'Sumber berhasil diperbarui.', 'success');
                $('#loadDataSumber').trigger('click');
            },
            error: function () {
                Swal.fire('Gagal!', 'Gagal memperbarui sumber.', 'error');
            },
            complete: function () {
                btn.prop('disabled', false).text('Simpan Perubahan');
            }
        });
    });

    // Tombol Hapus
    $(document).off('click', '.deleteBtnSumber').on('click', '.deleteBtnSumber', function () {
        const id = $(this).data('id');

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data sumber yang dihapus tidak bisa dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/sumber/${id}`,
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function () {
                        Swal.fire('Terhapus!', 'Sumber berhasil dihapus.', 'success');
                        $('#loadDataSumber').trigger('click');
                    },
                    error: function () {
                        Swal.fire('Gagal!', 'Gagal menghapus sumber.', 'error');
                    }
                });
            }
        });
    });

    // Tombol Kembali
    $(document).off('click', '.btnKembaliSumber').on('click', '.btnKembaliSumber', function () {
        $('#loadDataSumber').trigger('click');
    });
    function initDataTableSumber() {
    $('#tabelSumber').DataTable({
        responsive: true,
        autoWidth: false,
        language: {
            search: 'Cari:',
            lengthMenu: 'Tampilkan _MENU_ data per halaman',
            zeroRecords: 'Data tidak ditemukan',
            info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
            infoEmpty: 'Tidak ada data tersedia',
            paginate: {
                first: 'Awal',
                last: 'Akhir',
                next: '→',
                previous: '←'
            }
        }
    });
}

$(document).ready(function () {
    initDataTableSumber();
});

}
