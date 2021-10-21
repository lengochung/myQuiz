<?php

    require '../helpers/require_for_requests_server.php';

    $conn = new Connect_MySql();


    if($_GET['mode']) {

        $conn->load('users')->upd_column_value('uid', user()['uid'], 'password', md5($_GET['password']));
        send_message("Mật khẩu được thay đổi thành công!", "success");
        echo true;

    } else {
        echo $conn->load('users')->exists_2column('uid', user()['uid'], 'password', md5($_GET['password']));
    }