<?php

    function teachers () {

        $conn = new Connect_MySql();

        $GLOBALS['users'] = $conn->load('users');

        // Thiết lập user sinh viên về check 0 kẻo bị xóa oan uổng
        $conn->load('users')->upd_column_value('role', 3, 'checked', 0);

        // Add sinh viên
        if(isset($_POST['add'])) {
           
            Promise::resolve($conn)
                  ->then( function ($result) {
                    
                    if(!preg_match("/\s+/", $_POST['name']))
                        return Promise::reject([1,1]);

                })->then( function ($result) {
                    
                    if(preg_match("/[0-9!@#$%^&*()-=+]/", $_POST['name']))
                        return Promise::reject([2,1]);

                })->then( function ($result) {
                    
                    if(!preg_match("/(gmail\.com)$/", $_POST['email'])&&!preg_match("/(stu\.itc\.edu\.vn)$/", $_POST['email']))
                        return Promise::reject([3,2]);
                })->then( function ($result) {

                    $exists = $result->load("users")->exists("email", $_POST["email"]);
                    if($exists==true)
                        return Promise::reject([4,1]);
       
                })->then( function ($result) {

                    $result->load("users")->insert_into($_POST['uid'], $_POST['name'], $_POST["email"], md5("12345678"), 2, 0, null, "default.jpg", 0);
                    $name = $_POST['name'];
                    send_message("<a href=''><small><b>$name</b></small></a> đã được thêm vào hệ thống! Mật khẩu mặc định của hệ thống là '12345678'", "success");

                })->catch( function ($err) { 
                    switch ($err[0]) {
                        case 1:
                            send_message("Vui lòng nhập đầy đủ họ tên", "danger");
                            break;
                        case 2:
                            send_message("Tên không chứa ký tự số, ký tự đặc biệt!", "danger");
                            break;
                        case 3:
                            send_message("Hệ thống chỉ hỗ trợ tên miền stu.itc.edu.vn và gmail.com, vui lòng chỉnh sửa email!", "danger");
                            break;
                        case 4:
                            send_message("Email đã được sử dụng, vui lòng nhập email khác!", "danger");
                            break;
                    }
                });
        }
        
        // Import
        if(isset($_POST['submit'])):

            $promise = new Promise();

            $promise
                  ->ready ($_FILES['file']) // Ready
                  ->then( function ($result) { // Kiểm tra đuôi file

                    $filetype = explode('.', $result['name'])[1];

                    if($filetype!='xlsx')
                        return Promise::reject(1);

                })->then( function ($result) { // Lọc dữ liệu mỗi dòng excel không rỗng
                    
                    $file = $result['tmp_name'];

                    require Path_pro . '/sources/PHPExcel1-8/PHPExcel.php';

                    $reader = PHPExcel_IOFactory::createReaderForFile($file);
                
                    $data = $reader->load($file);
    
                    $sheet = $data->getActiveSheet()->toArray(null, true, true, true);
                    $highestRow = $data->setActiveSheetIndex()->getHighestRow();

                    $GLOBALS['row'] = $highestRow - 1;

                    $array = [];
                    for ( $i = 2; $i <= $highestRow ; $i++) { 
                        if($sheet[$i]['A']!=''&&$sheet[$i]['B']!='') {
                            array_push($array, $sheet[$i]);
                        }
                    }

                    if(count($array)==0)
                        return Promise::reject(2);
                    else
                        return Promise::resolve($array);

                })->then( function ($result) { // Lọc ra các dòng chưa tồn tại trong CSDL

                    $array = [];
                    foreach ($result as $key => $row) {
                        $is_name = $GLOBALS['users']->exists('name', $row['A']);
                        $is_email = $GLOBALS['users']->exists('email', $row['B']);

                        if(!$is_name&&!$is_email)
                            array_push($array, $row);
                    }

                    if(count($array)==0)
                        return Promise::reject(3);
                    else
                        return Promise::resolve($array);

                })->then( function ($result) { // Chèn vào csdl
                    
                    foreach ($result as $key => $row) {
                        $GLOBALS['users']->insert_into('Null', $row['A'], $row['B'], md5('12345678'), 2, 0, '', 'default.jpg', 0);
                    }

                })->then( function ($result) {

                    $failed = $GLOBALS['row'] - count($result);

                    send_message( "<span class='text-danger'>$failed dòng thất bại, </span>" .
                        count($result) . " dòng đã thực thi thành công, 
                        mật khẩu đăng nhập là '12345678' cho mỗi tài khoản", 'success');

                })->catch( function ($err) {

                    switch ($err) {
                        case 1:
                            send_message("Vui lòng nhập file '.xlsx'!", 'danger');
                            break;
                        case 2:
                            send_message("Vui lòng nhập tên ở cột A, email ở cột B trong file excel!", 'danger');
                            break;
                        case 3:
                            send_message("Thất bại! Các tài khoản trong file excel đã tồn tại trên hệ thống!", 'danger');
                            break;
                    }
                            
                });
        endif;

        // Bỏ chọn
        if(isset($_POST['check_none_all'])) {
            $conn->load('users')->upd_column_value('checked', 1, 'checked', 0);
        }

        // Xóa
        if(isset($_POST['del_check'])) {
            $arr_del = $conn->load('users')->get_column_value_fetchAll('checked', 1);

            foreach ($arr_del as $key => $teacher) {
                $conn->load("classs")->upd_column_value("tid", $teacher['uid'], "tid", 1);
                $conn->load("users")->delete_column_value('uid', $teacher['uid']);
            }

            send_message("Đã xóa " . count($arr_del) . " giáo viên khỏi hệ thống!", "success");
        }

        // Lọc UID
        // $ids = [];
        // foreach ($conn->load("users")->get_all() as $key => $value) {
            
        // }
        $ids = [];
        $id_max = $conn->load("users")->max("uid");
        for ($i = 1; $i <= $id_max ; $i++) { 
            $dem = 0;
            foreach ($conn->load("users")->get_all() as $key => $user) {
                if($i==$user['uid']) $dem++;
            }

            if($dem==0) array_push($ids, $i);
        }

        // Phân trang
        $log = empty($_GET['log']) ? 1 : $_GET['log'];
        $limit = 10;
        $index = ($log - 1)*$limit;

        // Sắp xếp
        if(isset($_SESSION['sort'])) {
            $list = $conn->load("users")->get_column_value_i_limit_asc('role', 2, $_SESSION['sort'], $index, $limit);
        } else {
            $list = $conn->load("users")->get_column_value_i_limit_asc('role', 2, 'uid', $index, $limit);
        }

        // Render
        render_admin('teachers', [
            'title' => 'Admin', //$title
            'active' => 3,      //$active

            "conn" => $conn,

            "ids" => $ids,

            'list' => $list,
            'num_logs' => ceil($conn->load("users")->count_column_value('role', 2)/$limit),
            'log' => $log
        ]);
    }