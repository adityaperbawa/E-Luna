function initPlogpal() {
    $(document).off('click', '#btnTambahPlogpal').on('click', '#btnTambahPlogpal', function () {
        $.get('/plogpal/create', res => $('main').html(res));
    });

    $(document).off('submit', '#formTambahPlogpal').on('submit', '#formTambahPlogpal', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const btn = $(this).find('button[type=submit]');
        btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: '/plogpal',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success() {
                Swal.fire('Berhasil', 'Data berhasil ditambahkan!', 'success');
                $('#loadDataPenerimaanLogpal').trigger('click');
            },
            error() {
                Swal.fire('Gagal', 'Terjadi kesalahan saat menyimpan.', 'error');
            },
            complete() {
                btn.prop('disabled', false).text('Simpan');
            }
        });
    });

    $(document).off('click', '.editBtnPlogpal').on('click', '.editBtnPlogpal', function () {
        const id = $(this).data('id');
        $.get(`/plogpal/${id}/edit`, res => $('main').html(res));
    });

    $(document).off('submit', '#formEditPlogpal').on('submit', '#formEditPlogpal', function (e) {
        e.preventDefault();
        const id = $(this).find('[name=id]').val();
        const formData = new FormData(this);
        const btn = $(this).find('button[type=submit]');
        btn.prop('disabled', true).text('Memperbarui...');

        $.ajax({
            url: `/plogpal/${id}`,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success() {
                Swal.fire('Berhasil', 'Data berhasil diperbarui!', 'success');
                $('#loadDataPenerimaanLogpal').trigger('click');
            },
            error() {
                Swal.fire('Gagal', 'Terjadi kesalahan saat memperbarui.', 'error');
            },
            complete() {
                btn.prop('disabled', false).text('Simpan');
            }
        });
    });

    $(document).off('click', '.deleteBtnPlogpal').on('click', '.deleteBtnPlogpal', function () {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then(result => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/plogpal/${id}`,
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content') },
                    success() {
                        Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success');
                        $('#loadDataPenerimaanLogpal').trigger('click');
                    },
                    error() {
                        Swal.fire('Gagal', 'Gagal menghapus data.', 'error');
                    }
                });
            }
        });
    });

    $(document).off('click', '.btnKembaliPlogpal').on('click', '.btnKembaliPlogpal', function () {
        $('#loadDataPenerimaanLogpal').trigger('click');
    });

    $(document).off('click', '.btnDokumenPlogpal').on('click', '.btnDokumenPlogpal', function () {
    const dokumen = $(this).data('dokumen');
    if (dokumen) {
        window.open('/uploads/plogpal/' + dokumen, '_blank');
    } else {
        Swal.fire('Info', 'Dokumen belum di-upload.', 'info');
    }
});

$(document).off('click', '.btnRincianPlogpal').on('click', '.btnRincianPlogpal', function () {
    const id = $(this).data('id');
    $.get(`/plogpal/${id}/rincian`, function (res) {
        $('#rincianPlogpalContent').html(res);
        $('#rincianPlogpalContainer').fadeIn();
        $('main').addClass('blurred');
    });
});

$(document).off('click', '.btnTutupRincianPlogpal').on('click', '.btnTutupRincianPlogpal', function () {
    $('#rincianPlogpalContainer').fadeOut(function () {
        $('#rincianPlogpalContent').html('');
    });
    $('main').removeClass('blurred');
});
$(document).ready(function () {
    $('#tablePlogpal').DataTable({
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: {
                next: "→",
                previous: "←"
            },
            zeroRecords: "Tidak ada data yang cocok",
            infoEmpty: "Tidak ada data tersedia",
        },
        columnDefs: [
            { orderable: false, targets: [6] } // Kolom ke-7 (aksi) tidak bisa disortir
        ],
        order: [[2, 'desc']] // Urutan default: kolom tanggal surat descending
    });
});


}
