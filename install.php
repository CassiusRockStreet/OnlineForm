<?php
require_once('./controllers/config.php');

$CheckTable = $con->query("SELECT * FROM formdata");
if($CheckTable != true){
    $runDatabase = queryMysql("CREATE TABLE `formdata` (
        `id` int(5) NOT NULL AUTO_INCREMENT,
        `username` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        `phone` varchar(40) NOT NULL,
        `age` int(3) DEFAULT NULL,
        `nationality` varchar(255) DEFAULT NULL,
        `FavorAnimal` varchar(255) DEFAULT NULL,
        `currentCar` varchar(255) DEFAULT NULL,
        PRIMARY KEY (id),
        `timstamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=latin1; ");
    
      if($runDatabase){
          echo "Database Successfully imported";
      }else{
        echo "An error occured adding table";
      }

}else{
    echo "Table already created";
} 

?>