# 🚀 Phase 12: Vanilla JS Interactivity (Step-by-Step)

In this phase, we move beyond static HTML and add a layer of modern "feel" to our app using **Vanilla JavaScript**. No libraries needed—just pure code!

---

## 🛠️ Step 1: CSS Animation & UI States
Before we write JS, we need our elements to have a place to live and a way to move. Add these to your `public/css/style.css`:

```css
/* 1. Modal Overlay (Hidden by default) */
.modal-overlay {
    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(0,0,0,0.5); display: none; align-items: center; justify-content: center;
    z-index: 1000; backdrop-filter: blur(4px);
}
.modal-overlay.active { display: flex; }

/* 2. Toast Container */
#toast-container { position: fixed; bottom: 2rem; right: 2rem; z-index: 2000; }

/* 3. Reveal Animation Class */
.reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s ease; }
.reveal.show { opacity: 1; transform: translateY(0); }
```

---

## 🛠️ Step 2: Global UI Containers
Add the "Placeholders" for your interactive elements at the top of your `<body>` in `app/Views/layouts/main.php`.

```html
<!-- Toast Container (Empty for now) -->
<div id="toast-container"></div>

<!-- Custom Delete Confirmation Modal -->
<div id="deleteModal" class="modal-overlay">
    <div class="modal-content">
        <h3>Are you sure?</h3>
        <p>This action cannot be undone.</p>
        <div class="modal-btns">
            <button id="cancelDelete" class="btn btn-secondary">Cancel</button>
            <button id="confirmDelete" class="btn" style="background: #ef4444;">Delete</button>
        </div>
    </div>
</div>
```

---

## 🛠️ Step 3: JavaScript Logic (`public/js/app.js`)
Now, let's make it work! We need three main features:

1.  **Toast Function**: To create a temporary notification.
2.  **Modal Logic**: To capture the delete click and show our custom modal.
3.  **Intersection Observer**: To watch for elements entering the screen and animate them.

```javascript
// Function to show a Toast
function showToast(message) {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.innerText = message;
    container.appendChild(toast);
    setTimeout(() => toast.remove(), 3000); // Remove after 3s
}

// Function to handle Reveal Animations
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) entry.target.classList.add('show');
    });
});
document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
```

---

## 🛠️ Step 4: The PHP-to-JS Bridge
We need to tell the browser when an action was successful. In your **Controller**, set a "Flash" message:

```php
// Inside PostController.php after a successful delete/save
$_SESSION['flash'] = "Success! Action completed.";
```

Then, in your **Layout** (`main.php`), check for that message and "hand it over" to JavaScript:

```php
<?php if (isset($_SESSION['flash'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            showToast("<?= $_SESSION['flash'] ?>");
        });
    </script>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>
```

---

## 🛠️ Step 5: Updating the View
Finally, update your `home.php` to use the new interactivity:
1.  Add the `reveal` class to your list items `<li>`.
2.  Change your delete link class to `delete-btn` and remove the `onclick` attribute.

---

## 🎯 Student Challenge
Can you add a **Progress Bar** to the Toast notification that shrinks as the 3 seconds count down? 
*Hint: Use CSS `transition` and JS to set a width!*
