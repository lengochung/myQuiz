<?php

    require '../helpers/require_for_requests_server.php';

    $conn = new Connect_MySql();
    $class_detail = $conn->load('class_detail');

    $data = $class_detail->get_ref_table_fkey_where('users', 'uid', 'cid', current_group()['cid']);
 
?>

<style>
    .online_status {
        width: 10px; height: 10px; float: right;
    }
</style>

<?php 
    $i = 1;
    foreach ($data as $key => $value): 
?>

    <div id="item<?php echo $i; ?>" class="count"> 
        <div class="btn-group">
            <div>
                <div style="opacity:<?php if(!$value['login']) echo '0.4'; ?>;">
                    <img src="../sources//static/images/<?php echo $value['image']; ?>" 
                        width="20px" height="20px" class="rounded-circle"> 
                    <small>
                        <b><a href="?group=<?php echo current_group()['cname']; ?>&namestudent=<?php echo $value['name']; ?>" class="text-secondary"><?php echo $value['name']; ?></a></b>
                    </small>
                    <?php if($value['in']): ?>
                        <span class="rounded-circle" style="width: 10px; height: 10px; display: block; position: absolute; top: 18px; left: 15px; background: blue;"></span>
                    <?php endif; ?>
                </div>
            </div>
            
            <div id="hover<?php echo $i++; ?>" class="dropdown-menu ml-5 mt-0">
                <?php if($value['login']) { ?><small class="dropdown-item">Đang trực tuyến <span class="rounded-circle online_status" style="background: green;"></span></small>
                <?php } else { ?><small class="dropdown-item">Đang ngoại tuyến <span class="rounded-circle online_status" style="background: red;"></span></small><?php } ?>
                
                <?php  $time = getdate(date_timestamp_get(new DateTime($value['login_at']))); ?>
                <a class="dropdown-item disabled" href="#"><small>Đăng nhập lần cuối lúc
                    <i class=" float-right">
                        <?php if($time['hours']<10) {echo '0'.$time['hours'];} else {echo $time['hours'];} ?>:<?php if($time['minutes']<10) {echo '0'.$time['minutes'];} else {echo $time['minutes'];} ?>
                        ngày <?php if($time['mday']<10) {echo '0'.$time['mday'];} else {echo $time['mday'];} ?>/<?php if($time['mon']<10) {echo '0'.$time['mon'];} else {echo $time['mon'];} ?>
                    </i>
                </small></a>
            </div>
        </div>
    </div>
        
<?php endforeach; ?>



