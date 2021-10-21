<?php

    class Users extends Tables {

        protected $table = 'users';

        function password_confirm($email, $password) {
            $sql = "SELECT if(count(*) > 0, true, false) 
                from $this->table where email = :email and password = :password";
            
            $sth = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute([
                ':email' => $email, ':password' => $password
            ]);

            return $sth->fetchColumn();
        }

        function upd_user_login_and_login_at ($email) { 
            $sql = "UPDATE $this->table set login_at = CURRENT_TIMESTAMP, login = 1  WHERE email = '$email'";

            $exec = $this->exec_fetch($sql);
        }

        function upd_user_logout ($email) { 
            $sql = "UPDATE $this->table set login = 0  WHERE email = '$email'";

            $exec = $this->exec_fetch($sql);
        }
    }