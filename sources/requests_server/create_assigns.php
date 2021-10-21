<?php

    require '../helpers/require_for_requests_server.php';

    $conn = new Connect_MySql();

    $assigns = $conn->load('assignments');
    $class = $conn->load('classs');
    $users_assigns = $conn->load('users_assigns');
    $nof = $conn->load('notifications');

    $exists = $assigns->exists_2column('cid', current_group()['cid'], 'aname', $_GET['aname']);

    if($exists):
        send_message('Thất bại! Tên bài thi bị trùng, vui lòng chọn tên khác!', 'danger');
    else:
        $time_str = $_GET['year'].'-'.$_GET['month'].'-'.$_GET['day'].' '.$_GET['hours'].':'.$_GET['minutes'].':0';

        $dotime = date_timestamp_get(new DateTime($time_str)) ;
       
        $list = $assigns->get_column_value_fetchAll('cid', current_group()['cid']);

        $isval = true;
        foreach ($list as $key => $value) {
            $time_match = date_timestamp_get(new DateTime($value['start']));
            $start_match = $time_match - $_GET['duration']*60;
            $end_match = $time_match + $value['duration']*60;
            
            if($dotime > $start_match && $dotime < $end_match) {
                $isval = false; 
                break;
            } 
        }
        
        if($isval) {
            $assigns->insert_into(null, current_group()['cid'], $time_str, $_GET['duration'], 0, $_GET['aname'], $_GET['now']);        

            $nof->insert_into(null, current_group()['cid'], user()['name'], 'đã tạo mới bài thi', $_GET['aname'], null);

            $students = $class->get_ref_table_fkey_where('class_detail', 'cid', 'cid', current_group()['cid']);

            $aid = $assigns->max('aid');

            foreach ($students as $key => $value) {
                $users_assigns->insert_into(null, $value['uid'], $aid, 0, null, 0);
            }

            send_message("Thêm thành công nhiệm vụ " . "<b>" . $_GET['aname'] . '</b>', 'success');
        } else {
            send_message('Thất bại! Thời gian làm bài bị trùng với bài thi khác trong lớp! (chỉ một bài thi trong lớp diễn ra trong một thời điểm', 'danger');
        }
    endif;




    if(recieved_message()) echo message();