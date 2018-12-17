<?php 
  require_once 'init.php';
  require_once 'functions.php';
  // Xử lý logic ở đây
  $page = 'profile';
  $success = false;
  if (isset($_POST['fullname']) && isset($_POST['numberphone'])){
    $fullName = $_POST['fullname'];
    $numberPhone = $_POST['numberphone'];
    $email = currentUser['email'];
    updateProfile($email, $fullName, $numberPhone);
    //header('Location: index.php');
    $success = true;
  }
?>
<?php include 'header.php'; ?>
<h1>Thông tin cá nhân - Chức năng đang được xây dựng...</h1>
<?php if (!$success) : ?>
<form acction="profile.php" method="POST">
    <div class="form-group">
    <label for="fullname">Họ và tên</label>
    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Ví dụ: Lê Tuấn Kiệt">
    </div>
    <div class="form-group">
    <label for="numberphone">Số điện thoại</label>
    <input type="text" class="form-control" id="numberphone" name="numberphone" placeholder="Ví dụ: 01679722235">
    </div>
  <button type="submit" name="profile" class="btn btn-primary">Cập nhật</button>
</form>
<?php endif; ?>
<?php include 'footer.php'; ?>