# 🚀 Phase 11: Composer & Environment Variables

In this phase, we move from manual setups to professional industry standards using **Composer** and **Dotenv**.

---

## 1. Introducing Composer
Composer is the "App Store" for PHP libraries. Instead of writing everything from scratch, we can use libraries built by the community.

**Key Files:**
- `composer.json`: The "Shopping List" of your project.
- `vendor/`: The folder where all external libraries live.

**Command to run:**
```powershell
composer install
```

---

## 2. Environment Variables (`.env`)
Never hardcode your database passwords! We use a `.env` file to store settings that change depending on where the app is running.

**New logic:**
1. Create a `.env` file (see `.env.example`).
2. Use `$_ENV['DB_PASS']` in your code instead of writing it directly.

---

## 3. Fixing the "Directory Listing" Issue
We've added a root `index.php`. Now, when you visit `localhost/ite3`, it will automatically redirect you to the `public/` folder where our real app lives.

---

## 🛠️ Student Checklist
*   [ ] Verify you have **Composer** installed (`composer --version`).
*   [ ] Run `composer install` in your project root.
*   [ ] Create your own `.env` file by copying `.env.example`.
*   [ ] Update your `public/index.php` to use the `vendor/autoload.php`.
*   [ ] Check that your `.env` variables are being loaded correctly.
*   [ ] **CRITICAL:** Ensure `.env` is listed in your `.gitignore` so you don't leak passwords to GitHub!

---

## 🧠 Key Concept: Portability
By using `.env` and Composer, your project is now "Portable." Another developer can download your code, run `composer install`, create their own `.env`, and the app will work perfectly on their machine without changing a single line of your PHP code!

---

## 🎯 Challenge
Can you add a custom variable to your `.env` called `APP_MAINTENANCE=false` and use it in `index.php` to show a "Coming Soon" message if it is set to `true`?
