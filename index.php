<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMEXACurhat</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/main.js" defer></script>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container nav-flex">
            <h1 class="logo">SMEXACurhat</h1>
            <nav>
                <ul>
                    <li><a href="#hero">Beranda</a></li>
                    <li><a href="#services">Layanan</a></li>
                    <li><a href="#magang-info">Magang</a></li>
                    <li><a href="#career-test">Tes Minat</a></li>
                    <li><a href="#faq">FAQ</a></li>
                    <li><a href="#contact">Kontak</a></li>
                    <?php if ($user['role'] === 'guru'): ?>
                        <li><a href="dashboard-guru.html" class="btn" style="padding:8px 18px;">Dashboard Guru</a></li>
                    <?php endif; ?>
                    <li><a href="logout.php" style="color:#ef4444;">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="hero" class="reveal">
        <div class="container hero-flex">
            <div class="hero-text">
                <h2>Selamat Datang di <span class="highlight">SMEXACurhat</span></h2>
                <p>Bimbingan konseling modern untuk siswa Smexa: solusi belajar, magang, karir, dan kesehatan mental.</p>
                <button type="button" id="open-guru-modal" class="btn">Hubungi Konselor</button>
    <!-- Modal Pilih Guru BK -->
    <div id="guru-modal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.45); z-index:1000; align-items:center; justify-content:center;">
        <div style="background:#fff; border-radius:18px; padding:32px 24px 24px 24px; min-width:320px; max-width:90vw; box-shadow:0 8px 40px #6366f144; position:relative;">
            <span id="close-guru-modal" style="position:absolute; top:12px; right:18px; font-size:1.8rem; color:#6366f1; cursor:pointer; font-weight:bold;">&times;</span>
            <h2 style="text-align:center; color:#6366f1; margin-bottom:18px;">Pilih Guru BK</h2>
            <div style="display:flex; flex-wrap:wrap; gap:18px; justify-content:center;">
                <!-- Daftar guru statis, bisa diubah ke dinamis dari database -->
                <div class="guru-card" data-guru="Bu Sari" style="cursor:pointer; text-align:center; padding:12px 8px; border-radius:12px; border:1.5px solid #c7d2fe; background:#f8fafc; width:120px; transition:box-shadow 0.2s;">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Bu Sari" style="width:64px; height:64px; border-radius:50%; object-fit:cover; margin-bottom:8px;">
                    <div style="font-weight:600; color:#2b4c7e;">Bu Sari</div>
                </div>
                <div class="guru-card" data-guru="Pak Budi" style="cursor:pointer; text-align:center; padding:12px 8px; border-radius:12px; border:1.5px solid #c7d2fe; background:#f8fafc; width:120px; transition:box-shadow 0.2s;">
                    <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Pak Budi" style="width:64px; height:64px; border-radius:50%; object-fit:cover; margin-bottom:8px;">
                    <div style="font-weight:600; color:#2b4c7e;">Pak Budi</div>
                </div>
                <div class="guru-card" data-guru="Bu Lina" style="cursor:pointer; text-align:center; padding:12px 8px; border-radius:12px; border:1.5px solid #c7d2fe; background:#f8fafc; width:120px; transition:box-shadow 0.2s;">
                    <img src="https://randomuser.me/api/portraits/women/46.jpg" alt="Bu Lina" style="width:64px; height:64px; border-radius:50%; object-fit:cover; margin-bottom:8px;">
                    <div style="font-weight:600; color:#2b4c7e;">Bu Lina</div>
                </div>
            </div>
            <div id="guru-terpilih" style="margin-top:18px; text-align:center; color:#16a34a; font-weight:600; display:none;">Guru terpilih: <span id="nama-guru-terpilih"></span></div>
        </div>
    </div>
            </div>
            <div class="hero-img">
                <!-- Ilustrasi konseling dari unDraw -->
                <img src="images/temancurhat.png" alt="Konseling Ilustrasi" />

                <!-- Atau ilustrasi konseling Storyset -->
                <!-- <img src="https://storyset.com/illustration/psychologist/rafiki" alt="Konseling Ilustrasi" /> -->
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="reveal">
        <div class="container">
            <h2>Layanan Kami</h2>
            <div class="services-grid">
                <div class="service-card" data-article="pribadi">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Konseling Pribadi" />
                    <h3>Konseling Pribadi</h3>
                    <p>Bantuan untuk masalah belajar, keluarga, dan sosial.</p>
                </div>
                <div class="service-card" data-article="karir">
                    <img src="https://cdn-icons-png.flaticon.com/512/2920/2920061.png" alt="Konseling Karir" />
                    <h3>Konseling Karir</h3>
                    <p>Panduan memilih jurusan, magang, dan dunia kerja.</p>
                </div>
                <div class="service-card" data-article="keluarga">
                    <img src="https://cdn-icons-png.flaticon.com/512/3062/3062634.png" alt="Konseling Keluarga" />
                    <h3>Konseling Keluarga</h3>
                    <p>Solusi komunikasi & hubungan keluarga sehat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Topics -->
    <section id="popular-topics" class="reveal alt-bg">
        <div class="container">
            <h2>Topik Konseling Populer</h2>
            <ul class="topics-list">
                <li>Menentukan Jurusan & Karir</li>
                <li>Persiapan Magang/Prakerin</li>
                <li>Masalah di Sekolah & Bullying</li>
                <li>Manajemen Waktu & Belajar</li>
                <li>Kesehatan Mental Remaja</li>
            </ul>
        </div>
    </section>

    <!-- Magang Info -->
    <section id="magang-info" class="reveal">
        <div class="container">
            <h2>Info Magang/Prakerin Terbaru</h2>
            <div class="magang-grid">
                <div class="magang-card">
                    <img src="https://cdn-icons-png.flaticon.com/512/1055/1055687.png" alt="Magang 1" />
                    <div>
                        <h3>PT Industri Kreatif</h3>
                        <p>Desain Grafis - Deadline: 30 Juni 2025</p>
                        <a href="#" class="btn btn-small">Lihat Detail</a>
                    </div>
                </div>
                <div class="magang-card">
                    <img src="https://cdn-icons-png.flaticon.com/512/1055/1055672.png" alt="Magang 2" />
                    <div>
                        <h3>CV Teknologi Nusantara</h3>
                        <p>IT Support - Deadline: 15 Juli 2025</p>
                        <a href="#" class="btn btn-small">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Career Test -->
    <section id="career-test" class="reveal alt-bg">
        <div class="container">
            <h2>Tes Minat & Bakat</h2>
            <form id="minat-form">
                <label>Pilih aktivitas yang paling kamu suka:</label>
                <select id="minat-select">
                    <option value="">-- Pilih --</option>
                    <option value="teknik">Membongkar/memperbaiki barang</option>
                    <option value="desain">Membuat gambar/desain</option>
                    <option value="bisnis">Berjualan/berorganisasi</option>
                    <option value="it">Mengutak-atik komputer</option>
                </select>
                <button type="submit" class="btn">Lihat Saran Jurusan</button>
            </form>
            <div id="minat-result"></div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="reveal">
        <div class="container">
            <h2>FAQ</h2>
            <div class="faq-list">
                <div class="faq-item">
                    <button class="faq-question">Bagaimana cara memulai konseling?</button>
                    <div class="faq-answer">Isi form kontak, tim kami akan menghubungi Anda untuk jadwal sesi.</div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">Apakah data saya aman?</button>
                    <div class="faq-answer">Data Anda dijamin kerahasiaannya dan hanya digunakan untuk keperluan konseling.</div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">Berapa biaya layanan?</button>
                    <div class="faq-answer">Kami menyediakan layanan gratis dan berbayar, silakan hubungi kami untuk info lebih lanjut.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section id="contact" class="reveal alt-bg">
        <div class="container contact-flex">
            <div>
                <h2>Kontak Kami</h2>
                <form id="contact-form">
                    <label for="name">Nama:</label>
                    <input type="text" id="name" name="name" required>
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    
                    <label for="message">Pesan:</label>
                    <textarea id="message" name="message" required></textarea>
                    
                    <button type="submit" class="btn">Kirim</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Student Story Section -->
    <section id="student-story" class="reveal alt-bg">
        <div class="container">
            <h2>Tempat Cerita Murid</h2>
            <form id="story-form">
                <label for="story-name">Nama (opsional):</label>
                <input type="text" id="story-name" name="story-name" placeholder="Nama kamu (boleh dikosongkan)">
                
                <label for="story-type">Jenis Cerita:</label>
                <select id="story-type" name="story-type" required>
                    <option value="public">Publik (bisa dilihat semua & dikomentari)</option>
                    <option value="private">Privat (hanya guru BK yang bisa melihat)</option>
                </select>
                
                <label for="story-content">Ceritamu:</label>
                <textarea id="story-content" name="story-content" rows="5" required placeholder="Tulis ceritamu di sini..."></textarea>
                
                <button type="submit" class="btn">Kirim Cerita</button>
            </form>
            <div id="story-success" style="display:none; color:#6366f1; margin-top:16px; font-weight:600;">
                Cerita kamu berhasil dikirim!
            </div>
        </div>
    </section>

    <!-- Public Stories Section -->
<div>
    <section id="public-stories" class="reveal">
        <div class="container">
            <h2>Cerita Murid yang Dipublikasi</h2>
            <div id="stories-list">
                <!-- Cerita publik akan muncul di sini -->
            </div>
        </div>
    </div>
    </section>

    <!-- Modal Artikel Layanan -->
    <div id="service-modal" style="display:none;">
        <div class="modal-bg"></div>
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <div id="modal-article"></div>
        </div>
    </div>

    <!-- Floating Buttons -->
    <button id="dark-toggle" title="Toggle Dark Mode">🌙</button>
    <button id="scrollTopBtn" title="Kembali ke atas">⬆️</button>
    <button id="chat-open">💬</button>

    <!-- Live Chat Widget -->
    <div id="live-chat">
        <div id="chat-header">Live Chat Konselor <span id="chat-close">×</span></div>
        <div id="chat-body">
            <div class="chat-msg bot">Halo! Ada yang bisa kami bantu?</div>
        </div>
        <form id="chat-form">
            <input type="text" id="chat-input" placeholder="Tulis pesan..." autocomplete="off" />
            <button type="submit">Kirim</button>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 Konseling Online SMK. All rights reserved.</p>
        </div>
    </footer>

    <script>
const articles = {
    pribadi: {
        title: "Konseling Pribadi",
        content: `<p>Konseling pribadi membantu siswa menghadapi masalah belajar, pertemanan, stres, dan pengembangan diri. Konselor akan mendengarkan tanpa menghakimi dan memberi solusi yang sesuai dengan kebutuhanmu.</p>
        <ul>
            <li>Curhat masalah pribadi & emosi</li>
            <li>Kesulitan belajar atau motivasi</li>
            <li>Masalah pertemanan & bullying</li>
            <li>Tips mengelola stres & waktu</li>
        </ul>
        <p><b>Jangan ragu untuk bercerita, konselor siap membantumu!</b></p>`
    },
    karir: {
        title: "Konseling Karir",
        content: `<p>Konseling karir membantumu mengenali minat, bakat, dan potensi untuk menentukan jurusan, magang, atau pekerjaan yang cocok. Konselor akan membimbingmu membuat rencana masa depan yang realistis.</p>
        <ul>
            <li>Menentukan jurusan SMK/lanjutan</li>
            <li>Persiapan magang/prakerin</li>
            <li>Simulasi wawancara kerja</li>
            <li>Info beasiswa & peluang kerja</li>
        </ul>
        <p><b>Raih masa depan cerah dengan perencanaan karir yang matang!</b></p>`
    },
    keluarga: {
        title: "Konseling Keluarga",
        content: `<p>Konseling keluarga membantu siswa yang mengalami masalah di rumah, komunikasi dengan orang tua, atau konflik keluarga. Konselor akan menjadi penengah dan memberi solusi terbaik.</p>
        <ul>
            <li>Masalah komunikasi dengan orang tua</li>
            <li>Konflik antar anggota keluarga</li>
            <li>Perubahan suasana rumah</li>
            <li>Dukungan saat menghadapi masalah keluarga</li>
        </ul>
        <p><b>Keluarga harmonis, belajar pun jadi lebih tenang!</b></p>`
    }
};

document.querySelectorAll('.service-card').forEach(card => {
    card.style.cursor = "pointer";
    card.addEventListener('click', function() {
        const key = this.getAttribute('data-article');
        if (articles[key]) {
            document.getElementById('modal-article').innerHTML = `<h2 style="color:#6366f1;">${articles[key].title}</h2>${articles[key].content}`;
            document.getElementById('service-modal').style.display = 'flex';
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('#service-modal .modal-close').onclick = function() {
        document.getElementById('service-modal').style.display = 'none';
    };
    document.querySelector('#service-modal .modal-bg').onclick = function() {
        document.getElementById('service-modal').style.display = 'none';
    };
});
// Tambahkan ke script dark mode kamu
document.getElementById('dark-toggle').onclick = function() {
    document.body.classList.toggle('dark-mode');
};
</script>
<script>
// Modal Guru BK
document.addEventListener('DOMContentLoaded', function() {
    const guruModal = document.getElementById('guru-modal');
    const openGuruBtn = document.getElementById('open-guru-modal');
    const closeGuruBtn = document.getElementById('close-guru-modal');
    const guruTerpilih = document.getElementById('guru-terpilih');
    const namaGuruTerpilih = document.getElementById('nama-guru-terpilih');

    openGuruBtn.onclick = function() {
        guruModal.style.display = 'flex';
        guruTerpilih.style.display = 'none';
    };
    closeGuruBtn.onclick = function() {
        guruModal.style.display = 'none';
    };
    window.onclick = function(e) {
        if (e.target === guruModal) guruModal.style.display = 'none';
    };
    document.querySelectorAll('.guru-card').forEach(function(card) {
        card.onclick = function() {
            const nama = this.getAttribute('data-guru');
            namaGuruTerpilih.textContent = nama;
            guruTerpilih.style.display = 'block';
            setTimeout(function() {
                window.location.href = 'guru.php?nama=' + encodeURIComponent(nama);
            }, 700);
        };
    });
});
</script>
</body>
</html>