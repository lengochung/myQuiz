<?php

    session_start();
        
    $config = require '../../config.php';

    define("Path_pro", $config['path']);

    require Path_pro . '/sources/helpers/helper.php';
    require Path_pro . '/sources/helpers/promise.php';

    require Path_pro . '/sources/models/database.php';
    require Path_pro . '/sources/models/tables.php';
    require Path_pro . '/sources/models/connect_mysql.php';