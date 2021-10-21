<?php

class Tables extends Database {

    function get_all() {
        $sql = "SELECT * from $this->table";
        return $this->exec_fetchAll($sql);
    }

    function exists($column, $value) {
        $sql = "SELECT if(count(*) > 0, true, false) from $this->table where $column = '$value'";
        return $this->exec_fetchColumn($sql);
    }
    function exists_2column($column1, $value1, $column2, $value2) {
        $sql = "SELECT if(count(*) > 0, true, false) from $this->table where $column1 = '$value1' and $column2 = '$value2'";
        return $this->exec_fetchColumn($sql);
    }

    function exists_ref_table($table, $fkey, $column, $value) {
        $sql = "SELECT if(count(*) > 0, true, false) from $this->table this, $table t 
            where this.$fkey = t.$fkey and $column = '$value'";
        return $this->exec_fetchColumn($sql);
    }

    function get_column_value_i_limit_desc ($col, $value, $desc, $index, $limit) {
        $sql  = "SELECT * from $this->table where $col = '$value'
                    order by $desc desc limit $index, $limit";
        return $this->exec_fetchAll($sql);
    }

    function get_column_value_i_limit_asc ($col, $value, $asc, $index, $limit) {
        $sql  = "SELECT * from $this->table where $col = '$value'
                    order by $asc asc limit $index, $limit";
        return $this->exec_fetchAll($sql);
    }

    function get_column_value_desc ($column, $value, $desc) {
        $sql  = "SELECT * from $this->table where $column = '$value' order by $desc desc";
        return $this->exec_fetchAll($sql);
    }

    function get_column_value_asc ($column, $value, $asc) {
        $sql  = "SELECT * from $this->table where $column = '$value' order by $asc asc";
        return $this->exec_fetchAll($sql);
    }

    function get_column_value_fetchAll ($column, $value) {
        $sql = "SELECT * from $this->table where $column = '$value'";
        return $this->exec_fetchAll($sql);
    }

    function get_column_value_fetch ($column, $value) {
        $sql = "select * from $this->table where $column = '$value'";
        return $this->exec_fetch($sql);
    }

    function get_ref_table_fkey_where_fetch ( $table, $foreign_key, $column, $value) {
    
        $sql = "SELECT * from $this->table this, $table t where this.$foreign_key = t.$foreign_key and this.$column = '$value'";
        return $this->exec_fetch($sql);
    }

    function get_ref_table_fkey_where ( $table, $foreign_key, $column, $value) {
    
        $sql = "SELECT * from $this->table this, $table t where this.$foreign_key = t.$foreign_key and this.$column = '$value'";
        return $this->exec_fetchAll($sql);
    }

    function get_ref_table_fkey_where_asc ( $table, $foreign_key, $column, $value, $asc) {
    
        $sql = "SELECT * from $this->table this, $table t where this.$foreign_key = t.$foreign_key and this.$column = '$value' order by $asc asc";
        return $this->exec_fetchAll($sql);
    }

    function get_ref_table_fkey_where_desc ( $table, $foreign_key, $column, $value, $desc) {
    
        $sql = "SELECT * from $this->table this, $table t where this.$foreign_key = t.$foreign_key and this.$column = '$value' order by $desc desc";
        return $this->exec_fetchAll($sql);
    }

    function get_ref_table_fkeys ( $table, $foreign_key) {
    
        $sql = "select * from $this->table this, $table t where this.$foreign_key = t.$foreign_key";
        return $this->exec_fetchAll($sql);
    }

    function get_ref_dl_table_where ( $table1, $fk1, $table2, $fk2, $col, $value) {
    
        $sql = "SELECT * from $this->table this, $table1 t1, $table2 t2 
            where this.$fk1 = t1.$fk1 and t1.$fk2 = t2.$fk2 and $col = '$value'";
        return $this->exec_fetchAll($sql);
    }

    function get_ref_dl_table_where_orderby ( $table1, $fk1, $table2, $fk2, $col, $value, $orderby, $descOrasc) {
    
        $sql = "SELECT * from $this->table this, $table1 t1, $table2 t2 
            where this.$fk1 = t1.$fk1 and t1.$fk2 = t2.$fk2 and $col = '$value' order by $orderby $descOrasc";
        return $this->exec_fetchAll($sql);
    }

    function get_ref_table_dl_where ( $table, $fk, $col1, $value1, $col2, $value2) {
    
        $sql = "SELECT * from $this->table this, $table t 
            where this.$fk = t.$fk and t.$col1 = '$value1' and $col2 = '$value2'";
        return $this->exec_fetchAll($sql);
    }

    function get_ref_table_dl_where_fetch ( $table, $fk, $col1, $value1, $col2, $value2) {
    
        $sql = "SELECT * from $this->table this, $table t 
            where this.$fk = t.$fk and t.$col1 = '$value1' and $col2 = '$value2'";
        return $this->exec_fetch($sql);
    }

    function insert_into(...$values) {
        $sql = "INSERT into $this->table values (";

        foreach ($values as $key => $value) {
            $sql = $sql . " '$value',";
        }

        $sql = substr_replace($sql,'', strlen($sql)-1) . ")";

        $query = $this->db->query($sql);
        $query->closeCursor();
    }

    // Update
    function upd_column_value ($col, $value, $set, $val_set) {
        $sql = "UPDATE $this->table set $set = '$val_set' where $col = '$value'";
        $query = $this->db->query($sql);
        $query->closeCursor();
    }

    function upd_2column_value ($where1, $value1, $where2, $value2, $column, $value) {
        $sql = "UPDATE $this->table set $column = '$value' where $where1 = '$value1' and $where2 = '$value2'";
        $query = $this->db->query($sql);
        $query->closeCursor();
    }

    // count
    function count_all () {
        $sql = "SELECT count(*) from $this->table";
        return $this->exec_fetchColumn($sql);
    }

    function count_column_value ($column, $value) {
        $sql = "SELECT count(*) from $this->table where $column = '$value'";
        return $this->exec_fetchColumn($sql);
    }

    function get_all_column_in ($column, $array) {
        $values = "(";
        foreach ($array as $key => $value) {
            $values = $values . " '$value',";
        }

        $values = substr_replace($values,'', strlen($values)-1) . ")";

        $sql = "SELECT * from $this->table where $column in $values";
        return $this->exec_fetchAll($sql);
    }
    function get_all_column_not_in ($column, $array) {
        $values = "(";
        foreach ($array as $key => $value) {
            $values = $values . " '$value',";
        }

        $values = substr_replace($values,'', strlen($values)-1) . ")";

        $sql = "SELECT * from $this->table where $column not in $values";
        return $this->exec_fetchAll($sql);
    }

    function upd_time_now ($upd_col, $column, $value ) {
        $sql = "UPDATE $this->table set $upd_col = CURRENT_TIMESTAMP where $column = '$value'";
        $this->db->query($sql);
    }

    function max ($column ) {
        $sql = "SELECT max($column) from $this->table";
        return $this->exec_fetchColumn($sql);
    }
    function min ($column ) {
        $sql = "SELECT min($column) from $this->table";
        return $this->exec_fetchColumn($sql);
    }

    function get_date_biggerThan_currentTime ($minOrmax, $column) {
        $sql = "SELECT $minOrmax($column) from $this->table where $column > CURRENT_TIMESTAMP";
        return $this->exec_fetchColumn($sql);
    }

    function get_date_smallerThan_currentTime ($minOrmax, $column) {
        $sql = "SELECT $minOrmax($column) from $this->table where $column < CURRENT_TIMESTAMP";
        return $this->exec_fetchColumn($sql);
    }

    function get_date_biggerThan_currentTime_where ($minOrmax, $col_day, $column, $value ) {
        $sql = "SELECT $minOrmax($col_day) from $this->table where $col_day > CURRENT_TIMESTAMP and $column = '$value'";
        return $this->exec_fetchColumn($sql);
    }

    function get_date_smallerThan_currentTime_where ($minOrmax, $col_day, $column, $value ) {
        $sql = "SELECT $minOrmax($col_day) from $this->table where $col_day < CURRENT_TIMESTAMP and $column = '$value'";
        return $this->exec_fetchColumn($sql);
    }
    

    function delete_column_value ( $column, $value ) {
        $sql = "DELETE from $this->table where $column = '$value'";
        $this->db->query($sql);
    }

    function delete_dl_column_value ( $column1, $value1, $column2, $value2 ) {
        $sql = "DELETE from $this->table where $column1 = '$value1' and $column2 = '$value2'";
        $this->db->query($sql);
    }

    //  Random
    function get_random () {
        $sql = "SELECT * from $this->table order by rand()";
        return $this->exec_fetchAll($sql);
    }

    function get_random_column_value ($col, $value) {
        $sql = "SELECT * from $this->table where $col = '$value' order by rand()";
        return $this->exec_fetchAll($sql);
    }
    
}