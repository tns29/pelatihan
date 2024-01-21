$(function () {
    $("#update-status-passed").hide();
    $("#passed").on("change", function () {
        $("#submitForm").submit();
    });
    $("#search").on("click", function () {
        $("#submitForm").submit();
    });
});

var arrItem = [];
function selectItem(item, number) {
    if (arrItem.includes(item)) {
        remove(arrItem, item);
    } else {
        arrItem.push(item);
    }
    if (arrItem.length > 0) {
        $("#update-status-passed").show();
    } else {
        $("#update-status-passed").hide();
    }
    $("#selectedId").val(arrItem);
}

function remove(arr) {
    var what,
        a = arguments,
        L = a.length,
        ax;
    while (L > 1 && arr.length) {
        what = a[--L];
        while ((ax = arr.indexOf(what)) !== -1) {
            arr.splice(ax, 1);
        }
    }
    return arr;
}

function passedUpdate(status_passed) {
    var selectedId = $("#selectedId").val();
    console.log(status_passed);
    console.log(selectedId);

    $.ajax({
        type: "PUT",
        url: "/update-status-passed", // Use the route function to generate the URL
        data: {
            selectedId: selectedId,
            status_passed: status_passed,
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            // Handle the response here
            console.log(response);
            if (response.status == "success") {
                window.location.reload();
            }
        },
        error: function (error) {
            console.log("Ajax request failed");
        },
    });
}
