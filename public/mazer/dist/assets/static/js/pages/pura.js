document.addEventListener("DOMContentLoaded", function () {

    let optionsVisitorsProfile = {
        series: window.chartDataJenisKelamin.series,
        labels: window.chartDataJenisKelamin.labels,
        chart: {
            type: 'donut',
            height: 350,
        },
    };

    let dataAgama = {
        series: window.chartDataAgama.series,
        labels: window.chartDataAgama.labels,
        chart: {
            type: 'donut',
            height: 350,
        },
    };


    let dataPekerjaan = {
        series: window.chartDataPekerjaan.series,
        labels: window.chartDataPekerjaan.labels,
        chart: {
            type: 'donut',
            height: 350,
        },
    };

    let dataPendidikan = {
        series: window.chartDataPendidikan.series,
        labels: window.chartDataPendidikan.labels,
        chart: {
            type: 'donut',
            height: 350,
        },
    };

    let dataPernikahan = {
        series: window.chartDataPernikahan.series,
        labels: window.chartDataPernikahan.labels,
        chart: {
            type: 'donut',
            height: 350,
        },
    };

    let dataBantuan = {
        series: window.chartDataBantuan.series,
        labels: window.chartDataBantuan.labels,
        chart: {
            type: 'donut',
            height: 350,
        },
    };

    let dataJenis = {
        series: window.chartDataJenis.series,
        labels: window.chartDataJenis.labels,
        chart: {
            type: 'donut',
            height: 350,
        },
    };

    new ApexCharts(
        document.querySelector("#jenis-kelamin"),
        optionsVisitorsProfile
    ).render();
    
    new ApexCharts(
        document.querySelector("#agama"),
        dataAgama
    ).render();

    new ApexCharts(
        document.querySelector("#pekerjaan"),
        dataPekerjaan
    ).render();

    new ApexCharts(
        document.querySelector("#pendidikan"),
        dataPendidikan
    ).render();

    new ApexCharts(
        document.querySelector("#pernikahan"),
        dataPernikahan
    ).render();

    new ApexCharts(
        document.querySelector("#bantuan"),
        dataBantuan
    ).render();

    new ApexCharts(
        document.querySelector("#bpjs"),
        dataJenis
    ).render();

});
