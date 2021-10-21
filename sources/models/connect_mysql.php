<?php

    class Connect_MySql {

        function load($table)
        {
            $path_table = Path_pro . '/sources/models/tables/' . $table . '.php';
            if(!file_exists($path_table))
                exit("File $table not found");

            require_once $path_table;

            $name_table = ucfirst($table);

            return new $name_table;
        }
    }