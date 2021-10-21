<?php

    function groups_teacher () {

        $conn = new Connect_MySql();

        $GLOBALS['class'] = $conn->load('classs');
        $GLOBALS['users'] = $conn->load('users');
        $GLOBALS['class_detail'] = $conn->load('class_detail');
        $GLOBALS['users_assigns'] = $conn->load('users_assigns');
        $notifications = $conn->load('notifications');
        $GLOBALS['nof'] = $conn->load('notifications');
        $GLOBALS['assigns'] = $conn->load('assignments');
        $GLOBALS['questions'] = $conn->load('questions');
        $GLOBALS['uqa'] = $conn->load('users_questions_assigns');


        if(isset($_POST['createclasssubmit'])):
            $class_exists = $GLOBALS['class']->exists_2column('cname', $_POST['createclass'], 'tid', user()['uid']);

            if($class_exists):
                $alert = "Lớp " . $_POST['createclass'] . " đã tồn tại!";
                Js::alert($alert);
            else:

                $GLOBALS['class']->insert_into(null, $_POST['createclass'], user()['uid'], 0, '');
                $cid = $GLOBALS['class']->max('cid');
                $GLOBALS['class']->upd_time_now('day_create', 'cid', $cid);
                
                header("location: ?group=" . $_POST['createclass']);
            endif;
        endif; 

        if(isset($_POST['deleteclass'])):
            $list_assignsOfClass = $GLOBALS['assigns']->get_column_value_fetchAll('cid', $_POST['deleteclass']);
            foreach ($list_assignsOfClass as $key => $value) {
                $GLOBALS['uqa']->delete_column_value('aid', $value['aid']);
                $GLOBALS['questions']->delete_column_value('aid', $value['aid']);
                $GLOBALS['users_assigns']->delete_column_value('aid', $value['aid']);
                $GLOBALS['assigns']->delete_column_value('aid', $value['aid']);
            }

            $GLOBALS['class_detail']->delete_column_value('cid', $_POST['deleteclass']);
            $GLOBALS['class']->delete_column_value('cid', $_POST['deleteclass']);
            $notifications->delete_column_value('cid', $_POST['deleteclass']);
            header("location: ./");
        endif; 

        

        // exists class of teacher
        $isval_exists_class = $GLOBALS['class']->exists('tid', user()['uid']);

        if($isval_exists_class):
            $name_group_request_get = empty($_GET['group']) ? $GLOBALS['class']->get_column_value_fetch('tid', user()['uid'])['cname'] : $_GET['group'];
            $current_group = $GLOBALS['class']->get_column_value_fetch('cname', $name_group_request_get);
            set_current_group($current_group);
        endif; 

        if(isset($_POST['notification'])):
            $notifications->insert_into(null, current_group()['cid'], user()['name'], '', $_POST['notifications'], null);
        endif;

        // ImportFile
        if(isset($_POST['importfile'])):
            $promise = new Promise();

            $promise->ready ($_FILES['file'])
            ->then( function ($result) {

                $filename = $result['name'];
                
                $filetype = explode('.', $filename)[1];

                if($filetype=='xlsx') 
                    return Promise::resolve($result);
                else 
                    return Promise::reject(1);

            })->then( function ($result) {
                
                $file = $result['tmp_name'];

                require Path_pro . '/sources/PHPExcel1-8/PHPExcel.php';

                $reader = PHPExcel_IOFactory::createReaderForFile($file);
            
                $data = $reader->load($file);

                $sheet = $data->getActiveSheet()->toArray(null, true, true, true);
                $highestRow = $data->setActiveSheetIndex()->getHighestRow();

                $arrray_email = [];
                for ($i = 2; $i <= $highestRow ; $i++) { 
                    if($sheet[$i]['A']!='')
                        array_push($arrray_email, $sheet[$i]['A']);
                }

                if(count($arrray_email)==0)
                    return Promise::reject(2);
                else 
                    return Promise::resolve($arrray_email);

            })->then( function ($result) {

                $array_exists = [];

                foreach ($result as $key => $email) {
                    $exists_users = $GLOBALS['users']->exists('email', $email);
                    if(!$exists_users) {
                        $GLOBALS['nof']->insert_into(null, current_group()['cid'], user()['name'], 'thêm thất bại', $email , null);
                    } else {
                        array_push($array_exists, $email);
                    }
                }
                
                if(count($array_exists)==0)
                    return Promise::reject(3);
                else
                    return Promise::resolve($array_exists);

            })->then( function ($result) {

                $arrray_users = [];

                foreach ($result as $key => $email) {
                    $user = $GLOBALS['users']->get_column_value_fetch('email', $email);
                    $exists_class_detail = $GLOBALS['class_detail']->exists( current_group()['cid'], $user['uid']);
                    
                    if(!$exists_class_detail) {
                        array_push($arrray_users, $user);
                    }
                }

                return Promise::resolve($arrray_users);
                
            })->then( function ($result) {
                
                foreach ($result as $key => $user) {
                    $GLOBALS['class_detail']->insert_into('Null', current_group()['cid'], $user['uid'], '', 0);
                    $GLOBALS['class_detail']->upd_time_now('time_in', 'cdid', $GLOBALS['class_detail']->max('cdid') );

                    $GLOBALS['nof']->insert_into(null, current_group()['cid'], user()['name'], 'đã thêm', $user['email'], null);
                }

                $total = $GLOBALS['class_detail']->count_column_value("cid", current_group()['cid']);
                $GLOBALS['class']->upd_column_value("cid", current_group()['cid'], "total", $total);

                return Promise::resolve($result);
                
            })->then( function ($result) {

                $list_assigns_of_class = $GLOBALS['assigns']->get_column_value_fetchAll('cid', current_group()['cid']);

                foreach ($list_assigns_of_class as $key => $assign) {
                        
                    $start = date_timestamp_get(new DateTime($assign['start'])) - 5*60*60;
                    
                    if($start > time()) {
                        foreach ($result as $key => $user) {
                            $GLOBALS['users_assigns']->insert_into(null, $user['uid'], $assign['aid'], 0, null, 0);

                            $listquestions = $GLOBALS['questions']->get_column_value_fetchAll('aid', $assign['aid']);
                            foreach ($listquestions as $key => $question) {
                                $GLOBALS['uqa']->insert_into(null, $assign['aid'], $user['uid'], $question['qid'], 'none');
                            }
                        }
                    }
                }

                return Promise::resolve(count($result));
                
            })->then( function ($result) {
                
                send_message("$result dòng được thực thi, xem chi tiết ở phần Thông báo!", 'success');
                return Promise::resolve(null);

            })->catch(function ($err) {

                switch ($err) {
                    case 1:
                        send_message("Vui lòng nhập file '.xlsx'!", 'danger');
                        break;
                    case 2:
                        send_message("Vui lòng nhập email ở cột A trong file excel!", 'danger');
                        break;  
                    case 3:
                        send_message("0 dòng được thực thi, các email phải tồn tại trên hệ thống!", 'danger');
                        break;  
                }
            });

        endif;

        $namestudent = empty($_GET['namestudent']) ? '' : $_GET['namestudent'];
        
        render_role('groups_teacher', [
            'title' => 'Groups',
            "active" => 2,

            'class' => $GLOBALS['class'],
            'users' => $GLOBALS['users'],
            'class_detail' => $GLOBALS['class_detail'],
            'users_assigns' => $GLOBALS['users_assigns'],

            'namestudent' => $namestudent,
            'isvalgroup' => $isval_exists_class
        ]);
    }