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
        <small><b><i>Trạng thái: </i></b><i class="text-primary">đang diễn ra</i></small>
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

<?php if(c_assign()['turn_in']): ?>
    <small class="text-success"><b>Đã nộp bài</b></small>
    <div class="">
    <?php
        $result_ques = $questions->get_ref_table_dl_where('users_questions_assigns', 'qid', 'aid', c_assign()['aid'], 'uid', user()['uid']);
        $numR = $numF = $numN = 0;
        foreach ($result_ques as $key => $rs_q) {
            if($rs_q['choose']==$rs_q['answer']) { $numR++; } 
            if($rs_q['choose']=='none') { $numN++; }
        }
    ?>
    
    <?php $num_ques = $questions->count_column_value('aid', c_assign()['aid']); ?>
        <div class="">
            <small><b>Tổng số câu hỏi:</b></small> <b><?php echo $num_ques; ?></b>
            <div class="">
                <b>Kết quả: </b> 
                <span>
                    Đúng : <b class="text-success"><?php echo $numR; ?></b>
                    Sai : <b class="text-danger"><?php echo $num_ques - $numR - $numN; ?></b>
                    Chưa chọn : <b><?php echo $numN; ?></b>
                </span>
            </div>
        </div>

    <!-- Khung làm bài -->
        <div class="border mt-2 p-2">
            Bạn đã hoàn thành bài thi với điếm số là : <b><?php echo round(c_assign()['result'], 2); ?></b>
        </div>
        <div class="border mt-2 p-2" id="result_assign">
            <small><b>Chú ý: </b><i>đây là bài làm của bạn dựa trên thứ tự câu hỏi của bài thi gốc, 
                đáp án sẽ được hiển thị sau khi bài thi kết thúc</i></small>
            <br>
            <?php $i = 1; ?>
            <?php foreach ($result_ques as $key => $rs_q): ?>
                <span class="mr-4"><?php echo $i++; ?> . <?php echo $rs_q['choose']; ?></span>
            <?php endforeach; ?>
        </div>

    </div>

<?php else: ?>

    <div class="">
        <?php set_list_questions($questions->get_random()); ?>
        
        <?php $num_ques = $questions->count_column_value('aid', c_assign()['aid']); ?>
        <div class="">
            <small><b>Tổng số câu hỏi:</b></small> <b><?php echo $num_ques; ?></b>
            <div class="float-right">
                <small><b>Tiến trình: </small> <span><span class="text-primary" id="process">0</span>/<?php echo $num_ques; ?></b></span>
            </div>
        </div>

        <!-- Khung làm bài -->
        <div class="border mt-2 p-2" id="questionfordo">
            Vui lòng chọn câu hỏi để làm bài
        </div>
        <div class="border mt-2 p-2 mb-2" id="btn_questions">
            
        </div>
        <?php require Path_pro . '/sources/views/call_requests_server/questionfordo.php'; ?>

    </div>

<?php endif; ?>

</div>

<?php require Path_pro . '/sources/views/call_requests_server/countdown_assigns.php'; ?>

