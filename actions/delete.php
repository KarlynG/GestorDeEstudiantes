<?php

require_once 'estudiante.php';
require_once '../helpers/utilities.php';
require_once 'Cookies.php';

    $session = new CookiesTest();

    if(isset($_GET['id'])){
        $student = $session->GetById($_GET["id"]);
        $session->Delete($student);
        header("Location: ../index.php");
        exit();
    }
    else{
        header("Location: ../index.php");
        exit();
    }
    

?>