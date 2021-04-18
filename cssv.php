<?php

class cssv extends mysqli
{
    private $state_csv = false;
    public function _construct()
	{
		parent::_construct("localhost","creation_user","Creation@2018","creation_skfdatabase");
		if($this->connect_error){
			echo "Failed to connect to DataBase : ".$this->connect_error;
		}
	}
	public function import($file)
	{
	    $file = fopen($file,'r');
	    while($row = fgetcsv($file)){
	        $value = "'".implode("','",$row)."'";
	        $q = "INSERT INTO file(supplier,bearing_type,bearing_part,inwards_stock,sale,wh_bal_stock,rate,wh_value,sales_value,unit_weight,wh_weight) VALUES(".$value.")";
	        if($this->query($q)){
	            $this->state_csv = true;
	        }
	        else{
	            $this->state_csv = false;
	            
	        }
	    }
	    
	    if($this->state_csv){
	        echo "Successfully uploaded";
	    }
	    else{
	        echo "Wrong";
	    }
	}
}

?>