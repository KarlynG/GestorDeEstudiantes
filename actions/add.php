<?php
    require_once '../helpers/utilities.php';
    require_once 'Cookies.php';
    require_once 'estudiante.php';

    $service = new CookiesTest();

    if(isset($_POST["NombreEstudiante"]) && isset($_POST["ApellidoEstudiante"]) && isset($_POST["MateriasFavoritas"]) && isset($_POST["CarreraId"]) && isset($_FILES['archivo']['name'])){
        $student = new Estudiante(0, $_POST["NombreEstudiante"], $_POST["ApellidoEstudiante"], $_POST["MateriasFavoritas"], $_POST["CarreraId"], "on", $_FILES['archivo']['name']);
        $nombreFoto = $_FILES['archivo']['name'];
        $fotoLocation = $_FILES['archivo']['tmp_name'];
        //$students = ["name" => $_POST["TituloName"],"description"=>$_POST["DescripcionName"],"generoId"=>$_POST["GeneroId"], "disponibleStatus"=>"on"];
        $service->Add($student);
        $service->SavePhoto($nombreFoto, $fotoLocation);

        header("Location: ../index.php");
    }

?>