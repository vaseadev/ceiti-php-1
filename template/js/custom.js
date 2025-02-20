storageHTMLKeNNy = localStorage.getItem("alertHTMLKeNNy");
if (storageHTMLKeNNy) {
        storageHTMLKeNNy = JSON.parse(storageHTMLKeNNy);
        alertHTML = document.querySelector("#alertHTML");

        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: storageHTMLKeNNy[0],
            title: storageHTMLKeNNy[1]
        });

        /*
        alertHTML.innerHTML = `
        <div class='alert alert-${storageHTMLKeNNy[0]} alert-dismissible alert-alt fade show'>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='btn-close'></button>
        <strong>${storageHTMLKeNNy[1]}</strong>
        </div>
        `;
        */

        localStorage.removeItem("alertHTMLKeNNy");
}

    add_cant = document.querySelector(".add_cant");
    remove_cant = document.querySelector(".remove_cant");

    add_cant.addEventListener('click', () => {
        price = add_cant.getAttribute("data-price");
        nr_cant = document.querySelector(`#nr_cant`);
        nr_cant.value++;
        serviciuTotalPrice = document.querySelector(`#serviciuTotalPrice`);
        serviciuCountPrice = parseFloat(serviciuTotalPrice.innerText);
        serviciuCountPrice += parseFloat(price);
        serviciuTotalPrice.innerHTML = serviciuCountPrice;
    });

    remove_cant.addEventListener('click', () => {
        price = add_cant.getAttribute("data-price");
        nr_cant = document.querySelector(`#nr_cant`);
        if (nr_cant.value > 1) {
            nr_cant.value--;
            serviciuTotalPrice = document.querySelector(`#serviciuTotalPrice`);
            serviciuCountPrice = parseFloat(serviciuTotalPrice.innerText);
            serviciuCountPrice -= parseFloat(price);
            serviciuTotalPrice.innerHTML = serviciuCountPrice;
        }
    });