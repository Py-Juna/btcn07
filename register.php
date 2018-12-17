<?php 
  require_once 'init.php';
  require_once 'functions.php';
  // Xử lý logic ở đây
  $page = 'register';
  $success = false;
  if (isset($_POST['fullName']) && isset($_POST['email']) && isset($_POST['password'])){
    $password = $_POST['password'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $passwordHash = password_hash($password,PASSWORD_DEFAULT);
    $userId = createUser($email, $fullName,$passwordHash);
    $numberPhoneP = 'Dafault';
    createProfile($userId, $fullName, $numberPhoneP, $email);
    $_SESSION['userId'] = $userId;
    header('Location: index.php');
    $success = true;
  }
?>
<?php include 'header.php'; ?>
<h1>Đăng ký</h1>
<?php if (!$success) : ?>
<form acction="register.php" method="POST">
    <div class="form-group">
    <label for="fullName">Tên hiển thị</label>
    <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Tên hiển thị trên website">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Địa chỉ email</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Nhập email">
  </div>
  <div class="form-group">
    <label for="password">Mật khẩu</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
  </div>
  <button type="submit" name="register" class="btn btn-primary">Đăng ký</button>
</form>
<?php endif; ?>
<?php include 'footer.php'; ?>