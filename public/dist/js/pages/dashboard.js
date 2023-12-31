// $(function () {
//     "use strict";

//     // Get context with jQuery - using jQuery's .get() method.
//     var salesChartCanvas = $("#salesChart").get(0).getContext("2d");

//     var salesChartData = {
//         labels: [
//             "January",
//             "February",
//             "March",
//             "April",
//             "May",
//             "June",
//             "July",
//         ],
//         datasets: [
//             {
//                 label: "Digital Goods",
//                 backgroundColor: "rgba(60,141,188,0.9)",
//                 borderColor: "rgba(60,141,188,0.8)",
//                 pointRadius: false,
//                 pointColor: "#3b8bba",
//                 pointStrokeColor: "rgba(60,141,188,1)",
//                 pointHighlightFill: "#fff",
//                 pointHighlightStroke: "rgba(60,141,188,1)",
//                 data: [28, 48, 40, 19, 86, 27, 90],
//             },
//             {
//                 label: "Electronics",
//                 backgroundColor: "rgba(210, 214, 222, 1)",
//                 borderColor: "rgba(210, 214, 222, 1)",
//                 pointRadius: false,
//                 pointColor: "rgba(210, 214, 222, 1)",
//                 pointStrokeColor: "#c1c7d1",
//                 pointHighlightFill: "#fff",
//                 pointHighlightStroke: "rgba(220,220,220,1)",
//                 data: [65, 59, 80, 81, 56, 55, 40],
//             },
//         ],
//     };

//     var salesChartOptions = {
//         maintainAspectRatio: false,
//         responsive: true,
//         legend: {
//             display: false,
//         },
//         scales: {
//             xAxes: [
//                 {
//                     gridLines: {
//                         display: false,
//                     },
//                 },
//             ],
//             yAxes: [
//                 {
//                     gridLines: {
//                         display: false,
//                     },
//                 },
//             ],
//         },
//     };

//     // This will get the first returned node in the jQuery collection.
//     // eslint-disable-next-line no-unused-vars
//     var salesChart = new Chart(salesChartCanvas, {
//         type: "line",
//         data: salesChartData,
//         options: salesChartOptions,
//     });

//     // Make the dashboard widgets sortable Using jquery UI
//     $(".connectedSortable").sortable({
//         placeholder: "sort-highlight",
//         connectWith: ".connectedSortable",
//         handle: ".card-header, .nav-tabs",
//         forcePlaceholderSize: true,
//         zIndex: 999999,
//     });
//     $(".connectedSortable .card-header").css("cursor", "move");

//     // bootstrap WYSIHTML5 - text editor
//     $(".textarea").summernote();

//     $(".daterange").daterangepicker(
//         {
//             ranges: {
//                 Today: [moment(), moment()],
//                 Yesterday: [
//                     moment().subtract(1, "days"),
//                     moment().subtract(1, "days"),
//                 ],
//                 "Last 7 Days": [moment().subtract(6, "days"), moment()],
//                 "Last 30 Days": [moment().subtract(29, "days"), moment()],
//                 "This Month": [
//                     moment().startOf("month"),
//                     moment().endOf("month"),
//                 ],
//                 "Last Month": [
//                     moment().subtract(1, "month").startOf("month"),
//                     moment().subtract(1, "month").endOf("month"),
//                 ],
//             },
//             startDate: moment().subtract(29, "days"),
//             endDate: moment(),
//         },
//         function (start, end) {
//             // eslint-disable-next-line no-alert
//             alert(
//                 "You chose: " +
//                     start.format("MMMM D, YYYY") +
//                     " - " +
//                     end.format("MMMM D, YYYY")
//             );
//         }
//     );

//     // The Calender
//     $("#calendar").datetimepicker({
//         format: "L",
//         inline: true,
//     });

//     // SLIMSCROLL FOR CHAT WIDGET
//     $("#chat-box").overlayScrollbars({
//         height: "250px",
//     });
// });

function pesertaTidakLulus() {
    $("#pesertaTidakLulus").submit();
}

function pesertaLulus() {
    $("#pesertaLulus").submit();
}
