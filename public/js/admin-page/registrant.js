$("#status").on("change", function () {
    $("#submitForm").submit();
});

function approve(nomor, name, training_nomor, trainingsTitle) {
    $("#modal-edit").modal("show");
    $(".modal-title").text("Approve Pelatihan");
    $("#modal-edit form").attr("action", "/approve/" + nomor);
    $("#content-edit").html("");

    var html =
        `<div class="col mb-2">
                <input type="hidden" name="id" id="id" value="` +
        nomor +
        `">
        <input type="hidden" name="training_id" value="` +
        training_nomor +
        `" >
        Terima <label for="name">` +
        name +
        `</label> untuk mengikuti pelatihan
        <label for="name">` +
        trainingsTitle +
        `</label>
                
        </div>`;

    $("#content-edit").append(html);
}

function decline(nomor, name, training_id, trainingsTitle) {
    $("#modal-delete").modal("show");
    $(".modal-title").text("Hapus Data");
    $("#modal-delete form").attr("action", "/decline/" + nomor);
    $("#content-delete").html("");

    var html =
        `<div class="col mb-2">
                <input type="hidden" name="id" id="id" value="` +
        nomor +
        `">
        <input type="hidden" name="training_id" value="` +
        training_id +
        `" >
                <span style="margin-left: 10px;">Tolak <b>` +
        name +
        `</b> untuk pendaftaran pelatihan <label for="name">` +
        trainingsTitle +
        `</label> ?<span>
                </div>`;

    $("#content-delete").append(html);
}
