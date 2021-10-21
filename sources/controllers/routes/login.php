<?php
    
    function login () {

        $conn = new Connect_MySql();

        $users = $conn->load('users');

        if(isset($_POST['forgot'])) {

            set_email_forgot($_POST['email']);
            $exists = $conn->load('users')->exists('email', email_forgot());

            if($exists) {
                header("location: ?forgotpassword&confirm");
            
            } else
                send_message("Email không tồn tại trong hệ thống!", "danger");
        }
        
        if(isset($_POST['cfm_code'])) {

            if($_SESSION['cfm_code']==$_POST['code']) {
                $reset = "reset" . rand(10,99) . "pw" . rand(10,99);
                $users->upd_column_value('email', email_forgot(), 'password', md5($reset));

                Mail::send_reset_password(email_forgot(), $reset);
                unset_email_forgot();

            } else
                send_message("Không đúng, chúng tôi đang gửi lại mã cho bạn!", "primary");
        }




        $is_email = $is_pass = false;

        if(isset($_POST['submit'])):

            set_email_forgot($_POST['email']);

            try {
                $is_email = $users->exists('email', $_POST['email']);
                $is_pass = $users->password_confirm($_POST['email'], md5($_POST['password']));
            } catch ( Exception $th) {
                
            }

            $promise = new Promise();

            $promise->ready ([$is_email, $is_pass])
                ->then( function ($result) {
                    
                    if(!$result[0]) {
                        return Promise::reject($result[0]);
                    } else 
                        return Promise::resolve($result[1]);

                })->then( function ($result) {

                    if(!$result) {
                        send_message("Mật khẩu không đúng!", 'danger');
                    } else {
                        $conn = new Connect_MySql();

                        $users = $conn->load('users');
                        $users->upd_user_login_and_login_at($_POST['email']);
                        $user = $users->get_ref_table_fkey_where_fetch('role', 'role', 'email', $_POST['email']);
                        set_user_login($user); 

                        send_message( user()['name'] . ' đăng nhập thành công!', 'success');
                        
                    }
                    
                })->catch( function ($err) {
                    send_message("Email không tồn tại trong hệ thống!", 'danger');
                });
        endif;

        if(user_logged()) {

            switch (user()['role']) {
                case '1':
                    header('location: ' . URL . 'admin');
                    break;
                
                default:
                header('location: ' . URL . 'dashboard');
                    break;
            }
        }
        
        render('login', [
            'title' => 'Đăng nhập',
            'is_email' => $is_email,
            'is_pass' => $is_pass
        ]);
    }
?>