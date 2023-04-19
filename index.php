<?php 
    if(empty($_GET["path"]) || empty($_GET["method"])) exit("API");
    require('./config.php');

    $path = $_GET["path"];
    $method = $_GET["method"];
    $filePath = "./source/classes/class.$path.php";
    if(file_exists($filePath)){

        require($filePath);

        $class = new $path;
        $json_data = $class->$method();
        echo json_encode($json_data);
        
    }