<?php
session_start();
require_once '../config/db.php';

if (isset($_POST['add_project'])) {
    $category = $_POST['category'] ?? 'rr_home';
    $title = $_POST['title'] ?? '';
    $short_description = $_POST['short_description'] ?? '';
    $description = $_POST['description'] ?? '';
    $specifications = $_POST['specifications'] ?? '';
    $seo_title = $_POST['seo_title'] ?? '';
    $seo_description = $_POST['seo_description'] ?? '';

    try {
        // Insert Project
        $stmt = $pdo->prepare("INSERT INTO projects (category, title, short_description, description, specifications, seo_title, seo_description) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$category, $title, $short_description, $description, $specifications, $seo_title, $seo_description]);
        $project_id = $pdo->lastInsertId();

        // Handle Image Uploads
        $upload_dir = '../assets/images/projects/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if (!empty($_FILES['images']['name'][0])) {
            foreach ($_FILES['images']['name'] as $key => $filename) {
                $tmp_name = $_FILES['images']['tmp_name'][$key];
                $error = $_FILES['images']['error'][$key];
                
                if ($error === UPLOAD_ERR_OK) {
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $new_filename = uniqid() . '_' . time() . '.' . $ext;
                    $target_file = $upload_dir . $new_filename;
                    
                    if (move_uploaded_file($tmp_name, $target_file)) {
                        // Insert Media
                        $media_path = 'assets/images/projects/' . $new_filename;
                        $stmt = $pdo->prepare("INSERT INTO project_media (project_id, file_path) VALUES (?, ?)");
                        $stmt->execute([$project_id, $media_path]);
                    }
                }
            }
        }

        $_SESSION['success_msg'] = "Project added successfully!";
        header("Location: add_project.php");
        exit();

    } catch (PDOException $e) {
        $_SESSION['error_msg'] = "Error adding project: " . $e->getMessage();
        header("Location: add_project.php");
        exit();
    }
} else {
    header("Location: add_project.php");
    exit();
}
?>
