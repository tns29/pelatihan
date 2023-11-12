function add_m_category() {
    $("#modal-add").modal("show");
    $(".modal-title").text("Tambah Data");
    $("#content-add").html("");

    var html = `<div class="col mb-2">
                    <label for="name" style="margin-left: 10px;">Nama Kategori<label>
                    <input type="text" name="name" id="name" class="form-control" style="margin-left: 30px;">
                </div>`;

    $("#content-add").append(html);
}

function edit_m_category(id, name) {
    $("#modal-edit").modal("show");
    $(".modal-title").text("Ubah Data");
    // $("#modal-edit form").attr("action", "/category/" + id);
    // $("#modal-edit form").attr("method", "PUT");
    $("#content-edit").html("");

    var html =
        `<div class="col mb-2">
                <input type="hidden" name="id" id="id" value="` +
        id +
        `">
                <label for="name" style="margin-left: 10px;">Nama Kategori<label>
                <input type="text" name="name" id="name" class="form-control" style="margin-left: 30px;" value="` +
        name +
        `">
                </div>`;

    $("#content-edit").append(html);
}

function delete_m_category(id, name) {
    $("#modal-delete").modal("show");
    $(".modal-title").text("Hapus Data");
    $("#modal-delete form").attr("action", "/category/" + id);
    $("#modal-delete form").attr("method", "DELETE");
    $("#content-delete").html("");

    var html =
        `<div class="col mb-2">
                <input type="hidden" name="id" id="id" value="` +
        id +
        `">
                <span style="margin-left: 10px;">Hapus Kategori <b>` +
        name +
        `</b> ?<span>
                </div>`;

    $("#content-delete").append(html);
}
