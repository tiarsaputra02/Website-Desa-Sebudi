document.addEventListener("DOMContentLoaded", function () {
    const perkawinanData = window.perkawinanStat;
    if (!perkawinanData) return;

    // --- CHART ---
    const labels = perkawinanData.map(item => item.status_pernikahan);
    const series = perkawinanData.map(item => Number(item.jumlah));

    // auto-generate colors sesuai jumlah data
    const colors = labels.map((_, i) => `hsl(${(i * 45) % 360} 70% 55%)`);

    let chart = new ApexCharts(document.querySelector("#chartPerkawinan"), {
        chart: { type: "donut", height: 300 },
        labels,
        series,
        colors,
        legend: { position: "bottom" }
    });


    chart.render();

    // --- TABEL ---
    const tableBody = document.getElementById("perkawinanTable");
    let total = 0;
    let rows = '';

    perkawinanData.forEach(item => {
        rows += `
            <tr>
                <td class="border px-3 py-2">${item.status_pernikahan}</td>
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

