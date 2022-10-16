<?php
    session_start();//continue yung value nung user
    session_destroy();
    
    header("location: index.php");
?>