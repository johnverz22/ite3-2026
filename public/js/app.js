// DevBlog CMS Client Logic
document.addEventListener('DOMContentLoaded', () => {
    initScrollAnimations();
    initDeleteModals();
});

// 1. Toast Notifications
function showToast(message) {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.innerText = message;
    
    container.appendChild(toast);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 500);
    }, 3000);
}

// 2. Custom Delete Confirmation Modal
function initDeleteModals() {
    const modal = document.getElementById('deleteModal');
    const confirmBtn = document.getElementById('confirmDelete');
    const cancelBtn = document.getElementById('cancelDelete');
    let deleteUrl = '';

    // Delegate click events for delete buttons
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('delete-btn')) {
            e.preventDefault();
            deleteUrl = e.target.href;
            modal.classList.add('active');
        }
    });

    cancelBtn?.addEventListener('click', () => modal.classList.remove('active'));
    confirmBtn?.addEventListener('click', () => {
        if (deleteUrl) window.location.href = deleteUrl;
    });
}

// 3. Scroll Reveal Animations
function initScrollAnimations() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
}
