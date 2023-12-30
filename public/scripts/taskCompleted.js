
/* let checkboxTasks = document.querySelectorAll(".checkbox-task");
let taskList = document.getElementById("taskList");

taskList.addEventListener('load', function () {
    checkboxTasks.forEach(function (checkbox) {

        let grandparent = checkbox.parentNode.parentNode.parentNode;

        if (checkbox.checked) {
            grandparent.classList.add('opacity-50');
        } else {
            grandparent.classList.remove('opacity-50');
        }

    });
});    */


/* document.addEventListener('DOMContentLoaded', function () {
    let checkboxTasks = document.querySelectorAll(".checkbox-task");

    checkboxTasks.forEach(function (checkbox) {
            let grandparent = checkbox.parentNode.parentNode.parentNode;

            if (checkbox.checked) {
                grandparent.classList.add('opacity-50');
            } else {
                grandparent.classList.remove('opacity-50');
            }
    });

    checkboxTasks.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            let grandparent = checkbox.parentNode.parentNode.parentNode;

            if (checkbox.checked) {
                grandparent.classList.add('opacity-50');
            } else {
                grandparent.classList.remove('opacity-50');
            }
        });
    });
}); */


/* checkboxTasks.forEach(function (checkbox) {
    checkbox.addEventListener('click', function () {
        // Obtener el elemento abuelo
        let grandparent = checkbox.parentNode.parentNode.parentNode;

        console.log(grandparent);

        if (checkbox.checked) {
            grandparent.classList.add('opacity-50');
        } else {
            grandparent.classList.remove('opacity-50');
        }
        // Código adicional según sea necesario
        console.log("Clic en el checkbox:", checkbox.checked);
    });
}); */

