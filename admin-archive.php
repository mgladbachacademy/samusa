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
          // Eksekusi hapus file fisik gambar (hanya saat Delete Permanen)
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
  
<section class="section-default section-admin-article content-center">
  <div class="section-container">

    <div class="admin-article-content">
      <div class="section-title">
        <h2 class="text-title section-title-primary">Archived Articles</h2>
      </div>
      <div class="aal-new-article">
        <a class="btn aal-button" href="/admin/">Back to Article List</a>
      </div>
      <div class="admin-article-list" id="article-list-container">
        <?php foreach ($articles as $row){ ?>
          <div class="aal-box">
            <div class="aal-image">
              <div class="aal-image-frame img-frame thumb-loading">
                <img alt="Foto <?php echo htmlspecialchars($row['title']); ?>" class="lazyload" data-original="template/img/blog/<?php echo htmlspecialchars($row['hero_image']); ?>-mobile-small.jpg"/>
              </div>
            </div>
            <div class="aal-info">
              <h2 class="aal-title"><?php echo htmlspecialchars($row['title']); ?></h2>
              <div class="aal-action">
                <button class="btn aal-button button-edit" onclick="submitArchive(<?php echo $row['id']; ?>, 'restore')">Restore</button>
                <button class="btn aal-button button-delete" onclick="submitArchive(<?php echo $row['id']; ?>, 'delete_permanent')">Delete Permanent</button>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>

  </div>
</section>

</div>

<form id="archive-form" method="POST" action="/admin/archive/" class="hide">
  <input type="hidden" name="csrf_token" value="<?php echo get_csrf_token(); ?>">
  <input type="hidden" name="article_id" id="archive-id-input" value="">
  <input type="hidden" name="action" id="archive-action-input" value="">
</form>

<script>
function submitArchive(id, action) {
    let msg = action === 'restore' ? 'Kembalikan artikel ini ke daftar utama?' : 'Hapus permanen? Data dan gambar fisik tidak bisa dikembalikan!';
    if (confirm(msg)) {
        document.getElementById('archive-id-input').value = id;
        document.getElementById('archive-action-input').value = action;
        document.getElementById('archive-form').submit();
    }
}

let currentPage = 1;
let isLoading = false;
let hasMore = <?php echo count($articles) >= 9 ? 'true' : 'false'; ?>;

window.addEventListener('scroll', () => {
    if (isLoading || !hasMore) return;
    
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 200) {
        isLoading = true;
        currentPage++;

        fetch(`/api/articles.php?page=${currentPage}&type=archive`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    const container = document.getElementById('article-list-container');
                    data.forEach(item => {
                        const div = document.createElement('div');
                        div.className = 'aal-box';
                        div.innerHTML = `
                          <div class="aal-image">
                            <div class="aal-image-frame img-frame thumb-loading">
                              <img alt="Foto ${item.title}" class="lazyload" src="template/img/blog/${item.hero_image}-mobile-small.jpg"/>
                            </div>
                          </div>
                          <div class="aal-info">
                            <h2 class="aal-title">${item.title}</h2>
                            <div class="aal-action">
                              <button class="btn aal-button button-edit" onclick="submitArchive(${item.id}, 'restore')">Restore</button>
                              <button class="btn aal-button button-delete" onclick="submitArchive(${item.id}, 'delete_permanent')">Delete Permanent</button>
                            </div>
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
            });
    }
});
</script>

<?php require ($_SERVER['SMS'].'template/inc/footer.php')?>
<?php require ($_SERVER['SMS'].'template/inc/base-bottom.php')?>