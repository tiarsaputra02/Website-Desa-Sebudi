document.addEventListener("DOMContentLoaded", function () {
    const umurData = window.umurStat;
    if (!umurData) return;

    // --- DATA UNTUK CHART ---
    const labels = umurData.map(item => item.kategori);
    const series = umurData.map(item => Number(item.jumlah));

    // auto-generate warna
    const colors = labels.map((_, i) => `hsl(${(i * 45) % 360} 70% 55%)`);

    let chart = new ApexCharts(document.querySelector("#chartUmur"), {
        chart: { type: "bar", height: 360 },
        series: [
            { name: "Jumlah", data: series }
        ],
        xaxis: { categories: labels },
        colors,
        plotOptions: {
            bar: {
                horizontal: true,
                borderRadius: 6,
            }
        },
        dataLabels: { enabled: true },
        legend: { show: false }
    });

    chart.render();

    // --- TABEL ---
    const tableBody = document.getElementById("umurTable");
    let total = 0;
    let rows = '';

    umurData.forEach(item => {
        rows += `
            <tr>
                <td class="border px-3 py-2">${item.kategori}</td>
                <td class="border px-3 py-2">${item.jumlah}</td>
            </tr>
        `;
        total += Number(item.jumlah);
    });

    rows += `
        <tr class="bg-gray-50 font-semibold">
            <td class="border px-3 py-2">Total</td>
            <td class="border px-3 py-2">${total}</td>
        </tr>
    `;

    tableBody.innerHTML = rows;
});

