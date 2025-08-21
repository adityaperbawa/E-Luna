function initRencanaAlokasi() {
    // Tombol tambah
    $(document).off('click', '#btnTambahRencana').on('click', '#btnTambahRencana', function (e) {
        e.preventDefault(); // hindari reload
        $.get('/rencana/create', function (res) {
            $('main').html(res);
            initRencanaAlokasi(); // panggil ulang untuk re-bind event di form tambah
        }).fail(function () {
            Swal.fire('Gagal', 'Tidak bisa membuka form tambah.', 'error');
        });
    });

    // Tombol batal
    $(document).off('click', '#btnBatalRencana').on('click', '#btnBatalRencana', function () {
        $.get('/rencana', function (res) {
            $('main').html(res);
            initRencanaAlokasi(); // re-bind setelah kembali ke list
        });
    });

    // Simpan data
    $(document).off('submit', '#formRencanaAlokasi').on('submit', '#formRencanaAlokasi', function (e) {
        e.preventDefault();
        let form = $(this)[0];
        let formData = new FormData(form);

        $.ajax({
            url: '/rencana',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                Swal.fire('Berhasil', res.message, 'success');
                $.get('/rencana', function (res) {
                    $('main').html(res);
                    initRencanaAlokasi(); // re-bind setelah simpan sukses
                });
            },
            error: function (xhr) {
                let msg = 'Gagal menyimpan data.';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    msg = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                }
                Swal.fire('Gagal', msg, 'error');
            }
        });
    });
    // Tombol edit
$(document).off('click', '.btnEditRencana').on('click', '.btnEditRencana', function () {
    const id = $(this).data('id');
    $.get(`/rencana/${id}/edit`, function (res) {
        $('main').html(res);
        initRencanaAlokasi();
    });
});

// Simpan edit
$(document).off('submit', '#formEditRencanaAlokasi').on('submit', '#formEditRencanaAlokasi', function (e) {
    e.preventDefault();
    const id = $(this).find('input[name="id"]').val();
    const formData = new FormData(this);

    $.ajax({
        url: `/rencana/${id}`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            Swal.fire('Berhasil', res.message, 'success');
            $.get('/rencana', function (res) {
                $('main').html(res);
                initRencanaAlokasi();
            });
        },
        error: function () {
            Swal.fire('Gagal', 'Gagal menyimpan perubahan.', 'error');
        }
    });
});

// Setujui / Tolak
$(document).off('click', '.btnSetujuRencana, .btnTolakRencana').on('click', '.btnSetujuRencana, .btnTolakRencana', function () {
    const id = $(this).data('id');
    const status = $(this).hasClass('btnSetujuRencana') ? 'disetujui' : 'ditolak';

    $.post(`/rencana/${id}/status`, {
        _token: $('meta[name="csrf-token"]').attr('content'),
        status: status
    }, function (res) {
        Swal.fire('Sukses', res.message, 'success');
        $.get('/rencana', function (res) {
            $('main').html(res);
            initRencanaAlokasi();
        });
    });
});


    // Tombol hapus
    $(document).off('click', '.btnHapusRencana').on('click', '.btnHapusRencana', function () {
        const id = $(this).data('id');
        const token = $('meta[name="csrf-token"]').attr('content');

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            confirmButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/rencana/${id}`,
                    type: 'DELETE',
                    data: { _token: token },
                    success: function (res) {
                        Swal.fire('Dihapus!', res.message, 'success');
                        $.get('/rencana', function (res) {
                            $('main').html(res);
                            initRencanaAlokasi(); // re-bind setelah hapus
                        });
                    }
                });
            }
        });
    });

    // Setujui / Tolak dengan konfirmasi
$(document).off('click', '.btnSetujuRencana, .btnTolakRencana').on('click', '.btnSetujuRencana, .btnTolakRencana', function () {
    const id = $(this).data('id');
    const isSetuju = $(this).hasClass('btnSetujuRencana');
    const status = isSetuju ? 'disetujui' : 'ditolak';
    const icon = isSetuju ? 'success' : 'warning';
    const title = isSetuju ? 'Setujui Rencana?' : 'Tolak Rencana?';

    Swal.fire({
        title: title,
        icon: icon,
        showCancelButton: true,
        confirmButtonText: 'Ya, lanjutkan!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post(`/rencana/${id}/status`, {
                _token: $('meta[name="csrf-token"]').attr('content'),
                status: status
            }, function (res) {
                Swal.fire('Berhasil', res.message, 'success');
                $.get('/rencana', function (res) {
                    $('main').html(res);
                    initRencanaAlokasi();
                });
            }).fail(() => {
                Swal.fire('Gagal', 'Gagal memproses status.', 'error');
            });
        }
    });
});

$(document).ready(function () {
    $('#tabelRencana').DataTable({
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data yang tersedia",
            zeroRecords: "Tidak ditemukan data yang sesuai",
            paginate: {
                next: "→",
                previous: "←"
            }
        },
        columnDefs: [
            { orderable: false, targets: [4] } // Misalnya kolom ke-5 (aksi) tidak disort
        ],
        ordering: true,  // Aktifkan sorting default
        responsive: true // Opsional: agar tabel responsif di mobile
    });
});


}
