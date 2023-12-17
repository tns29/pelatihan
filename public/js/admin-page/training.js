function delete_data(id, name) {
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: "/getRegistrant",
        data: { training_id: id },
        async: false,
        success: function (result) {
            $("#modal-delete").modal("show");
            $("#content-delete").html("");
            if (result.length > 0) {
                $(".modal-title").text("Peringatan");
                $("#modal-delete .modal-footer #n").text("Ok.");
                $("#modal-delete .modal-footer #y").hide();

                var html = `<div class="mx-3">
                <p>
                        Pelatihan ini tidak dapat dihapus karna telah berjalan dan sedang digunakan
                </p>
                <div>`;
                $("#content-delete").append(html);
            } else {
                $(".modal-title").text("Hapus Data");
                $("#modal-delete form").attr("action", "/service/" + id);

                var html =
                    `<div class="col mb-2">
                <input type="hidden" name="id" id="id" value="` +
                    id +
                    `">
                <span style="margin-left: 10px;">Hapus Pelatihan <b>` +
                    name +
                    `</b> ?<span>
                </div>`;

                $("#modal-delete .modal-footer #n").text("Tidak");
                $("#modal-delete .modal-footer #y").show();
                $("#content-delete").append(html);
            }
        },
    });
}
