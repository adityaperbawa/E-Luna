// public/js/usulan_logpal.js

function initUsulanLogpal() {
    // Tombol Tambah
    $(document).off('click', '#btnTambahUsulan').on('click', '#btnTambahUsulan', function () {
        $.get('/usulan/form', function (form) {
            $('main').html(form);
        });
    });

    // Simpan Tambah
   $(document).off('submit', '#formTambahUsulan').on('submit', '#formTambahUsulan', function (e) {
    e.preventDefault();

    const form = this;
    const formData = new FormData(form); // Wajib pakai FormData agar file dan input ikut semua
    const btn = $(form).find('button[type=submit]');
    btn.prop('disabled', true).text('Menyimpan...');

    $.ajax({
        url: '/usulan',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function () {
            Swal.fire('Berhasil', 'Data usulan berhasil ditambahkan!', 'success');
            $('#loadDataUsulanLogpal').trigger('click');
        },
        error: function (xhr) {
            console.log(xhr.responseText); // Cek error detail di console
            Swal.fire('Gagal', 'Terjadi kesalahan saat menyimpan data.', 'error');
        },
        complete: function () {
            btn.prop('disabled', false).text('Simpan');
        }
    });
});
    // Tombol Edit
    $(document).off('click', '.editBtnUsulan').on('click', '.editBtnUsulan', function () {
        const id = $(this).data('id');
        $.get('/usulan/form/edit/' + id, function (form) {
            $('main').html(form);
        });
    });

    // Simpan Edit
    $(document).off('submit', '#formEditUsulan').on('submit', '#formEditUsulan', function (e) {
        e.preventDefault();
        const id = $(this).find('[name="id"]').val();
        const formData = new FormData(this);
        const btn = $(this).find('button[type=submit]');
        btn.prop('disabled', true).text('Memperbarui...');

        $.ajax({
            url: `/usulan/${id}`,
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function () {
                Swal.fire('Berhasil', 'Usulan berhasil diperbarui!', 'success');
                $('#loadDataUsulanLogpal').trigger('click');
            },
            error: function () {
                Swal.fire('Gagal', 'Terjadi kesalahan saat memperbarui.', 'error');
            },
            complete: function () {
                btn.prop('disabled', false).text('Simpan Perubahan');
            }
        });
    });

    // Hapus Usulan
    $(document).off('click', '.deleteBtnUsulan').on('click', '.deleteBtnUsulan', function () {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data usulan tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Ya, Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/usulan/${id}`,
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function () {
                        Swal.fire('Terhapus!', 'Usulan berhasil dihapus.', 'success');
                        $('#loadDataUsulanLogpal').trigger('click');
                    },
                    error: function () {
                        Swal.fire('Gagal', 'Gagal menghapus data.', 'error');
                    }
                });
            }
        });
    });

    // Tombol Kembali
    $(document).off('click', '.btnKembaliUsulan').on('click', '.btnKembaliUsulan', function () {
        $('#loadDataUsulanLogpal').trigger('click');
    });

     $('#tableUsulan').DataTable({
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
            { orderable: false, targets: [5] } // kolom aksi tidak bisa di-sort
        ]
    });
}

