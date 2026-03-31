## Phase 2.3: The View Engine (Step-by-Step)

### Step 1: Create the Views Folder Structure
We need a place for our "Shell" (the layout) and our "Pages" (the views).

```text
ite3/
└── views/
    ├── layouts/
    │   └── main.php      # The HTML Shell (Header/Footer)
    ├── home.php          # The Content for the Home page
    └── post-create.php   # The Content for the Create page
```

---

### Step 2: Create the Master Layout (`views/layouts/main.php`)
This file contains the `<head>` and `<body>` tags. We use a variable called `$content` to show where the specific page data should appear.

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DevBlog CMS</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; padding: 20px; }
        nav { margin-bottom: 20px; border-bottom: 1px solid #ccc; padding-bottom: 10px; }
        nav a { margin-right: 15px; text-decoration: none; color: blue; }
    </style>
</head>
<body>
    <nav>
        <a href="/ite3/home">Home</a>
        <a href="/ite3/post/create">Create Post</a>
    </nav>

    <main>
        <?php echo $content; ?>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> DevBlog CMS - Capstone Model</p>
    </footer>
</body>
</html>
```

---

### Step 3: Create a Page View (`views/home.php`)
This file **only** contains the HTML for the middle section of the page. No `<html>` or `<body>` tags are needed here.

```php
<h1>Welcome to the Blog</h1>
<p>This content is being loaded from a separate view file!</p>
<ul>
    <li>Post 1: Learning PHP MVC</li>
    <li>Post 2: How Autoloaders Work</li>
</ul>
```

---

### Step 4: The "Magic" Logic (The Render Helper)
We need a way to tell PHP: "Take `home.php`, save its output into a variable, then put that variable inside `main.php`."

Update your `app/Controllers/PostController.php` with a `render` helper method:

```php
<?php
namespace App\Controllers;

class PostController {
    
    // Helper function to render views
    protected function render($viewName, $data = []) {
        // 1. Extract data array into variables 
        // (e.g., ['title' => 'Home'] becomes $title = 'Home')
        extract($data);

        // 2. Start Output Buffering (Capture everything)
        ob_start();
        
        // 3. Include the specific page view
        include __DIR__ . "/../../views/{$viewName}.php";
        
        // 4. Save the captured HTML into $content and stop buffering
        $content = ob_get_clean();

        // 5. Include the master layout (which uses the $content variable)
        include __DIR__ . "/../../views/layouts/main.php";
    }

    public function index() {
        $this->render('home', [
            'title' => 'Welcome to DevBlog'
        ]);
    }

    public function create() {
        $this->render('post-create');
    }
}
```

---

## 🧠 Why use `ob_start()` and `ob_get_clean()`?
Normally, as soon as PHP sees HTML or an `echo`, it sends it straight to the browser. 
* **`ob_start()`** tells PHP: "Wait! Don't send anything to the browser yet. Put it in a temporary 'bucket' instead."
* **`ob_get_clean()`** says: "Give me everything in that bucket and save it to a variable, then empty the bucket."



---

## 🛠️ Individual Task for Students
1. Create the `views/` folder and the files listed in Step 1.
2. Update your `PostController` to use the `render()` method instead of `echo`.
3. Create `views/post-create.php` and add a simple HTML form inside it.
4. Refresh `localhost/ite3/` and `localhost/ite3/post/create`. You should see the **Navigation Bar** and **Footer** on both pages, but the middle content should change.