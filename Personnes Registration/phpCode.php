<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $dataBaseName = "crud";

    $connect = mysqli_connect($serverName, $userName, $password, $dataBaseName);

    if(!$connect){
        die("Connection Filed!: ".mysqli_connect_error());
    }

?>