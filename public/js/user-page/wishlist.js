function printCard(periode, training_name, date, is_passed, approve) {
    $("#printCard").modal("show");
    $("#periode").text(periode);
    $("#training_name").text(training_name);
    $("#date").text(date);
    if (is_passed == "Y") {
        var span = `<span class="text-success"><b> L U L U S </b></span>`;
    } else if (is_passed == "N") {
        var span = `<span class="text-danger">TIDAK LULUS</span>`;
    } else {
        if (approve == "Y") {
            var span = `<span class="text-success"><b> Sedang Berlangsung </b></span>`;
        } else if (approve == "N") {
            var span = `<span class="text-danger"><b> Pelatihan ditolak </b></span>`;
        } else {
            var span = `<span class="text-warning"><b> Menunggu persetujuan </b></span>`;
        }
    }

    if (approve) {
        $("#tr_approve").show();
    } else {
        $("#tr_approve").hide();
    }
    $("#passed").html(span);
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
