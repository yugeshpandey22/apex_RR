<?php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_project'])) {
    $id = $_POST['id'];
    $category = $_POST['category'] ?? 'rr_home';

    try {
        // Fetch media to delete physical files
        $stmt_media = $pdo->prepare("SELECT file_path FROM project_media WHERE project_id = ?");
        $stmt_media->execute([$id]);
        $media_files = $stmt_media->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($media_files as $media) {
            $path = '../' . $media['file_path'];
            if (file_exists($path)) {
                unlink($path);
            }
        }

        // Project media records are deleted via CASCADE in DB if set up, otherwise we delete them manually
        $stmt_delete_media = $pdo->prepare("DELETE FROM project_media WHERE project_id = ?");
        $stmt_delete_media->execute([$id]);

        // Delete project
        $stmt_delete = $pdo->prepare("DELETE FROM projects WHERE id = ?");
        $stmt_delete->execute([$id]);

        // Redirect back with success (optional query string param could be added)
        header("Location: projects.php?category=" . urlencode($category));
        exit();

    } catch (Exception $e) {
        die("Error deleting project: " . $e->getMessage());
    }
} else {
    header("Location: projects.php");
    exit();
}
?>
