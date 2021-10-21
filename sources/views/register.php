
<div class="col-lg-4 col-md-6 col-sm-8 col-xs-12" style="margin: auto;">
    <?php
        if($is_name||$is_email||$is_confirm)
            if (recieved_message()) echo message();
    ?>
    <small>
        <a href="<?php echo URL; ?>login">Trở lại trang đăng nhập</a>
    </small>
    <legend class="border-bottom">Đăng ký tài khoản</legend>
    <form action="" method="post">
        <fieldset>
            <label for="">Bạn là ai?</label>
            <div class="form-check form-group">
                <small class="form-check-label">
                    <input type="radio" class="form-check-input" name="role" id="" value="2" checked>
                    Giáo viên
                </small>
                <small class="form-check-label ml-5">
                    <input type="radio" class="form-check-input" name="role" id="" value="3">
                    Sinh viên
                </small>
            </div>
            <div class="form-group">
                <label for="name">Họ tên</label>
                <input type="text" name="name" class="form-control <?php  if ($is_name) echo 'border-danger'; ?>" required value="<?php echo request_post('name'); ?>" aria-describedby="helpId">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control <?php  if ($is_email) echo 'border-danger'; ?>" required value="<?php echo request_post('email'); ?>" aria-describedby="helpId">
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" name="password" class="form-control" required value="<?php echo request_post('password'); ?>" aria-describedby="helpId">
            </div>
            <div class="form-group">
                <label for="confirm">Nhập lại mật khẩu</label>
                <input type="password" name="confirm" class="form-control <?php if ($is_confirm)  echo 'border-danger'; ?>" required value="<?php echo request_post('confirm'); ?>" aria-describedby="helpId">
            </div>
        </fieldset>
        <button type="submit" name="submit" class="btn btn-success">Hoàn tất</button>
    </form>
</div>






