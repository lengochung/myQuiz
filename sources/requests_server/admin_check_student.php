<?php

    require '../helpers/require_for_requests_server.php';

    $conn = new Connect_MySql();

    $users = $conn->load('users');

    $bool = $_GET['bool'];

    if($bool) {
        $users->upd_column_value('uid', $_GET['uid'], 'checked', 1);
    } else {
        $users->upd_column_value('uid', $_GET['uid'], 'checked', 0);
    }