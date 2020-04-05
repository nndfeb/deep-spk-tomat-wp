
// var modal = document.querySelector(".modal");
// var modal_1 = document.querySelector(".modal_1");

// var trigger = document.querySelector(".trigger");
// var trigger_1 = document.querySelector(".trigger1");

// var closeButton = document.querySelector(".close-button");
// var closeButton_1 = document.querySelector(".close-button");




// function toggleModal() {
//     modal.classList.toggle("show-modal");
// }

// function toggleModal_1() {
//     modal.classList.toggle("show-modal_1");
// }


// function windowOnClick(event) {
//     if (event.target === modal) {
//         toggleModal();
//     }
// }
// function windowOnClick(event) {
//     if (event.target === modal_1) {
//         toggleModal_1();
//     }
// }

// trigger.addEventListener("click", toggleModal);
// trigger_1.addEventListener("click", toggleModal_1);

// closeButton.addEventListener("click", toggleModal);

// window.addEventListener("click", windowOnClick);


// Validasi Form kriteria
function validasi_input(form) {
    if (form.nm_kriteria.value == "") {
        alert("kriteria masih kosong!");
        form.nm_kriteria.focus();
        return (false);
    }

    if (form.tipe.value == "pilih") {
        alert("Anda belum memilih Tipe!");
        form.tipe.focus();
        return false;

    }
    if (form.bobot.value == "") {
        alert("Bobot masih kosong!");
        form.bobot.focus();
        return (false);
    }


    if (form.bobot.value >=100) {
        alert("Maxsimal bobotnya 100");
        form.bobot.focus();
        return (false);
    }

    return true;
}

// pop UP form 
var modal = document.getElementById('id01');
var modal2 = document.getElementById('id02');

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    } else if(event.target==modal2){
        modal2.style.display ="none";
    }
}
// Tutup


