"use strict";
const datas = [];

function getStatistics() {
    var id = $('#id').val();
    $.ajax({
        type: "get",
        url: "/statistics?id="+id,
        dataType: "json",
        success: function (res) {
            $.each(res, function(index, item){
                datas.push({
                    x: item.date,
                    y: item.amount,
                    goals: [
                        {
                            name: "Expected",
                            value: item.amount,
                            strokeHeight: 5,
                            strokeColor: "#775DD0",
                        },
                    ],
                })
            })
        },
    });
}


var options = {
    series: [
        {
            name: "Actual",
            data: datas,
        },
    ],
    chart: {
        height: 350,
        type: "bar",
    },
    plotOptions: {
        bar: {
            columnWidth: "60%",
        },
    },
    colors: ["#5927e3"],
    dataLabels: {
        enabled: false,
    },
    legend: {
        show: true,
        showForSingleSeries: true,
        customLegendItems: ["Actual", "Expected"],
        markers: {
            fillColors: ["#5927e3", "#775DD0"],
        },
    },
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();
