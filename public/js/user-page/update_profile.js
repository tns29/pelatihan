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
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: "getVillages",
        data: { sub_district_id: $(this).val() },
        success: function (result) {
            var html = `<option value="">Pilih kelurahan</option>`;
            result.map((item) => {
                html +=
                    `<option value="` +
                    item.name +
                    `">  » &nbsp; ` +
                    item.name +
                    `</option>`;
            });

            $("#village").append(html);
        },
    });
});
