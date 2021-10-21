<?php

    require '../helpers/require_for_requests_server.php';

    $conn = new Connect_MySql();

    $assigns = $conn->load('assignments');

    

    $start = date_timestamp_get(new DateTime(load_assign()['start'])) - 5*60*60;
    $end = $start + load_assign()['duration']*60;

    $now = date_timestamp_get(new DateTime('now'));

    if($now >= $start && $now <= $end) {
        $assigns->upd_column_value('aid', load_assign()['aid'], 'mode', 1);
        echo true;
    } else {
        echo false;
    }
