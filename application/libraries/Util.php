<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Util{

public function __construct(){
}

    function calcularFecha()
    {
       $time = time();
       date_default_timezone_set("America/Bogota");
       return date("Y-m-d H:i:s", $time);
    }

}



?>