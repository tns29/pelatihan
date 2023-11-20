getServicesList();

function getCategory(id) {
    $("#category").val(id);
    const categoryId = $("#category").val();
    const countCategory = $("#count-id-category").val();

    for (let i = 1; i <= countCategory; i++) {
        const attrId = "btn-category-" + i;
        if (categoryId == i) {
            $("." + attrId).css("background", "#000");
            $("." + attrId).css("color", "#FFF");
        } else {
            $("." + attrId).css("background", "#FFF");
            $("." + attrId).css("color", "#000");
        }
    }

    getServicesList(categoryId);
}

function getServicesList(categoryId) {
    $("#services-list").html("");
    var route = "getDataServices";
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: route,
        data: { categoryId: categoryId },
        success: function (result) {
            var html = "";
            result.map((item, index) => {
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
                                <i class="fas fa-calendar-minus me-2"></i>  
                                ` +
                    item.start_date +
                    `
                            </small> <br>
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

            $("#services-list").append(html);
        },
    });
}
