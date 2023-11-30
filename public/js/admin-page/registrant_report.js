$("#submitRpt").on("click", function () {
    var fullname = $("#fullname").val();
    var gender = $("#gender").val();

    $.ajax({
        type: "GET",
        url: "/registrant-rpt",
        dataType: "JSON",
        data: {
            fullname: fullname,
            gender: gender,
        },
        success: function (data) {
            openRpt();
        },
    });
});

function openRpt() {
    window.popup = window.open(
        "/open-registrant-rpt",
        "rpt",
        "width=1150, height=560, top=100, left=100, toolbar=1"
    );
}
