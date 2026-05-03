<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'config/koneksi.php';
include 'includes/header.php';
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

<style>
:root{
    --primary-color: #198754;
    --primary-dark: #146c43;
    --secondary-color: #20c997;
    --accent-color: #f59e0b;
    --dark-color: #14202b;
    --text-color: #334155;
    --muted-color: #64748b;
    --light-bg: #f7faf8;
    --white: #ffffff;
    --border-soft: rgba(15, 23, 42, 0.08);
    --shadow-sm: 0 10px 30px rgba(15, 23, 42, 0.06);
    --shadow-md: 0 18px 45px rgba(15, 23, 42, 0.10);
    --shadow-lg: 0 25px 60px rgba(15, 23, 42, 0.16);
    --radius-sm: 14px;
    --radius-md: 20px;
    --radius-lg: 28px;
    --transition-smooth: all 0.35s ease;
}

/* =========================
   GLOBAL
========================= */
html{
    scroll-behavior: smooth;
}

body, h1, h2, h3, h4, h5, h6, p, a, span, div, li, small, strong {
    font-family: 'Open Sans', sans-serif !important;
}

body{
    color: var(--text-color);
    background:
        radial-gradient(circle at top left, rgba(25,135,84,0.07), transparent 20%),
        radial-gradient(circle at bottom right, rgba(32,201,151,0.06), transparent 22%),
        linear-gradient(180deg, #ffffff 0%, #f8fbf9 100%);
    overflow-x: hidden;
}

.navbar-brand, .nav-link {
    font-family: 'Open Sans', sans-serif !important;
}

a{
    text-decoration: none;
    transition: var(--transition-smooth);
}

img{
    max-width: 100%;
}

.section{
    position: relative;
    padding: 95px 0;
}

.section-soft{
    background: var(--light-bg);
}

.section-title-wrap{
    max-width: 760px;
    margin: 0 auto 55px;
    text-align: center;
}

.section-badge{
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    border-radius: 999px;
    background: rgba(25,135,84,0.10);
    color: var(--primary-color);
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    border: 1px solid rgba(25,135,84,0.10);
    margin-bottom: 18px;
}

.section-title{
    font-size: clamp(2rem, 3vw, 2.8rem);
    font-weight: 800;
    line-height: 1.2;
    color: var(--dark-color);
    margin-bottom: 12px;
    letter-spacing: -0.7px;
}

.section-subtitle{
    font-size: 1rem;
    line-height: 1.9;
    color: var(--muted-color);
    margin: 0;
}

.btn-main{
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: #fff;
    border: none;
    padding: 14px 24px;
    border-radius: 999px;
    font-weight: 700;
    box-shadow: 0 12px 28px rgba(25,135,84,0.22);
}

.btn-main:hover{
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 18px 38px rgba(25,135,84,0.28);
}

.btn-outline-soft{
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(255,255,255,0.10);
    color: #fff;
    border: 1px solid rgba(255,255,255,0.20);
    padding: 14px 24px;
    border-radius: 999px;
    font-weight: 700;
    backdrop-filter: blur(10px);
}

.btn-outline-soft:hover{
    color: #fff;
    transform: translateY(-3px);
    background: rgba(255,255,255,0.18);
}

.card-soft{
    background: rgba(255,255,255,0.92);
    border: 1px solid rgba(255,255,255,0.70);
    box-shadow: var(--shadow-md);
    border-radius: var(--radius-lg);
    backdrop-filter: blur(10px);
}

.text-gradient{
    background: linear-gradient(135deg, #ffffff 0%, #d2f8e8 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* =========================
   ANIMATION
========================= */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(28px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes fadeInLeft {
    from { opacity: 0; transform: translateX(-28px); }
    to { opacity: 1; transform: translateX(0); }
}
@keyframes fadeInRight {
    from { opacity: 0; transform: translateX(28px); }
    to { opacity: 1; transform: translateX(0); }
}
@keyframes floatSoft {
    0%,100%{ transform: translateY(0px); }
    50%{ transform: translateY(-8px); }
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(50px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes scaleIn {
    from { 
        opacity: 0; 
        transform: scale(0.85); 
    }
    to { 
        opacity: 1; 
        transform: scale(1); 
    }
}

@keyframes shimmer {
    0% { background-position: -1000px 0; }
    100% { background-position: 1000px 0; }
}

.scroll-animate{
    animation: fadeInUp 0.8s ease both;
}
.delay-1{ animation-delay: 0.12s; }
.delay-2{ animation-delay: 0.24s; }
.delay-3{ animation-delay: 0.36s; }
.delay-4{ animation-delay: 0.48s; }
.delay-5{ animation-delay: 0.60s; }

/* =========================
   HERO
========================= */
.hero-section{
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    color: #fff;
    overflow: hidden;
    background-size: cover;
    background-position: center;
}

.hero-section::before{
    content:'';
    position:absolute;
    inset:0;
    background:
        linear-gradient(120deg, rgba(10,16,24,0.78), rgba(10,16,24,0.42)),
        linear-gradient(135deg, rgba(25,135,84,0.34), rgba(32,201,151,0.22));
    z-index:1;
}

.hero-section::after{
    content:'';
    position:absolute;
    inset:0;
    background:
        radial-gradient(circle at 20% 25%, rgba(255,255,255,0.10), transparent 20%),
        radial-gradient(circle at 80% 15%, rgba(255,255,255,0.08), transparent 20%);
    z-index:1;
}

.hero-content{
    position: relative;
    z-index: 3;
    width: 100%;
    padding: 130px 0 90px;
}

.hero-grid{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    gap: 24px;
}

.hero-copy{
    max-width: 760px;
    width: 100%;
    text-align: center;
}

.hero-kicker{
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    border-radius: 999px;
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.18);
    backdrop-filter: blur(8px);
    margin-bottom: 22px;
    font-size: 0.82rem;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.hero-copy h1{
    font-size: clamp(2.4rem, 5vw, 4.8rem);
    font-weight: 800;
    line-height: 1.08;
    letter-spacing: -1.6px;
    margin-bottom: 22px;
    text-shadow: 0 8px 30px rgba(0,0,0,0.25);
}

.hero-copy .lead{
    font-size: 1.12rem;
    line-height: 1.95;
    color: rgba(255,255,255,0.88);
    max-width: 650px;
    margin: 0 auto 30px;
    text-align: center;
}

.hero-actions{
    display: flex;
    flex-wrap: wrap;
    gap: 14px;
    justify-content: center;
    margin-top: 18px;
}

.hero-panel{
    position: relative;
    background: rgba(255,255,255,0.10);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 30px;
    padding: 28px;
    backdrop-filter: blur(12px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.14);
    animation: floatSoft 4s ease-in-out infinite;
}

.hero-panel-top{
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 18px;
}

.hero-panel-icon{
    width: 62px;
    height: 62px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #fff, #d7fff0);
    color: var(--primary-color);
    font-size: 1.6rem;
    flex-shrink: 0;
}

.hero-panel h4{
    color: #fff;
    font-size: 1.15rem;
    font-weight: 800;
    margin: 0;
}

.hero-panel p{
    color: rgba(255,255,255,0.82);
    line-height: 1.9;
    font-size: 0.96rem;
    margin: 0;
}

.hero-mini-stats{
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 14px;
    margin-top: 18px;
}

.hero-stat{
    background: rgba(255,255,255,0.08);
    border-radius: 18px;
    padding: 16px;
    border: 1px solid rgba(255,255,255,0.10);
}

.hero-stat strong{
    display: block;
    color: #fff;
    font-size: 1.25rem;
    font-weight: 800;
    margin-bottom: 4px;
}

.hero-stat span{
    color: rgba(255,255,255,0.78);
    font-size: 0.88rem;
}

/* =========================
   TENTANG
========================= */
.tentang-wrap{
    position: relative;
}

.tentang-image-box{
    position: relative;
    border-radius: 30px;
    overflow: hidden;
    box-shadow: var(--shadow-lg);
    background: transparent;
    min-height: 0;
    animation: slideUp 0.8s ease forwards;
    opacity: 0;
}

.tentang-image-box img{
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
    transition: 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.tentang-image-box:hover img{
    transform: scale(1.06);
}

.tentang-floating-card{
    position: absolute;
    bottom: 24px;
    right: 24px;
    background: rgba(255,255,255,0.95);
    border-radius: 22px;
    padding: 18px 20px;
    box-shadow: 0 18px 42px rgba(15,23,42,0.14);
    max-width: 260px;
    animation: floatSoft 4s ease-in-out infinite, slideUp 0.8s ease 0.3s forwards;
    opacity: 0;
}

.tentang-floating-card h5{
    font-size: 1rem;
    font-weight: 800;
    color: var(--dark-color);
    margin-bottom: 8px;
}

.tentang-floating-card p{
    margin: 0;
    color: var(--muted-color);
    font-size: 0.92rem;
    line-height: 1.8;
}

.sambutan-card{
    padding: 34px;
    border-radius: 30px;
    background: linear-gradient(180deg, rgba(255,255,255,0.96), rgba(248,251,249,0.96));
    border: 1px solid rgba(15,23,42,0.06);
    box-shadow: var(--shadow-md);
    transition: var(--transition-smooth);
}

.sambutan-card:hover {
    box-shadow: 0 18px 45px rgba(15,23,42,0.12);
    transform: translateY(-4px);
}

.sambutan-card h2{
    font-size: clamp(1.8rem, 3vw, 2.5rem);
    line-height: 1.25;
    color: var(--dark-color);
    font-weight: 800;
    margin-bottom: 18px;
}

.sambutan-card .desc{
    color: var(--muted-color);
    line-height: 2;
    text-align: justify;
    margin-bottom: 24px;
}

.sambutan-points{
    display: grid;
    gap: 14px;
    margin-top: 22px;
}

.sambutan-point{
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 14px 16px;
    border-radius: 18px;
    background: #fff;
    border: 1px solid rgba(15,23,42,0.06);
    transition: var(--transition-smooth);
    animation: slideUp 0.6s ease forwards;
    opacity: 0;
}

.sambutan-point:nth-child(1) {
    animation-delay: 0.2s;
}

.sambutan-point:nth-child(2) {
    animation-delay: 0.3s;
}

.sambutan-point:nth-child(3) {
    animation-delay: 0.4s;
}

.sambutan-point:hover {
    border-color: var(--primary-color);
    background: rgba(25,135,84,0.05);
    transform: translateX(8px);
}

.sambutan-point i{
    font-size: 1.2rem;
    color: var(--primary-color);
    margin-top: 2px;
}

.sambutan-point span{
    color: var(--dark-color);
    font-weight: 700;
    line-height: 1.6;
}

/* =========================
   VISI MISI
========================= */
.visi-misi-grid{
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 26px;
}

.vm-card{
    position: relative;
    height: 100%;
    border-radius: 28px;
    overflow: hidden;
    box-shadow: var(--shadow-md);
    border: 1px solid rgba(15,23,42,0.06);
    background: #fff;
    padding: 34px;
    transition: var(--transition-smooth);
    opacity: 0;
    animation: slideUp 0.8s ease forwards;
}

.vm-card.scroll-animate.show {
    animation: slideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

.vm-card:hover{
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(15,23,42,0.15);
}

.vm-card::before{
    content:'';
    position:absolute;
    width: 220px;
    height: 220px;
    border-radius: 50%;
    top: -80px;
    right: -80px;
    opacity: 0.18;
}

.vm-card.visi{
    background: linear-gradient(135deg, #edf9fb, #ffffff);
}
.vm-card.visi::before{
    background: #06b6d4;
}

.vm-card.misi{
    background: linear-gradient(135deg, #f3faee, #ffffff);
}
.vm-card.misi::before{
    background: #84cc16;
}

.vm-icon{
    width: 66px;
    height: 66px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 20px;
    font-size: 1.6rem;
    margin-bottom: 18px;
}

.vm-card.visi .vm-icon{
    background: rgba(6,182,212,0.12);
    color: #0891b2;
}
.vm-card.misi .vm-icon{
    background: rgba(132,204,22,0.12);
    color: #65a30d;
}

.vm-card h3{
    font-size: 1.55rem;
    font-weight: 800;
    margin-bottom: 14px;
    color: var(--dark-color);
}

.vm-card p,
.vm-card li{
    color: var(--text-color);
    line-height: 1.95;
}

.vm-card ul{
    padding-left: 1.2rem;
    margin-bottom: 0;
}

/* =========================
   BERITA
========================= */
.berita-section{
    background:
        radial-gradient(circle at top left, rgba(25,135,84,0.06), transparent 24%),
        radial-gradient(circle at bottom right, rgba(25,135,84,0.05), transparent 22%),
        linear-gradient(180deg, #f7faf8 0%, #ffffff 100%);
}

.berita-grid{
    display: grid;
    grid-template-columns: 1.25fr 0.75fr;
    gap: 26px;
}

.berita-featured{
    position: relative;
    min-height: 560px;
    border-radius: 32px;
    overflow: hidden;
    box-shadow: var(--shadow-lg);
}

.berita-featured img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: 0.7s ease;
}

.berita-featured:hover img{
    transform: scale(1.05);
}

.berita-featured-overlay{
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(8,13,19,0.86), rgba(8,13,19,0.18) 55%, rgba(8,13,19,0.04));
}

.berita-featured-body{
    position: absolute;
    inset: auto 0 0 0;
    padding: 34px;
    z-index: 2;
    color: #fff;
}

.berita-chip{
    display: inline-flex;
    padding: 8px 14px;
    background: rgba(255,255,255,0.14);
    border: 1px solid rgba(255,255,255,0.18);
    border-radius: 999px;
    font-size: 0.8rem;
    font-weight: 700;
    margin-bottom: 14px;
    backdrop-filter: blur(10px);
}

.berita-meta{
    display: flex;
    flex-wrap: wrap;
    gap: 14px;
    align-items: center;
    font-size: 0.9rem;
    margin-bottom: 12px;
}

.berita-featured-body h3{
    font-size: clamp(1.6rem, 2.4vw, 2.2rem);
    font-weight: 800;
    line-height: 1.3;
    margin-bottom: 14px;
}

.berita-featured-body p{
    color: rgba(255,255,255,0.88);
    line-height: 1.9;
    margin-bottom: 20px;
    max-width: 90%;
}

.berita-side{
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
}

.berita-side-card{
    display: grid;
    grid-template-columns: 160px 1fr;
    gap: 18px;
    background: #fff;
    border-radius: 26px;
    padding: 16px;
    box-shadow: var(--shadow-md);
    border: 1px solid rgba(15,23,42,0.05);
    min-height: 190px;
    transition: var(--transition-smooth);
    opacity: 0;
    animation: slideUp 0.8s ease forwards;
}

.berita-side-card.scroll-animate.show {
    animation: slideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

.berita-side-card:hover{
    transform: translateY(-8px);
    box-shadow: 0 24px 52px rgba(15,23,42,0.12);
}

.berita-side-thumb{
    border-radius: 18px;
    overflow: hidden;
    height: 100%;
}

.berita-side-thumb img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: 0.5s ease;
}

.berita-side-card:hover .berita-side-thumb img{
    transform: scale(1.05);
}

.berita-side-body{
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.berita-side-body h4{
    font-size: 1.08rem;
    line-height: 1.45;
    font-weight: 800;
    color: var(--dark-color);
    margin: 8px 0 10px;
}

.berita-side-body p{
    color: var(--muted-color);
    line-height: 1.8;
    margin-bottom: 12px;
    font-size: 0.94rem;
}

.berita-link{
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: var(--primary-color);
    font-weight: 700;
}

.berita-link:hover{
    color: var(--primary-dark);
    gap: 12px;
}

.berita-empty-box{
    background: #fff;
    border-radius: 28px;
    padding: 60px 28px;
    box-shadow: var(--shadow-md);
    border: 1px solid rgba(15,23,42,0.06);
    text-align: center;
}

.berita-empty-box i{
    font-size: 2.7rem;
    color: var(--primary-color);
    display: block;
    margin-bottom: 16px;
}

.berita-empty-box h4{
    font-weight: 800;
    color: var(--dark-color);
    margin-bottom: 8px;
}

.berita-empty-box p{
    margin: 0;
    color: var(--muted-color);
}

/* =========================
   GALERI
========================= */
.galeri-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Kembali ke 3 kolom agar fotonya lebih besar */
    gap: 22px; 
}

.galeri-card {
    position: relative;
    border-radius: 24px;
    overflow: hidden;
    aspect-ratio: 4 / 3;
    box-shadow: var(--shadow-md);
    background: #dbe7df;
    transition: var(--transition-smooth);
    opacity: 0;
    animation: scaleIn 0.8s ease forwards;
}

.galeri-card.scroll-animate.show {
    animation: scaleIn 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

.galeri-card:hover{
    transform: translateY(-10px) scale(1.02);
    box-shadow: var(--shadow-lg);
}

.galeri-card img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: 0.55s ease;
}

.galeri-card:hover img{
    transform: scale(1.08) rotate(0.6deg);
}

.galeri-overlay{
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(8,13,19,0.88), rgba(8,13,19,0.05));
}

.galeri-caption{
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    padding: 24px;
    z-index: 2;
}

.galeri-caption h5{
    color: #fff;
    margin: 0;
    font-weight: 800;
    font-size: 1.02rem;
    line-height: 1.45;
}

/* =========================
   EKSKUL
========================= */
.ekskul-grid{
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}

.ekskul-card{
    position: relative;
    background: #fff;
    border-radius: 30px;
    overflow: hidden;
    box-shadow: var(--shadow-md);
    border: 1px solid rgba(15,23,42,0.05);
    transition: var(--transition-smooth);
    height: 100%;
    opacity: 0;
    animation: slideUp 0.8s ease forwards;
}

.ekskul-card.scroll-animate.show {
    animation: slideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

.ekskul-card:hover{
    transform: translateY(-12px);
    box-shadow: var(--shadow-lg);
}

.ekskul-thumb{
    position: relative;
    height: 255px;
    overflow: hidden;
}

.ekskul-thumb img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: 0.55s ease;
}

.ekskul-card:hover .ekskul-thumb img{
    transform: scale(1.08);
}

.ekskul-overlay{
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(25,135,84,0.20), rgba(32,201,151,0.02));
    opacity: 0;
    transition: var(--transition-smooth);
}

.ekskul-card:hover .ekskul-overlay{
    opacity: 1;
}

.ekskul-body{
    padding: 24px 22px 26px;
    text-align: center;
}

.ekskul-body h5{
    font-size: 1.08rem;
    color: var(--dark-color);
    margin: 0;
    font-weight: 800;
    line-height: 1.5;
}

/* =========================
   EMPTY / ALERT
========================= */
.simple-empty{
    padding: 30px 20px;
    text-align: center;
    color: var(--muted-color);
    background: #fff;
    border-radius: 20px;
    border: 1px solid rgba(15,23,42,0.06);
    box-shadow: var(--shadow-sm);
}

/* =========================
   RESPONSIVE
========================= */
@media (max-width: 1199.98px){
    .hero-grid{
        grid-template-columns: 1fr;
    }

    .hero-panel{
        max-width: 520px;
    }

    .berita-side{
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    }

    .galeri-grid,
    .ekskul-grid{
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 991.98px){
    .section{
        padding: 78px 0;
    }

    .tentang-image-box{
        min-height: 420px;
    }

    .visi-misi-grid{
        grid-template-columns: 1fr;
    }

    .berita-featured{
        min-height: 470px;
    }
}

@media (max-width: 767.98px){
    .hero-section{
        min-height: auto;
        background-attachment: scroll !important;
    }

    .hero-content{
        padding: 100px 0 60px;
    }

    .hero-copy h1{
        letter-spacing: -1px;
        font-size: clamp(1.8rem, 5vw, 2.2rem);
    }

    .hero-copy .lead{
        font-size: 0.95rem;
        line-height: 1.8;
    }

    .hero-actions{
        flex-direction: column;
        align-items: stretch;
        gap: 12px;
    }

    .hero-actions .btn-main,
    .hero-actions .btn-outline-soft{
        justify-content: center;
        width: 100%;
        padding: 14px 20px;
        font-size: 0.9rem;
    }

    .hero-panel{
        padding: 18px;
        border-radius: 20px;
        margin-top: 20px;
    }

    .hero-mini-stats{
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .section{
        padding: 60px 1rem;
    }

    .section-title-wrap{
        margin-bottom: 35px;
        padding: 0 1rem;
    }

    .section-title{
        font-size: clamp(1.5rem, 4vw, 2rem);
    }

    .tentang-image-box{
        min-height: 280px;
        border-radius: 20px;
    }

    .tentang-floating-card{
        position: static;
        max-width: none;
        margin-top: 16px;
    }

    .sambutan-card{
        padding: 20px;
        border-radius: 20px;
    }

    .vm-card{
        padding: 20px;
        border-radius: 20px;
    }

    .berita-featured{
        min-height: 350px;
        border-radius: 20px;
    }

    .berita-featured-body{
        padding: 18px;
    }

    .berita-featured-body p{
        max-width: 100%;
        font-size: 0.9rem;
        line-height: 1.6;
    }

    .berita-side{
        grid-template-columns: 1fr;
        gap: 14px;
    }

    .berita-side-card{
        grid-template-columns: 1fr;
        padding: 12px;
        border-radius: 18px;
        min-height: auto;
    }

    .berita-side-thumb{
        height: 160px;
        border-radius: 16px;
    }

    .berita-side-body{
        padding: 12px 0;
    }

    .galeri-grid,
    .ekskul-grid{
        grid-template-columns: 1fr;
        gap: 14px;
    }

    .galeri-card{
        min-height: 220px;
        border-radius: 18px;
    }

    .ekskul-card{
        border-radius: 18px;
        padding: 16px;
    }

    .ekskul-thumb{
        height: 200px;
        border-radius: 14px;
    }

    .container{
        padding-left: 1rem;
        padding-right: 1rem;
    }
}

@media (max-width: 575.98px){
    .hero-section{
        min-height: 90vh;
    }

    .hero-content{
        padding: 80px 1rem 50px;
    }

    .hero-copy h1{
        font-size: clamp(1.4rem, 6vw, 1.8rem);
        line-height: 1.2;
    }

    .hero-copy .lead{
        font-size: 0.85rem;
    }

    .hero-panel{
        padding: 16px;
        gap: 16px;
    }

    .hero-mini-stats{
        grid-template-columns: 1fr;
    }

    .section{
        padding: 50px 0.75rem;
    }

    .section-title{
        font-size: clamp(1.3rem, 5vw, 1.7rem);
    }

    .section-badge{
        font-size: 0.7rem;
        padding: 8px 14px;
    }

    .card, .card-soft{
        border-radius: 14px;
        padding: 14px;
    }

    .berita-featured{
        min-height: 300px;
    }

    .berita-featured-body{
        padding: 14px;
    }

    .berita-featured-body h3{
        font-size: 1.1rem;
    }

    .berita-side-card{
        padding: 10px;
        gap: 8px;
    }

    .berita-side-thumb{
        height: 140px;
    }

    .btn-main, .btn-outline-soft{
        padding: 12px 18px;
        font-size: 0.85rem;
    }

    h1, h2, h3, h4, h5, h6{
        line-height: 1.2;
    }

    /* Prevent form inputs from triggering zoom on iOS */
    input, textarea, select{
        font-size: 16px !important;
    }
}
</style>

<?php
include 'includes/navbar.php';

$q_profil = mysqli_query($koneksi, "SELECT * FROM profil_sekolah WHERE id=1");
$p = mysqli_fetch_assoc($q_profil);

function limit_text($text, $limit = 140){
    $text = trim(strip_tags($text ?? ''));
    if (mb_strlen($text) <= $limit) return $text;
    return mb_substr($text, 0, $limit) . '...';
}

$gambar_hero = "https://source.unsplash.com/random/1920x1080/?school_building";
if (!empty($p['gambar_hero']) && file_exists("assets/img_sekolah/" . $p['gambar_hero'])) {
    $gambar_hero = "assets/img_sekolah/" . $p['gambar_hero'];
}

$img_profil = "https://source.unsplash.com/random/600x700/?teacher,school";
if (!empty($p['gambar_profil']) && file_exists("assets/img_sekolah/" . $p['gambar_profil'])) {
    $img_profil = "assets/img_sekolah/" . $p['gambar_profil'];
}
?>

<section class="hero-section" style="background-image: url('<?= $gambar_hero ?>');">
    <div class="hero-content">
        <div class="container">
            <div class="hero-grid">
                <div class="hero-copy scroll-animate">
                    <div class="hero-kicker">
                        <i class="bi bi-stars"></i>
                        Website Resmi Sekolah
                    </div>

                    <h1>
                        Selamat Datang di <br>
                        <span class="text-gradient"><?= htmlspecialchars($p['nama_sekolah'] ?? 'Sekolah Purwanida') ?></span>
                    </h1>

                    <p class="lead">
                        <?= htmlspecialchars($p['deskripsi_hero'] ?? 'Mencetak generasi cerdas, berkarakter, kreatif, dan berakhlak mulia melalui lingkungan belajar yang inspiratif.') ?>
                    </p>

                    <div class="hero-actions">
                        <a href="#tentang" class="btn-main">
                            <i class="bi bi-arrow-down-circle"></i>
                            Jelajahi Profil
                        </a>
                        <a href="#berita" class="btn-outline-soft">
                            <i class="bi bi-newspaper"></i>
                            Lihat Berita
                        </a>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>

<section id="tentang" class="section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 scroll-animate">
                <div class="tentang-wrap">
                    <div class="tentang-image-box">
                        <img src="<?= $img_profil ?>" alt="Tentang Kami">
                    </div>

                </div>
            </div>

            <div class="col-lg-7 scroll-animate delay-1">
                <div class="sambutan-card">
                    <div class="section-badge">
                        <i class="bi bi-person-badge"></i>
                        Tentang Kami
                    </div>

                    <h2>Sambutan Kepala Sekolah</h2>

                    <div class="desc">
                        <?= nl2br($p['isi_profil'] ?? 'Selamat datang di website resmi sekolah kami.') ?>
                    </div>

                    <div class="sambutan-points">
                        <div class="sambutan-point">
                            <i class="bi bi-check-circle-fill"></i>
                            <span><?= htmlspecialchars(!empty($p['keunggulan_1']) ? $p['keunggulan_1'] : 'Kurikulum Berkualitas') ?></span>
                        </div>
                        <div class="sambutan-point">
                            <i class="bi bi-check-circle-fill"></i>
                            <span><?= htmlspecialchars(!empty($p['keunggulan_2']) ? $p['keunggulan_2'] : 'Fasilitas Lengkap') ?></span>
                        </div>
                        <div class="sambutan-point">
                            <i class="bi bi-check-circle-fill"></i>
                            <span><?= htmlspecialchars(!empty($p['keunggulan_3']) ? $p['keunggulan_3'] : 'Ekstrakurikuler Aktif') ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="visi-misi" class="section section-soft">
    <div class="container">
        <div class="section-title-wrap scroll-animate">
            <div class="section-badge">
                <i class="bi bi-compass"></i>
                Fondasi Kami
            </div>
            <h2 class="section-title">Visi & Misi</h2>
            <p class="section-subtitle">
                Arah dan komitmen sekolah dalam membangun pendidikan yang unggul, berkarakter, dan relevan dengan perkembangan zaman.
            </p>
        </div>

        <div class="visi-misi-grid">
            <div class="vm-card visi scroll-animate delay-1">
                <div class="vm-icon">
                    <i class="bi bi-eye-fill"></i>
                </div>
                <h3>Visi</h3>
                <p>
                    <?php if (!empty($p['visi'])): ?>
                        <?= nl2br(htmlspecialchars($p['visi'])) ?>
                    <?php else: ?>
                        <span class="fst-italic">Visi belum diset. Silakan atur di pengaturan admin.</span>
                    <?php endif; ?>
                </p>
            </div>

            <div class="vm-card misi scroll-animate delay-2">
                <div class="vm-icon">
                    <i class="bi bi-bullseye"></i>
                </div>
                <h3>Misi</h3>

                <?php if (!empty($p['misi'])): ?>
                    <ul>
                        <?php foreach (explode("\n", $p['misi']) as $m): ?>
                            <?php $m = trim($m); ?>
                            <?php if ($m !== ''): ?>
                                <li><?= htmlspecialchars($m) ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p><span class="fst-italic">Misi belum diset. Silakan atur di pengaturan admin.</span></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section id="berita" class="section berita-section">
    <div class="container">
        <div class="section-title-wrap scroll-animate">
            <div class="section-badge">
                <i class="bi bi-newspaper"></i>
                Berita Terbaru
            </div>
            <h2 class="section-title">Informasi & Berita Sekolah</h2>
            <p class="section-subtitle">
                Ikuti kabar terbaru, kegiatan, prestasi, dan momen penting dari lingkungan sekolah.
            </p>
        </div>

        <?php
        $q_berita = mysqli_query($koneksi, "SELECT * FROM berita WHERE status = 'publish' ORDER BY id DESC LIMIT 3");
        $data_berita = [];

        if ($q_berita && mysqli_num_rows($q_berita) > 0) {
            while ($b = mysqli_fetch_assoc($q_berita)) {
                $data_berita[] = $b;
            }
        }
        ?>

        <?php if (!empty($data_berita)): ?>
            <div class="berita-side">
                <?php foreach ($data_berita as $index => $item): ?>
                    <?php
                    $img_item = (!empty($item['gambar']) && file_exists(__DIR__ . "/assets/img_berita/" . $item['gambar']))
                        ? "assets/img_berita/" . $item['gambar']
                        : "https://via.placeholder.com/800x600?text=Berita";
                    $delay_class = "delay-" . (($index % 3) + 1);
                    ?>
                    <article class="berita-side-card scroll-animate <?= $delay_class ?>">
                        <div class="berita-side-thumb">
                            <img src="<?= $img_item ?>" alt="<?= htmlspecialchars($item['judul']) ?>">
                        </div>
                        <div class="berita-side-body">
                            <div class="berita-meta" style="color: var(--muted-color);">
                                <span><i class="bi bi-clock-history"></i> <?= date('d M Y', strtotime($item['tanggal'])) ?></span>
                            </div>
                            <h4><?= htmlspecialchars($item['judul']) ?></h4>
                            <p><?= htmlspecialchars(limit_text($item['isi'], 95)) ?></p>
                            <a href="detail_berita.php?id=<?= $item['id'] ?>" class="berita-link">
                                Lihat detail
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="berita-empty-box">
                <i class="bi bi-newspaper"></i>
                <h4>Belum ada berita</h4>
                <p>Informasi terbaru sekolah akan tampil di sini.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<section id="galeri" class="section">
    <div class="container">
        <div class="section-title-wrap scroll-animate">
            <div class="section-badge">
                <i class="bi bi-images"></i>
                Dokumentasi
            </div>
            <h2 class="section-title">Galeri Kegiatan</h2>
            <p class="section-subtitle">
                Potret berbagai kegiatan, suasana belajar, dan momen kebersamaan di sekolah.
            </p>
        </div>

        <?php
        $cek_tabel = mysqli_query($koneksi, "SHOW TABLES LIKE 'galeri'");
        if (mysqli_num_rows($cek_tabel) > 0):
            $q_galeri = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY id DESC LIMIT 6");
            if (mysqli_num_rows($q_galeri) > 0):
        ?>
            <div class="galeri-grid">
                <?php
                $galeri_index = 0;
                while ($g = mysqli_fetch_assoc($q_galeri)):
                    $img_galeri = "assets/img_galeri/" . $g['gambar'];
                    $judul_galeri = isset($g['judul']) && trim($g['judul']) !== '' ? $g['judul'] : 'Galeri Kegiatan';
                    $delay_class = "delay-" . (($galeri_index % 3) + 1);
                    $galeri_index++;
                ?>
                    <div class="galeri-card scroll-animate <?= $delay_class ?>">
                        <img src="<?= $img_galeri ?>" alt="<?= htmlspecialchars($judul_galeri) ?>">
                        <div class="galeri-overlay"></div>
                        <div class="galeri-caption">
                            <h5><?= htmlspecialchars($judul_galeri) ?></h5>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php
            else:
                echo "<div class='simple-empty'>Belum ada foto di galeri.</div>";
            endif;
        else:
            echo "<div class='simple-empty text-danger'>Tabel 'galeri' belum dibuat di database.</div>";
        endif;
        ?>
    </div>
</section>

<section id="ekskul" class="section section-soft">
    <div class="container">
        <div class="section-title-wrap scroll-animate">
            <div class="section-badge">
                <i class="bi bi-trophy"></i>
                Pengembangan Diri
            </div>
            <h2 class="section-title">Ekstrakurikuler</h2>
            <p class="section-subtitle">
                Wadah bagi siswa untuk berkembang, berprestasi, dan menyalurkan minat serta bakatnya.
            </p>
        </div>

        <?php
        $cek_ekskul = mysqli_query($koneksi, "SHOW TABLES LIKE 'ekstrakurikuler'");
        if (mysqli_num_rows($cek_ekskul) > 0):
            $q_ekskul = mysqli_query($koneksi, "SELECT * FROM ekstrakurikuler ORDER BY id DESC");
            if (mysqli_num_rows($q_ekskul) > 0):
        ?>
            <div class="ekskul-grid">
                <?php
                $ekskul_index = 0;
                while ($e = mysqli_fetch_assoc($q_ekskul)):
                    $delay_class = "delay-" . (($ekskul_index % 3) + 1);
                    $ekskul_index++;
                ?>
                    <div class="ekskul-card scroll-animate <?= $delay_class ?>">
                        <div class="ekskul-thumb">
                            <img src="assets/img_ekskul/<?= $e['gambar'] ?>" alt="<?= htmlspecialchars($e['nama_ekskul']) ?>">
                            <div class="ekskul-overlay"></div>
                        </div>
                        <div class="ekskul-body">
                            <h5><?= htmlspecialchars($e['nama_ekskul']) ?></h5>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php
            else:
                echo "<div class='simple-empty'>Belum ada data ekskul.</div>";
            endif;
        endif;
        ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
