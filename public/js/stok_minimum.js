function initStokMinimum() {
    // Inisialisasi DataTable
    $('#tabelStokMinimum').DataTable({
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
            { orderable: false, targets: -1 } // kolom aksi tidak bisa diurutkan
        ]
    });

    // Hindari binding ganda
    $(document).off('click', '.simpanStokMinimum');

    $(document).on('click', '.simpanStokMinimum', function () {
        const id = $(this).data('id');
        const stok_minimum = $(this).closest('tr').find('.stok-minimum-input').val();

        Swal.fire({
            title: 'Simpan Stok Minimum?',
            text: "Apakah Anda yakin ingin menyimpan perubahan ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/stok-minimum/update',
                    type: 'POST',
                    data: {
                        id: id,
                        stok_minimum: stok_minimum,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: res.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: xhr.responseJSON.message || 'Terjadi kesalahan'
                        });
                    }
                });
            }
        });
    });
}
