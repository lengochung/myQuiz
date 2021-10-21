<?php

    require '../helpers/require_for_requests_server.php';

    $conn = new Connect_MySql();

    $uqa = $conn->load('users_questions_assigns');

    $uqa->upd_2column_value('qid', $_GET['qid'], 'uid', user()['uid'], 'choose', $_GET['answer']);
