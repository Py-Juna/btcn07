<?php 
  require_once 'init.php';
  require_once 'functions.php';
  // Xử lý logic ở đây
  $page = 'forgot-password';
  $success = false;
  if (isset($_POST['secret']) && isset($_POST['password'])){
    $password = $_POST['password'];
    $secret = $_POST['secret'];
    $passwordHash = password_hash($password,PASSWORD_BCRYPT);
    $reset = findResetPassword($secret);
    if ($reset){
        $userId = $reset['userId'];
        markResetPasswordUsed($secret);
        updatePassword($userId, $passwordHash);
        header('Location: login.php');
        $success = true;
    }
  }
?>
<?php include 'header.php'; ?>
<h1>Khôi phục mật khẩu</h1>
<?php if (!$success) : ?>
<form acction="reset-password.php" method="POST">
    <input type="hidden" name="secret" value="<?php echo $_GET['secret']; ?>">
    <div class="form-group">
        <label for="password">Mật khẩu</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
    </div>
    <button type="submit" name="register" class="btn btn-primary">Đăng ký</button>
</form>
<?php endif; ?>
<?php include 'footer.php'; ?>