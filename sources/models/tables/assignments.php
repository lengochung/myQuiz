<?php

    class Assignments extends Tables {

        protected $table = 'assignments';

        function get_date_ofAssign_smallerThan_currentTime_toLoad ($table, $fkey, $minOrmax, $col_day, $column, $value ) {
            $sql = "SELECT $minOrmax($col_day) from $this->table this, $table t where
                this.$fkey = t.$fkey and $col_day > CURRENT_TIMESTAMP and $column = '$value'";
            return $this->exec_fetchColumn($sql);
        }

        function get_date_ofAssign_biggerThan_currentTime_toLoad ($table, $fkey, $minOrmax, $col_day, $column, $value ) {
            $sql = "SELECT $minOrmax($col_day) from $this->table this, $table t where
                this.$fkey = t.$fkey and $col_day > CURRENT_TIMESTAMP and $column = '$value'";
            return $this->exec_fetchColumn($sql);
        }

        
    }