<?php
    
    $config = require_once "config.php";
    define("Path_pro", $config['path']);

    require_once "sources/models/database.php";
    require_once "sources/models/tables.php";
    require_once "sources/models/connect_mysql.php";

    require_once "sources/helpers/promise.php";
    require_once "sources/helpers/helper.php";

