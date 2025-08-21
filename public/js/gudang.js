function initGudang() {
    // Tambah Gudang
    $(document).off('click', '#btnTambahGudang').on('click', '#btnTambahGudang', function () {
        $.get('/gudang/form', function (form) {
            $('main').html(form);
        });
    });

    // Simpan Tambah
    $(document).off('submit', '#formTambahGudang').on('submit', '#formTambahGudang', function (e) {
        e.preventDefault();
        const btn = $(this).find('button[type=submit]');
        btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: '/gudang/store',
            method: 'POST',
            data: $(this).serialize(),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function () {
                Swal.fire('Berhasil', 'Gudang berhasil ditambahkan!', 'success');
                $('#loadDataGudang').trigger('click');
            },
            error: function () {
                Swal.fire('Gagal', 'Terjadi kesalahan saat menambahkan.', 'error');
            },
            complete: function () {
                btn.prop('disabled', false).text('Simpan');
            }
        });
    });

    // Edit Gudang
    $(document).off('click', '.editBtnGudang').on('click', '.editBtnGudang', function () {
        const id = $(this).data('id');
        $.get(`/gudang/${id}/edit`, function (form) {
            $('main').html(form);
        });
    });

    // Simpan Edit
    $(document).off('submit', '#formEditGudang').on('submit', '#formEditGudang', function (e) {
        e.preventDefault();
        const id = $(this).find('[name="id"]').val();
        const btn = $(this).find('button[type=submit]');
        btn.prop('disabled', true).text('Memperbarui...');

        $.ajax({
            url: `/gudang/${id}`,
            method: 'PUT',
            data: $(this).serialize(),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function () {
                Swal.fire('Berhasil', 'Gudang berhasil diperbarui!', 'success');
                $('#loadDataGudang').trigger('click');
            },
            error: function () {
                Swal.fire('Gagal', 'Terjadi kesalahan saat memperbarui.', 'error');
            },
            complete: function () {
                btn.prop('disabled', false).text('Simpan Perubahan');
            }
        });
    });

    // Hapus Gudang
    $(document).off('click', '.deleteBtnGudang').on('click', '.deleteBtnGudang', function () {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data gudang tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Ya, Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/gudang/${id}`,
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function () {
                        Swal.fire('Terhapus!', 'Gudang berhasil dihapus.', 'success');
                        $('#loadDataGudang').trigger('click');
                    },
                    error: function () {
                        Swal.fire('Gagal', 'Gagal menghapus data.', 'error');
                    }
                });
            }
        });
    });

    // Kembali
    $(document).off('click', '.btnKembaliGudang').on('click', '.btnKembaliGudang', function () {
        $('#loadDataGudang').trigger('click');
    });

    $(document).ready(function () {
        $('#tableGudang').DataTable({
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
                { orderable: false, targets: [0, 4] } // Kolom QR Code dan Aksi tidak bisa disort
            ]
        });
    });
}
