<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('Direct access not permitted');
}

$domain = $_SERVER['HTTP_HOST'];
if ($domain === 'samusa' || $domain === '127.0.0.1') {
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'db_samusa'; 
} else {
    $db_host = 'localhost'; 
    $db_user = 'u981788094_samusa'; 
    $db_pass = '54mUs@Ind0N3S1a'; 
    $db_name = 'u981788094_samusa'; 
}

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    die("Koneksi Database Gagal: " . $e->getMessage());
}

if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_samesite', 'Lax');
    session_start();
}

// Auto-seed akun admin (username: admin, password: 54mUs@Ind0N3S1a)
$stmt_check = $pdo->query("SELECT COUNT(*) FROM users WHERE username = 'admin'");
if ($stmt_check->fetchColumn() == 0) {
    $default_pass_hash = password_hash('54mUs@Ind0N3S1a', PASSWORD_DEFAULT);
    $pdo->prepare("INSERT INTO users (username, password) VALUES ('admin', ?)")->execute([$default_pass_hash]);
}

function get_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token) {
    if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
        die("Validasi Keamanan Gagal (CSRF Token Invalid). Silakan refresh halaman.");
    }
}

function check_admin() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header("Location: /login/");
        exit;
    }
}

function create_slug($string) {
    $string = strtolower(trim($string));
    $string = preg_replace('/[^a-z0-9-]/', '-', $string);
    $string = preg_replace('/-+/', "-", $string);
    return rtrim($string, '-');
}

// Helper Resize Gambar Proporsional (Resolusi: 414px, 640px, 1024px, 1920px)
function resize_image_proporsional($source_path, $dest_path, $target_width) {
    list($width, $height, $type) = getimagesize($source_path);
    
    $ratio = $target_width / $width;
    $target_height = round($height * $ratio);

    $src_img = null;
    switch ($type) {
        case IMAGETYPE_JPEG: $src_img = imagecreatefromjpeg($source_path); break;
        case IMAGETYPE_PNG:  $src_img = imagecreatefrompng($source_path); break;
        case IMAGETYPE_WEBP: $src_img = imagecreatefromwebp($source_path); break;
        default: return false;
    }

    if (!$src_img) return false;

    $dst_img = imagecreatetruecolor($target_width, $target_height);
    imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $target_width, $target_height, $width, $height);
    imagejpeg($dst_img, $dest_path, 90);

    imagedestroy($src_img);
    imagedestroy($dst_img);
    return true;
}
?>