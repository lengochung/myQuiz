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
        <small><b><i>Trạng thái: </i></b><i class="text-primary"> ... đang diễn ra</i></small>
        <?php $start = getdate(date_timestamp_get(new DateTime(c_assign()['start']))); ?>
        <small class="float-right">
            <i>
            Bắt đầu lúc: <?php if($start['hours']<10) {echo '0'.$start['hours'];} else {echo $start['hours'];} ?>:<?php if($start['minutes']<10) {echo '0'.$start['minutes'];} else {echo $start['minutes'];} ?>
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
    <div class="p-2 mt-3 mb-3 border" id="showquestion">
        Trong quá trình bài thi diễn ra, giáo viên vẫn có thể cập nhật đáp án câu hỏi
    </div>
    <small><b>Nhấn vào sinh viên ở thanh bên để xem chi tiết quá trình làm bài của sinh viên</b></small>
        <div class="p-2 mt-3 pb-4 mb-3 border" id="show_detail_student_doing">
        
        </div>

    <?php
        require Path_pro . '/sources/views/call_requests_server/showquestion.php';
        require Path_pro . '/sources/views/call_requests_server/update_question.php'; 
        require Path_pro . '/sources/views/call_requests_server/countdown_assigns.php';
    ?>


</div>

<!--  -->
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 mr-0 border-left border-top">
    <div class="border-bottom pb-2 mb-2 pt-2"><small><b>Tình trạng làm bài</b></small></div>
    <div id="request_student_turnin" class="p-0">

    </div>

</div>
<?php require Path_pro . '/sources/views/call_requests_server/request_student_turnin.php'; ?>
<?php if(isset($_GET['requestnamestudent'])): ?>
    <?php require Path_pro . '/sources/views/call_requests_server/show_detail_student_doing.php'; ?>
<?php endif; ?>