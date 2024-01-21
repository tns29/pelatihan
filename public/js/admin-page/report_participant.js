$(document).ready(function () {
    $("#sub_district").on("change", function () {
        $("#village").html("");
        $("#village").val("");
        // console.log($(this).val());
        // loadVillages($(this).val());
        loadVillages($("#sub_district").val());
    });

    $("#category_id").on("change", function () {
        $("#training_id").html("");
        $("#training_id").val("");

        loadTraining($("#category_id").val());
    });

    $(".select-fullname").select2({
        placeholder: "Pilih Peserta",
        width: "760",
    });

    let startYear = 2010;
    let endYear = new Date().getFullYear();
    for (var listYear = startYear; listYear <= endYear; listYear++) {
        $("#year").append($("<option />").val(listYear).html(listYear));
    }
    $("#year").val(endYear).change();
});

function loadVillages(id) {
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: "/getVillages",
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

function loadTraining(id) {
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: "/getTrainings",
        data: { category_id: id },
        async: false,
        success: function (result) {
            var html = `<option value="">Pilih Pelatihan</option>`;
            result.map((item) => {
                html +=
                    `<option value="` +
                    item.id +
                    `">  » &nbsp; ` +
                    item.title +
                    `</option>`;
            });

            $("#training_id").append(html);
        },
    });
}

var village = $("#village_").val();
$("#village").val(village).change();

$("#submitRpt").on("click", function () {
    var fullname = $("#fullname").val();
    var category_id = $("#category_id").val();
    var training_id = $("#training_id").val();
    var gender = $("#gender").val();
    var sub_district = $("#sub_district").val();
    var village = $("#village").val();
    var material_status = $("#material_status").val();
    // var religion = $("#religion").val();
    var last_education = $("#last_education").val();
    var period = $("#period").val();
    var year = $("#year").val();

    $.ajax({
        type: "GET",
        url: "/participant-rpt",
        dataType: "JSON",
        data: {
            fullname: fullname,
            category_id: category_id,
            training_id: training_id,
            gender: gender,
            sub_district: sub_district,
            village: village,
            material_status: material_status,
            // religion: religion,
            last_education: last_education,
            period: period,
            year: year,
        },
        success: function (data) {
            openRpt();
        },
    });
});

function openRpt() {
    window.popup = window.open(
        "/open-participant-rpt",
        "rpt",
        "width=1550, height=600, top=10, left=10, toolbar=1"
    );
}
