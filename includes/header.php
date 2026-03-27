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
    
    <!-- Global CSS Animations & Effects -->
    <style>
        :root {
            --primary-color: #198754;
            --secondary-color: #20c997;
            --dark-color: #1a1a1a;
            --light-color: #f8f9fa;
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.1);
            --shadow-md: 0 8px 16px rgba(0,0,0,0.15);
            --shadow-lg: 0 15px 40px rgba(0,0,0,0.2);
            --gradient-primary: linear-gradient(135deg, #198754 0%, #20c997 100%);
            --transition-smooth: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ========================
           SMOOTH SCROLL & BASE
           ======================== */
        html {
            scroll-behavior: smooth;
        }

        body {
            color: #333;
            overflow-x: hidden;
        }

        * {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* ========================
           ANIMATION KEYFRAMES
           ======================== */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.8;
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes glow {
            0%, 100% {
                box-shadow: 0 0 20px rgba(25, 135, 84, 0.3);
            }
            50% {
                box-shadow: 0 0 40px rgba(25, 135, 84, 0.6);
            }
        }

        /* ========================
           UTILITY CLASSES
           ======================== */
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        .fade-in-left {
            animation: fadeInLeft 0.6s ease-out;
        }

        .fade-in-right {
            animation: fadeInRight 0.6s ease-out;
        }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }

        /* ========================
           SCROLL ANIMATION TRIGGER
           ======================== */
        .scroll-animate {
            opacity: 0;
        }

        .scroll-animate.show {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        /* ========================
           SMOOTH BUTTON EFFECTS
           ======================== */
        .btn {
            border: none;
            border-radius: 50px;
            padding: 0.65rem 2rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-success, .btn-outline-success {
            background: var(--gradient-primary);
            border: none;
        }

        .btn-success:hover, .btn-outline-success:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* ========================
           CARD IMPROVEMENTS
           ======================== */
        .card {
            border-radius: 12px;
            transition: var(--transition-smooth);
            border: none;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        /* ========================
           SECTION SPACING
           ======================== */
        .section {
            position: relative;
            overflow: hidden;
        }

        /* ========================
           GRADIENT BACKGROUNDS
           ======================== */
        .bg-gradient-primary {
            background: var(--gradient-primary);
            color: white;
        }

        .text-gradient {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ========================
           HEADING STYLES
           ======================== */
        h1, h2, h3, h4, h5, h6 {
            color: var(--dark-color);
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .section-title {
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--gradient-primary);
            border-radius: 10px;
        }
    </style>
</head>
<body>  
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ========================
    // NAVBAR SCROLL EFFECT
    // ========================
    window.addEventListener('scroll', function() {
        const nav = document.querySelector('.navbar');
        if(window.scrollY > 50) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
    });

    // ========================
    // SMOOTH SCROLL FOR ANCHORS
    // ========================
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if(target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // ========================
    // SCROLL REVEAL ANIMATION
    // ========================
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if(entry.isIntersecting) {
                entry.target.classList.add('show');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Apply observer to scroll-animate elements
    document.querySelectorAll('.scroll-animate').forEach(el => {
        observer.observe(el);
    });

    // ========================
    // PARALLAX EFFECT
    // ========================
    window.addEventListener('scroll', function() {
        const parallaxElements = document.querySelectorAll('[data-parallax]');
        parallaxElements.forEach(el => {
            const scrollPosition = window.scrollY;
            const yPos = scrollPosition * 0.5;
            el.style.transform = `translateY(${yPos}px)`;
        });
    });
});
</script>