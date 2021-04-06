<?php

    Class CookiesTest{

    
    private $CookieName;
    private $utilities;

    public function __construct(){
        session_start();
        $this ->CookieName = "students";
        $this ->utilities = new UtilitiesTest();

    }

    public function Add($item){
        $students = $this->GetList();

        if(count($students) == 0){
            $item->id = 1;

        }else{

            $lastElement = $this->utilities->getLastElement($students);

            $item->id = $lastElement->id + 1;
        }   

        array_push($students, $item);

        setcookie($this->CookieName, json_encode($students), $this->GetCookieTime(), "/");

    }

    public function Edit($item){      

        $students = $this->GetList();
        $studentId = $this->GetById($item->id);

        if($studentId != null && count($studentId) > 0 ){
      
            $index = $this->utilities->getIndexElement($students,"id",$item->id);
            $students[$index] = $item;

            setcookie($this->CookieName, json_encode($students), $this->GetCookieTime(), "/");

        }           
    }

    public function Delete($item){
        $students = $this->GetList();
        $studentId = $this->GetById($item->id);

        if($studentId != null && count($studentId) > 0 ){
      
            $index = $this->utilities->getIndexElement($students,"id",$item->id);
            unset($students[$index]);

            setcookie($this->CookieName, json_encode($students), $this->GetCookieTime(), "/");
            

        }    
    }

    public function SavePhoto($item, $item2){
        $nombre = $item;
        $guardado = $item2;

        if(!file_exists('../archivos')){
            mkdir('../archivos',0777,true);
        }
        if (file_exists('../archivos/'.$nombre)) {
            return $nombre;
        }
        move_uploaded_file($guardado, '../archivos/'.$nombre);
    }

    public function GetList(){
        $students = array();

        if(isset($_COOKIE[$this->CookieName])){
            $students = (array) json_decode($_COOKIE[$this->CookieName]); 
            
            if(isset($_GET['filtroId'])){
                
                $students = $this->utilities->searchProperty($students, 'CarreraId', $_GET['filtroId']);
            }
        }
        else{
            $students = [];
        }

        return $students;
    }
    
    public function GetById($id){

        $students = $this->GetList();

        $student = $this->utilities->searchProperty($students,"id",$id);     
        
        return $student[0];
    }

    private function GetCookieTime(){
        return time() + 60 * 60 * 24 * 15;
    }

}

?>