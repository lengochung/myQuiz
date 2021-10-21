<?php

    function register () {

        if(user_logged()) header('location: ' . URL . 'dashboard');

        $conn = new Connect_MySql();
        $GLOBALS['users'] = $conn->load('users');

        $GLOBALS['is_name'] = $GLOBALS['is_email'] = $GLOBALS['is_confirm'] = false;

        if(isset($_POST['submit'])) {

            $promise = new Promise();

            $promise->ready (null)
            ->then( function ($result) {

                try {
                    $GLOBALS['is_name'] = $GLOBALS['users']->exists('name', $_POST['name']);
                    return Promise::resolve($GLOBALS['is_name']);
                } catch ( Exception $th) {
                    return Promise::reject(1);
                }

            })->then( function ($result) {

                if($result)
                    return Promise::reject(2);
                else
                    return Promise::resolve([]);

            })->then( function ($result) {

                try {
                    $GLOBALS['is_email'] = $GLOBALS['users']->exists('email', $_POST['email']);
                    return Promise::resolve($GLOBALS['is_email']);
                } catch ( Exception $th) {
                    return Promise::reject(3);
                }

            })->then( function ($result) {

                if($result)
                    return Promise::reject(4);
                else
                    return Promise::resolve([]);

            })->then( function ($result) {

                if($_POST['password']!=$_POST['confirm']) {
                    $GLOBALS['is_confirm'] = true;
                    return Promise::reject(5);
                } else {
                    return Promise::resolve([]);
                }

            })->then( function ($result) {

                try {
                    $GLOBALS['users']->insert_into('Null', $_POST['name'], $_POST['email'], md5($_POST['password']), $_POST['role'], 0, '', 'default.jpg', 0);

                    return Promise::resolve([]);
                } catch (Exception $th) {
                    return Promise::reject(6);
                }

            })->then( function ($result) {

                send_message( 'Tài khoản ' . $_POST['email'] . ' đăng ký thành công!', 'success');
                header('location: ' . URL . 'login');
                return Promise::resolve([]);
                
            })->catch( function ($err) {

                switch ($err) {
                    case 1:
                        send_message('SQL Ejection trường họ tên!', 'danger');
                        break;
                    case 2:
                        send_message('Tên đã được sử dụng, hãy chọn tên khác!', 'danger');
                        break;
                    case 3:
                        send_message('SQL Ejection trường email!', 'danger');
                        break;
                    case 4:
                        send_message('Email đã tồn tại trong hệ thống!', 'danger');
                        break;
                    case 5:
                        send_message('Xác nhận mật khẩu không đúng!', 'danger');
                        break;
                    case 6:
                        send_message('Lỗi hệ thống insert into!', 'danger');
                        break;
                }
            });
        }
     

        render('register', [
            'title' => 'Đăng ký',
            'is_email' => $GLOBALS['is_email'],
            'is_name' => $GLOBALS['is_name'],
            'is_confirm' => $GLOBALS['is_confirm']
        ]);
    }