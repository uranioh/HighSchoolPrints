function plus(id) {
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
    // document.getElementById("price_single").value =
    //     prices[document.getElementById("size_single")] *
    //     document.getElementById("qty_single").value;

    let verticals = document.getElementById("verticals");
    while (verticals.firstChild) {
        verticals.removeChild(verticals.firstChild);
    }

    let horizontals = document.getElementById("horizontals");
    while (horizontals.firstChild) {
        horizontals.removeChild(horizontals.firstChild);
    }


    let qty_single = parseFloat(document.getElementById("qty_single").value) || 0;
    let qty_group = parseFloat(document.getElementById("qty_group").value) || 0;


    let size_single = document.getElementById("size_single").value;
    let size_group = document.getElementById("size_group").value;

    let price_single = prices[size_single] * qty_single;
    let price_group = prices[size_group] * qty_group;

    console.log(price_single);

    document.getElementById("price_single").value = price_single.toFixed(2)
    document.getElementById("price_group").value = price_group.toFixed(2);
    document.getElementById("submit_button").textContent = "Paga €" + (price_single + price_group).toFixed(2);

    for (let i = 0; i < qty_single; i++) {
        let img = document.createElement("img");
        img.src = "img/" + size_single + ".jpg";
        img.className = "vertical";

        img.style.top = (i * 27 + 28) + "px";
        img.style.left = (i * 27 + 63) + "px";

        let images = document.getElementById("verticals");
        images.append(img);
    }

    for (let i = 0; i < qty_group; i++) {
        let img = document.createElement("img");
        img.src = "img/" + size_group + ".jpg";
        img.className = "horizontal";

        img.style.bottom = (i * 27 + 70) + "px";
        img.style.right = (i * 27 + 30) + "px";

        let images = document.getElementById("horizontals");
        images.append(img);
    }
}

function validateForm() {
    const qtySingle = parseInt(document.getElementById('qty_single').value, 10);
    const qtyGroup = parseInt(document.getElementById('qty_group').value, 10);

    if (isNaN(qtySingle) || isNaN(qtyGroup)) {
        alert('Valore non valido.');
        return false;
    }

    if (qtySingle < 1 && qtyGroup < 1) {
        alert('Almeno una quantità deve essere maggiore di 0.');
        return false;
    }

    return true;
}