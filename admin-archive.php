<?php 
  $menu='admin';
  require ('template/inc/base.php');
  require_once ($_SERVER['SMS'].'template/inc/db.php');
  check_admin();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      verify_csrf_token($_POST['csrf_token'] ?? '');
      $target_id = (int)$_POST['article_id'];
      $action = $_POST['action'] ?? '';

      if ($action === 'restore') {
          $pdo->prepare("UPDATE articles SET is_deleted = 0 WHERE id = ?")->execute([$target_id]);
      } elseif ($action === 'delete_permanent') {
          $stmt_img = $pdo->prepare("SELECT hero_image FROM articles WHERE id = ?");
          $stmt_img->execute([$target_id]);
          $img_data = $stmt_img->fetch();

          if ($img_data) {
              $upload_dir = $_SERVER['SMS'] . 'template/img/blog/';
              $resizes = ['-mobile-small.jpg', '-mobile.jpg', '-desktop.jpg', '-desktop-big.jpg'];
              foreach ($resizes as $suffix) {
                  $file_path = $upload_dir . $img_data['hero_image'] . $suffix;
                  if (file_exists($file_path)) unlink($file_path);
              }
          }
          $pdo->prepare("DELETE FROM articles WHERE id = ?")->execute([$target_id]);
      }
      header("Location: /admin/archive/");
      exit;
  }

  $stmt = $pdo->query("SELECT * FROM articles WHERE is_deleted = 1 ORDER BY created_at DESC LIMIT 9");
  $articles = $stmt->fetchAll();
?>
<?php require ($_SERVER['SMS'].'template/inc/meta.php')?>
<?php require ($_SERVER['SMS'].'template/inc/header.php')?>
<div class="rancak-foundation">
  
<section class="section-default section-admin content-center">
  <div class="section-container">

    <div class="admin-top">
      <h2 class="text-title section-title-primary">Archived Articles</h2>
      <div class="admin-top-action">
        <a href="/admin/" class="btn btn-outline">Back to Article List</a>
      </div>
    </div>

    <div class="admin-article-list" id="article-container">
      <?php foreach ($articles as $row): ?>
        <div class="admin-article-box">
          <div class="aal-image">
            <picture class="aal-image-frame img-frame thumb-loading">
              <img alt="Foto <?php echo htmlspecialchars($row['title']); ?>" class="lazyload" data-original="template/img/blog/<?php echo htmlspecialchars($row['hero_image']); ?>-mobile-small.jpg"/>
            </picture>
          </div>
          <div class="aal-info">
            <h3 class="text-title aal-title">
              <?php echo htmlspecialchars($row['title']); ?>
            </h3>
            <div class="aal-date">Dihapus pada: <?php echo date('d M Y, H:i', strtotime($row['updated_at'])); ?></div>
          </div>
          <div class="aal-action">
            <form method="POST" action="/admin/archive/">
              <input type="hidden" name="csrf_token" value="<?php echo get_csrf_token(); ?>">
              <input type="hidden" name="article_id" value="<?php echo $row['id']; ?>">
              <button type="submit" name="action" value="restore" class="btn btn-outline">Restore</button>
              <button type="submit" name="action" value="delete_permanent" class="btn button-delete" onclick="return confirm('Hapus permanen? Data dan gambar tidak bisa dikembalikan!');">Delete Permanen</button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div id="scroll-loader" class="content-center hide">
      <span>Loading more archive...</span>
    </div>

  </div>
</section>

</div>

<script>
let currentPage = 1;
let isLoading = false;
let hasMore = <?php echo count($articles) >= 9 ? 'true' : 'false'; ?>;

window.addEventListener('scroll', () => {
    if (isLoading || !hasMore) return;
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 200) {
        isLoading = true;
        currentPage++;
        document.getElementById('scroll-loader').classList.remove('hide');

        fetch(`/api/articles.php?page=${currentPage}&type=archive`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('scroll-loader').classList.add('hide');
                if (data.length > 0) {
                    const container = document.getElementById('article-container');
                    data.forEach(item => {
                        const div = document.createElement('div');
                        div.className = 'admin-article-box';
                        div.innerHTML = `
                          <div class="aal-image">
                            <picture class="aal-image-frame img-frame thumb-loading">
                              <img alt="Foto ${item.title}" class="lazyload" src="template/img/blog/${item.hero_image}-mobile-small.jpg"/>
                            </picture>
                          </div>
                          <div class="aal-info">
                            <h3 class="text-title aal-title">${item.title}</h3>
                            <div class="aal-date">Dihapus pada: ${item.date}</div>
                          </div>
                          <div class="aal-action">
                            <form method="POST" action="/admin/archive/">
                              <input type="hidden" name="csrf_token" value="<?php echo get_csrf_token(); ?>">
                              <input type="hidden" name="article_id" value="${item.id}">
                              <button type="submit" name="action" value="restore" class="btn btn-outline">Restore</button>
                              <button type="submit" name="action" value="delete_permanent" class="btn button-delete" onclick="return confirm('Hapus permanen? Data dan gambar tidak bisa dikembalikan!');">Delete Permanen</button>
                            </form>
                          </div>
                        `;
                        container.appendChild(div);
                    });
                    if (data.length < 9) hasMore = false;
                } else {
                    hasMore = false;
                }
                isLoading = false;
            })
            .catch(() => {
                isLoading = false;
                document.getElementById('scroll-loader').classList.add('hide');
            });
    }
});
</script>

<?php require ($_SERVER['SMS'].'template/inc/footer.php')?>
<?php require ($_SERVER['SMS'].'template/inc/base-bottom.php')?>