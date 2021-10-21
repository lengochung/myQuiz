<?php

    require '../helpers/require_for_requests_server.php';

    $conn = new Connect_MySql();

    $questions = $conn->load('questions');

    $questions->upd_column_value('qid', $_GET['qid'], 'answer', $_GET['answer']);

    // header('location: ./');