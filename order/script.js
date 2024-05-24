function plus_single(id) {
    document.getElementById(id).stepUp();
    refresh();
}

function plus_group(id) {
    document.getElementById(id).stepUp();
    refresh();
}

function minus(id) {
    document.getElementById(id).stepDown()
    refresh();
    //
    // let images = document.getElementById("images");
    // images.removeChild(images.lastChild);
}

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("size_single").addEventListener("change", refresh);
    document.getElementById("size_group").addEventListener("change", refresh);
});


function refresh() {
    let verticals = document.getElementById("verticals");
    while (verticals.firstChild) {
        verticals.removeChild(verticals.firstChild);
    }

    let horizontals = document.getElementById("horizontals");
    while (horizontals.firstChild) {
        horizontals.removeChild(horizontals.firstChild);
    }


    let qty_single = document.getElementById("qty_single").value;
    let qty_group = document.getElementById("qty_group").value;

    let size_single = document.getElementById("size_single").value;
    let size_group = document.getElementById("size_group").value;

    for (let i = 0; i < qty_single; i++) {
        let img = document.createElement("img");
        img.src = "img/" + size_single + ".jpg";
        img.className = "vertical";

        img.style.top = (i * 27 + 28) + "px";
        img.style.left = (i * 27 + 60) + "px";

        let images = document.getElementById("verticals");
        images.append(img);
    }

    for (let i = 0; i < qty_group; i++) {
        let img = document.createElement("img");
        img.src = "img/" + size_group + ".jpg";
        img.className = "horizontal";

        img.style.bottom = (i * 27 + 70) + "px";
        img.style.right = (i * 27 + 33) + "px";

        let images = document.getElementById("horizontals");
        images.append(img);
    }
}