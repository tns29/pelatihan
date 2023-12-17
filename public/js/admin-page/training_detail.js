function delete_data(id, name) {
    //
    $("#modal-delete").modal("show");
    $(".modal-title").text("Hapus Data");
    $("#modal-delete form").attr("action", "/service-detail/" + id);
    $("#content-delete").html("");

    var html =
        `<div class="col mb-2">
                <input type="hidden" name="id" id="id" value="` +
        id +
        `">
                <span style="margin-left: 10px;">Hapus Kontent Pelatihan <b>` +
        name +
        `</b> ?<span>
                </div>`;

    $("#content-delete").append(html);
}
