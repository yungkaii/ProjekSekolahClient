<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- custom styles -->
    <?php
    // calculate relative path to assets directory (handles pages inside subfolders)
    $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    ?>
    <link rel="stylesheet" href="<?= $basePath ?>/assets/css/style.css?v=<?= time() ?>">
</head>
<body>  
<script>
document.addEventListener('DOMContentLoaded', function() {
    // toggle class when scrolling
    window.addEventListener('scroll', function() {
        const nav = document.querySelector('.navbar');
        if(window.scrollY > 50) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
    });

    // smooth scroll for internal anchors
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if(target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
});
</script>