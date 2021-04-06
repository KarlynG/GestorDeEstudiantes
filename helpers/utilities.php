<?php

    class UtilitiesTest{

    

    public $carreras = [0 => 'No seleccionado', 1 => 'Redes', 2 => 'Software', 3 => 'Multimedia', 4 => 'Mecatronica', 5 => 'Seguridad informática'];

    public function getLastElement($list){

        $countList = count($list);
        $lastElement = $list[$countList -1];

        return $lastElement;

    }

    public function getIndexElement($list,$property,$value){

        foreach($list as $key => $item){

            if($item->$property == $value){             
                return $key;                
                break;
            }
        }
    }

    public function searchProperty($list,$property,$value){

        $filters = [];

        foreach($list as $item){

            if($item->$property == $value){
                array_push($filters, $item);
            }
            else{
                continue;
            }
        }

        return $filters;
    }
}

?>