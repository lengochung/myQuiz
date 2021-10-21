<?php

    class Notifications extends Tables {

        protected $table = 'notifications';

        function insert_into(...$values) {
			$sql = "INSERT into $this->table values (";

			foreach ($values as $key => $value) {
				$sql = $sql . " '$value',";
			}

			$sql = substr_replace($sql,'', strlen($sql)-1) . ")";
			$query = $this->db->query($sql);

			$nid_update = $this->max('nid');

            $this->upd_time_now('time', 'nid', $nid_update);
		}
        
    }