$(document).ready(function(){

    $("#content-container").on("click", "#btn-delete", function () {
        if (confirm("¿Seguro que desea eliminar este elemento?")) {

            let id = $(this).data("id");
            if (id !== null && id !== undefined && id !== "") {
                window.location.href = "actions/delete.php?id=" + id;
            }

        }
    });

});