// JavaScript Document
/* checking if browser supports service worker, if yes then registor */
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/service-worker.js')
        /* remove these below two lines of code once development is complete
     <- ignore this error, its a wappler issue, js is completely fine */
        .then((reg) => console.log('Service worker registored', reg))
        .catch((err) => console.log('Service worker not registored', err))
}

function MonthlyGraph() {
    setTimeout(function () {
        var rec_data = dmx.app.data.routeDashboard.scMonthlyReport.data.HTML;
        $('#expense_monthly').html(rec_data);
    }, 400);
}
