<?php

    class conn{  
        public  $db;
        function __construct()
        {
           $this->db = new mysqli('localhost','user','pass','data_base');
        }  
    
    }
?>