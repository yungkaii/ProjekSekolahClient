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
<<<<<<< HEAD
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
=======
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">    
    <style>
        body { font-family: 'Open Sans', sans-serif; background-color: #f4f7f6; }
        
        /* Hero Section */
        .hero-section {
            position: relative; height: 80vh; background-size: cover; background-position: center;
            display: flex; align-items: center; justify-content: center; color: white; text-align: center;
        }
        .hero-overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.6); z-index: 1;
        }
        .hero-content { position: relative; z-index: 2; padding: 20px; }
        
        /* Judul Section */
        .section-title { font-weight: 700; color: #28a745; margin-bottom: 40px; position: relative; }
        .section-title::after {
            content: ''; position: absolute; left: 50%; transform: translateX(-50%); bottom: -15px;
            width: 80px; height: 4px; background-color: #28a745;
        }

        /* Card Berita */
        .card-custom {
            border: none; border-radius: 10px; transition: transform 0.3s; box-shadow: 0 4px 15px rgba(0,0,0,0.08); overflow: hidden;
        }
        .card-custom:hover { transform: translateY(-8px); }
        
        /* Footer */
        footer { background-color: #343a40; color: #f8f9fa; padding: 60px 0 30px; }
        footer a { color: #adb5bd; text-decoration: none; }
    </style>
</head>
<body>
>>>>>>> de354fc30b76cb77a822ce5b1d0cd7fcb2b0f525
