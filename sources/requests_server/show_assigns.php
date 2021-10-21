<?php

    require '../helpers/require_for_requests_server.php';

    $conn = new Connect_MySql();

    $assigns = $conn->load('assignments');

    $list = $assigns->get_column_value_fetchAll('cid', current_group()['cid']);
?>
<!-- <small><b>Danh sách nhiệm vụ/bài thi trong lớp</b></small> -->
<div class="">
    <?php foreach($list as $key => $value): ?>
        <div class="pt-1 border-top pb-2">
            <a href="../assignments/?assignments=<?php echo $value['aname']; ?>&group=<?php echo current_group()['cname']; ?>" class="text-secondary"><?php echo $value['aname']; ?></a>
            <?php 
                    switch($value['mode']) :
                     case '0':
                ?>
                    <small class="text-danger"><i>Sắp diễn ra</i></small>
                <?php 
                    break;  
                    case '1': 
                ?>
                    <small class="text-primary"><i>Đang diễn ra</i></small>
                <?php
                     break; 
                     default: 
                     
                ?>
                    <small class="text-success"><i>Đã kết thúc</i></small>
                <?php break; ?>
            <?php endswitch; ?>
            
            <small class="float-right">
            <?php $day_create = getdate(date_timestamp_get(new DateTime($value['create_at']))); ?>
                <i>
                Được tạo lúc <?php if($day_create['hours']<10) {echo '0'.$day_create['hours'];} else {echo $day_create['hours'];} ?>:<?php if($day_create['minutes']<10) {echo '0'.$day_create['minutes'];} else {echo $day_create['minutes'];} ?>
                ngày <?php if($day_create['mday']<10) {echo '0'.$day_create['mday'];} else {echo $day_create['mday'];} ?>/<?php if($day_create['mon']<10) {echo '0'.$day_create['mon'];} else {echo $day_create['mon'];} ?>
                </i>
            </small> <br>
                <?php $dotime = getdate(date_timestamp_get(new DateTime($value['start']))); ?>
                <small class="pl-5">Ngày giờ làm bài: 
                    <i>
                        <?php if($dotime['hours']<10) {echo '0'.$dotime['hours'];} else {echo $dotime['hours'];} ?>:<?php if($dotime['minutes']<10) {echo '0'.$dotime['minutes'];} else {echo $dotime['minutes'];} ?>
                        ngày <?php if($dotime['mday']<10) {echo '0'.$dotime['mday'];} else {echo $dotime['mday'];} ?>/<?php if($dotime['mon']<10) {echo '0'.$dotime['mon'];} else {echo $dotime['mon'];} ?>/<?php echo $dotime['year']; ?>
                    </i>
                </small><br>
                <small class="pl-5"> Thởi gian làm bài:
                    <i><?php echo $value['duration']; ?> phút</i>
                </small>
        </div>
    <?php endforeach; ?>
</div>