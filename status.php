<?php 
  require_once 'init.php';
  require_once 'functions.php';
  // Xử lý logic ở đây
  $page = 'status';
  $success = false;
  if (isset($_POST['content'])){
    $content = $_POST['content'];
    $time = date('Y-m-d H:i:s');
    createStatus($content, $currentUser['id'], $time);
    header('Location: index.php');
    $success = true;
  }
?>
<?php include 'header.php'; ?>
<h1>Thêm trạng thái mới</h1>
<?php if (!$success) : ?>
<form acction="status.php" method="POST">
    <div class="form-group">
    <label for="content">Nội dung trạng thái</label>
    <input type="text" class="form-control" id="content" name="content" placeholder="Bạn đang nghĩ gì?">
  </div>
  <button type="submit" name="status" class="btn btn-primary">Đăng</button>
</form>
<?php endif; ?>
<?php include 'footer.php'; ?>