document.addEventListener("DOMContentLoaded", function () {
    const pekerjaanData = window.pekerjaanStat;
    if (!pekerjaanData) return;

    // --- CHART ---
    const labels = pekerjaanData.map(item => item.pekerjaan);
    const series = pekerjaanData.map(item => Number(item.jumlah));

    // auto-generate colors sesuai jumlah data
    const colors = labels.map((_, i) => `hsl(${(i * 45) % 360} 70% 55%)`);

    let chart = new ApexCharts(document.querySelector("#chartPekerjaan"), {
        chart: { type: "donut", height: 300 },
        labels,
        series,
        colors,
        legend: { position: "bottom" }
    });

    chart.render();

    // --- TABEL ---
    const tableBody = document.getElementById("pekerjaanTable");
    let total = 0;
    let rows = '';

    pekerjaanData.forEach(item => {
        rows += `
            <tr>
                <td class="border px-3 py-2">${item.pekerjaan}</td>
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

