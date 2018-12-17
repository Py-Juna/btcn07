<?php 
  require_once 'init.php';
  require_once 'functions.php';
  // Xử lý logic ở đây
  $posts = findAllPosts();
  $page = 'home';
?>
<?php include 'header.php'; ?>
<h1>Trang chủ</h1>
<p><?php if($currentUser): ?>
Xin chào <strong><?php echo $currentUser['fullname']; ?></strong>!
<?php else: ?>
Chào khách!
<?php endif; ?>
</p>
<?php foreach ($posts as $post) : ?>
<div class="card">
  <div class="card-header">
   <strong><?php echo $post['fullname'];?></strong> Create at: <?php echo $post['createAt'];?>
  </div>
  <div class="card-body">
    <p class="card-text"><?php echo $post['content'];?></p>
  </div>
</div>
</br>
<?php endforeach; ?>
<?php include 'footer.php'; ?>