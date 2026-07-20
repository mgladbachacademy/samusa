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
  
  
  
  

<section class="section-default section-admin-article content-center">
  <div class="section-container">

    <div class="admin-article-content">
      <div class="section-title">
        <h2 class="text-title section-title-primary">Article List</h2>
      </div>
      <div class="aal-new-article">
        <a class="btn aal-button aal-button-create" href="admin/new-article/">Create Article</a>
        <a class="btn btn-outline aal-button" href="admin/archive/">Archive</a>
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
                <a class="btn aal-button button-edit" href="admin/edit/<?php echo $row['id'] . '-' . $row['slug']; ?>/">Edit</a>
                <button class="btn aal-button button-delete" onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete</button>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>

  </div>
</section>

</div>

<form id="delete-form" method="POST" action="/admin/" class="hide">
  <input type="hidden" name="csrf_token" value="<?php echo get_csrf_token(); ?>">
  <input type="hidden" name="delete_id" id="delete-id-input" value="">
</form>

<script>
function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus artikel ini?')) {
        document.getElementById('delete-id-input').value = id;
        document.getElementById('delete-form').submit();
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

        fetch(`/api/articles.php?page=${currentPage}&type=admin`)
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
                              <a class="btn aal-button button-edit" href="admin/edit/${item.id}-${item.slug}/">Edit</a>
                              <button class="btn aal-button button-delete" onclick="confirmDelete(${item.id})">Delete</button>
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