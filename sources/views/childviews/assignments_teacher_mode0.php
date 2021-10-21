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
        <small><b><i>Trạng thái: </i></b><i class="text-danger">chưa hoàn thành</i></small>
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
        
        <!-- Modal -->
        <div class="modal fade" id="deleteAssign" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Xác nhận xóa bài thi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                        <form action="" method="post">
                            <button type="submit" name="delete_assign" class="btn btn-danger" value="<?php echo c_assign()['aid']; ?>">Xác nhận</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
        <!-- Modal -->
        <div class="modal fade" id="update_assign" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Chỉnh sửa thời gian nhiệm vụ</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="p-3">
                                <form action="" name="form">
                                    <?php $start_time = getdate(date_timestamp_get(new DateTime(c_assign()['start']))); ?>
                                    <fieldset>
                                        <div class="form-group">
                                            <label for="">Ngày làm bài</label>
                                            <input type="date" name="date" class="form-control" aria-describedby="helpId" value="<?php echo explode(" ", c_assign()['start'])[0]; ?>">
                                            <small class="text-danger"><i id="date_alert"></i></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Bắt đầu lúc </label>
                                                <select name="hours" id="">
                                                    <?php for ($i = 7; $i <= 21; $i++) : ?>
                                                        <option value="<?php echo $i; ?>" <?php if($start_time['hours']==$i) echo "selected"; ?>>
                                                            <?php if($i<10) {echo '0'.$i;} else{echo $i;} ?>
                                                        </option>
                                                    <?php endfor; ?>
                                                </select> giờ
                                                <select name="minutes" id="">
                                                    <?php for ($i= 0; $i <= 3; $i++) : ?>
                                                        <option value="<?php echo $i*15; ?>" <?php if($start_time['minutes']==$i*15) echo "selected"; ?>>
                                                            <?php echo $i*15; ?>
                                                        </option>
                                                    <?php endfor; ?>
                                                </select> phút
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="">Thời gian làm bài (phút)</label>
                                                <select name="duration" id="" class="form-control">
                                                    <?php for ($i= 1; $i <= 6; $i++) : ?>
                                                        <option value="<?php echo $i*15; ?>" <?php if(c_assign()['duration']==$i*15) echo "selected"; ?>>
                                                            <?php echo $i*15; ?>
                                                        </option>
                                                    <?php endfor; ?>
                                                </select>		
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                
                        <button type="button" name="settime" class="btn btn-primary" onclick="update_assign(document.forms.form)">Sửa</button>
                      
                    </div>
                </div>
            </div>
        </div> 
        <!--  -->
        <div class="btn-group dropdown float-left">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu">
                <div class="dropdown-item dropdown-header pl-2 pt-0 pr-0 pb-0">
                    <!-- Button trigger modal -->
                    <a type="button" class="btn float-left" data-toggle="modal" data-target="#deleteAssign">
                        Xóa nhiệm vụ
                    </a>
                    <a type="button" class="btn float-left" data-toggle="modal" data-target="#update_assign">
                        Thiết lập thời gian
                    </a>
                </div>
                
            </div>
        </div>
        <!--  -->
        <div class="btn-group dropdown float-right">
            <button type="button" class="btn btn-secondary">Câu hỏi</button>
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu">
                <?php $count = $questions->count_column_value("aid", c_assign()['aid']); ?>
                <?php if($count==0): ?>
                    <div class="dropdown-item dropdown-header pl-2 pt-0 pr-0 pb-0">(Trống)</div>
                <?php else: ?>
                    <?php $i = 1; ?>
                    <?php foreach($questions->get_column_value_fetchAll('aid', c_assign()['aid']) as $key => $value): ?>
                        
                        <button class="dropdown-item dropdown-header pl-2 pt-0 pr-0 pb-0" href="" 
                                onclick="showquestion(<?php echo $value['qid']; ?>, <?php echo $i; ?>)">Câu <?php echo $i++;?></button>
                    
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div> <br>

    <!--  -->
    <div class="p-2 mt-3 mb-3 border" id="showquestion">
        Nhấn chọn câu hỏi để xem câu hỏi <br>
        Nếu chưa có câu hỏi vui lòng nhập câu hỏi ở phía dưới
    </div>
    <?php
        require Path_pro . '/sources/views/call_requests_server/showquestion.php';
        require Path_pro . '/sources/views/call_requests_server/update_question.php'; 
        require Path_pro . '/sources/views/call_requests_server/update_assign.php'; 
    ?>
    <!--  -->
    <div class="">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for=""><small><b>Nhập nhanh câu hỏi</b></small></label> <br>
              <input type="file" name="file" required aria-describedby="helpId">
            </div>
            <button type="submit" name="importquestions" class="btn btn-outline-secondary">Tải lên</button>
        </form>
    </div>


</div>

<!--  -->
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 mr-0 border-left border-top">
    <div class="border-bottom pb-2 mb-2 pt-2">Danh sách SV</div>
    <?php $listStudent = $users_assigns->get_ref_table_fkey_where_asc('users', 'uid', 'aid', c_assign()['aid'], 'name'); ?>
    <?php foreach($listStudent as $key => $value): ?>
        <small class="text-secondary"><b><?php echo $value['name']; ?></b></small>
        <small class="float-right mt-2 rounded-circle bg-<?php if($value['login']) {echo 'success';} else {echo 'danger';} ?>" style="width: 7px; height: 7px;"></small> <br>
    <?php endforeach; ?>
</div>