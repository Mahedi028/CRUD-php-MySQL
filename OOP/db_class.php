<?php

class databaseClass{
    public function __construct(){
        $hostName='localhost';
        $userName='root';
        $password='';
        $dbName='db_user';

        $conn=mysqli_connect($hostName, $userName, $password, $dbName);


        if(!$conn){
            die('Database Server not connected'.mysqli_connect_error());
        }else{
            echo'Database Server Connected successfully';
            mysqli_select_db($conn,$dbName);
        }

    }
    
}


?>