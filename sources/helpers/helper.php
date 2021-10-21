<?php
    
    function user_logged () {
        if(!isset($_SESSION['user'])||$_SESSION['user']=='')
            return false;
        return true;
    }

    function set_user_login ($user) {
        $_SESSION['user'] = $user;
    }

    function set_user_logout () {
        unset($_SESSION['user']);
    }

    function user () {
        return $_SESSION['user'];
    }

    // 

    function recieved_message () {
        if(!isset($_SESSION['message'])||$_SESSION['message']=='')
            return false;
        return true;
    }

    function send_message ($content, $class) {
        $_SESSION['message'] = "<div class='alert alert-$class'>$content</div>";
    }

    function message () {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
        return $message;
    }

    // 

    function request_post($name) {
        if(isset($_POST['submit']))
            return $_POST[$name];
        return "";
    }

    // 

    function set_current_group ($current_group) {
        $_SESSION['current_group'] = $current_group;
    }

    function current_group () {
        return $_SESSION['current_group'];
    }
    
    function set_current_assignment ($current_group) {
        $_SESSION['current_assignment'] = $current_group;
    }

    function c_assign () {
        return $_SESSION['current_assignment'];
    }

    function set_list_questions ($list_questions) {
        $_SESSION['list_questions'] = $list_questions;
    }

    function list_questions () {
        return $_SESSION['list_questions'];
    }

    function set_load_assign ($load_assign) {
        $_SESSION['load_assign'] = $load_assign;
    }

    function unset_load_assign () {
        unset($_SESSION['load_assign']);
    }

    function load_assign () {
        return $_SESSION['load_assign'];
    }

    function set_email_forgot ($load_assign) {
        $_SESSION['email_forgot'] = $load_assign;
    }

    function unset_email_forgot () {
        unset($_SESSION['email_forgot']);
    }

    function email_forgot () {
        if(isset($_SESSION['email_forgot']))
            return $_SESSION['email_forgot'];
        return '';
    }


    