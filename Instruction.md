# 🚀 Phase 7: Assets & Responsive UI

In this phase, we are moving away from messy internal styles and building a professional, responsive front-end for our DevBlog CMS.

---

## 1. Organizing the Public Folder
To keep things clean, we need to create subdirectories for our static files inside the `public/` directory.

**New Structure:**
- `public/css/` -> For your stylesheets.
- `public/js/` -> For your JavaScript files.

---

## 2. The Global Stylesheet (`public/css/style.css`)
We are using **CSS Variables** and **Flexbox** to create a modern, responsive layout.

```css
:root {
    --primary: #6366f1;
    --bg: #f8fafc;
    --card: #ffffff;
}

/* Mobile-First Responsive Design */
.container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 1rem;
}

/* Using Flexbox for navigation */
nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
```

---

## 3. Linking Assets in the Layout (`app/Views/layouts/main.php`)
We need to tell our browser where to find these files. Use the absolute path starting from `/ite3/`.

```html
<head>
    <link rel="stylesheet" href="/ite3/css/style.css">
</head>
<body>
    ...
    <script src="/ite3/js/app.js"></script>
</body>
```

---

## 🛠️ Student Checklist
*   [ ] Create `public/css/` and `public/js/` folders.
*   [ ] Move internal styles from `main.php` to `public/css/style.css`.
*   [ ] Link `style.css` and `app.js` in your `main.php` layout.
*   [ ] Add a Media Query to `style.css` to change the background color on mobile devices.
*   [ ] Update `home.php` to use the new CSS classes.

---

## 🧠 Key Concept: Separation of Concerns
By moving CSS and JS to external files:
1. **Cleaner Code:** Your PHP files focus only on logic and structure.
2. **Performance:** The browser can cache these files, making your site load faster.
3. **Responsive Design:** You can use Media Queries (`@media`) to make your site look great on both Phones and Desktops.

---

## 🎯 Challenge
Can you add a simple "Hello World" `console.log()` in `app.js` and verify it appears in your browser's Developer Tools (F12)?
