<?php 
  $menu='admin';
  require ('template/inc/base.php');
  require_once ($_SERVER['SMS'].'template/inc/db.php');
  check_admin();

  $article_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
  $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ? AND is_deleted = 0");
  $stmt->execute([$article_id]);
  $article = $stmt->fetch();

  if (!$article) {
      header("Location: /admin/");
      exit;
  }

  $error_msg = '';
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      verify_csrf_token($_POST['csrf_token'] ?? '');
      $action = $_POST['action'] ?? 'save';

      if ($action === 'delete') {
          $stmt_del = $pdo->prepare("UPDATE articles SET is_deleted = 1 WHERE id = ?");
          $stmt_del->execute([$article_id]);
          header("Location: /admin/");
          exit;
      } elseif ($action === 'save') {
          $title = trim($_POST['Title'] ?? '');
          $content = $_POST['Content'] ?? '';

          if (!empty($title) && !empty($content)) {
              $slug = $article['slug']; 

              if (isset($_FILES['HeroImage']) && $_FILES['HeroImage']['error'] === UPLOAD_ERR_OK) {
                  $upload_dir = $_SERVER['SMS'] . 'template/img/blog/';
                  $tmp_name = $_FILES['HeroImage']['tmp_name'];
                  $resizes = [
                      '-mobile-small.jpg' => 414,
                      '-mobile.jpg'       => 1080,
                      '-desktop.jpg'      => 1920,
                      '-desktop-big.jpg'  => 2560
                  ];
                  foreach ($resizes as $suffix => $width) {
                      resize_image_proporsional($tmp_name, $upload_dir . $slug . $suffix, $width);
                  }
              }

              $stmt_upd = $pdo->prepare("UPDATE articles SET title = ?, content = ? WHERE id = ?");
              $stmt_upd->execute([$title, $content, $article_id]);
              
              header("Location: /admin/edit/" . $article['id'] . "-" . $article['slug'] . "/");
              exit;
          } else {
              $error_msg = 'Judul dan Konten tidak boleh kosong!';
          }
      }
  }

  $post_date = date('Y-m-d', strtotime($article['created_at']));
  $post_time = date('H:i', strtotime($article['created_at']));
?>
<?php require ($_SERVER['SMS'].'template/inc/meta.php')?>
<?php require ($_SERVER['SMS'].'template/inc/header.php')?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>
<script>
  tinymce.init({
    selector: '#editor-textarea',
    height: 450,
    menubar: false,
    plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
    toolbar: 'undo redo | blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
    content_style: 'body { font-family:Poppins,sans-serif; font-size:14px }'
  });
</script>

<div class="rancak-foundation">
  
<section class="section-default section-editor content-center">
  <div class="section-container">

    <form method="POST" action="" enctype="multipart/form-data">
      <input type="hidden" name="csrf_token" value="<?php echo get_csrf_token(); ?>">
      <div class="editor-content">
        <div class="section-title">
          <h2 class="text-title section-title-primary">Edit Article</h2>
        </div>
        <?php if (!empty($error_msg)): ?>
          <div class="slb-label"><?php echo htmlspecialchars($error_msg); ?></div>
        <?php endif; ?>
        <div class="editor-detail">
          <div class="editor-detail-form">
            <div class="slb-label">Title</div>
            <div class="form-box slb-box">
              <input class="form-field" type="text" name="Title" required placeholder="Title" value="<?php echo htmlspecialchars($article['title']); ?>">
            </div>
          </div>
          <div class="editor-detail-form">
            <div class="slb-label">Hero Image</div>
            <div class="form-box slb-box">
              <input class="form-field" type="file" name="HeroImage" accept="image/*" placeholder="Hero Image">
              <div class="slb-label">Image saat ini: <?php echo htmlspecialchars($article['hero_image'] . '-desktop-big.jpg'); ?></div>
            </div>
          </div>
          <div class="editor-detail-form">
            <div class="slb-label">Date</div>
            <div class="form-box slb-box">
              <input class="form-field" type="date" name="Date" value="<?php echo $post_date; ?>" disabled>
            </div>
          </div>
          <div class="editor-detail-form">
            <div class="slb-label">Time</div>
            <div class="form-box slb-box">
              <input class="form-field" type="time" name="Time" value="<?php echo $post_time; ?>" disabled>
            </div>
          </div>
          <div class="editor-detail-action">
            <textarea id="editor-textarea" name="Content"><?php echo htmlspecialchars($article['content']); ?></textarea>
          </div>
          <div class="editor-detail-action">
            <button type="submit" name="action" value="save" class="btn eda-button button-save">Save</button>
            <a href="/admin/" class="btn btn-outline eda-button button-cancel">Cancel</a>
            <button type="submit" name="action" value="delete" class="btn eda-button button-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">Delete</button>
          </div>
        </div>
      </div>
    </form>

  </div>
</section>

</div>
<?php require ($_SERVER['SMS'].'template/inc/footer.php')?>
<?php require ($_SERVER['SMS'].'template/inc/base-bottom.php')?>