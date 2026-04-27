# 🎨 Phase 7: Assets & Responsive UI

In this phase, we transform our basic HTML structure into a modern, professional, and mobile-friendly web application by introducing external assets and responsive design principles.

## 1. Separation of Concerns (External Assets)
Previously, our styles were trapped inside `<style>` tags in our PHP files. By moving them to `public/css/style.css` and `public/js/app.js`, we achieve:
- **Cached Loading:** The browser saves these files so they don't have to be downloaded every time the user clicks a link.
- **Organization:** It’s easier to manage 500 lines of CSS in a dedicated `.css` file than inside a PHP template.
- **Cleaner Views:** Our PHP files now focus purely on data and structure.

## 2. Responsive Design (Media Queries)
The web isn't just for desktops. We use **Media Queries** to detect the user's screen size and adjust the layout accordingly.
```css
/* Tablet and Mobile adjustments */
@media (max-width: 768px) {
    .container { padding: 10px; }
    nav { 
        flex-direction: column; 
        gap: 1rem;
    }
}
```

## 3. The Asset Pipeline
In our CMS, the `public/` folder is the ONLY folder accessible to the world. 
- All CSS, JS, and Images MUST live inside `public/`.
- We link them in our `layouts/main.php` using absolute paths (e.g., `/ite3/css/style.css`) so every page automatically gets the same look and feel.

---

## 🛠️ Student Checklist: UI Modernization
1.  **Directory Setup:** Create `public/css/` and `public/js/` folders.
2.  **Asset Migration:** Move your CSS from `main.php` to `style.css`.
3.  **External Linking:** Link both `style.css` and `app.js` in your `main.php` layout.
4.  **Responsive Layout:** Use Flexbox (`display: flex`) for your navigation bar and ensure it stacks on mobile.
5.  **Testing:** Shrink your browser window. Does the content still look good?
