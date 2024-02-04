ClassicEditor.create(document.querySelector("#body"), {
    toolbar: [
        "heading",
        "|",
        "bold",
        "italic",
        "link",
        "bulletedList",
        "numberedList",
        "blockQuote",
    ],
    heading: {
        options: [
            {
                model: "paragraph",
                title: "Paragraph",
                class: "ck-heading_paragraph",
            },
            {
                model: "heading1",
                view: "h1",
                title: "Heading 1",
                class: "ck-heading_heading1",
            },
            {
                model: "heading2",
                view: "h2",
                title: "Heading 2",
                class: "ck-heading_heading2",
            },
        ],
    },
}).catch((error) => {
    console.log(error);
});

// const imgInp = document.getElementById("image");
// let blah = document.getElementById("blah");
// imgInp.onchange = (evt) => {
//     const [file] = imgInp.files;
//     // console.log(file);
//     if (file) {
//         blah.src = URL.createObjectURL(file);
//     }
// };

function previewImages() {
    var previewContainer = document.getElementById("image-preview");
    var files = document.getElementById("image").files;
    console.log(files);
    previewContainer.innerHTML = ""; // Clear previous previews

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.onload = function (e) {
            var previewImage = document.createElement("img");
            previewImage.src = e.target.result;
            previewImage.classList.add("preview-image");
            previewContainer.appendChild(previewImage);
        };

        reader.readAsDataURL(file);
    }
}
