<?php

    require '../helpers/require_for_requests_server.php';
    
    Promise::resolve(null)
          ->then( function ($result) {

            $conn = new Connect_MySql();

            try {
                $user_of_class = $conn->load('class_detail')
                    ->get_ref_table_fkey_where('users', 'uid', 'cid', current_group()['cid']);
            } catch ( PDOException $th) {
                return Promise::reject(null);
            } 

            $array = [];
            foreach ($user_of_class as $key => $value) {
                array_push($array, $value['uid']);
            }

            if(count($array) == 0)
                return Promise::reject(null);
            else
                return Promise::resolve($array);

        })->then( function ($result) {

            $conn = new Connect_MySql();

            try {
                $data = $conn->load('users')->get_all_column_not_in('uid', $result);
            } catch (PDOException $th) {
                return Promise::reject(null);
            }

            return Promise::resolve($data);

        })->then( function ($result) {
            
            $keyword = empty($_GET['keyword']) ? '' : $_GET['keyword'];

            $data = [];
            foreach ($result as $key => $value) {
                $name = strtolower($value['name']);
                if((str_starts_with( $name, $keyword)||str_starts_with($value['name'], $keyword))&&$value['role']==3) {
                    array_push($data, $value);
                }
            }

            if(count($data)==0)
                return Promise::reject(null);
            else
                return Promise::resolve($data);
        })->catch( function ($err) {
            
            $conn = new Connect_MySql();

            $data = $conn->load('users')->get_column_value_fetchAll('role', 3);

            return Promise::resolve($data);

        })->finally( function ($result) {
            
            foreach ($result as $key => $value) {
                $name = $value['name'];
                echo "<option value='$name'>";
            }

        })
?>

