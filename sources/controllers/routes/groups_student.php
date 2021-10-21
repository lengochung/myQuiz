<?php

    function groups_student () {

        $conn = new Connect_MySql();

        $class = $conn->load('classs');
        $users = $conn->load('users');
        $class_detail = $conn->load('class_detail');
        $users_assigns = $conn->load('users_assigns');
        $notifications = $conn->load('notifications');
        $assigns = $conn->load('assignments');
        $questions = $conn->load('questions');
        $uqa = $conn->load('users_questions_assigns');

        $num_class = $class_detail->count_column_value('uid', user()['uid']);

        if($num_class > 0):
            $name_group_request_get = empty($_GET['group']) ? $class_detail->get_ref_table_fkey_where_fetch('class', 'cid', 'uid', user()['uid'])['cname'] : $_GET['group'];
            $current_group = $class->get_column_value_fetch('cname', $name_group_request_get);
            set_current_group($current_group);
        endif;

        

        render_role('groups_student', [
            'title' => 'Groups',
            "active" => 2,
            'num_class' => $num_class,
            
            'class' => $class,
            'users' => $users,
            'class_detail' => $class_detail,
            'users_assigns' => $users_assigns,
            'assigns' => $assigns,
            'questions' => $questions,
            'uqa' => $uqa
        ]);
    }