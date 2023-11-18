$("#cancel").hide();
$("#save").hide();

$("#edit").click(function () {
    $("#edit").hide();
    $("#cancel").fadeIn(400);
    $("#save").fadeIn(400);

    $("input").attr("readonly", false);
});

$("#cancel").click(function () {
    $("#cancel").hide();
    $("#save").hide();
    $("#edit").fadeIn(400);

    $("input").attr("readonly", true);
});
