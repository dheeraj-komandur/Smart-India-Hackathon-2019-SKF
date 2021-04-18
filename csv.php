<?php


class csv extends mysqli{
    private $state_csv = false;
    public function _construct(){
        echo "File Uploaded";
        parent::_construct("localhost","creation_user","Creation@2018","creation_skfdatabase");
        if($this->connect_error){
            echo "Failed to connect to DataBase".$this->connect_error;
        }
    }
    
    public function import($file){
        $file = fopen($file,'r');
        while($row = fgetcsv($file)){
            $value = "'".implode("','",$row)."'";
            $q = "INSERT INTO file(first,last,age) VALUES(". $value .")";
            
        }
        
    }
}

?>