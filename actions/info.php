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

    if(isset($student->MateriasFav)){
        $listOfSubjects = explode(",", $student->MateriasFav);
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
    <div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="../archivos/<?= $student->Foto ?>" width="100%" height="250">
        </div>
        <div class="col-md-8">
        <div class="card-body">
            <h5 class="card-title">Informacion del estudiante</h5>
            <p class="card-text"><b>Nombre: </b><?= $student->Name ?></p>
            <p class="card-text"><b>Apellido: </b><?= $student->Apellido ?></p>
            <p class="card-text"><b>Carrera: </b><?= $utilities->carreras[$student->CarreraId]?></p>

            <p class="card-text"><b>Materias Favoritas:</b></p>

            <ol class="list-group list-group-numbered mb-4">
                <?php foreach($listOfSubjects as $value => $materias):?>
                                    
                    <li class="list-group-item"><?= $materias?></li>

                <?php endforeach;?>

            </ol>

            <?php if($student->Status !== "on"): ?>
                <p class="card-text"><b>Estado:</b> Inactivo</p>
            <?php else: ?>
                <p class="card-text"><b>Estado:</b> Activo</p>
            <?php endif; ?>
            
            
        </div>
        <div class="card-body">
            <a href="../index.php" class="btn btn-primary">Volver</a>
        </div>
        </div>
    </div>
    </div>

    </div>    

    

    <?php echo $layout->printFooter() ?>

</body>

</html>