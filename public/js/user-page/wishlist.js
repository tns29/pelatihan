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
    var style = `<style>
                #wmark {
                    background-position: center;
                    background-size: cover;
                    width: 340px; height: 400px;
                    margin-left:-20px;
                    margin-top: -20px;
                    filter: blur(5px);
                    -webkit-filter: blur(5px);
                }
                .content-body {
                    position: absolute;
                    top: 35%;
                    left: 13%;
                    margin-top: 5px;
                    padding: 45px 55px;
                    transform: translate(-50%, -50%);
                    z-index: 2;
                    background-color: rgba(255,255,255, 0.4);
                    color: white;
                    font-weight: bold;
                }
                .content-body img {
                    margin-left:20px; 
                }
                </style>`;
    console.log(divContents);
    var a = window.open("", "", "height=720, width=1300");
    a.document.write("<html>");
    a.document.write(style);
    a.document.write(
        "<body > <h1 style='margin-left:15px;'>Kartu Pelatihan</h1> <br>"
    );
    a.document.write(divContents);
    a.document.write("</body></html>");
    a.document.close();
    a.print();
}
