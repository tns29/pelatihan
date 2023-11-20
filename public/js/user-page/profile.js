$("#additional-data").hide(200);
$("#see-less").hide(200);
$("#see-more").on("click", function () {
    $("#see-more").hide(100);
    $("#see-less").fadeIn(200);
    $("#additional-data").fadeIn(600);
});
$("#see-less").on("click", function () {
    $("#see-less").hide(200);
    $("#see-more").fadeIn(200);
    $("#additional-data").fadeOut(600);
});
