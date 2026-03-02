document.addEventListener("DOMContentLoaded", function () {
    const agamaData = window.agamaStat;
    if (!agamaData) return;

    // --- CHART ---
    const labels = agamaData.map(item => item.agama);
    const series = agamaData.map(item => Number(item.jumlah));

    // auto-generate colors sesuai jumlah data
    const colors = labels.map((_, i) => `hsl(${(i * 45) % 360} 70% 55%)`);

    let chart = new ApexCharts(document.querySelector("#chartAgama"), {
        chart: { type: "donut", height: 300 },
        labels,
        series,
        colors,
        legend: { position: "bottom" }
    });


    chart.render();

    // --- TABEL ---
    const tableBody = document.getElementById("agamaTable");
    let total = 0;
    let rows = '';

    agamaData.forEach(item => {
        rows += `
            <tr>
                <td class="border px-3 py-2">${item.agama}</td>
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

