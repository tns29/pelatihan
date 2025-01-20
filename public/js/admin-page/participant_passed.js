$(function () {
    $("#update-status-passed").hide();
    $("#passed").on("change", function () {
        $("#submitForm").submit();
    });
    $("#training_id").on("change", function () {
        $("#submitForm").submit();
    });
    $("#search").on("click", function () {
        $("#submitForm").submit();
    });
});

var arrItem = [];

// Function to toggle individual item selection
function selectItem(item, number) {
    if (arrItem.includes(item)) {
        remove(arrItem, item);
    } else {
        arrItem.push(item);
    }
    toggleUpdateStatusButton();
    $("#selectedId").val(arrItem);
}

// Function to select or deselect all items
function selectAllItems(checkAllCheckbox) {
    const checkboxes = document.querySelectorAll('input[type="checkbox"][id="items"]');
    const isChecked = checkAllCheckbox.checked;

    checkboxes.forEach(checkbox => {
        checkbox.checked = isChecked; // Update the checkbox state
        const itemValue = checkbox.value;

        if (isChecked && !arrItem.includes(itemValue)) {
            arrItem.push(itemValue);
        } else if (!isChecked) {
            remove(arrItem, itemValue);
        }
    });

    toggleUpdateStatusButton();
    $("#selectedId").val(arrItem);
}

// Helper function to remove items from an array
function remove(arr, item) {
    const index = arr.indexOf(item);
    if (index !== -1) {
        arr.splice(index, 1);
    }
}

// Function to toggle the visibility of the update button
function toggleUpdateStatusButton() {
    if (arrItem.length > 0) {
        $("#update-status-passed").show();
    } else {
        $("#update-status-passed").hide();
    }
}

// var arrItem = [];
// function selectItem(item, number) {
//     if (arrItem.includes(item)) {
//         remove(arrItem, item);
//     } else {
//         arrItem.push(item);
//     }
//     if (arrItem.length > 0) {
//         $("#update-status-passed").show();
//     } else {
//         $("#update-status-passed").hide();
//     }
//     $("#selectedId").val(arrItem);
// }

// function remove(arr) {
//     var what,
//         a = arguments,
//         L = a.length,
//         ax;
//     while (L > 1 && arr.length) {
//         what = a[--L];
//         while ((ax = arr.indexOf(what)) !== -1) {
//             arr.splice(ax, 1);
//         }
//     }
//     return arr;
// }

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
