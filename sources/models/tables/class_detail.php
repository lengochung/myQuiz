<?php

    class Class_detail extends Tables {

        protected $table = 'class_detail';

        function exists($cid, $uid) {
            $sql = "SELECT if(count(*) > 0, true, false) 
                from $this->table where cid = :cid and uid = :uid";
            
            $sth = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute([
                ':cid' => $cid, ':uid' => $uid
            ]);

            return $sth->fetchColumn();
        }

    }