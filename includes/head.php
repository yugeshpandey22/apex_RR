<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>RR Homes & Apex | Premium Real Estate</title>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Custom Global CSS -->
<link rel="stylesheet" href="/apex/assets/css/style.css">

<!-- Page Specific CSS -->
<?php 
$page_css = str_replace('.php', '.css', basename($_SERVER['PHP_SELF']));
$css_path = $_SERVER['DOCUMENT_ROOT'] . "/apex/assets/css/" . $page_css;
if (file_exists($css_path)) {
    echo '<link rel="stylesheet" href="/apex/assets/css/' . $page_css . '?v=' . time() . '">';
}


?>

