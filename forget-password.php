<?php 
  require_once 'init.php';
  require_once 'functions.php';
  // Xử lý logic ở đây
  $page = 'forget-password';
  //$success = false;
  if (isset($_POST['email'])){
    $success = true;
    $email = $_POST['email'];
    $user = findUserByEmail($email);
    if($user){
        $secref = createResetPassword($user['id']);
        sendEmail($user['email'], $user['fullname'], 'Yeu cau doi mat khau', 'Click <a href="http://localhost:8888/BTCN07/reset-password.php?secret=' . $secref .'">vào đây</a>');
    }
  }
?>
<?php include 'header.php'; ?>
<h1>Quên mật khẩu</h1>
<?php if (!isset($_POST['email'])) : ?>
<form acction="forget-password.php" method="POST">
    <div class="form-group">
    <label for="exampleInputEmail1">Địa chỉ email</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  <button type="submit" name="forget-password" class="btn btn-primary">Yêu cầu khôi phục mật khẩu</button>
</form>
<?php else: ?>
<div class="alert alert-success" role="alert">
Đã gửi hướng dẫn khôi phục mật khẩu qua email, vui lòng kiểm tra.
</div>
<?php endif; ?>
<?php include 'footer.php'; ?>