$(function () {
    setTimeout(() => {
        $("#success").hide(300);
    }, 3000);
});

function popUpResetPassword() {
    $("#modal-reset-password").modal("show");
}
