<?php
session_start();

// Demo user (username => [password, role])
$users = [
    'guru1' => ['password' => 'gurubk123', 'role' => 'guru'],
    'siswa1' => ['password' => 'siswa123', 'role' => 'siswa'],
    'siswa2' => ['password' => 'siswa456', 'role' => 'siswa']
];

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        $_SESSION['user'] = [
            'username' => $username,
            'role' => $users[$username]['role']
        ];
        header('Location: index.php');
        exit;
    } else {
        $error = 'Username atau password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Konseling SMK</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        html, body {
            height: 100%;
        }
        body {
            min-height: 100vh;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            height: 100vh;
            width: 100vw;
        }
        .video-bg {
            position: fixed;
            top: 0; left: 0;
            width: 100vw; height: 100vh;
            object-fit: cover;
            z-index: 0;
            filter: brightness(0.7) blur(2px);
            background: #222;
        }
        .neon-circle {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 420px;
            height: 420px;
            transform: translate(-50%, -50%);
            pointer-events: none;
            z-index: 1;
            filter: blur(0.5px) brightness(1.2);
            animation: spin 8s linear infinite;
        }
        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg);}
            100% { transform: translate(-50%, -50%) rotate(360deg);}
        }
        .login-glass {
            position: relative;
            z-index: 2;
            width: 350px;
            background: rgba(255,255,255,0.13);
            border-radius: 28px;
            box-shadow: 0 8px 40px #6366f144;
            padding: 44px 32px 32px 32px;
            backdrop-filter: blur(18px) saturate(180%);
            -webkit-backdrop-filter: blur(18px) saturate(180%);
            border: 1.5px solid rgba(255,255,255,0.25);
            animation: popIn 1.2s;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        @keyframes popIn {
            from { opacity: 0; transform: scale(0.92) translateY(40px);}
            to { opacity: 1; transform: scale(1) translateY(0);}
        }
        .avatar {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            margin: -70px auto 18px auto;
            border: 4px solid #fff;
            box-shadow: 0 4px 24px #6366f133;
            object-fit: cover;
            background: #e0e7ef;
            display: block;
            animation: bounce 2.5s infinite;
        }
        @keyframes bounce {
            0%,100% { transform: translateY(0);}
            50% { transform: translateY(-10px);}
        }
        .login-glass h2 {
            color: #fff;
            margin-bottom: 18px;
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            letter-spacing: 1px;
            text-shadow: 0 2px 8px #6366f1aa;
        }
        .input-group {
            position: relative;
            margin-bottom: 18px;
            width: 100%;
        }
        .input-group input {
            width: 100%;
            padding: 12px 44px 12px 44px;
            border-radius: 12px;
            border: 1.5px solid #c7d2fe;
            font-size: 1.08rem;
            background: rgba(255,255,255,0.7);
            transition: border 0.3s, box-shadow 0.3s;
            outline: none;
        }
        .input-group input:focus {
            border: 1.5px solid #6366f1;
            box-shadow: 0 0 8px #6366f1aa;
            background: #fff;
        }
        .input-group .icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 22px;
            height: 22px;
            opacity: 0.7;
        }
        .login-glass button {
            width: 100%;
            background: linear-gradient(270deg, #6366f1, #2b4c7e, #00c6fb, #6366f1, #2b4c7e);
            background-size: 400% 400%;
            color: #fff;
            padding: 14px 0;
            border: none;
            border-radius: 32px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 24px rgba(99,102,241,0.08);
            transition: background 0.3s, transform 0.2s;
            text-decoration: none;
            animation: gradientMove 3s ease-in-out infinite, pulse 2s infinite;
            margin-top: 10px;
        }
        @keyframes gradientMove {
            0% {background-position:0% 50%;}
            50% {background-position:100% 50%;}
            100% {background-position:0% 50%;}
        }
        @keyframes pulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(99,102,241,0.2);}
            50% { box-shadow: 0 0 16px 8px rgba(99,102,241,0.12);}
        }
        .login-glass button:hover {
            background: linear-gradient(90deg, #00c6fb 0%, #6366f1 100%);
            background-size: 200% 200%;
            animation: gradientMove 1s linear infinite;
            transform: translateY(-2px) scale(1.04);
        }
        .login-error {
            color: #ef4444;
            margin-bottom: 12px;
            text-align: center;
            font-weight: 600;
            animation: shake 0.4s;
            background: rgba(255,255,255,0.7);
            border-radius: 8px;
            padding: 6px 0;
            width: 100%;
        }
        @keyframes shake {
            0% { transform: translateX(0);}
            20% { transform: translateX(-8px);}
            40% { transform: translateX(8px);}
            60% { transform: translateX(-8px);}
            80% { transform: translateX(8px);}
            100% { transform: translateX(0);}
        }
        @media (max-width: 600px) {
            .login-glass { padding: 24px 4vw; width: 98vw;}
            .avatar { width: 64px; height: 64px; margin-top: -48px;}
            .neon-circle { width: 260px; height: 260px;}
        }
    </style>
</head>
<body>
    <video class="video-bg" src="https://videos.pexels.com/video-files/857195/857195-hd_1920_1080_24fps.mp4" autoplay loop muted playsinline></video>
    <svg class="neon-circle" width="420" height="420" viewBox="0 0 420 420">
      <defs>
        <radialGradient id="glow" cx="50%" cy="50%" r="50%">
          <stop offset="0%" stop-color="#fff" stop-opacity="0.7"/>
          <stop offset="60%" stop-color="#6366f1" stop-opacity="0.5"/>
          <stop offset="100%" stop-color="#2b4c7e" stop-opacity="0.2"/>
        </radialGradient>
      </defs>
      <circle cx="210" cy="210" r="160" fill="none" stroke="url(#glow)" stroke-width="24" />
    </svg>
    <!-- Animasi partikel bulat kecil -->
<canvas id="particles-bg" style="position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:1;pointer-events:none;"></canvas>
<script>
const canvas = document.getElementById('particles-bg');
const ctx = canvas.getContext('2d');
let particles = [];
function resize() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
}
window.addEventListener('resize', resize);
resize();

function randomColor() {
    const colors = ['#6366f1', '#2b4c7e', '#00c6fb', '#fff'];
    return colors[Math.floor(Math.random()*colors.length)];
}
for(let i=0;i<28;i++) {
    particles.push({
        x: Math.random()*canvas.width,
        y: Math.random()*canvas.height,
        r: 8+Math.random()*10,
        dx: (Math.random()-0.5)*0.4,
        dy: (Math.random()-0.5)*0.4,
        color: randomColor(),
        alpha: 0.15+Math.random()*0.15
    });
}
function animate() {
    ctx.clearRect(0,0,canvas.width,canvas.height);
    for(let p of particles) {
        ctx.save();
        ctx.globalAlpha = p.alpha;
        ctx.beginPath();
        ctx.arc(p.x,p.y,p.r,0,2*Math.PI);
        ctx.fillStyle = p.color;
        ctx.shadowColor = p.color;
        ctx.shadowBlur = 18;
        ctx.fill();
        ctx.restore();
        p.x += p.dx;
        p.y += p.dy;
        if(p.x<0||p.x>canvas.width) p.dx*=-1;
        if(p.y<0||p.y>canvas.height) p.dy*=-1;
    }
    requestAnimationFrame(animate);
}
animate();
</script>
    <form class="login-glass" method="post" autocomplete="off">
        <img class="avatar" src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar Guru/Siswa" />
        <h2>Login Konseling SMK</h2>
        <?php if ($error): ?><div class="login-error"><?= $error ?></div><?php endif; ?>
        <div class="input-group">
            <span class="icon">
                <svg fill="none" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4" stroke="#6366f1" stroke-width="2"/><path d="M4 20c0-4 16-4 16 0" stroke="#6366f1" stroke-width="2"/></svg>
            </span>
            <input type="text" name="username" placeholder="Username" required autofocus>
        </div>
        <div class="input-group">
            <span class="icon">
                <svg fill="none" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="10" rx="2" stroke="#6366f1" stroke-width="2"/><path d="M7 11V7a5 5 0 0110 0v4" stroke="#6366f1" stroke-width="2"/></svg>
            </span>
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</body>
</html>