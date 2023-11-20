function delete_m_category(id, name) {
    $("#modal-delete").modal("show");
    $(".modal-title").text("Hapus Data");
    $("#modal-delete form").attr("action", "/posts/" + id);
    $("#content-delete").html("");

    var html =
        `<div class="col mb-2">
                <input type="hidden" name="id" id="id" value="` +
        id +
        `">
                <span style="margin-left: 10px;">Hapus data Berita <b>` +
        name +
        `</b> ?<span>
                </div>`;

    $("#content-delete").append(html);
}
