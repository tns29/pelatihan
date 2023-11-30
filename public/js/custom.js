function dateFormat(type, date) {
    var objectDate = new Date(date);
    var day = objectDate.getDate();
    var month = objectDate.getMonth();
    var year = objectDate.getFullYear();

    if (type == "-") {
        return day + "-" + (month + 1) + "-" + year;
    } else if (type == "/") {
        return day + "/" + (month + 1) + "/" + year;
    }
}
