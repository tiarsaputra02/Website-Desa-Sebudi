const data = window.statistik;

let chart = new ApexCharts(document.querySelector("#chart"), {
    chart: { type: "donut", height: 300 },
    labels: ["Laki-laki", "Perempuan"],
    colors: ["#3C4A76", "#F472B6"],
    series: [data.pria, data.wanita],
    legend: { position: "bottom" }
});

chart.render();

// tabel
document.getElementById("dataTable").innerHTML = `
<tr><td class="border px-3 py-2">Laki-laki</td><td class="border px-3 py-2">${data.pria}</td></tr>
<tr><td class="border px-3 py-2">Perempuan</td><td class="border px-3 py-2">${data.wanita}</td></tr>
<tr class="bg-gray-50 font-semibold">
  <td class="border px-3 py-2">Total</td>
  <td class="border px-3 py-2">${data.total}</td>
</tr>`;


