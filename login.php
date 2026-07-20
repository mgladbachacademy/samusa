<?php 
  $menu='login';
  require ('template/inc/base.php');
  require_once ($_SERVER['SMS'].'template/inc/db.php');

  if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
      header("Location: /admin/");
      exit;
  }

  $error_msg = '';
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      verify_csrf_token($_POST['csrf_token'] ?? '');
      $username = trim($_POST['username'] ?? '');
      $password = $_POST['password'] ?? '';

      if (!empty($username) && !empty($password)) {
          $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
          $stmt->execute([$username]);
          $user = $stmt->fetch();

          if ($user && password_verify($password, $user['password'])) {
              session_regenerate_id(true);
              $_SESSION['admin_logged_in'] = true;
              $_SESSION['admin_username'] = $user['username'];
              header("Location: /admin/");
              exit;
          } else {
              $error_msg = 'Username atau Password salah!';
          }
      } else {
          $error_msg = 'Silakan isi username dan password!';
      }
  }
?>
<?php require ($_SERVER['SMS'].'template/inc/meta.php')?>
<?php require ($_SERVER['SMS'].'template/inc/header.php')?>
<div class="rancak-foundation">
  
<section class="section-default section-login content-center">
  <div class="section-container">

    <form method="POST" action="/login/">
      <input type="hidden" name="csrf_token" value="<?php echo get_csrf_token(); ?>">
      <ul class="section-login-box">
        <?php if (!empty($error_msg)){ ?>
          <li class="slb-row">
            <div class="slb-label"><?php echo htmlspecialchars($error_msg); ?></div>
          </li>
        <?php } ?>
        <li class="slb-row">
          <div class="slb-label">Username</div>
          <div class="form-box slb-box">
            <input class="form-field" type="text" name="username" required placeholder="Username" autocomplete="username">
          </div>
        </li>
        <li class="slb-row">
          <div class="slb-label">Password</div>
          <div class="form-box form-password slb-box">
            <input class="form-field" type="password" name="password" required placeholder="••••••••••" autocomplete="current-password">
            <span title="Show/Hide Password" class="form-icon hide-password content-center" onclick="const p = this.previousElementSibling; p.type = p.type === 'password' ? 'text' : 'password';">
              <?php require ($_SERVER['SMS'].'template/img/icon/pass-hide.svg')?>
              <?php require ($_SERVER['SMS'].'template/img/icon/pass-show.svg')?>
            </span>
          </div>
        </li>
        <li class="slb-row">
          <button type="submit" class="btn slb-button">Login</button>
        </li>
      </ul>
    </form>

  </div>
</section>

</div>
<?php require ($_SERVER['SMS'].'template/inc/footer.php')?>
<?php require ($_SERVER['SMS'].'template/inc/base-bottom.php')?>