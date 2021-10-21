<?php

    require '../helpers/require_for_requests_server.php';

    $conn = new Connect_MySql();
    $notifications = $conn->load('notifications');

    $notifications->insert_into(null, current_group()['cid'], user()['name'], '', $_GET['content_nof'], null);

?>