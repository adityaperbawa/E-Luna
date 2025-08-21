function initDashboard() {
    document.addEventListener("DOMContentLoaded", function () {
        const chartData = document.getElementById("chartData").dataset;

        // Chart Penerimaan
        new Chart(document.getElementById("chartPenerimaan"), {
            type: "pie",
            data: {
                labels: ["Usulan Logpal", "Logistik", "Peralatan"],
                datasets: [{
                    data: [
                        parseInt(chartData.usulan),
                        parseInt(chartData.logistik),
                        parseInt(chartData.peralatan)
                    ],
                    backgroundColor: ["#0d6efd", "#198754", "#ffc107"]
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: "bottom" } }
            }
        });

        // Chart Penyimpanan
        new Chart(document.getElementById("chartPenyimpanan"), {
            type: "bar",
            data: {
                labels: ["Total Stok", "Kadaluwarsa"],
                datasets: [{
                    data: [
                        parseInt(chartData.totalstok),
                        parseInt(chartData.expsoon)
                    ],
                    backgroundColor: ["#0dcaf0", "#dc3545"]
                }]
            },
            options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
        });

        // Chart Distribusi
        new Chart(document.getElementById("chartDistribusi"), {
            type: "bar",
            data: {
                labels: ["Surat Permohonan", "Surat Pengiriman", "Kirim Barang"],
                datasets: [{
                    data: [
                        parseInt(chartData.permohonan),
                        parseInt(chartData.pengiriman),
                        parseInt(chartData.kirim)
                    ],
                    backgroundColor: ["#0d6efd", "#198754", "#ffc107"]
                }]
            },
            options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
        });

        // Prevent dropdown links from navigating
        const dropdownLinks = document.querySelectorAll('.dropdown-item, .nav-link.dropdown-toggle');
        dropdownLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault(); // jangan pindah halaman
            });
        });
    });
}

// Panggil fungsi ini agar chart muncul
initDashboard();
