

<?php if(isset($_GET['forgotpassword'])) : ?>
  <?php if(isset($_GET['confirm'])) : ?>
    <div class="col-lg-4 col-md-6 col-sm-8 col-xs-12 border p-3 mt-5" style="margin: auto;">
      <small class="mb-2">
        <a href="<?php echo URL; ?>login?forgotpassword" class="border-bottom">Quay lại</a>
      </small>
      <?php
        if(!user_logged())
          if(recieved_message()) echo message();
      ?>
      <legend class="border-bottom">Xác nhận </legend>
      <form action="" method="post">
          <fieldset>
              <div class="form-group">
                <label for="email"><small>Bạn sẽ nhận được mật khẩu reset qua email nếu xác nhận đúng</small></label>
                <input type="text" name="code" class="form-control" 
                    required value="" aria-describedby="helpId">
              </div>
          </fieldset>
          <button type="submit" name="cfm_code" class="btn btn-success">Xác nhận</button>
          <a type="submit" href="" class="btn btn-outline-success">Gửi lại</a>
          
      </form>

  </div>
  <?php
    $_SESSION['cfm_code'] = rand(1000, 9999);
    Mail::send_confirm_code(email_forgot(), $_SESSION['cfm_code']);
  ?>
  <?php else: ?>

  <div class="col-lg-4 col-md-6 col-sm-8 col-xs-12 border p-3 mt-5" style="margin: auto;">
    <small class="">
      <a href="<?php echo URL; ?>login" class="border-bottom">Quay lại</a>
    </small>
    <?php
      if(!user_logged())
        if(recieved_message()) echo message();
    ?>
    <legend class="border-bottom">Quên mật khẩu </legend>
    <form action="" method="post">
        <fieldset>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" class="form-control" 
                  required value="<?php echo email_forgot(); ?>" aria-describedby="helpId">
            </div>
        </fieldset>
        <small>Mã xác nhận được gửi đến email</small> <br>
        <button type="submit" name="forgot" class="btn btn-success">Gửi</button>
    </form>

  </div>
    <?php endif; ?>
<?php else: ?>

<h2 class="text-center mb-0 mt-5">PHP2 - Assignment</h2>
<div class="col-lg-4 col-md-6 col-sm-8 col-xs-12 border p-3 mt-5" style="margin: auto;">
<?php
  if(!user_logged())
    if(recieved_message()) echo message();
?>
    <legend class="border-bottom">Đăng nhập </legend>
    <form action="" method="post">
        <fieldset>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email"
                  class="form-control <?php if(isset($_POST['submit'])) if(!$is_email) echo 'border-danger'; ?>" 
                  required value="<?php echo request_post('email'); ?>" aria-describedby="helpId">
            </div>
            <div class="form-group">
              <label for="password">Mật khẩu</label>
              <input type="password" name="password" 
                  class="form-control <?php if($is_email) if(!$is_pass) echo 'border-danger'; ?>" 
                  required value="<?php echo request_post('password'); ?>" aria-describedby="helpId">
            </div>
        </fieldset>
        <button type="submit" name="submit" class="btn btn-success">Đăng nhập</button>
    </form>
    <div class="mt-2">
      <span class="text-secondary">Bạn chưa có tài khoản? </span>
      <small class="">
        <a href="<?php echo URL; ?>register">Đăng ký ngay</a>
      </small>
    </div>
    <div class="mt-2">
      <small class="">
        <a href="<?php echo URL; ?>login?forgotpassword">Quên mật khẩu</a>
      </small>
    </div>
</div>

<?php endif; ?>





