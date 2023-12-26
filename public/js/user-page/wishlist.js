function printCard(periode, training_name, date) {
    $("#printCard").modal("show");
    $("#periode").text(periode);
    $("#training_name").text(training_name);
    $("#date").text(date);
}

function printDiv() {
    var divContents = document.getElementById("content").innerHTML;
    var a = window.open("", "", "height=500, width=500");
    a.document.write("<html>");
    a.document.write("<body > <h1>Kartu Pelatihan <br>");
    a.document.write(divContents);
    a.document.write("</body></html>");
    a.document.close();
    a.print();
}
