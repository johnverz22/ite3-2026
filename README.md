# 🖼️ Phase 2.3: The View Engine & Layout System

In this phase, we separate our **Logic** (PHP) from our **Presentation** (HTML). We are building a system that allows us to have a consistent "Look and Feel" across all pages without duplicating code.

## 1. The "Don't Repeat Yourself" (DRY) Principle
Instead of writing the `<head>`, `<nav>`, and `<footer>` in every single file, we created a **Master Layout**. 
* **Location:** `views/layouts/main.php`
* **The Slot:** We use a special variable called `$content` to act as a placeholder for the unique parts of each page.

## 2. Key Technology: Output Buffering
By default, PHP sends HTML to the browser as soon as it sees it. To "inject" a page into a layout, we must temporarily stop this process.

### The `ob_start()` / `ob_get_clean()` Cycle:
1.  **`ob_start()`**: Opens a "temporary bucket" in the server's memory.
2.  **`include 'view.php'`**: PHP executes the view, but instead of sending it to the user, the HTML falls into the "bucket."
3.  **`ob_get_clean()`**: Grabs everything inside the bucket, saves it into the `$content` variable, and empties the bucket.
4.  **Final Step**: We include the `main.php` layout, which simply echoes the `$content` variable.



## 3. The `render()` Helper Method
We added a protected method to our **Base Controller** (or `PostController`) to handle this process automatically.

**Functionality:**
* **`extract($data)`**: This built-in PHP function takes an associative array and turns keys into variables. 
  * *Example:* `['user' => 'Juan']` becomes `$user = 'Juan';` inside the view.
* **Dynamic Loading**: It finds the correct file in the `views/` folder based on the name we provide.

---

## 🛠️ Student Checklist: Verification
To ensure your View Engine is working:

1.  **Consistent Navigation:** Visit `/home` and `/post/create`. The navigation bar and footer should be identical on both.
2.  **Dynamic Titles:** Pass a `'title'` in your data array and echo it in the `<title>` tag of `main.php`. Does the browser tab change when you switch pages?
3.  **Data Injection:** In `PostController@index`, pass an array of `posts`. In `views/home.php`, use a `foreach` loop to display them. Do they appear inside the layout?

---

## ⚠️ Common Troubleshooting
* **Path Errors:** If you see `include(): failed to open stream`, check your `__DIR__` pathing in the `render()` method. Remember that `index.php` is in the `public/` folder, but your views are in the root `views/` folder.
* **Undefined Variable $content:** This happens if you include the layout *before* you've captured the buffer. Ensure `ob_get_clean()` happens first!
* **Nested Buffers:** If your page looks strange or double-rendered, ensure you aren't calling `ob_start()` multiple times without closing them.