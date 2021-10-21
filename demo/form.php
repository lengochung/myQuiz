<?php
    require "./promise.php";

    $GLOBALS['err'] = [
        "name" => "",
        "email" => "",
        "phone" => "",
        "web" => "",
        "gender" => "",
    ];

    if(isset($_POST['submit'])) {
        Promise::resolve(null)
              ->then( function ($result) {
                
                if(strlen($_POST['name'])<6) 
                    return Promise::reject(1);

            })->then( function ($result) {
                
                $pt = "/[a-z0-9]@[a-z]{3,6}(\.com)$/";

                if(!preg_match($pt, $_POST['email']))
                    return Promise::reject(2);

            })->then( function ($result) {
                
                $pt = "/[\d]{10}/";

                if(!preg_match($pt, $_POST['phone'])||strlen($_POST['phone'])!=10)
                    return Promise::reject(3);

            })->then( function ($result) {
                
                $pt = "/^(http:\/\/)/";
                if(!preg_match($pt, $_POST['web']))
                    return Promise::reject(4);

            })->then( function ($result) {
                
                if(empty($_POST['gender']))
                    return Promise::reject(5);

            })->catch( function ($err) {
                switch ($err) {
                    case 1:
                        $GLOBALS['err']['name'] = "Tên trên 6 ký tự";
                        break;
                    case 2:
                        $GLOBALS['err']['email'] = "Email có @ và kết thúc '.com'";
                        break;
                    case 3:
                        $GLOBALS['err']['phone'] = "Điện thoại kiểu số, 10 ký tự";
                        break;
                    case 4:
                        $GLOBALS['err']['web'] = "Bắt đầu bằng 'http://'";
                        break;
                    case 5:
                        $GLOBALS['err']['gender'] = "Chưa chọn giới tính'";
                        break;
                }
            });
    }

    function res_post($name) {
        if(isset($_POST['submit'])) return $_POST[$name];
    }
?>




<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      

     <div class="col-6" style="margin: auto;">
        <legend>FORM</legend>
        <form action="" method="post">
            <div class="form-group">
              <label for="">Name</label>
              <input type="text" name="name" id="" class="form-control" value="<?php echo res_post('name'); ?>" aria-describedby="helpId">
              <small id="helpId" class="text-danger"><?php echo $GLOBALS['err']['name']; ?></small>
            </div>
            <div class="form-group">
              <label for="">Email</label>
              <input type="text" name="email" id="" class="form-control" value="<?php echo res_post('email'); ?>" aria-describedby="helpId">
              <small id="helpId" class="text-danger"><?php echo $GLOBALS['err']['email']; ?></small>
            </div>
            <div class="form-group">
              <label for="">Phone</label>
              <input type="text" name="phone" id="" class="form-control" value="<?php echo res_post('phone'); ?>" aria-describedby="helpId">
              <small id="helpId" class="text-danger"><?php echo $GLOBALS['err']['phone']; ?></small>
            </div>
            <div class="form-group">
              <label for="">Website</label>
              <input type="text" name="web" id="" class="form-control" value="<?php echo res_post('web'); ?>" aria-describedby="helpId">
              <small id="helpId" class="text-danger"><?php echo $GLOBALS['err']['web']; ?></small>
            </div>
            <div class="form-group">
              <label for="">Comment</label>
              <textarea type="text" name="comment" id="" class="form-control" placeholder="" aria-describedby="helpId"></textarea>
              
            </div>
            <div class="form-check pb-4">
                
                <label class="form-check-label">
                <input type="radio" class="form-check-input" name="gender" id="" value="female" <?php if(isset($_POST['submit'])&&isset($_POST['gender'])) if($_POST['gender']=="female") echo "checked"; ?> >
                Female
              </label> <br>
                <label class="form-check-label">
                <input type="radio" class="form-check-input" name="gender" id="" value="male" <?php if(isset($_POST['submit'])&&isset($_POST['gender'])) if($_POST['gender']=="male") echo "checked"; ?>>
                Male
              </label> <br>
                <label class="form-check-label">
                <input type="radio" class="form-check-input" name="gender" id="" value="else" <?php if(isset($_POST['submit'])&&isset($_POST['gender'])) if($_POST['gender']=="else") echo "checked"; ?>>
                Something else
              </label>  <br>
              <small id="helpId" class="text-danger"><?php echo $GLOBALS['err']['gender']; ?></small>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>