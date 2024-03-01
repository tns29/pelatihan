$(function () {
    $("#sub_district").on("change", function () {
        $("#submitForm").submit();
    });
    $("#search").on("click", function () {
        $("#submitForm").submit();
    });
});

function delete_data(number, name) {
    //
    $("#modal-delete").modal("show");
    $(".modal-title").text("Hapus Data");
    $("#modal-delete form").attr(
        "action",
        "/delete-participant-work/" + number
    );
    $("#content-delete").html("");

    var html =
        `<div class="col mb-2">
                <input type="hidden" name="number" id="number" value="` +
        number +
        `">
                <span style="margin-left: 10px;">Hapus Data <b>` +
        name +
        `</b> ?<span>
                </div>`;

    $("#content-delete").append(html);
}
