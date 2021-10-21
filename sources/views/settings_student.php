<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
    <?php if(recieved_message()) echo message(); ?>
    <div class=" p-2">
        <legend class="border-bottom">Thông tin sinh viên</legend>
        <table>
            <tr>
                <td>Họ tên</td> <td></td>
                <td>
                    <form action="" method="post">
                        <input type="text" class="text-right" name="name" required value="<?php echo user()['name']; ?>">
                        <button type="submit" class="btn-sm btn-primary"
                                        name="update_name" value="hung" href="">
                            Thay đổi
                        </button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>Email</td><td></td>
                <td><small><b><i><?php echo user()['email']; ?></i></b></small></td>
            </tr>
            <tr>
                <td>Mật khẩu</td><td></td>
                <td>
                    <!-- Button trigger modal -->
                    <a type="" href="" class="btn-sm" data-toggle="modal" data-target="#update_password">
                      Thay đổi
                    </a>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="update_password" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                            <h5 class="modal-title">Thay đổi mật khẩu</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <form action="" method="post" name="update_password_form" class="">
                                            <div class="form-group">
                                              <label for="">Mật khẩu cũ</label>
                                              <input type="password" name="old_password" id="old_password" class="form-control" placeholder="" aria-describedby="helpId">
                                              <small id="alert_old_password" class="text-danger text" style="display: none;"></small>
                                            </div>
                                            <div class="form-group">
                                              <label for="">Mật khẩu mới</label>
                                              <input type="password" name="new_password" id="new_password" class="form-control" placeholder="" aria-describedby="helpId">
                                              <small id="alert_new_password" class="text-danger" style="display: none;"></small>
                                            </div>
                                            <div class="form-group">
                                              <label for="">Nhập lại mật khẩu mới</label>
                                              <input type="password" name="cfm_new_password" id="cfm_new_password" class="form-control" placeholder="" aria-describedby="helpId">
                                              <small id="alert_cfm_new_password" class="text-danger" style="display: none;"></small>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                    <button type="button" id="update_password" onclick="updatepassword(document.forms.update_password_form)" class="btn btn-primary">Lưu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <script>
                        $('#exampleModal').on('show.bs.modal', event => {
                            var button = $(event.relatedTarget);
                            var modal = $(this);
                            // Use above variables to manipulate the DOM
                            
                        });
                    </script>
                </td>
            </tr>
        </table>
        <!--  -->
        <div class="row mt-5">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <legend class="">Lớp học</legend>
                <table style="width: 100%;" class="table">
                    <thead>
                    <tr>
                        <td><small><b>Tên lớp</b></small></td>
                        <td><small><b>Sĩ số</b></small></td>
                        <td><small><b>Giáo viên</b></small></td>
                    </tr>
                    </thead>
                <?php foreach($list_group as $key => $group): ?>
                    <tr>
                        <td>
                            <a href="<?php echo URL; ?>groups?group=<?php echo $group['cname']; ?>" class="text-secondary"><?php echo $group['cname']; ?></a>
                        </td>
                        <td><?php echo $group['total']; ?></td>
                        <?php $teacher = $conn->load('users')->get_column_value_fetch('uid', $group['tid']); ?>
                        <td><?php if($teacher['uid']==1) {echo "trống";} else {echo $teacher['name'];} ?></td>
                    </tr>
                <?php endforeach; ?>
                </table>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <legend class="">Bài thi/ Nhiệm vụ</legend>
                <table style="width: 100%;" class="table">
                    <tr>
                        <td><small><b>Bài thi</b></small></td>
                        <td><small><b></b></small></td>
                        <td><small><b>Điểm</b></small></td>
                    </tr>
                <?php foreach($list_assign as $key => $assign): ?>
                    <tr>
                        <td>
                            <a href="<?php echo URL; ?>assignments?assignments=<?php echo $assign['aname']; ?>" class="text-secondary"><?php echo $assign['aname']; ?></a>
                        </td>
                        <td>
                            <?php if($assign['turn_in']): ?> 
                                <small class="text-success"><i>đã nộp</i></small>
                            <?php else: ?>
                                <small class="text-secondary"><i>chưa nộp</i></small>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $assign['result']; ?></td>
                    </tr>
                <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>




<!--  -->

<?php require Path_pro . '/sources/views/call_requests_server/update_password.php'; ?>
