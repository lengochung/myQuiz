<?php

    function assignments_student () {

        $conn = new Connect_MySql();

        $users_assigns = $conn->load('users_assigns');
        $assigns = $conn->load('assignments');

        // Turn in/ Nộp bài
        if(isset($_POST['turn_in'])):
            $questions = $conn->load('questions');

            $users_assigns->upd_2column_value('aid', $_POST['turn_in'], 'uid', user()['uid'], 'turn_in', 1);
            $result_ques = $questions->get_ref_table_dl_where('users_questions_assigns', 'qid', 'aid', c_assign()['aid'], 'uid', user()['uid']);

            $numR = $total = 0;
            foreach ($result_ques as $key => $value) {
                $total++;
                if($value['choose']==$value['answer']) { $numR++;}
            }

            if($total==0)
                $result_diem = 0;
            else 
                $result_diem = round((10*$numR/$total), 2);

            $users_assigns->upd_2column_value('aid', $_POST['turn_in'], 'uid', user()['uid'], 'result', $result_diem);

            send_message("Bạn đã nộp bài thành công!", 'success');
        endif;

        // Kiểm tra tồn tại asignments của sinh viên
        $exists_assigns = $users_assigns->exists('uid', user()['uid']);

        if($exists_assigns):
            $aname = empty($_GET['assignments']) ? '' : $_GET['assignments'];
            $exist_get = $assigns->exists_ref_table('class', 'cid', 'aname', $aname);

            if($exist_get):
                set_current_assignment($assigns->get_ref_table_dl_where_fetch('users_assigns', 'aid', 'uid', user()['uid'], 'aname', $aname));
            else:
                $fetch = $users_assigns->get_ref_table_fkey_where_fetch('assignments', 'aid', 'uid', user()['uid']);
                set_current_assignment($fetch);
            endif;  
            set_current_group($assigns->get_ref_table_fkey_where_fetch('class', 'cid', 'aname', c_assign()['aname']));
           
        endif;


        render_role('assignments_student', [
            'title' => 'Assignments',
            "active" => 3,

            'exists_assigns' => $exists_assigns,

            'group' => $conn->load('classs'),
            'assign' => $assigns,
            'users_assigns' => $users_assigns,
            'questions' => $conn->load('questions')
            
        ]);
    }