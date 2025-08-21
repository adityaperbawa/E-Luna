function initBarang() {
    // Tombol tambah
    $('#btnTambahBarang').off().on('click', function () {
        $.get('/barang/create', function (res) {
            $('main').html(res);
            initBarang(); // Penting untuk bind ulang di form
        });
    });

    // Tombol batal di form
    $(document).off('click', '#btnBatalBarang').on('click', '#btnBatalBarang', function () {
        loadBarang();
    });

    // Submit form tambah
    $(document).off('submit', '#formTambahBarang').on('submit', '#formTambahBarang', function (e) {
        e.preventDefault();
        const data = $(this).serialize();
        $.post('/barang', data, function (res) {
            Swal.fire('Berhasil', res.message, 'success');
            loadBarang();
        }).fail(err => {
            Swal.fire('Gagal', 'Gagal menyimpan data', 'error');
        });
    });

    // Submit form edit
    $(document).off('submit', '#formEditBarang').on('submit', '#formEditBarang', function (e) {
        e.preventDefault();
        const id = $(this).data('id');
        const data = $(this).serialize();
        $.post('/barang/' + id, data, function (res) {
            Swal.fire('Berhasil', res.message, 'success');
            loadBarang();
        }).fail(err => {
            Swal.fire('Gagal', 'Gagal memperbarui data', 'error');
        });
    });

    // Edit data
    $(document).off('click', '.editBtnBarang').on('click', '.editBtnBarang', function () {
        const id = $(this).data('id');
        $.get('/barang/' + id + '/edit', function (res) {
            $('main').html(res);
            initBarang();
        });
    });

    // Hapus data
    $(document).off('click', '.deleteBtnBarang').on('click', '.deleteBtnBarang', function () {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Hapus?',
            text: 'Yakin ingin menghapus barang ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/barang/' + id,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res) {
                        Swal.fire('Berhasil', res.message, 'success');
                        loadBarang();
                    },
                    error: function () {
                        Swal.fire('Gagal', 'Tidak dapat menghapus data', 'error');
                    }
                });
            }
        });
    });

    // Preview kode barang (tambah/edit)
    function updatePreviewKode() {
        const sumberKode = $('#sumber_id option:selected').data('kode') || '';
        const kategoriKode = $('#kategori_id option:selected').data('kode') || '';
        const kode3 = $('input[name="kode_3"]').val();
        const kode4 = $('input[name="kode_4"]').val();
        const kode5 = $('input[name="kode_5"]').val();

        const finalKode = [sumberKode, kategoriKode, kode3, kode4, kode5]
            .filter(k => k !== '')
            .join('.');

        $('#previewKodeBarang').val(finalKode);
        $('#kode_barang_final').val(finalKode);
    }

    // Bind event untuk preview kode (baik form tambah & edit)
    $(document).off('change', '#sumber_id, #kategori_id').on('change', '#sumber_id, #kategori_id', updatePreviewKode);
    $(document).off('input', '.kode-level').on('input', '.kode-level', updatePreviewKode);

    // Jalankan saat pertama kali form dimuat
    if ($('#formTambahBarang').length || $('#formEditBarang').length) {
        updatePreviewKode();
    }
    $(document).ready(function () {
    $('#tabelBarang').DataTable({
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ entri",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            paginate: {
                first: "Awal",
                last: "Akhir",
                next: "→",
                previous: "←"
            },
            zeroRecords: "Tidak ada data yang ditemukan",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
            infoFiltered: "(disaring dari _MAX_ total entri)"
        },
        columnDefs: [
            { orderable: false, targets: -1 } // kolom aksi tidak bisa di-sort
        ]
    });
});

}

function loadBarang() {
    $.get('/barang', function (res) {
        $('main').html(res);
        initBarang();
    });
}
