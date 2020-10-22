<?php 
    $dbServer = "localhost";
    $dbName = "formSubmission";
    $dbUser = "root";
    $dbPass = "root";

    $con = new mysqli($dbServer,$dbUser,$dbPass,$dbName);
    if($con->connect_error){
        die ("Error connection ".$con->connect_error);
    }
    
    function queryMysql($query){
        global $con;
        $RunQuery = $con->query($query);
            if(!$RunQuery){
                die($con->error);
            }    
        return $RunQuery;
    }
?>