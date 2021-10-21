<?php

    require '../helpers/require_for_requests_server.php';

    $conn = new Connect_MySql();

    $assigns = $conn->load('assignments');

    $listStudent = $assigns->get_ref_dl_table_where_orderby('users_assigns','aid','users','uid','t1.aid',c_assign()['aid'],'name', 'asc');
    
    $i = 1;
    foreach($listStudent as $key => $value):

?>
        <small class="" id="detail_doassign<?php echo $i; ?>">
            <img src="../sources//static/images/<?php echo $value['image']; ?>" 
                width="20px" height="20px" class="rounded-circle">
            <b class=""><a href="?assignments=<?php echo c_assign()['aname']; ?>&requestnamestudent=<?php echo $value['name']; ?>" 
                    class="text-secondary">
                <?php echo $value['name']; ?></a></b>
            <?php if($value['turn_in']): ?>
                <i class="text-success float-right">đã nộp</i>
            <?php else: ?>
                <i class="text-secondary float-right">chưa nộp</i>
            <?php endif; ?> <br>
        </small> 
    <div class="btn-group">   
            <div id="hovers<?php echo $i++; ?>" class="dropdown-menu ml-0 mt-0">
                <?php if($value['login']) { ?>
                    <small class="dropdown-item">Đang trực tuyến <span class="rounded-circle float-right" style="background: green; width: 10px; height: 10px; display: block;"></span></small>
                <?php } else { ?>
                    <small class="dropdown-item">Đang ngoại tuyến <span class="rounded-circle float-right" style="background: red; width: 10px; height: 10px; display: block;"></span></small>
                <?php } ?>
                
                <?php  $time = getdate(date_timestamp_get(new DateTime($value['login_at']))); ?>
                <a class="dropdown-item disabled" href="#"><small>Đăng nhập lần cuối lúc
                    <i class=" float-right">
                        <?php if($time['hours']<10) {echo '0'.$time['hours'];} else {echo $time['hours'];} ?>:<?php if($time['minutes']<10) {echo '0'.$time['minutes'];} else {echo $time['minutes'];} ?>
                        ngày <?php if($time['mday']<10) {echo '0'.$time['mday'];} else {echo $time['mday'];} ?>/<?php if($time['mon']<10) {echo '0'.$time['mon'];} else {echo $time['mon'];} ?>
                    </i>
                </small></a>
            </div>
    </div>
<?php

    endforeach;
?>

