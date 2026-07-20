<?php
require_once ('../template/inc/db.php');

header('Content-Type: application/json');

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 9;
$offset = ($page - 1) * $limit;
$type = $_GET['type'] ?? 'blog';

// Proteksi keamanan: endpoint admin & archive wajib login admin
if ($type === 'admin' || $type === 'archive') {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        echo json_encode([]);
        exit;
    }
}

if ($type === 'archive') {
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE is_deleted = 1 ORDER BY created_at DESC LIMIT ? OFFSET ?");
} else {
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE is_deleted = 0 ORDER BY created_at DESC LIMIT ? OFFSET ?");
}

$stmt->bindValue(1, $limit, PDO::PARAM_INT);
$stmt->bindValue(2, $offset, PDO::PARAM_INT);
$stmt->execute();
$results = $stmt->fetchAll();

$data = [];
foreach ($results as $row) {
    $desc = strip_tags($row['content']);
    if (mb_strlen($desc) > 150) {
        $desc = mb_substr($desc, 0, 150) . '...';
    }

    $data[] = [
        'id' => $row['id'],
        'title' => htmlspecialchars($row['title']),
        'slug' => $row['slug'],
        'hero_image' => htmlspecialchars($row['hero_image']),
        'date' => date('d M Y, H:i', strtotime($row['created_at'])),
        'desc' => $desc
    ];
}

echo json_encode($data);
?>