# 🚀 Phase 11: Composer & Dotenv (Step-by-Step)

In this phase, we modernize the project's infrastructure using industry-standard tools for dependency management and secure configuration.

---

## 🛠️ Step 1: The Shopping List (`composer.json`)
Create a file named `composer.json` in your project root. This tells PHP which libraries we need and how our own classes should be loaded.

```json
{
    "require": {
        "vlucas/phpdotenv": "^5.6"
    },
    "autoload": {
        "psr-4": {
            "App\\": "app/"
        }
    }
}
```

---

## 🛠️ Step 2: Installation
Open your terminal in the project root and run the following command. This will create the `vendor/` folder and download all necessary libraries.

```powershell
composer install
```

---

## 🛠️ Step 3: Secure Secrets (`.env`)
1. Create a file named `.env.example` as a template.
2. Create a file named `.env` and fill it with your local details:

```env
DB_HOST=localhost
DB_NAME=ite3_db
DB_USER=root
DB_PASS=
APP_BASE_PATH=ite3
```

**CRITICAL:** Add `.env` and `/vendor/` to your `.gitignore` file so you don't upload your passwords to GitHub!

---

## 🛠️ Step 4: Refactor the Autoloader
In `public/index.php`, **delete** your manual `spl_autoload_register` block and replace it with:

```php
// 1. Load Composer's Autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// 2. Load Environment Variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
```

---

## 🛠️ Step 5: Update the Database Config
Update `app/Config/database.php` to use the environment variables instead of hardcoded strings:

```php
$host = $_ENV['DB_HOST'] ?? 'localhost';
$user = $_ENV['DB_USER'] ?? 'root';
// ... etc
```

---

## 🛠️ Step 6: Fix the Entrance
To prevent users from seeing a list of files when they visit `localhost/ite3`, create a simple `index.php` in your **root folder**:

```php
<?php
// Redirect to the secure public folder
header("Location: public/");
exit;
```

---

## 🎯 Student Challenge
Can you move your `APP_URL` to the `.env` file and use it in your navigation links? This makes it easy to switch between `localhost` and a real website in the future!
