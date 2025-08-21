function initKategori() {
    // Tambah
    $(document).off('click', '#btnTambahKategori').on('click', '#btnTambahKategori', function () {
        $.get('/kategori/form', function (form) {
            $('main').html(form);
        });
    });

    // Simpan tambah
    $(document).off('submit', '#formTambahKategori').on('submit', '#formTambahKategori', function (e) {
        e.preventDefault();
        const btn = $(this).find('button[type=submit]');
        btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: '/kategori/store',
            method: 'POST',
            data: $(this).serialize(),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: () => {
                Swal.fire('Berhasil', 'Kategori ditambahkan', 'success');
                $('#loadDataKategori').trigger('click');
            },
            error: () => {
                Swal.fire('Gagal', 'Kategori gagal ditambahkan', 'error');
            },
            complete: () => btn.prop('disabled', false).text('Simpan')
        });
    });

    // Edit
    $(document).off('click', '.editBtnKategori').on('click', '.editBtnKategori', function () {
        const id = $(this).data('id');
        $.get(`/kategori/${id}/edit`, function (form) {
            $('main').html(form);
        });
    });

    // Simpan edit
    $(document).off('submit', '#formEditKategori').on('submit', '#formEditKategori', function (e) {
        e.preventDefault();
        const id = $(this).find('[name=\"id\"]').val();
        const btn = $(this).find('button[type=submit]');
        btn.prop('disabled', true).text('Memproses...');

        $.ajax({
            url: `/kategori/${id}`,
            method: 'PUT',
            data: $(this).serialize(),
            headers: { 'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content') },
            success: () => {
                Swal.fire('Berhasil', 'Kategori diperbarui', 'success');
                $('#loadDataKategori').trigger('click');
            },
            error: () => {
                Swal.fire('Gagal', 'Kategori gagal diperbarui', 'error');
            },
            complete: () => btn.prop('disabled', false).text('Simpan Perubahan')
        });
    });

    // Hapus
    $(document).off('click', '.deleteBtnKategori').on('click', '.deleteBtnKategori', function () {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Hapus Kategori?',
            text: 'Data yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Ya, Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/kategori/${id}`,
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content') },
                    success: () => {
                        Swal.fire('Dihapus!', 'Kategori berhasil dihapus.', 'success');
                        $('#loadDataKategori').trigger('click');
                    },
                    error: () => {
                        Swal.fire('Gagal', 'Gagal menghapus kategori.', 'error');
                    }
                });
            }
        });
    });

    // Kembali
    $(document).off('click', '.btnKembaliKategori').on('click', '.btnKembaliKategori', function () {
        $('#loadDataKategori').trigger('click');
    });
   
$(document).ready(function() {
    $('#tabelKategori').DataTable({
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            zeroRecords: "Data tidak ditemukan",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data tersedia",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "→",
                previous: "←"
            }
        }
    });
});

}
