// JavaScript Document
/* checking if browser supports service worker, if yes then registor */

function MonthlyGraph() {
    console.log('Graph Called');
    setTimeout(function () {
        var rec_data = dmx.app.data.scMonthlyReport.data.HTML;
        $('#expense_monthly').html(rec_data);
    }, 2000);
}

function CurrentMonthGraph() {
    console.log('Graph Called');
    var rec_data = dmx.app.data.routeExpenseList.scGenerateGraph.data.HTML;
    $('#expense_monthly').html(rec_data);
}

$(function () {
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('../service-worker.js')
        /* remove these below two lines of code once development is complete
     <- ignore this error, its a wappler issue, js is completely fine */
        // .then((reg) => console.log('Service worker registored', reg))
        // .catch((err) => console.log('Service worker not registored', err))
    }

});
