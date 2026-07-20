<?php 
  $menu='blog-detail';
  require ('template/inc/base.php');
  require_once ($_SERVER['SMS'].'template/inc/db.php');

  $article_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
  $article_slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

  $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ? AND is_deleted = 0");
  $stmt->execute([$article_id]);
  $article = $stmt->fetch();

  // Validasi kecocokan slug & keberadaan artikel
  if (!$article || $article['slug'] !== $article_slug) {
      header("Location: /blog/");
      exit;
  }

  // Fetch 6 Artikel Terkait (Tanpa artikel saat ini)
  $stmt_rel = $pdo->prepare("SELECT * FROM articles WHERE id != ? AND is_deleted = 0 ORDER BY created_at DESC LIMIT 6");
  $stmt_rel->execute([$article_id]);
  $related_articles = $stmt_rel->fetchAll();
?>
<?php require ($_SERVER['SMS'].'template/inc/meta.php')?>
<?php require ($_SERVER['SMS'].'template/inc/header.php')?>
<div class="rancak-foundation">
  
<section class="section-default section-detail-article content-center">
  <div class="section-container">

    <div class="sda-top">
      <h1 class="text-title sda-title"><?php echo htmlspecialchars($article['title']); ?></h1>
      <h2 class="sda-date"><?php echo date('d F Y - H:i', strtotime($article['created_at'])); ?></h2>
      <h3 class="sda-author"><?php echo htmlspecialchars($article['author']); ?></h3>
    </div>

    <!-- Implementasi 4 Resolusi Gambar Proporsional -->
    <picture class="sda-img img-frame thumb-loading">
      <source media="(min-width:1280px)" data-srcset="template/img/blog/<?php echo htmlspecialchars($article['hero_image']); ?>-desktop-big.jpg">
      <source media="(min-width:640px)" data-srcset="template/img/blog/<?php echo htmlspecialchars($article['hero_image']); ?>-desktop.jpg">
      <source media="(min-width:415px)" data-srcset="template/img/blog/<?php echo htmlspecialchars($article['hero_image']); ?>-mobile.jpg">
      <img alt="Foto <?php echo htmlspecialchars($article['title']); ?>" class="lazyload" data-original="template/img/blog/<?php echo htmlspecialchars($article['hero_image']); ?>-mobile-small.jpg"/>
    </picture>

    <main class="sda-content">
      <?php echo $article['content']; ?>
    </main>

  </div>
</section>
  
<section class="section-default section-related-article content-center">
  <div class="section-container">

    <div class="related-article-content">
      <div class="section-title">
        <h2 class="text-title section-title-primary">Related Article</h2>
      </div>
      <div class="section-tipeB content-center">
        <div class="section-container">

          <?php foreach ($related_articles as $rel): ?>
            <?php 
              $rel_desc = strip_tags($rel['content']);
              if (mb_strlen($rel_desc) > 100) {
                  $rel_desc = mb_substr($rel_desc, 0, 100) . '...';
              }
            ?>
            <a title="<?php echo htmlspecialchars($rel['title']); ?>" class="tipeB-box article-box" href="blog/<?php echo $rel['id'] . '-' . $rel['slug']; ?>/">
              <div class="tipeB-img">
                <picture class="tipeB-img-frame img-frame thumb-loading">
                  <img alt="Foto <?php echo htmlspecialchars($rel['title']); ?>" class="lazyload" data-original="template/img/blog/<?php echo htmlspecialchars($rel['hero_image']); ?>-mobile-small.jpg"/>
                </picture>
              </div>
              <div class="tipeB-content">
                <h2 class="text-title tipeB-title"><?php echo htmlspecialchars($rel['title']); ?></h2>
                <div class="tipeB-desc"><?php echo $rel_desc; ?></div>
                <div class="tipeB-more">
                  <span>Read More</span>
                  <?php require ($_SERVER['SMS'].'template/img/icon/more.svg')?>
                </div>
              </div>
            </a>
          <?php endforeach; ?>

        </div>
      </div>
    </div>

  </div>
</section>

</div>
<?php require ($_SERVER['SMS'].'template/inc/footer.php')?>
<?php require ($_SERVER['SMS'].'template/inc/base-bottom.php')?>