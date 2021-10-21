<?php

    function settings_student () {

        $conn = new Connect_MySql();

        if(isset($_POST['update_name'])) {

            $conn->load('users')->upd_column_value('uid', user()['uid'], 'name', $_POST['name']);
            set_user_login($conn->load('users')->get_column_value_fetch('uid', user()['uid']));
        }
            

        render_role('settings_student', [
            "title" => "Tài khoản",
            "active" => 4,

            "conn" => $conn,

            "list_group" => $conn->load('class_detail')->get_ref_table_fkey_where('class', 'cid', 'uid', user()['uid']),
            "list_assign" => $conn->load('users_assigns')->get_ref_table_fkey_where('assignments', 'aid', 'uid', user()['uid']),
        ]);
    }