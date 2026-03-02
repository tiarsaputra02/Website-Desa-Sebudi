document.addEventListener("DOMContentLoaded", function () {
    const bantuanData = window.bantuanStat;
    if (!bantuanData) return;

    // --- CHART ---
    const labels = bantuanData.map(item => item.jenis_bantuan);
    const series = bantuanData.map(item => Number(item.jumlah));

    // auto-generate colors sesuai jumlah data
    const colors = labels.map((_, i) => `hsl(${(i * 45) % 360} 70% 55%)`);

    let chart = new ApexCharts(document.querySelector("#chartBantuan"), {
        chart: { type: "donut", height: 300 },
        labels,
        series,
        colors,
        legend: { position: "bottom" }
    });

    chart.render();

    // --- TABEL ---
    const tableBody = document.getElementById("bantuanTable");
    let total = 0;
    let rows = '';

    bantuanData.forEach(item => {
        rows += `
            <tr>
                <td class="border px-3 py-2">${item.jenis_bantuan}</td>
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

