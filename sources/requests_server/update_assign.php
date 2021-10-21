<?php

    require '../helpers/require_for_requests_server.php';

    $conn = new Connect_MySql();

    $assigns = $conn->load('assignments');
    $nof = $conn->load('notifications');

    $start = $_GET['year'].'-'.$_GET['month'].'-'.$_GET['day'].' '.$_GET['hours'].':'.$_GET['minutes'].':0';

    $assigns->upd_column_value("aid", $_GET['aid'], "start", $start);
    $assigns->upd_column_value("aid", $_GET['aid'], "duration", $_GET['duration']);

    send_message("Chỉnh sửa ngày giờ thành công!", "success");
