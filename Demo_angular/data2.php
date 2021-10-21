<?php
        $config = require '../config.php';

        define("Path_pro", $config['path']);
    
        require '../sources/models/database.php';
        require '../sources/models/tables.php';

        require '../sources/models/connect_mysql.php';

        $conn = new Connect_MySql();
    
        echo json_encode($conn->load("users")->get_all());

?>