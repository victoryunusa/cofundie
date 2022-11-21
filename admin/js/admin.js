"use strict";
function getTotalCustomers() {
    let url = $("#get-customers-url").val();
    $.ajax({
        type: "GET",
        url: url,
        success: function (res) {
            $(".total-customers").text(res.total);
            $(".active-customers").text(res.active);
            $(".paused-customers").text(res.pause);
            $(".suspend-customers").text(res.suspand);
            $("#loading").addClass("d-none");
        },
    });
}

function getTotalDeposits() {
    let url = $("#get-deposits-url").val();
    $.ajax({
        type: "GET",
        url: url,
        success: function (res) {
            $(".total-deposits").text(res.total);
            $(".completed-deposits").text(res.completed);
            $(".pending-deposits").text(res.pending);
            $(".rejected-deposits").text(res.rejected);
            $("#loading").addClass("d-none");
        },
    });
}

function getTotalTransactions() {
    let url = $("#get-transaction-url").val();
    $.ajax({
        type: "GET",
        url: url,
        success: function (res) {
            $(".total-transactions").text(res.total);
            $(".credit-transactions").text(res.credit);
            $(".debit-transactions").text(res.debit);
            $("#loading").addClass("d-none");
        },
    });
}

function getTotalPayouts() {
    let url = $("#get-payouts-url").val();
    $.ajax({
        type: "GET",
        url: url,
        success: function (res) {
            $(".total-payouts").text(res.withdraws);
            $(".completed-payouts").text(res.approved);
            $(".pending-payouts").text(res.rejected);
            $(".rejected-payouts").text(res.pending);
            $("#loading").addClass("d-none");
        },
    });
}

function getTotalOrders() {
    let url = $("#get-orders-url").val();
    $.ajax({
        type: "GET",
        url: url,
        success: function (res) {
            $(".total-orders").text(res.total);
            $(".completed-orders").text(res.completed);
            $(".pending-orders").text(res.pending);
            $(".cancled-orders").text(res.cancled);
            $("#loading").addClass("d-none");
        },
    });
}

function getAdminDashboardData() {
    let url = $("#get-dashbaord-url").val();
    $.ajax({
        type: "GET",
        url: url,
        success: function (res) {
            $(".total_customers").text(res.total_customers);
            $(".total_investments").text(res.total_investments);
            $(".investments_amount").text(res.investments_amount);
            $(".total_plans").text(res.total_plans);
            $(".active_plans").text(res.active_plans);
            $(".deactiev_plans").text(res.deactiev_plans);
        },
    });
}

function getUserDashboardData() {
    let url = $("#get-dashbaord-url").val();
    $.ajax({
        type: "GET",
        url: url,
        success: function (res) {
            $(".total-deposit").text(res.total_deposit);
            $(".total-withdraw").text(res.total_withdraw);
            $(".pending-deposit").text(res.pending_deposit);
            $(".total-earnings").text(res.total_earnings);
            $(".total-loss").text(res.total_loss);
            $(".total-invest").text(res.total_invest);
            $(".current-invest").text(res.current_invest);
            $(".pending-withdraw").text(res.pending_withdraw);

            var months = [];
            var loss_amount = [];
            var profit_amount = [];
            $.each(res.earnings_loss, function (index, value) {
                months.push(value.month);
                if (value.amount > 0) {
                    profit_amount.push(value.amount);
                    loss_amount.push(0);
                } else {
                    loss_amount.push(Math.abs(value.amount));
                    profit_amount.push(0);
                }
            });

            dashboardChart(months, profit_amount, loss_amount)
            $('#earning_performance').hide();
        },
    });
}

// Chart
var ctx = document.getElementById("myChart").getContext("2d");
function dashboardChart(months, profit_amount, loss_amount) {
    var myChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: months,
            datasets: [
                {
                    label: "Earnings",
                    data: profit_amount,
                    borderWidth: 2,
                    backgroundColor: "rgba(63,82,227,.8)",
                    borderWidth: 0,
                    borderColor: "transparent",
                    pointBorderWidth: 0,
                    pointRadius: 3.5,
                    pointBackgroundColor: "transparent",
                    pointHoverBackgroundColor: "rgba(63,82,227,.8)",
                },
                {
                    label: "Loss",
                    data: loss_amount,
                    borderWidth: 2,
                    backgroundColor: "rgba(254,86,83,.7)",
                    borderWidth: 0,
                    borderColor: "transparent",
                    pointBorderWidth: 0,
                    pointRadius: 3.5,
                    pointBackgroundColor: "transparent",
                    pointHoverBackgroundColor: "rgba(254,86,83,.8)",
                },
            ],
        },
        options: {
            legend: {
                display: false,
            },
            scales: {
                yAxes: [
                    {
                        gridLines: {
                            drawBorder: false,
                            color: "#f2f2f2",
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1500,
                            callback: function (value, index, values) {
                                return "$" + value;
                            },
                        },
                    },
                ],
                xAxes: [
                    {
                        gridLines: {
                            display: false,
                            tickMarkLength: 15,
                        },
                    },
                ],
            },
        },
    });
}

