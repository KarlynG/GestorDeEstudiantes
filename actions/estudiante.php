<?php

    class Estudiante{

        public $id;
        public $Name;
        public $Apellido;
        public $MateriasFav;
        public $CarreraId;
        public $Status;
        public $Foto;

        public function __construct($id, $name, $apellido, $materiasFav, $carrera, $status, $foto){
            $this->id = $id;
            $this->Name = $name;
            $this->Apellido = $apellido;
            $this->CarreraId = $carrera;
            $this->MateriasFav = $materiasFav;
            $this->Status = $status;
            $this->Foto = $foto;
         
        }
    }

?>