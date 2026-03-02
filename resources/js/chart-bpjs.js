document.addEventListener("DOMContentLoaded", function () {
    const jenisbpjsData = window.jenisbpjsStat;
    const kategoribpjsData = window.kategoribpjsStat;
    if (!jenisbpjsData) return;
    if (!kategoribpjsData) return;

    // --- CHART ---
    const labels = jenisbpjsData.map(item => item.jenis_bpjs);
    const series = jenisbpjsData.map(item => Number(item.jumlah));

    // auto-generate colors sesuai jumlah data
    const colors = labels.map((_, i) => `hsl(${(i * 45) % 360} 70% 55%)`);

    let chart = new ApexCharts(document.querySelector("#chartBPJS"), {
        chart: { type: "donut", height: 300 },
        labels,
        series,
        colors,
        legend: { position: "bottom" }
    });

    chart.render();

    // --- TABEL ---
    const tableBody = document.getElementById("jenisbpjsTable");
    let total = 0;
    let rows = '';

    jenisbpjsData.forEach(item => {
        rows += `
            <tr>
                <td class="border px-3 py-2">${item.jenis_bpjs}</td>
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
    //
    // --- TABEL ---
    const tableKategoriBody = document.getElementById("kategoriTable");
    let totalKategori = 0;
    let rowsKategori = '';

    kategoribpjsData.forEach(item => {
        rowsKategori += `
            <tr>
                <td class="border px-3 py-2">${item.kategori}</td>
                <td class="border px-3 py-2">${item.jumlah}</td>
            </tr>
        `;
        totalKategori += Number(item.jumlah);
    });

    // tambah row total
    rowsKategori += `
        <tr class="bg-gray-50 font-semibold">
            <td class="border px-3 py-2">Total</td>
            <td class="border px-3 py-2">${totalKategori}</td>
        </tr>
    `;

    tableKategoriBody.innerHTML = rowsKategori;
});

