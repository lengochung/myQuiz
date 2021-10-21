<?php

    function login($email, $password) {
        $GLOBALS["isval"] = false;

        $conn = new Connect_MySql();

        try {
            $is_email = $conn->load("users")->exists('email', $email);
            $is_pass = $conn->load("users")->password_confirm($email, md5($password));
        } catch ( Exception $th) {
            
        }

        $promise = new Promise();

        $promise->ready ([$is_email, $is_pass])
            ->then( function ($result) {
                
                if(!$result[0]) {
                    echo "Email không tồn tại";
                    $GLOBALS["isval"] = false;
                    return Promise::reject($result[0]);
                } else 
                    return Promise::resolve($result[1]);

            })->then( function ($result) {

                if(!$result) {
                    echo "Email tồn tại, Password không đúng";
                    $GLOBALS["isval"] = false;
                    send_message("Mật khẩu không đúng!", 'danger');
                } else {
                    echo "Email tồn tại, đúng Password, ";
                    echo "Hợp lệ";
                    $GLOBALS["isval"] = true;
                    // $conn = new Connect_MySql();

                    // $users = $conn->load('users');
                    // $users->upd_user_login_and_login_at($_POST['email']);
                    // $user = $users->get_ref_table_fkey_where_fetch('role', 'role', 'email', $_POST['email']);
                    // set_user_login($user); 

                    // send_message( user()['name'] . ' đăng nhập thành công!', 'success');
                    
                }
                
            })->catch( function ($err) {
                $GLOBALS["isval"] = false;
                send_message("Email không tồn tại trong hệ thống!", 'danger');
            });

            return $GLOBALS["isval"];
    }