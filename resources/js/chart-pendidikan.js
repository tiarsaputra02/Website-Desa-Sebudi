document.addEventListener("DOMContentLoaded", function () {
    const pendidikanData = window.pendidikanStat;
    if (!pendidikanData) return;

    // --- CHART ---
    const labels = pendidikanData.map(item => item.strata_pendidikan);
    const series = pendidikanData.map(item => Number(item.jumlah));

    // auto-generate colors sesuai jumlah data
    const colors = labels.map((_, i) => `hsl(${(i * 45) % 360} 70% 55%)`);

    let chart = new ApexCharts(document.querySelector("#chartPendidikan"), {
        chart: { type: "donut", height: 300 },
        labels,
        series,
        colors,
        legend: { position: "bottom" }
    });


    chart.render();

    // --- TABEL ---
    const tableBody = document.getElementById("pendidikanTable");
    let total = 0;
    let rows = '';

    pendidikanData.forEach(item => {
        rows += `
            <tr>
                <td class="border px-3 py-2">${item.strata_pendidikan}</td>
                <td class="border px-3 py-2">${item.jumlah}</td>
            </tr>
        `;
        total += Number(item.jumlah);
    });

    // tambah row total
    rows += `
        <tr class="bg-gray-50 font-semibold">
            <td class="border px-3 py-2">Total</td>
            <td class="border px-3 py-2">${total}</td>
        </tr>
    `;

    tableBody.innerHTML = rows;
});

