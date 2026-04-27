# 🚀 Phase 12: Vanilla JS Interactivity

In this phase, we move beyond static HTML and add a layer of modern "feel" to our app using **Vanilla JavaScript**.

---

## 1. Custom Modals
Browser alerts like `confirm()` look dated. We will build our own **Modal** component using HTML/CSS and control its visibility with JS.

**Key Steps:**
- Add a hidden `<div id="deleteModal">` to your layout.
- Use `element.classList.add('active')` to show it when a delete button is clicked.

---

## 2. Toast Notifications
Toasts are temporary messages that appear at the bottom of the screen to give the user feedback (e.g., "Post Saved!").

**Workflow:**
1. PHP sets a "Flash Message" in the session.
2. The Layout checks for this message and triggers a JS function.
3. JS creates a temporary `div` and fades it out after 3 seconds.

---

## 3. Smooth Scrolling & Animations
We will use the **Intersection Observer API** to detect when a post enters the screen and apply a "Fade In" animation.

```javascript
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) entry.target.classList.add('show');
    });
});
```

---

## 🛠️ Student Checklist
*   [ ] Add the Modal and Toast HTML to `main.php`.
*   [ ] Implement the `showToast()` and `openModal()` functions in `app.js`.
*   [ ] Update `PostController.php` to set `$_SESSION['flash']` messages.
*   [ ] Use `scroll-behavior: smooth;` in your CSS.
*   [ ] Add a `.reveal` class to your blog posts and observe them fading in as you scroll.

---

## 🧠 Key Concept: The User Experience (UX)
Code isn't just about logic—it's about how it *feels*. By adding subtle animations and custom components, you make your app feel premium and high-quality, which is essential for any professional portfolio project.

---

## 🎯 Challenge
Can you make the Toast notification change color? (e.g., Green for success, Red for errors).
