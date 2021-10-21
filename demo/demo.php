<?php
    
    $patt = "/\d{4}\s/" ;
    $str = "112234324";

    $isval = preg_match($patt, $str);
    var_dump($isval);

    FILTER_VALIDATE_EMAIL
?>