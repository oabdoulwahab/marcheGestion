document.addEventListener('DOMContentLoaded', function () {
    // Ligne
    var lineChartOptions = {
        chart: {
            height: 300,
            type: 'line',
            zoom: { enabled: false },
        },
        dataLabels: { enabled: false },
        stroke: { curve: 'straight' },
        colors: ["#1abc9c"],
        series: [{
            name: "Desktops",
            data: [10, 41, 35, 51, 49, 62, 69, 91, 148],
        }],
        title: {
            text: 'Product Trends by Month',
            align: 'left',
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
        }
    };
    new ApexCharts(document.querySelector("#line-chart-1"), lineChartOptions).render();

    // Aire
    var areaChartOptions = {
        chart: {
            height: 350,
            type: 'area',
        },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth' },
        colors: ["#f1c40f", "#e74c3c"],
        series: [{
            name: 'series1',
            data: [31, 40, 28, 51, 42, 109, 100],
        }, {
            name: 'series2',
            data: [11, 32, 45, 32, 34, 52, 41],
        }],
        xaxis: {
            type: 'datetime',
            categories: ["2018-09-19T00:00:00", "2018-09-19T01:30:00", "2018-09-19T02:30:00", "2018-09-19T03:30:00", "2018-09-19T04:30:00", "2018-09-19T05:30:00", "2018-09-19T06:30:00"],
        },
        tooltip: {
            x: { format: 'dd/MM/yy HH:mm' },
        }
    };
    new ApexCharts(document.querySelector("#area-chart-1"), areaChartOptions).render();

    // Barres
    var barChartOptions = {
        chart: {
            height: 350,
            type: 'bar',
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded',
            },
        },
        colors: ["#0e9e4a", "#1abc9c", "#e74c3c"],
        series: [{
            name: 'Net Profit',
            data: [44, 55, 57, 56, 61, 58, 63],
        }, {
            name: 'Revenue',
            data: [76, 85, 101, 98, 87, 105, 91],
        }, {
            name: 'Free Cash Flow',
            data: [35, 41, 36, 26, 45, 48, 52],
        }],
        xaxis: { categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'] },
        yaxis: { title: { text: '$ (thousands)' } },
        fill: { opacity: 1 },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "$ " + val + " thousands";
                },
            },
        },
    };
    new ApexCharts(document.querySelector("#bar-chart-1"), barChartOptions).render();

    // Camemberts
    var pieChartOptions = {
        chart: { height: 320, type: 'pie' },
        labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
        series: [44, 55, 13, 43, 22],
        colors: ["#1abc9c", "#0e9e4a", "#00acc1", "#f1c40f", "#e74c3c"],
        legend: { show: true, position: 'bottom' },
    };
    new ApexCharts(document.querySelector("#pie-chart-1"), pieChartOptions).render();
});
