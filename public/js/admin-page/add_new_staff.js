$(function () {
    console.log("ready");

    const imgInp = document.getElementById("images");
    let blah = document.getElementById("blah");
    imgInp.onchange = (evt) => {
        const [file] = imgInp.files;
        console.log(file);
        if (file) {
            blah.src = URL.createObjectURL(file);
        }
    };
});

function changeUsername() {
    const username = document.getElementById("username").value;
    const usnm = username.replaceAll(" ", "_");
    console.log(usnm);
    document.getElementById("username").value = usnm.toLowerCase();
}

function generateUsername() {
    const fullname = document.getElementById("fullname").value;
    const username = document.getElementById("username");
    const usnm = fullname.replace(" ", "_");

    username.value = usnm.substring(0, 10).toLowerCase();
}

var invalid = document.getElementById("invalid").value;
var valid = document.getElementById("valid").value;
if (valid) {
} else if (invalid) {
}
