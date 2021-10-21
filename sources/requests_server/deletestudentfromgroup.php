<?php

    require '../helpers/require_for_requests_server.php';

    $conn = new Connect_MySql();

    $class_detail = $conn->load('class_detail');
    $users_assigns = $conn->load('users_assigns');
    $notifications = $conn->load('notifications');
    $users = $conn->load('users');
    $uqa = $conn->load('users_questions_assigns');
    
    $uid = empty($_GET['uid']) ? 0 : $_GET['uid'];

    $user = $users->get_column_value_fetch('uid', $uid);
    $name = $user['name'];

    $detail_assigns = $users_assigns->get_detail_assign_student( current_group()['cid'] , $uid);

    foreach ($detail_assigns as $key => $value) {
        $users_assigns->delete_column_value('uaid', $value['uaid']);
        $uqa->delete_dl_column_value('aid', $value['aid'], 'uid', $uid);
    }

    $class_detail->delete_dl_column_value('cid', current_group()['cid'], 'uid', $uid);
    $total = $conn->load("classs")->count_column_value("cid", current_group()['cid']);
    $conn->load("classs")->upd_column_value("cid", current_group()['cid'], "total", $total);

    $notifications->insert_into(null, current_group()['cid'], user()['name'], 'đã xóa', $name, null);

    send_message("Xóa <small><b><i>$name</i></b></small> thành công", 'success');

    if(recieved_message()) echo message();
    
?>