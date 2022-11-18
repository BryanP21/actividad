function confirmacion(e) {
    if (confirm("¿Esta seguro que desea eliminar el registro?")) {
        return true;
    } else {

        e.preventDefault();
    }
}

let linkDelete = document.querySelectorAll(".users-table--delete");

for (var i = 0; i < linkDelete.length; i++) {
    linkDelete[i].addEventListener('click',confirmacion);

}