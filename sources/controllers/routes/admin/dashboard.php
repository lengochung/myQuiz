<?php

    function dashboard () {

        $conn = new Connect_MySql();

        $users = $conn->load('users');
        $class = $conn->load('classs');
        $nof = $conn->load('notifications');


        render_admin('dashboard', [
            'title' => 'Admin',
            'active' => 1,
            'conn' => $conn,

            

            'num_tea' => $users->count_column_value('role',2),
            'num_stu' => $users->count_column_value('role',3),
            'num_class' => $conn->load('classs')->count_all(),

            'nof_dashboard' => $nof->get_column_value_fetchAll('type', 'đã tạo mới bài thi')
        ]);
    }