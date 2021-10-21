<?php

    require '../helpers/require_for_requests_server.php';

    $conn = new Connect_MySql();

    $assigns = $conn->load('assignments');

    $assigns->upd_column_value('aid', c_assign()['aid'], 'mode', 2);

    echo true;