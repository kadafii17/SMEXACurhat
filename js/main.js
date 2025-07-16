// JavaScript code for interactivity on the website

const API_URL = 'http://localhost/bimbingan-konseling-online/backend/stories.php';

// Function to validate the contact form
function validateForm() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const message = document.getElementById('message').value;
    let valid = true;

    // Clear previous error messages
    clearErrors();

    // Name validation
    if (name.trim() === '') {
        showError('name', 'Name is required');
        valid = false;
    }

    // Email validation
    if (email.trim() === '') {
        showError('email', 'Email is required');
        valid = false;
    } else if (!validateEmail(email)) {
        showError('email', 'Invalid email format');
        valid = false;
    }

    // Message validation
    if (message.trim() === '') {
        showError('message', 'Message is required');
        valid = false;
    }

    return valid;
}

// Function to validate email format
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
}

// Function to show error messages
function showError(field, message) {
    const errorElement = document.getElementById(`${field}-error`);
    errorElement.innerText = message;
    errorElement.style.display = 'block';
}

// Function to clear error messages
function clearErrors() {
    const errorElements = document.querySelectorAll('.error-message');
    errorElements.forEach(element => {
        element.innerText = '';
        element.style.display = 'none';
    });
}

// Event listener for form submission
document.getElementById('contact-form').addEventListener('submit', function(event) {
    event.preventDefault();
    if (validateForm()) {
        // Form is valid, proceed with submission (e.g., send data to server)
        alert('Form submitted successfully!');
        this.reset(); // Reset the form
    }
});

// Animation on scroll
window.addEventListener('scroll', function() {
    const elements = document.querySelectorAll('.fade-in');
    elements.forEach(element => {
        const position = element.getBoundingClientRect().top;
        const screenPosition = window.innerHeight / 1.2;

        if (position < screenPosition) {
            element.classList.add('active');
        }
    });
});

// FAQ Accordion
document.querySelectorAll('.faq-question').forEach(btn => {
    btn.addEventListener('click', function() {
        this.classList.toggle('active');
        const answer = this.nextElementSibling;
        if (answer.style.display === "block") {
            answer.style.display = "none";
        } else {
            answer.style.display = "block";
        }
    });
});

// Dark Mode Toggle
const darkToggle = document.getElementById('dark-toggle');
darkToggle.addEventListener('click', () => {
    document.body.classList.toggle('dark');
    darkToggle.textContent = document.body.classList.contains('dark') ? '☀️' : '🌙';
});

// Scroll to Top Button
const scrollBtn = document.getElementById('scrollTopBtn');
window.onscroll = function() {
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        scrollBtn.style.display = "block";
    } else {
        scrollBtn.style.display = "none";
    }
};
scrollBtn.onclick = function() {
    window.scrollTo({top: 0, behavior: 'smooth'});
};

// Live Chat Widget
const chatOpen = document.getElementById('chat-open');
const chatWidget = document.getElementById('live-chat');
const chatClose = document.getElementById('chat-close');
chatOpen.onclick = () => {
    chatWidget.style.display = 'flex';
    chatOpen.style.display = 'none';
};
chatClose.onclick = () => {
    chatWidget.style.display = 'none';
    chatOpen.style.display = 'block';
};
document.getElementById('chat-form').onsubmit = function(e) {
    e.preventDefault();
    const input = document.getElementById('chat-input');
    const msg = input.value.trim();
    if (!msg) return;
    const chatBody = document.getElementById('chat-body');
    const userMsg = document.createElement('div');
    userMsg.className = 'chat-msg user';
    userMsg.textContent = msg;
    chatBody.appendChild(userMsg);
    input.value = '';
    setTimeout(() => {
        const botMsg = document.createElement('div');
        botMsg.className = 'chat-msg bot';
        botMsg.textContent = 'Terima kasih atas pesan Anda. Konselor kami akan segera membalas.';
        chatBody.appendChild(botMsg);
        chatBody.scrollTop = chatBody.scrollHeight;
    }, 800);
    chatBody.scrollTop = chatBody.scrollHeight;
};

// Reveal on Scroll
function revealOnScroll() {
    document.querySelectorAll('.reveal').forEach(el => {
        const windowHeight = window.innerHeight;
        const elementTop = el.getBoundingClientRect().top;
        if (elementTop < windowHeight - 60) {
            el.classList.add('active');
        }
    });
}
window.addEventListener('scroll', revealOnScroll);
window.addEventListener('load', revealOnScroll);

// Tambahkan class 'reveal' ke section utama
['hero','services','testimonials','contact','faq'].forEach(id => {
    const el = document.getElementById(id);
    if (el) el.classList.add('reveal');
});

// Tes Minat Bakat Sederhana
document.getElementById('minat-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const value = document.getElementById('minat-select').value;
    let result = '';
    switch(value) {
        case 'teknik':
            result = 'Saran jurusan: Teknik Mesin, Teknik Otomotif, Teknik Elektronika.';
            break;
        case 'desain':
            result = 'Saran jurusan: Multimedia, Desain Komunikasi Visual, Animasi.';
            break;
        case 'bisnis':
            result = 'Saran jurusan: Bisnis Daring & Pemasaran, Akuntansi, Manajemen Perkantoran.';
            break;
        case 'it':
            result = 'Saran jurusan: Rekayasa Perangkat Lunak, Teknik Komputer & Jaringan.';
            break;
        default:
            result = 'Silakan pilih aktivitas favoritmu.';
    }
    document.getElementById('minat-result').textContent = result;
});

// Tampilkan cerita publik
async function renderStories() {
    const res = await fetch(`${API_URL}`);
    const stories = await res.json();
    const list = document.getElementById('stories-list');
    list.innerHTML = '';
    stories.forEach((story) => {
        const card = document.createElement('div');
        card.className = 'story-card';
        card.innerHTML = `
            <div class="story-author">${story.name ? story.name : 'Anonim'}</div>
            <div class="story-date">${story.date}</div>
            <div class="story-content">${story.content}</div>
            <ul class="comment-list" id="comment-list-${story.id}">
                ${(story.comments||[]).map(c=>`<li>${c}</li>`).join('')}
            </ul>
            <form class="comment-form" data-id="${story.id}">
                <input type="text" placeholder="Tulis komentar..." required>
                <button type="submit">Kirim</button>
            </form>
        `;
        list.appendChild(card);
    });
    // Event komentar
    document.querySelectorAll('.comment-form').forEach(form => {
        form.onsubmit = async function(e) {
            e.preventDefault();
            const id = this.getAttribute('data-id');
            const input = this.querySelector('input');
            const val = input.value.trim();
            if (!val) return;
            await fetch(`${API_URL}?comment=1&id=${id}`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ comment: val })
            });
            renderStories();
        };
    });
}

// Kirim cerita baru ke backend
document.getElementById('story-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const name = document.getElementById('story-name').value;
    const type = document.getElementById('story-type').value;
    const content = document.getElementById('story-content').value;
    if (type === 'public' || type === 'private') {
        await fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ name, type, content })
        });
        if (type === 'public') renderStories();
    }
    document.getElementById('story-success').style.display = 'block';
    setTimeout(()=>{document.getElementById('story-success').style.display='none';}, 2000);
    this.reset();
});

// Tampilkan cerita publik saat halaman dimuat
window.addEventListener('DOMContentLoaded', renderStories);