# Phase 2: The Router & Controller Dispatcher

In this phase, we move away from simple `if/else` statements in our `index.php`. We are building a **Router Engine** that acts as a map for the entire application.

## 1. What is a Router?
The Router is a specialized class that stores a list of "Rules." Each rule says: *"If the user visits this URL using this Method (GET/POST), then execute this specific Controller and Method."*

## 2. Key Components Added

### A. The Router Class (`app/Core/Router.php`)
This class contains two main parts:
* **The Map (`$routes`):** An associative array that stores our defined paths.
* **The Resolver:** This is the logic that "dispatches" the request. It takes a string like `'PostController@index'`, splits it at the `@` symbol, and uses PHP's **Reflection** capabilities (instantiating a class from a string) to run the code.

### B. Controller Actions
Our `PostController` now has multiple "Actions" (Methods):
* `index()`: Typically used to list all records.
* `create()`: Typically used to show a form for a new record.

## 3. How the "Dispatch" Works
When a user visits `localhost/ite3/post/create`, the following happens:
1.  **`index.php`** captures the path: `post/create`.
2.  **`Router`** looks at its map and finds: `post/create` → `PostController@create`.
3.  **`Router`** automatically does: `new App\Controllers\PostController()->create();`.

---

## 🛠️ Student Checklist: Verification
To ensure your Router is working perfectly, try these three tests:

1.  **The Home Test:**
    * URL: `localhost/ite3/`
    * Expected: "All Blog Posts" (from `PostController@index`)
2.  **The Sub-page Test:**
    * URL: `localhost/ite3/post/create`
    * Expected: "Create New Post" (from `PostController@create`)
3.  **The Error Test:**
    * URL: `localhost/ite3/wrong-url`
    * Expected: **404 - Page Not Found** and a `404` status code in the Network Tab of your browser.

---

## ⚠️ Common Errors to Watch For
* **Explode Error:** If you forget the `@` symbol in your route definition (e.g., `'PostControllerindex'`), the `explode()` function will fail.
* **Class Not Found:** Ensure your Controller class name in the `Router` matches the actual filename and namespace exactly.
* **Method Not Found:** Check for typos in your method names (e.g., defining `public function index()` but calling `indexx`).
