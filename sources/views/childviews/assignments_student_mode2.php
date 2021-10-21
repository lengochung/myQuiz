
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
        <small><b><i>Trạng thái: </i></b><i class="text-secondary">đã hoàn thành</i></small>
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

    <div class="">
        <?php $num_ques = $questions->count_column_value('aid', c_assign()['aid']); ?>

    </div>

    <div>

        <?php
            $result_ques = $questions->get_ref_table_dl_where('users_questions_assigns', 'qid', 'aid', c_assign()['aid'], 'uid', user()['uid']);
            $numR = $numF = $numN = 0;
            foreach ($result_ques as $key => $rs_q) {
                if($rs_q['choose']==$rs_q['answer']) { $numR++; } 
                if($rs_q['choose']=='none') { $numN++; }
            }
        ?>
                <small>
                    <div class="text-secondary float-left">
                        <?php if(c_assign()['turn_in']): ?>
                            <i class="text-success">Đã nộp</i> <br>
                        <?php else: ?>
                            <i class="text-danger">Chưa nộp</i> <br>
                        <?php endif; ?>
                    </div>
                    <span class="float-right">
                    <?php $end = getdate(date_timestamp_get(new DateTime(c_assign()['start'])) + c_assign()['duration']*60); ?>
                        <i>
                        kết thúc: <?php if($end['hours']<10) {echo '0'.$end['hours'];} else {echo $end['hours'];} ?>:<?php if($end['minutes']<10) {echo '0'.$end['minutes'];} else {echo $end['minutes'];} ?>
                        ngày <?php if($end['mday']<10) {echo '0'.$end['mday'];} else {echo $end['mday'];} ?>/<?php if($end['mon']<10) {echo '0'.$end['mon'];} else {echo $end['mon'];} ?>
                        </i>
                    </span> <br>
                </small>
    
                <span>Điểm : <b><?php echo round(c_assign()['result'], 2); ?></b> đ</span> <br>
                <span>Số lượng câu hỏi: <b><?php echo $num_ques; ?></b></span>
                
                
                <div class="float-right">Đúng: <b><?php echo $numR; ?></b> Sai: <b><?php echo $num_ques - $numR - $numN; ?></b> Chưa chọn: <b><?php echo $numN; ?></b></div>

                <div class="">
                    <?php $i = 1; ?>
                    <?php foreach($result_ques as $key => $detail): ?>
                        <a class="dropdown-item border" href="#">
                            <div><b>Câu <?php echo $i++; ?>:</b> <?php echo $detail['content']; ?></div>
                            <div class="pl-2 <?php if($detail['answer']=='A') echo 'text-success'; ?>">A. <?php echo $detail['a']; ?></div> 
                            <div class="pl-2 <?php if($detail['answer']=='B') echo 'text-success'; ?>">B. <?php echo $detail['b']; ?></div> 
                            <div class="pl-2 <?php if($detail['answer']=='C') echo 'text-success'; ?>">C. <?php echo $detail['c']; ?></div> 
                            <div class="pl-2 <?php if($detail['answer']=='D') echo 'text-success'; ?>">D. <?php echo $detail['d']; ?></div> 
                            <small>
                                Đã chọn: <b><?php echo $detail['choose']; ?></b>
                                <?php if($detail['choose']==$detail['answer']) {echo "<i class='text-success'>Đúng</i>";} else { echo "<i class='text-danger'>Sai</i>";} ?>
                            </small>
                            
                        </a>
                    <?php endforeach; ?>
                </div>
        <!--  -->
    </div>
</div>

