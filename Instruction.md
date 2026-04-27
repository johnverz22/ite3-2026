# 🚀 Phase 7: Assets & Responsive UI (Step-by-Step)

In this phase, we move away from messy internal `<style>` tags and build a professional, responsive front-end for our DevBlog CMS.

---

## 🛠️ Step 1: Organizing the Public Folder
To keep things clean, we need to create subdirectories for our static files inside the `public/` directory.

**New Structure:**
- Create `public/css/` -> For your stylesheets.
- Create `public/js/` -> For your JavaScript files.

---

## 🛠️ Step 2: The Global Stylesheet (`public/css/style.css`)
Move all your CSS from `main.php` to this new file. We are using **CSS Variables** to make it easy to change colors later.

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
```

---

## 🛠️ Step 3: The JavaScript Logic (`public/js/app.js`)
Create a new file for your client-side logic. For now, just add a simple log to verify it works.

```javascript
console.log('🚀 DevBlog CMS Assets Loaded!');
```

---

## 🛠️ Step 4: Linking Assets in the Layout (`app/Views/layouts/main.php`)
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

## 🛠️ Step 5: Responsive Design (Media Queries)
The web isn't just for desktops. Add a **Media Query** to your `style.css` to adjust the layout for smaller screens.

```css
@media (max-width: 768px) {
    nav { 
        flex-direction: column; 
        gap: 1rem;
    }
}
```

---

## 🧠 Key Concept: Separation of Concerns
By moving CSS and JS to external files:
1. **Cleaner Code:** Your PHP files focus only on logic and structure.
2. **Performance:** The browser can cache these files, making your site load faster.
3. **Responsive Design:** You can easily support both Phones and Desktops.

---

## 🎯 Challenge
Can you change the background color of the page *only* for mobile devices using a Media Query?
