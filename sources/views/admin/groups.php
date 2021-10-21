<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 m-0">
    <?php if(recieved_message()) echo message(); ?>
    <div class="border p-2" style="height: 470px;">
        <table style="width: 100%;" id="table" class="table table-striped table-sm">
            <tr class="border-bottom">
                <td class="text-center"><b>Chọn</b></td>
                <td><b>__ID</b></td>
                <td><b>Tên lớp</b></td>
                <td class="text-right"><b>Giáo viên</b></td>
                <td class="text-right"><b>Sĩ số</b></td>
                <td class="text-right"><b>Ngày tạo</b></td>
                <td class="text-right"><b>Số lớp QL</b></td>
            </tr>
            <tr class="border-bottom">
                <form action="" method="post">
                    <td></td>
                    <td>
                        <select name="uid" id="">
                            <option value="null" <?php if(isset($_POST['add'])&&$_POST['uid']=="null") echo "selected"; ?>>Null</option>
                            <?php foreach($ids as $key => $id): ?>
                                <option value="<?php echo $id; ?>" <?php if(isset($_POST['add'])&&$_POST['uid']==$id) echo "selected"; ?>><?php echo $id; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="name" required value="<?php if(isset($_POST['add'])) echo $_POST['name']; ?>" >
                    </td>
                    <td class="text-right">
                        <input type="email" name="email" required value="<?php if(isset($_POST['add'])) echo $_POST['email']; ?>">
                    </td>
                    <td class="text-right">
                        <button type="submit" name="add" class="btn btn-primary btn-sm">Thêm</button>
                    </td>
                </form>
            </tr>
        <?php foreach($list as $key => $value): ?>
            <?php
                $uid = 0;
                if($value['cid']<10) $uid = '00' . $value['cid'];
                if($value['cid']>=10&&$value['cid']<100) $uid = '0' . $value['cid'];
                $teacher = $conn->load("users")->get_column_value_fetch("uid", $value['tid']);
            ?>
            <tr class="border-bottom">
                <td class="text-center">
                    <input type="checkbox" onclick="admin_check_student(this,<?php echo $value['cid']; ?>)">
                </td>
                <td class=""><?php echo $uid; ?></td>
                <td class=""><a href="?page=students&name=<?php echo $value['cname']; ?>"><?php echo $value['cname']; ?></a></td>
                <td class="text-right"><small><b><i><?php echo $teacher['name']; ?></i></b></small></td>
                <td class="text-right">
                    <?php echo $value['total']; ?>
                </td>
                <td class="text-right"><?php echo $value['day_create']; ?></td>
                <?php $num_g = $conn->load("classs")->count_column_value("tid", $value['cid']); ?>
                <td class="text-right"><a href="">(<?php echo $num_g; ?>) Xem</a></td>
            </tr>
        <?php endforeach; ?>
        </table>
    </div>
    <div>
        <form action="" method="post" class="float-left m-2">
            <button type="submit" name="check_none_all" href="#" class="border btn">Bỏ chọn</button>
            <!--  -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modelId">
                    Xóa
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                                <div class="modal-header">
                                        <h5 class="modal-title">Cảnh báo</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    Hãy chỉ định Giáo viên thay thế các lớp học sau khi xóa Giáo viên
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy thao tác</button>
                                <button type="submit" name="del_check" class="btn btn-outline-danger">Đã rõ, xóa</button>
                            </div>
                        </div>
                    </div>
                </div>
           
        </form>
        <div class="float-right m-2">
            <?php for ($i = 1; $i <= $num_logs ; $i++) : ?>
                <a href="?page=students&log=<?php echo $i; ?>" class="btn border <?php if($log==$i) echo "bg-primary"; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>
    </div> <br> <br>
    <div class="mt-2">
        <form enctype="multipart/form-data" method="post">
            <input type="file" name="file" required>
            <button type="submit" name="submit" class="btn btn-secondary">Thêm nhanh</button>
        </form>
    </div>
    <?php require Path_pro . '/sources/views/call_requests_server/admin_check_student.php'; ?>
    <!-- <script>
          
        
          window.addEventListener('DOMContentLoaded', event => {
              // Simple-DataTables
              // https://github.com/fiduswriter/Simple-DataTables/wiki

              const table = document.getElementById('table');
              if (table) {
                  new simpleDatatables.DataTable(table);
              }
          });
    
  </script> -->

    
    
