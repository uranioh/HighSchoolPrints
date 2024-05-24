function plus_single(id) {
    document.getElementById(id).stepUp();
    refresh();
    // let qty = document.getElementById(id).value;
    //
    //
    // // let images = document.getElementById("images");
    // // while (images.firstChild) {
    // //     images.removeChild(images.firstChild);
    // // }
    //
    // // remove all divs with id img_single
    // let divs = document.getElementsByClassName("img_single");
    // while (divs.length > 0) {
    //     divs[0].parentNode.removeChild(divs[0]);
    // }
    //
    // for (let i = 0; i < qty; i++) {
    //     let div = document.createElement("div");
    //     div.innerHTML = "ID: " + id;
    //     div.className = "img_single";
    //
    //     let images = document.getElementById("images");
    //     images.append(div);
    // }
}

function plus_group(id) {
    document.getElementById(id).stepUp();

    refresh();
    // let qty = document.getElementById(id).value;

    // let images = document.getElementById("images");
    // while (images.firstChild) {
    //     images.removeChild(images.firstChild);
    // }

    // remove all divs with id img_group
    // let divs = document.getElementsByClassName("img_group");
    // while (divs.length > 0) {
    //     divs[0].parentNode.removeChild(divs[0]);
    // }
    //
    // for (let i = 0; i < qty; i++) {
    //     let div = document.createElement("div");
    //     div.innerHTML = "ID: " + id;
    //     div.className = "img_group";
    //
    //     let images = document.getElementById("images");
    //     images.append(div);
    // }

}

function minus(id) {
    document.getElementById(id).stepDown()
    refresh();
    //
    // let images = document.getElementById("images");
    // images.removeChild(images.lastChild);
}

function refresh () {
    let images = document.getElementById("images");
    while (images.firstChild) {
        images.removeChild(images.firstChild);
    }

    let qty_single = document.getElementById("qty_single").value;
    let qty_group = document.getElementById("qty_group").value;

    for (let i = 0; i < qty_single; i++) {
        let div = document.createElement("div");
        div.innerHTML = "img_single";
        div.className = "img_single";

        let images = document.getElementById("images");
        images.append(div);
    }

    for (let i = 0; i < qty_group; i++) {
        let div = document.createElement("div");
        div.innerHTML = "img_group";
        div.className = "img_group";

        let images = document.getElementById("images");
        images.append(div);
    }
}