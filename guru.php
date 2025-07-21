
<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'siswa') {
    header('Location: login.php');
    exit;
}
$namaGuru = isset($_GET['nama']) ? htmlspecialchars($_GET['nama']) : 'Guru BK';

// Data profil guru statis (bisa diubah ke database)
$guruList = [
    'Bu Sari' => [
        'foto' => 'https://randomuser.me/api/portraits/women/44.jpg',
        'bio' => 'Guru BK berpengalaman, ramah, dan siap membantu masalah belajar dan pribadi.'
    ],
    'Pak Budi' => [
        'foto' => 'https://randomuser.me/api/portraits/men/45.jpg',
        'bio' => 'Ahli konseling karir dan pengembangan diri siswa.'
    ],
    'Bu Lina' => [
        'foto' => 'https://randomuser.me/api/portraits/women/46.jpg',
        'bio' => 'Spesialis konseling keluarga dan kesehatan mental remaja.'
    ]
];
$guru = $guruList[$namaGuru] ?? [
    'foto' => 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png',
    'bio' => 'Guru BK SMEXA.'
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil <?= $namaGuru ?> - SMEXACurhat</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body { background: #f3f4f6; font-family: 'Segoe UI', Arial, sans-serif; }
        .guru-container { max-width: 420px; margin: 48px auto; background: #fff; border-radius: 18px; box-shadow: 0 8px 40px #6366f122; padding: 32px 24px; }
        .guru-profile { text-align: center; }
        .guru-profile img { width: 96px; height: 96px; border-radius: 50%; object-fit: cover; border: 4px solid #6366f1; margin-bottom: 12px; }
        .guru-profile h2 { color: #2b4c7e; margin-bottom: 6px; }
        .guru-profile p { color: #6366f1; margin-bottom: 18px; }
        .chat-area { background: #f8fafc; border-radius: 12px; padding: 18px; min-height: 180px; margin-bottom: 12px; max-height: 260px; overflow-y: auto; }
        .chat-msg { margin-bottom: 10px; }
        .chat-msg.siswa { text-align: right; color: #2563eb; }
        .chat-msg.guru { text-align: left; color: #16a34a; }
        .chat-form { display: flex; gap: 8px; }
        .chat-form input { flex:1; padding: 10px; border-radius: 8px; border: 1.5px solid #c7d2fe; }
        .chat-form button { background: #6366f1; color: #fff; border: none; border-radius: 8px; padding: 10px 18px; font-weight: 600; cursor: pointer; }
        .back-btn { display:inline-block; margin-bottom:18px; color:#6366f1; text-decoration:none; font-weight:600; }
    </style>
</head>
<body>
    <div class="guru-container">
        <a href="index.php" class="back-btn">&larr; Kembali ke Beranda</a>
        <div class="guru-profile">
            <img src="<?= $guru['foto'] ?>" alt="<?= $namaGuru ?>">
            <h2><?= $namaGuru ?></h2>
            <p><?= $guru['bio'] ?></p>
        </div>
        <div class="chat-area" id="chat-area">
            <div class="chat-msg guru">Halo, ada yang bisa Ibu/Bapak bantu?</div>
        </div>
        <form class="chat-form" id="chat-form" autocomplete="off" onsubmit="return false;">
            <input type="text" id="chat-input" placeholder="Tulis pesan..." required />
            <button type="submit">Kirim</button>
        </form>
    </div>
    <script>
    // Chat dummy (frontend only)
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    const chatArea = document.getElementById('chat-area');
    chatForm.onsubmit = function() {
        const msg = chatInput.value.trim();
        if (!msg) return false;
        chatArea.innerHTML += `<div class='chat-msg siswa'>${msg}</div>`;
        chatInput.value = '';
        chatArea.scrollTop = chatArea.scrollHeight;
        setTimeout(function() {
            chatArea.innerHTML += `<div class='chat-msg guru'>${msg.length > 20 ? 'Terima kasih, pesan kamu sudah diterima.' : 'Baik, akan Ibu/Bapak bantu.'}</div>`;
            chatArea.scrollTop = chatArea.scrollHeight;
        }, 900);
        return false;
    };
    </script>
</body>
</html>
