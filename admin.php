<?php 
  $menu='admin';
  require ('template/inc/base.php');
  require_once ($_SERVER['SMS'].'template/inc/db.php');
  check_admin();

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
      verify_csrf_token($_POST['csrf_token'] ?? '');
      $del_id = (int)$_POST['delete_id'];
      $pdo->prepare("UPDATE articles SET is_deleted = 1 WHERE id = ?")->execute([$del_id]);
      header("Location: /admin/");
      exit;
  }

  $stmt = $pdo->query("SELECT * FROM articles WHERE is_deleted = 0 ORDER BY created_at DESC LIMIT 9");
  $articles = $stmt->fetchAll();
?>
<?php require ($_SERVER['SMS'].'template/inc/meta.php')?>
<?php require ($_SERVER['SMS'].'template/inc/header.php')?>
<div class="rancak-foundation">
  
<section class="section-default section-admin content-center">
  <div class="section-container">

    <div class="section-title">
      <h2 class="text-title section-title-primary">Article List</h2>
    </div>
    <div class="aal-new-article">
      <a href="/admin/archive/" class="btn btn-outline">Archive</a>
      <a href="/admin/new-article/" class="btn">Create Article</a>
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
              <a href="/blog/<?php echo $row['id'] . '-' . $row['slug']; ?>/" target="_blank">
                <?php echo htmlspecialchars($row['title']); ?>
              </a>
            </h3>
            <div class="aal-date"><?php echo date('d M Y, H:i', strtotime($row['created_at'])); ?></div>
          </div>
          <div class="aal-action">
            <a href="/admin/edit/<?php echo $row['id'] . '-' . $row['slug']; ?>/" class="btn btn-outline">Edit</a>
            <form method="POST" action="/admin/">
              <input type="hidden" name="csrf_token" value="<?php echo get_csrf_token(); ?>">
              <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
              <button type="submit" class="btn button-delete" onclick="return confirm('Hapus artikel ini?');">Delete</button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div id="scroll-loader" class="content-center hide">
      <span>Loading more articles...</span>
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

        fetch(`/api/articles.php?page=${currentPage}&type=admin`)
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
                            <h3 class="text-title aal-title">
                              <a href="/blog/${item.id}-${item.slug}/" target="_blank">${item.title}</a>
                            </h3>
                            <div class="aal-date">${item.date}</div>
                          </div>
                          <div class="aal-action">
                            <a href="/admin/edit/${item.id}-${item.slug}/" class="btn btn-outline">Edit</a>
                            <form method="POST" action="/admin/">
                              <input type="hidden" name="csrf_token" value="<?php echo get_csrf_token(); ?>">
                              <input type="hidden" name="delete_id" value="${item.id}">
                              <button type="submit" class="btn button-delete" onclick="return confirm('Hapus artikel ini?');">Delete</button>
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