<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 mr-0 border-top border-left border-right p-2">
    <div class="border-bottom pb-2">
        <b>Lớp <a href="../groups?group=<?php echo current_group()['cname']; ?>"><?php echo current_group()['cname']; ?></a> >>> <?php echo c_assign()['aname']; ?></b>
        <small class="float-right">
            <i>
            Đã tạo <?php if($day_create['hours']<10) {echo '0'.$day_create['hours'];} else {echo $day_create['hours'];} ?>:<?php if($day_create['minutes']<10) {echo '0'.$day_create['minutes'];} else {echo $day_create['minutes'];} ?>
            ngày <?php if($day_create['mday']<10) {echo '0'.$day_create['mday'];} else {echo $day_create['mday'];} ?>/<?php if($day_create['mon']<10) {echo '0'.$day_create['mon'];} else {echo $day_create['mon'];} ?>
            </i>
        </small>
    </div>
    <!--  -->



    <div class="pt-1">
        <small><b><i>Trạng thái: </i></b><i class="text-danger">chưa hoàn thành</i></small>
        <?php $start = getdate(date_timestamp_get(new DateTime(c_assign()['start']))); ?>
        <small class="float-right">
            <i>
            Bắt đầu: <?php if($start['hours']<10) {echo '0'.$start['hours'];} else {echo $start['hours'];} ?>:<?php if($start['minutes']<10) {echo '0'.$start['minutes'];} else {echo $start['minutes'];} ?>
            ngày <?php if($start['mday']<10) {echo '0'.$start['mday'];} else {echo $start['mday'];} ?>/<?php if($start['mon']<10) {echo '0'.$start['mon'];} else {echo $start['mon'];} ?>
            </i>
        </small> <br> <br>
        <small class="float-right"><i class="border-bottom">
            Thời gian: <?php echo c_assign()['duration']; ?> phút
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
        <div>Số lượng câu hỏi: <?php echo $num_ques; ?></div>
        <div>Điểm số được cập nhật sau khi bài thi diễn ra</div>

    </div>
</div>

