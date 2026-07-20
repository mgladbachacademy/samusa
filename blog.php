<?php 
  $menu='blog';
  require ('template/inc/base.php');
  require_once ($_SERVER['SMS'].'template/inc/db.php');

  $stmt = $pdo->query("SELECT * FROM articles WHERE is_deleted = 0 ORDER BY created_at DESC LIMIT 9");
  $articles = $stmt->fetchAll();
?>
<?php require ($_SERVER['SMS'].'template/inc/meta.php')?>
<?php require ($_SERVER['SMS'].'template/inc/header.php')?>
<div class="rancak-foundation">
  
<section class="section-default section-cover section-cover-small content-center">
  <picture class="section-bg img-frame">
    <source media="(min-width:1280px)" data-srcset="template/img/cover-about-desktop-big.jpg">
    <source media="(min-width:640px)" data-srcset="template/img/cover-about-desktop.jpg">
    <source media="(min-width:415px)" data-srcset="template/img/cover-about-mobile.jpg">
    <img alt="Cover Home" class="lazyload" data-original="template/img/cover-about-mobile-small.jpg"/>
  </picture>
  <div class="section-overlay"></div>
  <div class="section-gradient"></div>
  <div class="section-container">
    <div class="cover-box">
      <h2 class="text-title cover-title">Recent Articles</h2>
    </div>
  </div>
</section>
  
<section class="section-default section-tipeB content-center">
  <div class="section-container" id="blog-container">

    <?php foreach ($articles as $row): ?>
      <?php 
        $clean_desc = strip_tags($row['content']);
        if (mb_strlen($clean_desc) > 150) {
            $clean_desc = mb_substr($clean_desc, 0, 150) . '...';
        }
      ?>
      <a title="<?php echo htmlspecialchars($row['title']); ?>" class="tipeB-box article-box" href="blog/<?php echo $row['id'] . '-' . $row['slug']; ?>/">
        <div class="tipeB-img">
          <picture class="tipeB-img-frame img-frame thumb-loading">
            <img alt="Foto <?php echo htmlspecialchars($row['title']); ?>" class="lazyload" data-original="template/img/blog/<?php echo htmlspecialchars($row['hero_image']); ?>-mobile-small.jpg"/>
          </picture>
        </div>
        <div class="tipeB-content">
          <h2 class="text-title tipeB-title"><?php echo htmlspecialchars($row['title']); ?></h2>
          <div class="tipeB-desc"><?php echo $clean_desc; ?></div>
          <div class="tipeB-more">
            <span>Read More</span>
            <?php require ($_SERVER['SMS'].'template/img/icon/more.svg')?>
          </div>
        </div>
      </a>
    <?php endforeach; ?>

  </div>
</section>

<div id="scroll-loader" class="content-center hide">
  <span>Loading more articles...</span>
</div>

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

        fetch(`/api/articles.php?page=${currentPage}&type=blog`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('scroll-loader').classList.add('hide');
                if (data.length > 0) {
                    const container = document.getElementById('blog-container');
                    data.forEach(item => {
                        const a = document.createElement('a');
                        a.title = item.title;
                        a.className = 'tipeB-box article-box';
                        a.href = `blog/${item.id}-${item.slug}/`;
                        a.innerHTML = `
                          <div class="tipeB-img">
                            <picture class="tipeB-img-frame img-frame thumb-loading">
                              <img alt="Foto ${item.title}" class="lazyload" src="template/img/blog/${item.hero_image}-mobile-small.jpg"/>
                            </picture>
                          </div>
                          <div class="tipeB-content">
                            <h2 class="text-title tipeB-title">${item.title}</h2>
                            <div class="tipeB-desc">${item.desc}</div>
                            <div class="tipeB-more">
                              <span>Read More</span>
                              <?php require ($_SERVER['SMS'].'template/img/icon/more.svg')?>
                            </div>
                          </div>
                        `;
                        container.appendChild(a);
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