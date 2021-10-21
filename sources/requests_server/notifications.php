<?php

    require '../helpers/require_for_requests_server.php';

    $conn = new Connect_MySql();
    $notifications = $conn->load('notifications');
    
    
?>

<?php
    $i = 1;
    foreach ($notifications->get_column_value_desc('cid', current_group()['cid'], 'time') as $key => $value) :
      $time = getdate(date_timestamp_get(new DateTime($value['time']))); 
?>

    <small>
        <a href="">
            <b><?php echo $value['owner']; ?></b>
        </a> <?php if($i==1) echo '<i>mới nhất</i>'; ?> 
       <i class=" float-right">
            lúc <?php if($time['hours']<10) {echo '0'.$time['hours'];} else {echo $time['hours'];} ?>:<?php if($time['minutes']<10) {echo '0'.$time['minutes'];} else {echo $time['minutes'];} ?>
            ngày <?php if($time['mday']<10) {echo '0'.$time['mday'];} else {echo $time['mday'];} ?>/<?php if($time['mon']<10) {echo '0'.$time['mon'];} else {echo $time['mon'];} ?>
       </i>
    </small> <br>
<?php 
        switch ($value['type']) :
          case '': ?>
                <div class="ml-5"><?php echo $value['content']; ?></div>
<?php
            break;
            case 'đã xóa':
?>           
                <div class="ml-5">
                    <small class="text-secondary"><b><i><?php echo $value['type']; ?></i></b></small>
                    <small>
                        <a href=""><?php echo $value['content']; ?></a> <i>ra khỏi lớp</i>
                    </small>
                </div>
<?php
            break;
            case 'đã thêm':
?>
                <div class="ml-5">
                    <small class="text-success"><b><i><?php echo $value['type']; ?></i></b></small>
                    <small>
                        <a href=""><?php echo $value['content']; ?></a> <i>vào lớp</i>
                    </small>
                </div>
<?php
            break;
            case 'đã tạo mới bài thi':
?>
                <div class="ml-5">
                    <small class="text-secondary"><b><i><?php echo $value['type']; ?></i></b></small>
                    <small>
                        <a href=""><?php echo $value['content']; ?></a>
                    </small>
                </div>       
<?php
            break;
            case 'thêm thất bại':
?>
                <div class="ml-5">
                    <small class="text-danger"><b><i><?php echo $value['type']; ?></i></b></small>
                    <small>
                        <a href=""><?php echo $value['content']; ?></a>
                    </small>
                    <small><i>vì chưa tồn tại trong hệ thống    </i></small>
                </div>
<?php
            break;
            case 'đã xóa bài thi':
?>
                <div class="ml-5">
                    <small class="text-danger"><b><i><?php echo $value['type']; ?></i></b></small>
                    <small>
                        <b><?php echo $value['content']; ?></b>
                    </small>
                </div>
<?php
            break;
        endswitch;
        $i++;
    endforeach;
?>

