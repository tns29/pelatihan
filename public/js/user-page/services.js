getServicesList();

function getCategory(id) {
    const countCategory = $("#count-id-category").val();
    if (id == "all") {
        getServicesList();

        $(".btn-category-all").css("background", "#000");
        $(".btn-category-all").css("color", "#FFF");

        for (let i = 1; i <= countCategory; i++) {
            const attrId = "btn-category-" + i;

            $("." + attrId).css("background", "#FFF");
            $("." + attrId).css("color", "#000");
        }
    } else {
        $("#category").val(id);
        const categoryId = $("#category").val();

        for (let i = 1; i <= countCategory; i++) {
            const attrId = "btn-category-" + i;

            if (categoryId == i) {
                $("." + attrId).css("background", "#000");
                $("." + attrId).css("color", "#FFF");
            } else {
                $("." + attrId).css("background", "#FFF");
                $("." + attrId).css("color", "#000");
                $(".btn-category-all").css("background", "#FFF");
                $(".btn-category-all").css("color", "#000");
            }
        }

        getServicesList(categoryId);
    }
}

function getServicesList(categoryId) {
    var route = "getDataServices";
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: route,
        data: { categoryId: categoryId },
        success: function (data) {
            if (data.status == "success") {
                var html = "";
                data.services.map((item, index) => {
                    var start_date_ = dateFormat(
                        "-",
                        data.active_period.start_date
                    );
                    var end_date_ = dateFormat(
                        "-",
                        data.active_period.end_date
                    );

                    if (index == 0) {
                        html +=
                            `<div class="text-center alert alert-warning mx-2 py-1 ms-1 mt-3">
                        <i class="fas fa-calendar-minus me-2"></i>
                        Pendaftaran <b>` +
                            data.active_period.name +
                            `</b> dibuka pada <b>` +
                            start_date_ +
                            `</b> s/d <b>` +
                            end_date_ +
                            `</b>
                        </div>`;
                    }
                    let textLenght = item.description.length > 111 ? "..." : "";
                    if (item.image) {
                        var logo =
                            `<img src="storage/` +
                            item.image +
                            `" class="card-img-top img-services p-2" alt="` +
                            item.id +
                            `">`;
                    } else {
                        var logo =
                            `<img src="{{ asset('/img/logo-bussiness.png') }}" class="card-img-top img-services p-3" alt="` +
                            item.id +
                            `">`;
                    }
                    html +=
                        `
                        <div class="col-lg-3 col-md-3 col-sm-3 px-0 elevation-2" data-foo="` +
                        item.title +
                        `">
                        <div class="box-services">
                                <a href="/pelatihan/` +
                        item.id +
                        `" class="text-decoration-none text-dark-emphasis">
                            <div class="card shadow" style="width: 100%;">
                            ` +
                        logo +
                        `
                            <div class="card-body" style="height: 130px; !important;">
                                <h5 class="card-title" style="font-weight: 700; text-transform: uppercase;">` +
                        item.title +
                        `</h5>
                                <p class="card-text" style="font-size: 14.5px;">` +
                        item.description.substring(0, 111) +
                        textLenght +
                        `</p>
                            </div>
                            <div class="card-footer">
                                <p>
                                <small class="card-text"> 
                                    <i class="fas fa-certificate me-2"></i>
                                    ` +
                        item.category.name +
                        `
                                </small>
                                <br>
                                <small class="card-text"> 
                                    <i class="fas fa-tag me-2"></i>
                                    Gratis
                                </small>
                                </p>
                            </div>
                            </div>
                            </a>
                        </div>
                    </div>`;
                });
            } else {
                var html =
                    `<div class="text-center alert alert-danger py-1 ms-1 mt-3">` +
                    data.messsage +
                    `</div>`;
            }
            setTimeout(() => {
                $("#services-list").html("");
                $("#services-list").append(html);
            }, 100);
        },
    });
}
