<?php

    function cut ($input, $num) {
        if(strlen($input) > $num)
            return substr($input,0, $num) . " ...";
        else
            return substr($input,0, $num);

    }


    class Js {

        public static function alert ($content) {
            echo "<script>window.alert('$content')</script>";
        }
    }