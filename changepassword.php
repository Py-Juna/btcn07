<?php 
  require_once 'init.php';
  require_once 'functions.php';
  // Xử lý logic ở đây
  $page = 'changepassword';
  $success = false;
  $checkChangePassword = false;
  $flag_hidden = false;
  $flagCheckNewPassword = false;
  if (isset($_POST['new-password']) && isset($_POST['new-password']) && isset($_POST['old-password'])){
    $flag_hidden = true;
        if($_POST['new-password'] == $_POST['renew-password']){
        $old_password = $_POST['old-password'];
        $new_fullName = $_POST['new-password'];
        $email = $currentUser['email'];
        $check = password_verify($old_password, $currentUser['password']);
            if($check){
                $new_passwordHash = password_hash($new_fullName,PASSWORD_DEFAULT);
                changepassword($email, $new_passwordHash);
                $checkChangePassword = true;
                $flag_hidden = true;
            }
            else {
                $checkChangePassword = false;
            }
        }
        else{
            $flagCheckNewPassword = true;
        }
  }
?>
<?php include 'header.php'; ?>
<h1>Đổi mật khẩu</h1>
<?php if (!$success) : ?>
<form acction="changepassword.php" method="POST">
    <div class="form-group">
        <label for="fullName">Mật khẩu cũ</label>
        <input type="text" class="form-control" id="old-password" name="old-password" placeholder="Nhập mật khẩu cũ">
    </div>
    <div class="form-group">
        <label for="password">Mật khẩu mới</label>
        <input type="password" class="form-control" id="new-password" name="new-password" placeholder="Nhập mật khẩu mới!">
    </div>
    <div class="form-group">
        <label for="password">Nhập lại mật khẩu mới</label>
        <input type="password" class="form-control" id="renew-password" name="renew-password" placeholder="Nhập lại mật khẩu mới!">
    </div>
    <button type="submit" name="register" class="btn btn-primary">Đổi mật khẩu</button>
</form>
<?php endif; ?>
<?php if ($flag_hidden){
    if($flagCheckNewPassword){
        $notification = 'Mật khẩu mới không trùng khớp';
        echo $notification; 
    }
    else{
        if ($checkChangePassword){
            $notificationPass = 'Đổi mật khẩu thành công!';
            echo $notificationPass;
        }
        else{
            $notificationFail = 'Mật khẩu cũ bạn nhập không đúng, đổi mật khẩu không thành công!';
            echo $notificationFail;
        }
    }
}?>
<?php include 'footer.php'; ?>