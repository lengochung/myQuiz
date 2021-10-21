<?php

    class Users_assigns extends Tables {

        protected $table = 'users_assigns';

        function get_detail_assign_student ( $cid, $uid) {
            $sql = "SELECT * FROM $this->table, assignments, class WHERE
            users_assigns.aid = assignments.aid and assignments.cid = class.cid and class.cid = '$cid' and uid = '$uid'";
			return $this->exec_fetchAll($sql);
        }
    }

