function initLokasiBarang() {
    // Tombol tambah
    $('#btnTambahLokasiBarang').off().on('click', function () {
        $.get('/lokasi/create', function (res) {
            $('main').html(res);
        });
    });

    // Tombol batal tambah/edit
    $(document).off('click', '#btnBatalTambahLokasi, #btnBatalEditLokasi').on('click', '#btnBatalTambahLokasi, #btnBatalEditLokasi', function () {
        loadLokasiBarang();
    });

    // Simpan tambah lokasi
    $(document).off('submit', '#formTambahLokasiBarang').on('submit', '#formTambahLokasiBarang', function (e) {
    e.preventDefault();
    

    // Hapus input barang yang tidak dicentang
    $('#listBarang input[type="checkbox"]:not(:checked)').each(function () {
        const row = $(this).closest('tr');
        row.find('input').remove(); // buang semua input dalam row yang tidak dipilih
    });

    const formData = $(this).serialize();

    $.post('/lokasi', formData, function (res) {
        Swal.fire('Berhasil', res.message, 'success');
        loadLokasiBarang();
    }).fail(function (xhr) {
        let errors = xhr.responseJSON?.errors;
        let msg = 'Validasi gagal.';
        if (errors) {
            msg = Object.values(errors).flat().join('<br>');
        }
        Swal.fire('Gagal', msg, 'error');
    });
});


    // Simpan edit lokasi
    $(document).off('submit', '#formEditLokasiBarang').on('submit', '#formEditLokasiBarang', function (e) {
        e.preventDefault();
        const formData = $(this).serialize();
        const id = $(this).find('input[name="id"]').val();
        $.post(`/lokasi/${id}`, formData, function (res) {
            Swal.fire('Berhasil', res.message, 'success');
            loadLokasiBarang();
        }).fail(function (xhr) {
    let errors = xhr.responseJSON?.errors;
    let msg = 'Validasi gagal.';
    if (errors) {
        msg = Object.values(errors).flat().join('<br>');
    }
    Swal.fire('Gagal', msg, 'error');
});

    });

    // Tombol edit
    $(document).off('click', '.btnEditLokasi').on('click', '.btnEditLokasi', function () {
        const id = $(this).data('id');
        $.get(`/lokasi/${id}/edit`, function (res) {
            $('main').html(res);
        });
    });

    // Tombol hapus
    $(document).off('click', '.btnHapusLokasi').on('click', '.btnHapusLokasi', function () {
        const id = $(this).data('id');
        const token = $('meta[name="csrf-token"]').attr('content');
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/lokasi/${id}`,
                    type: 'DELETE',
                    data: { _token: token },
                    success: function (res) {
                        Swal.fire('Dihapus!', res.message, 'success');
                        loadLokasiBarang();
                    }
                });
            }
        });
    });

     // Checklist semua barang
    $('#checkAllBarang').on('change', function () {
        const isChecked = $(this).is(':checked');
        $('#listBarang input[type="checkbox"]').prop('checked', isChecked);
    });

    // Filter kategori
    $(document).on('change', '#kategoriFilter', function () {
    const selectedKategori = parseInt($(this).val());

    $('#listBarang tr').each(function () {
        const rowKategori = parseInt($(this).data('kategori'));
        
        if (isNaN(selectedKategori) || selectedKategori === rowKategori) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
});



    $(document).ready(function () {
        $('#tabelLokasi').DataTable({
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
                { orderable: false, targets: [7] } // kolom aksi tidak bisa disort
            ]
        });
    });


}

function loadLokasiBarang() {
    $.get('/lokasi', function (res) {
        $('main').html(res);
        initLokasiBarang();
    });
}
