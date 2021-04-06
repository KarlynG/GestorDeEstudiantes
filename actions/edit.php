<?php
    require_once 'estudiante.php';
    require_once 'Cookies.php';
    require_once '../helpers/utilities.php';
    require_once '../layout/main.php';

    $layout = new LayoutTest();
    $service = new CookiesTest();
    $utilities = new UtilitiesTest();

    $student = null;

    if(isset($_GET["id"])) {

        $student = $service->GetById($_GET["id"]);

    }


    if(isset($_POST["estudianteId"]) && isset($_POST["NombreEstudiante"]) && isset($_POST["ApellidoEstudiante"]) && isset($_POST["MateriasFavoritas"]) && isset($_POST["CarreraId"]) && isset($_FILES['archivo']['name'])){
        $student = new Estudiante($_POST["estudianteId"], $_POST["NombreEstudiante"], $_POST["ApellidoEstudiante"], $_POST["MateriasFavoritas"], $_POST["CarreraId"], $_POST["Disponible"], $_FILES['archivo']['name']);
        $nombreFoto = $_FILES['archivo']['name'];
        $fotoLocation = $_FILES['archivo']['tmp_name'];
        $service->Edit($student);
        $service->SavePhoto($nombreFoto, $fotoLocation);

        header("Location: ../index.php");

    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>

<body>

    <?php echo $layout->printHeader() ?>

    <div class="card card_fix2" style="max-width: 35rem;">
    <div class="card-body">
        <form class="form" action="edit.php" enctype="multipart/form-data" method="POST">

            <input type="hidden" name="estudianteId" value="<?= $student->id?>">

            <div class="form-floating mb-3">
                <input type="text" name="NombreEstudiante" value="<?= $student->Name?>" class="form-control" id="pelicula" placeholder="Pelicula">
                <label for="nombre">Editar Nombre</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="ApellidoEstudiante" value="<?= $student->Apellido?>" class="form-control" id="pelicula" placeholder="Pelicula">
                <label for="nombre">Editar Apellido</label>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control" name="MateriasFavoritas" placeholder="Leave a description here" id="description" style="height: 100px"><?= $student->MateriasFav?></textarea>
                <label for="description">Editar Materias Favoritas</label>
            </div> 

            <div class="col-sm-8 mb-4">

                <label class="visually-hidden" for="CarreraId">Elegir Carrera</label>
                <select name="CarreraId" class="form-select" id="genero">
                    <option value="0">Seleccionar Carrera</option>
                    <?php foreach($utilities->carreras as $value => $carrera):?>

                        <?php if($value == $student->CarreraId): ?>
                            <option selected value="<?= $value ?>"><?= $carrera ?></option>
                        <?php else: ?>    
                            <option value="<?= $value ?>"><?= $carrera ?></option>

                        <?php endif;?>

                    <?php endforeach;?>

                </select>

            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Seleccionar una foto de perfil</label>
                <input class="form-control" name="archivo" type="file" id="formFile">
            </div>
            
            <p>Seleccionar estado: </p>
            <div class="form-check form-check-inline">
                <?php if($student->Status != "on") :?>
                <input class="form-check-input" name="Disponible" type="radio" id="RadioStatus" value="on" >
                <?php else: ?>
                <input class="form-check-input" name="Disponible" type="radio" id="RadioStatus" value="on" checked>
                <?php endif; ?>

                <label class="form-check-label" for="RadioStatus">
                    Activo
                </label>
            </div>

            <div class="form-check form-check-inline">
                <?php if($student->Status != "on") :?>
                <input class="form-check-input" name="Disponible" type="radio" id="RadioStatus2" value="off" checked>
                <?php else: ?>
                <input class="form-check-input" name="Disponible" type="radio" id="RadioStatus2" value="off" >
                <?php endif; ?>

                <label class="form-check-label" for="RadioStatus2">
                    Inactivo
                </label>
            </div>
            
    <div class="modal-footer">
        <a href="../index.php" class="btn btn-secondary">Close</a>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>

    </form>
        

    </div>

    <?php echo $layout->printFooter() ?>

</body>

</html>