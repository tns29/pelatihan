const image = document.getElementById("image");
let preview = document.getElementById("preview");
image.onchange = (evt) => {
    const [file] = image.files;
    console.log(file);
    if (file) {
        preview.src = URL.createObjectURL(file);
    }
};

$("#sub_district").on("change", function () {
    $("#village").html("");
    $("#village").val("");

    loadVillages($(this).val());
});

loadVillages($("#sub_district").val());

function loadVillages(id) {
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: "getVillages",
        data: { sub_district_id: id },
        async: false,
        success: function (result) {
            var html = `<option value="">Pilih kelurahan</option>`;
            result.map((item) => {
                html +=
                    `<option value="` +
                    item.id +
                    `">  » &nbsp; ` +
                    item.name +
                    `</option>`;
            });

            $("#village").append(html);
        },
    });
}

var village = $("#village_").val();
$("#village").val(village).change();
