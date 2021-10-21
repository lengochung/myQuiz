<?php

function run () {

        require Path_pro . '/sources/models/database.php';
        require Path_pro . '/sources/models/tables.php';

        require Path_pro . '/sources/models/connect_mysql.php';

        require Path_pro . '/sources/helpers/helper.php';
        require Path_pro . '/sources/helpers/promise.php';
        require Path_pro . '/sources/helpers/crypts.php';
        require Path_pro . '/sources/helpers/mail.php';
        
        require Path_pro . '/sources/controllers/render.php';

        // Định tuyến
        Promise::resolve(null)
              ->then( function ($result) {  // Log out
                
                if(isset($_GET['logout'])):
                    $conn = new Connect_MySql();
                    $users = $conn->load('users');

                    $users->upd_user_logout(user()['email']);
                    set_user_logout();
                endif;

            })->then( function ($result) {  // Lấy view từ thanh URL
               
                $view = array_reverse(explode('/', $_SERVER['REQUEST_URI']))[1];

                if(user_logged()) {
                    if($view=='login'||$view=='register'||str_ends_with( URL, $_SERVER['REQUEST_URI'])) 
                        $view = 'dashboard';

                    return Promise::resolve($view);
                } else 
                    return Promise::reject($view);

            })->then( function ($view) {  // Đã đăng nhập, lấy route tương ứng cho role của user
            
                // routes role
                switch (user()['role']) {
                    case '1':
                        header('location: ' . URL . 'admin');
                        break;
                    case '2':
                        route($view . '_teacher');
                        break;
                    case '3':
                        route($view . '_student');
                        break;
                }

            })->then( function ($result) { // Thiết lập các Bài tập quá hạn hiện tại về mode 2
                
                $conn = new Connect_MySql();
                $assigns = $conn->load('assignments');

                foreach ($assigns->get_all() as $key => $value) {
                    $now = date_timestamp_get(new DateTime('now'));
                    $end = date_timestamp_get(new DateTime($value['start'])) + 60*$value['duration'] -5*60*60;
    
                    if($now >= $end) {
                        $assigns->upd_column_value('aid', $value['aid'], 'mode', 2);
                    }
                }

                return Promise::resolve($assigns);

            })->then( function ($result) {

                $day_min = '';
                switch (user()['role']) { // Lấy thông tin bài tập sắp diễn ra để countdown trên trình duyệt
                    case '2':
                        $day_min = $result->get_date_ofAssign_biggerThan_currentTime_toLoad('class',
                                                                        'cid','min','start','tid',user()['uid']);
                        break;
                    case '3':
                        $day_min = $result->get_date_ofAssign_biggerThan_currentTime_toLoad('users_assigns',
                                                                        'aid','min','start','uid',user()['uid']);
                        break;          
                }

                return Promise::resolve([$result, $day_min]);
            
            })->then( function ($result) { // Countdown bài tập
                
                if(user()['role']!=1&&$result[1]) {
                        
                    $assign = $result[0]->get_column_value_fetch('start', $result[1]);

                    set_load_assign($result[0]->get_column_value_fetch('aid', $assign['aid']));

                    if(load_assign()['mode']==0) {
                        require Path_pro . '/sources/views/call_requests_server/load_assignment.php';
                    } 
                }


            })->catch( function ($view) { // Chưa đăng nhập
                // Hack code
                if($view!='login'&&$view!='register') 
                    header('location: ' . URL . 'login');

                route($view);

            });

    }
    
?>