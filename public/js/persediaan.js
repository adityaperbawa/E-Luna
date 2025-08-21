function initBukuharianPersediaan() {
    $('#tabelPersediaan').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        responsive: true,
        autoWidth: false,
        columnDefs: [
            { targets: 0, orderable: false }
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
        }
    });
    document.addEventListener("DOMContentLoaded", function () {
    const chartDataElement = document.getElementById("chartData");
    if (!chartDataElement) return; // supaya aman

    const chartData = chartDataElement.dataset;

    // lanjut buat chart
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
                backgroundColor: ["#0d6efd", "#198754", "#ffc107"],
                borderColor: "#fff"
            }]
        },
        options: { plugins: { legend: { position: "bottom" } } }
    });
});

}
