<?php
    try{
        $conn=new PDO("mysql:host=localhost; dbname=wizelydb","root","");

        //set the PDO error mode yo exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
    }
    catch(PDOException $e){
        // echo "Connection failed".$e->getMessage();
        
    }
?>