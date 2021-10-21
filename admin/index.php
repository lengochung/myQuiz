<?php

    $config = require '../config.php';

    define("Path_pro", $config['path']);
    define('URL', $config['url']);

    session_start();

    require Path_pro . '/sources/models/database.php';
    require Path_pro . '/sources/models/tables.php';

    require Path_pro . '/sources/models/connect_mysql.php';

    require Path_pro . '/sources/helpers/helper.php';
    require Path_pro . '/sources/helpers/promise.php';

    require Path_pro . '/sources/controllers/render.php';


    Promise::resolve(null)
          ->then( function ($result) {
            // Log out
            if(isset($_GET['logout'])):
                $conn = new Connect_MySql();
                $users = $conn->load('users');

                $users->upd_user_logout(user()['email']);
                set_user_logout();
                header('location: ' . URL );
            endif;

        })->then( function ($result) { // Chuyển hướng nếu không phải Admin
            
            if(user()['role']!=1)
                header("Location: " . URL);

        })->finally( function ($result) { // Định tuyến
            
            $view = empty($_GET['page']) ? 'dashboard' :$_GET['page'];

            $route = require Path_pro . '/sources/controllers/routes/admin/' . $view . '.php';

            // Routes
            $route.$view();
        });

