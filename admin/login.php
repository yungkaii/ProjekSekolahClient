<?php
session_start();
include '../config/koneksi.php';

$error = '';
if(isset($_POST['login'])){
    $user = $_POST['user'];
    $pass = md5($_POST['pass']);
    $cek = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$user' AND password='$pass'");
    if(mysqli_num_rows($cek) > 0){
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,300;0,400;0,500;0,700;1,300&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #0d1117;
            --panel:     #161b22;
            --border:    rgba(255,255,255,0.07);
            --accent:    #3b82f6;
            --accent2:   #60a5fa;
            --muted:     #8b949e;
            --text:      #e6edf3;
            --input-bg:  #0d1117;
            --glow:      rgba(59,130,246,0.18);
        }

        body {
            min-height: 100vh;
            background: var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'DM Sans', sans-serif;
            overflow: hidden;
            position: relative;
        }

        /* ── Animated mesh background ── */
        .bg-mesh {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
        }
        .bg-mesh::before {
            content: '';
            position: absolute;
            width: 700px; height: 700px;
            top: -200px; left: -200px;
            background: radial-gradient(circle, rgba(59,130,246,0.12) 0%, transparent 70%);
            animation: drift1 12s ease-in-out infinite alternate;
        }
        .bg-mesh::after {
            content: '';
            position: absolute;
            width: 600px; height: 600px;
            bottom: -150px; right: -150px;
            background: radial-gradient(circle, rgba(96,165,250,0.08) 0%, transparent 70%);
            animation: drift2 15s ease-in-out infinite alternate;
        }
        @keyframes drift1 {
            from { transform: translate(0,0) scale(1); }
            to   { transform: translate(60px, 60px) scale(1.1); }
        }
        @keyframes drift2 {
            from { transform: translate(0,0) scale(1); }
            to   { transform: translate(-50px,-40px) scale(1.08); }
        }

        /* Subtle grid lines */
        .bg-grid {
            position: fixed;
            inset: 0;
            z-index: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* ── Card ── */
        .card {
            position: relative;
            z-index: 1;
            width: 420px;
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 44px 40px 36px;
            box-shadow:
                0 0 0 1px rgba(59,130,246,0.08),
                0 32px 64px rgba(0,0,0,0.6),
                0 0 80px var(--glow);
            animation: slideUp 0.55s cubic-bezier(0.22,1,0.36,1) both;
        }
        @keyframes slideUp {
            from { opacity:0; transform: translateY(30px); }
            to   { opacity:1; transform: translateY(0); }
        }

        /* ── Top accent bar ── */
        .card::before {
            content: '';
            position: absolute;
            top: 0; left: 20%; right: 20%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--accent), var(--accent2), transparent);
            border-radius: 2px;
        }

        /* ── Header ── */
        .header { margin-bottom: 36px; }

        .badge-wrap {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(59,130,246,0.1);
            border: 1px solid rgba(59,130,246,0.2);
            border-radius: 99px;
            padding: 4px 12px;
            margin-bottom: 18px;
        }
        .badge-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--accent2);
            box-shadow: 0 0 6px var(--accent2);
            animation: pulse-dot 2s ease-in-out infinite;
        }
        @keyframes pulse-dot {
            0%,100% { opacity:1; }
            50%      { opacity:0.4; }
        }
        .badge-label {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 1.5px;
            color: var(--accent2);
            text-transform: uppercase;
        }

        .logo-title {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            font-weight: 700;
            color: var(--text);
            line-height: 1.2;
            margin-bottom: 6px;
        }
        .subtitle {
            font-size: 13px;
            font-weight: 300;
            font-style: italic;
            color: var(--muted);
            letter-spacing: 0.5px;
        }

        /* ── Alert ── */
        .alert {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(239,68,68,0.08);
            border: 1px solid rgba(239,68,68,0.25);
            border-radius: 10px;
            padding: 12px 14px;
            margin-bottom: 22px;
            color: #f87171;
            font-size: 13.5px;
            animation: shake 0.4s cubic-bezier(0.36,0.07,0.19,0.97) both;
        }
        @keyframes shake {
            10%,90%  { transform: translateX(-2px); }
            20%,80%  { transform: translateX(4px); }
            30%,50%,70% { transform: translateX(-4px); }
            40%,60%  { transform: translateX(4px); }
        }
        .alert::before { content: '✕'; font-size: 12px; opacity: 0.7; }

        /* ── Form ── */
        .field { margin-bottom: 18px; }

        label {
            display: block;
            font-size: 12.5px;
            font-weight: 500;
            color: var(--muted);
            letter-spacing: 0.8px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .input-wrap {
            position: relative;
        }
        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.35;
            pointer-events: none;
            font-size: 15px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            background: var(--input-bg);
            border: 1px solid var(--border);
            border-radius: 11px;
            padding: 13px 14px 13px 40px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--text);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: rgba(59,130,246,0.5);
            box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
        }
        input::placeholder { color: rgba(139,148,158,0.5); }

        /* Toggle password */
        .toggle-pw {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--muted);
            padding: 2px;
            font-size: 15px;
            opacity: 0.5;
            transition: opacity 0.2s;
        }
        .toggle-pw:hover { opacity: 1; }

        /* ── Submit ── */
        .btn-login {
            width: 100%;
            margin-top: 10px;
            padding: 14px;
            border: none;
            border-radius: 11px;
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 14.5px;
            font-weight: 500;
            letter-spacing: 0.3px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 20px rgba(59,130,246,0.35);
        }
        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 28px rgba(59,130,246,0.45);
        }
        .btn-login:active { transform: translateY(0); }
        .btn-login::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.12), transparent);
        }

        .btn-back {
            width: 100%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            padding: 14px;
            border: 1px solid rgba(255,255,255,0.14);
            border-radius: 11px;
            background: transparent;
            color: rgba(255,255,255,0.9);
            font-size: 14.5px;
            font-weight: 500;
            text-decoration: none;
            transition: background-color 0.2s, border-color 0.2s, transform 0.15s;
            margin-top: 12px;
        }
        .btn-back:hover {
            background: rgba(255,255,255,0.08);
            border-color: rgba(255,255,255,0.28);
            transform: translateY(-1px);
        }

        /* ── Divider ── */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 26px 0 18px;
        }
        .divider-line { flex:1; height:1px; background: var(--border); }
        .divider-text { font-size: 11px; color: var(--muted); letter-spacing: 1px; text-transform: uppercase; }

        /* ── Footer ── */
        .footer {
            text-align: center;
            font-size: 12px;
            color: rgba(139,148,158,0.5);
            margin-top: 28px;
        }
        .footer strong { color: rgba(139,148,158,0.75); font-weight: 500; }
    </style>
</head>
<body>

<div class="bg-mesh"></div>
<div class="bg-grid"></div>

<div class="card">

    <div class="header">
        <div class="badge-wrap">
            <span class="badge-dot"></span>
            <span class="badge-label">Control Panel</span>
        </div>
        <div class="logo-title">Bina Karya Admin</div>
        <div class="subtitle">Sistem Manajemen Terpadu</div>
    </div>

    <?php if($error): ?>
        <div class="alert"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form action="proses.php" method="POST">

        <div class="field">
            <label>Username</label>
            <div class="input-wrap">
                <span class="input-icon">◎</span>
                <input type="text" name="user" placeholder="Masukkan username" required autocomplete="username">
            </div>
        </div>

        <div class="field">
            <label>Password</label>
            <div class="input-wrap">
                <span class="input-icon">◉</span>
                <input type="password" name="pass" id="passField" placeholder="Masukkan password" required autocomplete="current-password">
                <button type="button" class="toggle-pw" onclick="togglePass()" id="eyeBtn" title="Tampilkan password">👁</button>
            </div>
        </div>

        <button type="submit" name="login" class="btn-login">Masuk ke Dashboard</button>
        <a href="../index.php" class="btn-back">Kembali ke Halaman Utama</a>
    </form>

    <div class="divider">
        <span class="divider-line"></span>
        <span class="divider-text">Secured Access</span>
        <span class="divider-line"></span>
    </div>

    <div class="footer">
        &copy; <?php echo date("Y"); ?> &nbsp;<strong>Bina Karya</strong>&nbsp; &mdash; Hak akses terbatas
    </div>

</div>

<script>
function togglePass() {
    const f = document.getElementById('passField');
    const b = document.getElementById('eyeBtn');
    if (f.type === 'password') {
        f.type = 'text';
        b.textContent = '🙈';
    } else {
        f.type = 'password';
        b.textContent = '👁';
    }
}
</script>

</body>
</html>