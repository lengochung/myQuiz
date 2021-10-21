<?php

    function render ($view, $data=[]) {

        extract($data);

        require Path_pro . '/sources/views/layouts/header.php';

        require Path_pro . '/sources/views/' . $view . '.php';

        require Path_pro . '/sources/views/layouts/header.php';

    }

    function route ($view) {   // Routes
        $route = require Path_pro . '/sources/controllers/routes/' . $view . '.php';
        $route.$view();
    }

    function render_role ($view, $data=[]) {

        // if(!user_logged()) header('location: ' . URL );


        // Chỉnh sửa avatar, bỏ ké ở đây
        if(isset($_POST['edit_image'])):
            if(isset($_FILES['file'])):
                $check = getimagesize($_FILES["file"]["tmp_name"]);
                if($check) {
        
                    $file = $_FILES['file']['name'];
                    move_uploaded_file($_FILES['file']['tmp_name'], Path_pro . "/sources/static/images/$file");
        
                    $uid = $_POST['edit_image'];
        
                    $conn = new Connect_MySql();
                    $users = $conn->load('users');
        
                    $users->upd_column_value('uid', $uid, 'image', $file);
                    
                    $user = $users->get_ref_table_fkey('role', 'role', 'uid', $uid);
                    
                    set_user_login($user);
        
                } else {
                    send_message('File tải lên không phải là ảnh!', 'danger');
                }
            endif;
        endif;

        extract($data);

        require Path_pro . '/sources/views/layouts/header.php';

        require Path_pro . '/sources/views/layouts/fixed.php';

        require Path_pro . '/sources/views/layouts/menu.php';

        require Path_pro . '/sources/views/layouts/centerbar.php';

        require Path_pro . '/sources/views/layouts/sidebar.php';

        require Path_pro . '/sources/views/' . $view . '.php';

        require Path_pro . '/sources/views/call_requests_server/online.php';

        require Path_pro . '/sources/views/layouts/footer.php';

    }

    function render_admin ($view, $data=[]) {

        if(!user_logged()) header('location: ' . URL );

        // Chỉnh sửa avatar, bỏ ké ở đây
        if(isset($_POST['edit_image'])):
            if(isset($_FILES['file'])):
                $check = getimagesize($_FILES["file"]["tmp_name"]);
                if($check) {
        
                    $file = $_FILES['file']['name'];
                    move_uploaded_file($_FILES['file']['tmp_name'], Path_pro . "/sources/static/images/$file");
        
                    $uid = $_POST['edit_image'];
        
                    $conn = new Connect_MySql();
                    $users = $conn->load('users');
        
                    $users->upd_column_value('uid', $uid, 'image', $file);
                    
                    $user = $users->get_ref_table_fkey_where_fetch('role', 'role', 'uid', $uid);
                    
                    set_user_login($user);
        
                } else {
                    send_message('File tải lên không phải là ảnh!', 'danger');
                }
            endif;
        endif;


        extract($data);

        require Path_pro . '/sources/views/layouts/header.php';

        require Path_pro . '/sources/views/layouts/fixed.php';

        require Path_pro . '/sources/views/layouts/menu.php';

        require Path_pro . '/sources/views/layouts/sidebar_admin.php';

        require Path_pro . '/sources/views/admin/' . $view . '.php';

        require Path_pro . '/sources/views/call_requests_server/online.php';

        require Path_pro . '/sources/views/layouts/footer.php';

    }