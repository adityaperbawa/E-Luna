function initStokKadaluwarsa() {
    // Tombol Detail
    $(document).off('click', '.btnDetailKadaluwarsa').on('click', '.btnDetailKadaluwarsa', function () {
        const id = $(this).data('id');
        $.get(`/barang/stok-kadaluwarsa/${id}`, function (res) {
            $('#detailKadaluwarsaContent').html(res);
            $('#detailKadaluwarsaContainer').fadeIn();
            $('main').addClass('blurred');
        });
    });

    // Tombol Tutup Detail
    $(document).off('click', '.btnTutupDetailKadaluwarsa').on('click', '.btnTutupDetailKadaluwarsa', function () {
        $('#detailKadaluwarsaContainer').fadeOut(function () {
            $('#detailKadaluwarsaContent').html('');
        });
        $('main').removeClass('blurred');
    });

    // Tombol Hapus
    $(document).off('click', '.btnHapusKadaluwarsa').on('click', '.btnHapusKadaluwarsa', function () {
        const id = $(this).data('id');
        const token = $('meta[name="csrf-token"]').attr('content');

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data ini akan terhapus Pada Data Barang.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/barang/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: token
                    },
                    success: function (res) {
                        Swal.fire('Berhasil!', res.message, 'success');
                        loadStokKadaluwarsa(); // reload list
                    },
                    error: function () {
                        Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus.', 'error');
                    }
                });
            }
        });
    });

    // Tombol Status
    $(document).off('click', '.btnStatusKadaluwarsa').on('click', '.btnStatusKadaluwarsa', function () {
        const id = $(this).data('id');
        $.get(`/barang/stok-kadaluwarsa/${id}/status`, function (res) {
            $('#detailKadaluwarsaContent').html(res);
            $('#detailKadaluwarsaContainer').fadeIn();
            $('main').addClass('blurred');
        });
    });

    // Submit Form Status Kadaluwarsa
$(document).off('submit', '#formStatusKadaluwarsa').on('submit', '#formStatusKadaluwarsa', function (e) {
    e.preventDefault();

    const id = $('.btnStatusKadaluwarsa').data('id'); // atau bisa ambil dari URL jika perlu
    const status = $('#status').val();
    const token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: `/barang/stok-kadaluwarsa/${id}/status`,
        type: 'POST',
        data: {
            _token: token,
            status: status
        },
        success: function (res) {
            Swal.fire('Berhasil', res.message, 'success');
            $('#detailKadaluwarsaContainer').fadeOut(function () {
                $('#detailKadaluwarsaContent').html('');
            });
            $('main').removeClass('blurred');
            loadStokKadaluwarsa(); // refresh list
        },
        error: function (xhr) {
            console.error(xhr);
            Swal.fire('Gagal', 'Terjadi kesalahan saat menyimpan status', 'error');
        }
    });
});


const table = $('#tableKadaluwarsa').DataTable({
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            zeroRecords: "Tidak ditemukan data yang cocok",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data tersedia",
            infoFiltered: "(difilter dari _MAX_ total data)"
        },
        ordering: true
    });

    // Custom search filter
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        const selected = $('#filterKadaluwarsa').val();
        const row = table.row(dataIndex).node();
        const status = $(row).data('status');
        return !selected || selected === status;
    });

    $('#filterKadaluwarsa').on('change', function () {
        table.draw();
    });

}

// Untuk memuat halaman utama
function loadStokKadaluwarsa() {
    $.get('/barang/stok-kadaluwarsa', function (res) {
        $('main').html(res);
        if (typeof initStokKadaluwarsa === 'function') initStokKadaluwarsa();
    });
}
