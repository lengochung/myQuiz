<?php

    require '../helpers/require_for_requests_server.php';

    $conn = new Connect_MySql();

    $users = $conn->load('users');
    $class_detail = $conn->load('class_detail');
    $assigns = $conn->load('assignments');
    $users_assigns = $conn->load('users_assigns');
    $uqa = $conn->load('users_questions_assigns');
    $questions = $conn->load('questions');

    $name = empty($_GET['name']) ? '' : $_GET['name'];

    $exists = $users->exists('name', $name);


    if($exists) :
        $uid = $users->get_column_value_fetch('name', $name);
        $exists = $class_detail->exists_2column('uid', $uid['uid'], 'cid', current_group()['cid']);

        if(!$exists):
            // Insert into class_detail and update total
            $class_detail->insert_into('Null', current_group()['cid'], $uid['uid'], '', 0);
            $class_detail->upd_time_now('time_in', 'cdid', $class_detail->max('cdid') );
            $total = $class_detail->count_column_value("cid", current_group()['cid']);
            $conn->load("classs")->upd_column_value("cid", current_group()['cid'], "total", $total);

            $assignOfClass = $assigns->get_column_value_fetchAll('cid', current_group()['cid']);

            foreach ($assignOfClass as $key => $value) {
                $start = date_timestamp_get(new DateTime($value['start'])) - 5*60*60;
                if($start > time()) {
                    $users_assigns->insert_into(null, $uid['uid'], $value['aid'], 0, null, 0);

                    $listquestions = $questions->get_column_value_fetchAll('aid', $value['aid']);
                    foreach ($listquestions as $key => $question) {
                        $uqa->insert_into(null, $value['aid'], $uid['uid'], $question['qid'], 'E');
                    }
                }
            }

            $nof = $conn->load('notifications');
            $nof->insert_into(null, current_group()['cid'], user()['name'], 'đã thêm', $uid['name'], null);

            send_message("Đã thêm <small><b><i>$name</i></b></small> vào lớp", 'success');
        else:
            send_message("<small><b><i>$name</i></b></small> đã có trong lớp!", 'danger');
        endif;
    else:
        send_message("<small><b><i>$name</i></b></small> không tồn tại trong hệ thống!", 'danger');
    endif;

    if(recieved_message()) echo message();
    
?>

    

