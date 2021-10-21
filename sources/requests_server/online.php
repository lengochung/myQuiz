<?php

    require '../helpers/require_for_requests_server.php';

    $conn = new Connect_MySql();
    $users = $conn->load('users');

    foreach ($users->get_all() as $key => $value) : 
        if($value['login']&&$value['uid']!=user()['uid']) :
?>
        <h6 class="dropdown-header pb-0 pt-0 text-light">
            <img src="../sources//static/images/<?php echo $value['image']; ?>" 
                width="20px" height="20px" class="rounded-circle"> 
            <?php
             echo $value['name']; 
            ?>
            <span class="rounded-circle bg-success" 
                style="width: 10px; height: 10px; display: block; position: relative; top: -5px; left: 15px;">
            </span>
        </h6>
<?php 
        endif;
    endforeach; 
?>

