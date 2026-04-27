# 📦 Phase 11: Composer & Dotenv Integration

In this phase, we modernize the project's infrastructure by adopting industry-standard dependency management and secure configuration practices.

## 1. Professional Autoloading (PSR-4)
We have removed our manual `spl_autoload_register` and replaced it with **Composer's PSR-4 Autoloader**.
- **Efficiency:** Composer is faster and more reliable.
- **Standards:** It follows the global PHP standards, making our project compatible with any other modern PHP library.

## 2. Secure Configuration (.env)
We no longer store sensitive information (like DB passwords) in our PHP files.
- **Dotenv Library:** We use the `vlucas/phpdotenv` library via Composer.
- **Security:** The `.env` file is excluded from Git via `.gitignore`. This ensures that every developer can have their own local settings without overwriting others.
- **Flexibility:** Changing the project folder name (Base Path) is now as simple as editing one line in the `.env`.

## 3. The Public Entry Point
To solve the issue of directory listings when visiting `localhost/ite3`, we've implemented:
- **Root Redirect:** A root-level `index.php` that gracefully sends users to the secure `public/` directory.

---

## 🛠️ Student Checklist: Infrastructure Upgrade
1.  **Composer Setup:** Run `composer install` to download dependencies.
2.  **Environment Setup:** Copy `.env.example` to `.env` and fill in your local DB details.
3.  **Entry Point Test:** Visit `localhost/ite3`. Does it redirect to the home page?
4.  **Security Audit:** Run `git status`. Ensure `.env` and `vendor/` are NOT being tracked by Git.
