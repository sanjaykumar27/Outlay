// JavaScript Document

function MonthlyGraph() {
    setTimeout(function () {
        var rec_data = dmx.app.data.routeDashboard.scMonthlyReport.data.HTML;
        $('#expense_monthly').html(rec_data);
    }, 400);
}
