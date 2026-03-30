# 🚀 Phase 1: The Foundation (Front Controller & Autoloader)

This phase establishes the **Single Entry Point** for our application. Instead of many separate PHP files, every request is handled by one central script.

## 1. The Traffic Cop (`.htaccess`)
The `.htaccess` file is responsible for **URL Rewriting**. It ensures that "Clean URLs" (like `/home` or `/about`) are directed to our PHP code even if those folders don't exist on the server.

* **Rule 1:** Enables the rewrite engine.
* **Rules 2 & 3:** Checks if you are trying to access a real file (like `style.css`) or an image. If so, it lets you view them.
* **Rule 4:** If the request isn't for a real file, it sends the entire URL path to `public/index.php`.

## 2. The Gatekeeper (`public/index.php`)
This file "boots up" the application. It contains two critical pieces of logic:

### A. The Manual Autoloader
Instead of using `require` for every new class, we use `spl_autoload_register`.
* It looks for classes starting with the **`App\`** namespace.
* It automatically converts that namespace into a folder path (e.g., `App\Controllers\PostController` becomes `app/Controllers/PostController.php`).
* This teaches you how PHP finds files before we move to **Composer** later in the semester.

### B. The Route Parser
This section cleans the URL. It removes the subfolder name and query strings so that the application only sees the specific "route" the user wants (e.g., `home`, `login`, or `posts`).

## 3. The Test Controller (`app/Controllers/PostController.php`)
This is a simple class used to verify that your autoloader is working correctly.
* **Namespace:** Must match the folder structure (`App\Controllers`).
* **Success Message:** If you see "SUCCESS" in your browser, it means your manual autoloader correctly mapped the class name to the physical file on your disk.

---

### Checklist for Students
1. [ ] Create the `.htaccess` in your project root.
2. [ ] Create `public/index.php` and paste the provided code.
3. [ ] Create `app/Controllers/PostController.php`.
4. [ ] Open `localhost/ite3/` in your browser.
5. [ ] Verify you see the **Requested Route** and the **Success Message**.

**Next Step:** Once this foundation is solid, we will build a **Router Class** to handle these routes dynamically.