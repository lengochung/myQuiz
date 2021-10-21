<?php

    $config = require 'config.php';

    define("Path_pro", $config['path']);
    define('URL', $config['url']);
    
    $app = require Path_pro . '/sources/controllers/app.php';

    session_start();
    $app.run();



    
    
    

    


    
    
  
    