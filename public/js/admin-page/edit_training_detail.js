const imgInp = document.getElementById("image");
let blah = document.getElementById("blah");
imgInp.onchange = (evt) => {
    const [file] = imgInp.files;
    console.log(file);
    if (file) {
        blah.src = URL.createObjectURL(file);
    }
};
