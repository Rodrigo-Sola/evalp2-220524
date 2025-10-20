<?php
class cn{

    private $con = null;

    public function __construct()
    {
        $this->con = new mysqli('localhost', 'root', '', 'usuarios');
    }
    
    public function consulta($sql){
        return $this->con->query($sql);
    }

    
}