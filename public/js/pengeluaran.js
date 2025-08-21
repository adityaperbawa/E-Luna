function initBukuharianPengeluaran() {
    $(document).ready(function () {

    // --- Inisialisasi DataTables ---
    $('#tabelPengeluaran').DataTable({
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        ordering: true,
        responsive: true,
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data tersedia",
            zeroRecords: "Data tidak ditemukan",
            paginate: {
                first: "Awal",
                last: "Akhir",
                next: "›",
                previous: "‹"
            }
        }
    });

    $('#tabelBarangTanpaSurat').DataTable({
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        ordering: true,
        responsive: true,
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data tersedia",
            zeroRecords: "Data tidak ditemukan",
            paginate: {
                first: "Awal",
                last: "Akhir",
                next: "›",
                previous: "‹"
            }
        }
    });

    // Tombol detail
    $(document).on("click", ".show-detail", function () {
        let id = $(this).data("id");

        $.get("/pengeluaran/detail/" + id, function (data) {
            let html = "";
            if (data.length > 0) {
                data.forEach(function (item) {
                    html += `
                        <tr class="text-center">
                            <td>${item.nama_barang}</td>
                            <td>${item.kode_barang}</td>
                            <td>${item.jumlah}</td>
                            <td>${item.satuan}</td>
                        </tr>
                    `;
                });
            } else {
                html = `<tr><td colspan="4" class="text-center">Tidak ada data barang</td></tr>`;
            }

            $("#detailBarang").html(html);
            $("#detailBarangContainer").fadeIn();
        });
    });

    // Tutup Overlay
    $(document).on('click', '.btnTutupDetail', function () {
        $('#detailBarangContainer').fadeOut();
    });

    // Tutup overlay kalau klik luar konten
    $('#detailBarangContainer').on('click', function (e) {
        if (e.target.id === 'detailBarangContainer') {
            $(this).fadeOut();
        }
    });

});


}
