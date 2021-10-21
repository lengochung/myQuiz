<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 mr-0 border-top border-left border-right p-2">
    <div class="border-bottom pb-2">
        <b>Lớp <a href="../groups?group=<?php echo current_group()['cname']; ?>"><?php echo current_group()['cname']; ?></a> >>> <?php echo c_assign()['aname']; ?></b>
        <small class="float-right">
            <i>
            Được tạo lúc <?php if($day_create['hours']<10) {echo '0'.$day_create['hours'];} else {echo $day_create['hours'];} ?>:<?php if($day_create['minutes']<10) {echo '0'.$day_create['minutes'];} else {echo $day_create['minutes'];} ?>
            ngày <?php if($day_create['mday']<10) {echo '0'.$day_create['mday'];} else {echo $day_create['mday'];} ?>/<?php if($day_create['mon']<10) {echo '0'.$day_create['mon'];} else {echo $day_create['mon'];} ?>
            </i>
        </small>
    </div>
    <!--  -->

    <div class="pt-1">
        <small><b><i>Trạng thái: </i></b><i class="text-secondary"> đã hoàn thành</i></small>
        <?php $start = getdate(date_timestamp_get(new DateTime(c_assign()['start'])) + c_assign()['duration']*60); ?>
        <small class="float-right">
            <i>
            Kết thúc lúc: <?php if($start['hours']<10) {echo '0'.$start['hours'];} else {echo $start['hours'];} ?>:<?php if($start['minutes']<10) {echo '0'.$start['minutes'];} else {echo $start['minutes'];} ?>
            ngày <?php if($start['mday']<10) {echo '0'.$start['mday'];} else {echo $start['mday'];} ?>/<?php if($start['mon']<10) {echo '0'.$start['mon'];} else {echo $start['mon'];} ?>
            </i>
        </small> <br>
        <small class="float-right"><i class="border-bottom">
            Thời gian làm bài: <?php echo c_assign()['duration']; ?> phút
        </i></small> <br>
    </div>

    <div id="messagequestion"><?php if(recieved_message()) echo message(); ?></div>
    <script>
        setTimeout(() => {
            document.getElementById('messagequestion').innerHTML = '';
        }, 3000);
    </script>

    <!--  -->
    <div class="mb-2">
        <!--  -->
        <div class="btn-group dropdown float-right">
            <button type="button" class="btn btn-secondary">Câu hỏi</button>
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu">
                <?php $i = 1; ?>
                <?php foreach($questions->get_column_value_fetchAll('aid', c_assign()['aid']) as $key => $value): ?>
                    
                    <button class="dropdown-item dropdown-header pl-2 pt-0 pr-0 pb-0" href="" 
                            onclick="showquestion(<?php echo $value['qid']; ?>, <?php echo $i; ?>)">Câu <?php echo $i++;?></button>
                  
                <?php endforeach; ?>
            </div>
        </div>
    </div> <br>

    <!--  -->
    <div class="p-2 mt-3 mb-2 border" id="showquestion">
       Xem lại câu hỏi
    </div>
    <?php
        require Path_pro . '/sources/views/call_requests_server/showquestion.php';
        require Path_pro . '/sources/views/call_requests_server/update_question.php'; 
    ?>

    <!--  -->
    <div class="border p-2 mb-2">
        <form action="" method="post">
            <button type="submit" name="export" class="btn btn-primary">Xuất kết quả</button>
        </form>
    </div>

    <!--  -->

    <?php $extract = $users_assigns->get_ref_table_fkey_where_asc('users','uid','aid',c_assign()['aid'],'name'); ?>
    
    <div class="border p-2">
        <table style="width: 100%;" id="table" class=" table-striped table-sm">
            <thead>
            <tr class="border-bottom">
                <td class="border-right"><small>STT</small></td>
                <td class="pl-2"><small>Họ tên</small></td>
                <td><small>Nộp bài</small></td>
                <td><small>Đúng</small></td>
                <td><small>Sai</small></td>
                <td><small>None</small></td>
                <td><small>Điểm</small></td>
            </tr>
            </thead>
            <?php $i = 1; ?>
            <?php foreach($extract as $key => $value): ?>
                <?php
                     $each = $questions->get_ref_table_dl_where('users_questions_assigns','qid','aid', c_assign()['aid'],'uid',$value['uid']);
        
                     $total = $numN = $numR = $numF = 0;
                     foreach ($each as $key => $e) {
                         $total++;
                         if($e['choose']=='none') { 
                             $numN++;
                         }
                         if($e['choose']==$e['answer']) { 
                             $numR++;
                         }
                     }
                ?>
                <tr>
                    <td class="border-right"><small><?php echo $i++; ?></small></td>
                    <td class="pl-2"><small><?php echo $value['name']; ?></small></td>
                    <td><small>
                        <?php if($value['turn_in']) { echo "<i class='text-success'>đã nộp</i>"; } else { echo "<i class='text-secondary'>không nộp</i>"; } ?>
                    </small></td>
                    <td><small><?php echo $numR; ?></small></td>
                    <td><small><?php echo $total - $numR - $numN; ?></small></td>
                    <td><small><?php echo $numN; ?></small></td>
                    <td><small><?php echo round($value['result'], 2); ?></small></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>


</div>

<!--  -->
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 mr-0 border-left border-top">
    <div class="border-bottom pb-2 mb-2 pt-2">Danh sách SV của bài thi</div>
    <?php $listStudent = $users_assigns->get_ref_table_fkey_where_asc('users', 'uid', 'aid', c_assign()['aid'], 'name'); ?>
    <?php foreach($listStudent as $key => $value): ?>
        <small class="text-secondary"><b><?php echo $value['name']; ?></b></small>
        <small class="float-right mt-2 rounded-circle bg-<?php if($value['login']) {echo 'success';} else {echo 'danger';} ?>" style="width: 7px; height: 7px;"></small> <br>
    <?php endforeach; ?>
</div>