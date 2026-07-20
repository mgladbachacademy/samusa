<?php 
  $menu='admin';
  require ('template/inc/base.php');
  require_once ($_SERVER['SMS'].'template/inc/db.php');
  check_admin();

  $error_msg = '';
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      verify_csrf_token($_POST['csrf_token'] ?? '');
      $title = trim($_POST['Title'] ?? '');
      $content = $_POST['Content'] ?? '';
      
      if (!empty($title) && !empty($content) && isset($_FILES['HeroImage']) && $_FILES['HeroImage']['error'] === UPLOAD_ERR_OK) {
          $slug = create_slug($title);
          
          $stmt = $pdo->prepare("SELECT COUNT(*) FROM articles WHERE slug = ?");
          $stmt->execute([$slug]);
          if ($stmt->fetchColumn() > 0) {
              $slug .= '-' . time();
          }

          $upload_dir = $_SERVER['SMS'] . 'template/img/blog/';
          if (!is_dir($upload_dir)) {
              mkdir($upload_dir, 0755, true);
          }

          $tmp_name = $_FILES['HeroImage']['tmp_name'];
          
          // Resolusi baru sesuai instruksi review
          $resizes = [
              '-mobile-small.jpg' => 414,
              '-mobile.jpg'       => 640,
              '-desktop.jpg'      => 1024,
              '-desktop-big.jpg'  => 1920
          ];

          $upload_success = true;
          foreach ($resizes as $suffix => $width) {
              if (!resize_image_proporsional($tmp_name, $upload_dir . $slug . $suffix, $width)) {
                  $upload_success = false;
                  break;
              }
          }

          if ($upload_success) {
              $stmt = $pdo->prepare("INSERT INTO articles (title, slug, content, hero_image, author, is_deleted) VALUES (?, ?, ?, ?, 'Samusa Global Consultant', 0)");
              $stmt->execute([$title, $slug, $content, $slug]);
              header("Location: /admin/");
              exit;
          } else {
              $error_msg = 'Gagal memproses gambar. Pastikan format file adalah JPG, PNG, atau WEBP.';
          }
      } else {
          $error_msg = 'Silakan lengkapi Judul, Gambar Utama, dan Isi Artikel!';
      }
  }
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

    <form method="POST" action="/admin/new-article/" enctype="multipart/form-data">
      <input type="hidden" name="csrf_token" value="<?php echo get_csrf_token(); ?>">
      <div class="editor-content">
        <div class="section-title">
          <h2 class="text-title section-title-primary">Create Article</h2>
        </div>
        <?php if (!empty($error_msg)){ ?>
          <div class="slb-label"><?php echo htmlspecialchars($error_msg); ?></div>
        <?php } ?>
        <div class="editor-detail">
          <div class="editor-detail-form">
            <div class="slb-label">Title</div>
            <div class="form-box slb-box">
              <input class="form-field" type="text" name="Title" required placeholder="Title">
            </div>
          </div>
          <div class="editor-detail-form">
            <div class="slb-label">Hero Image</div>
            <div class="form-box slb-box">
              <input class="form-field" type="file" name="HeroImage" accept="image/*" required placeholder="Hero Image">
            </div>
          </div>
          <div class="editor-detail-action">
            <textarea id="editor-textarea" name="Content"></textarea>
          </div>
          <div class="editor-detail-action">
            <button type="submit" class="btn eda-button button-save">Save</button>
            <a href="/admin/" class="btn btn-outline eda-button button-cancel">Cancel</a>
          </div>
        </div>
      </div>
    </form>

  </div>
</section>

</div>
<?php require ($_SERVER['SMS'].'template/inc/footer.php')?>
<?php require ($_SERVER['SMS'].'template/inc/base-bottom.php')?>