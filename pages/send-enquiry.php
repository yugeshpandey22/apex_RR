<?php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';
    $project_name = $_POST['project_name'] ?? '';

    try {
        $stmt = $pdo->prepare("INSERT INTO enquiries (name, email, phone, subject, message, project_name) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $subject, $message, $project_name]);

        // Instead of setting session and redirecting, we can show a simple success message
        // Or if the project uses a specific pattern, we can redirect back to the referer.
        $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
        
        echo "<script>
            alert('Thank you for your enquiry! We will get back to you soon.');
            window.location.href = '{$referer}';
        </script>";
        exit();
        
    } catch (PDOException $e) {
        $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
        echo "<script>
            alert('Sorry, there was an error submitting your enquiry. Please try again later.');
            window.location.href = '{$referer}';
        </script>";
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>
