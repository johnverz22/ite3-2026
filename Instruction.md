# 🚀 Phase 4: Models & Content CRUD

In this phase, you will refactor your code to follow professional standards and make your blog homepage dynamic by pulling real data from the database.

## Phase 4.1: Create the Base Controller
Don't repeat yourself (DRY)! Instead of writing the `render()` helper in every single controller, you will create a **Base Controller** that all your other controllers will inherit from.

**Your Task:** Create a new file at `app/Controllers/Controller.php` and add this code:

```php
<?php
namespace App\Controllers;

abstract class Controller {
    
    protected function render($viewName, $data = []) {
        // 1. Extract the data array into variables
        extract($data);

        // 2. Start capturing the output
        ob_start();
        
        // 3. Load the specific view file
        include __DIR__ . "/../views/{$viewName}.php";
        
        // 4. Save the view content and stop capturing
        $content = ob_get_clean();

        // 5. Load the master layout (which uses $content)
        include __DIR__ . "/../views/layouts/main.php";
    }
}
```

---

## Phase 4.2: Make the Homepage Dynamic
It's time to stop using "Lorem Ipsum." You need to update your homepage view to loop through the posts you've saved in your database.

**Your Task:** Open `app/Views/home.php` and update it with this loop:

```php
<h1>Welcome to the Blog</h1>
<a href="/ite3/post/create">Add New Post</a>
<hr>

<?php foreach ($posts as $post): ?>
    <div>
        <h3><?= htmlspecialchars($post['title']) ?></h3>
        <p><?= htmlspecialchars($post['content']) ?></p>
        <small>Posted on: <?= $post['created_at'] ?></small>
    </div>
    <hr>
<?php endforeach; ?>
```

---

## Phase 4.3: Build the Post Creation Flow
You need to allow users to add new posts. This requires three parts: a form, a model method, and a controller action.

### 1. Create the Form
Open `app/Views/post-create.php` and create the HTML form. Make sure the `method` is set to `POST`.

```html
<h1>Create a New Post</h1>
<form action="/ite3/post/store" method="POST">
    <input type="text" name="title" placeholder="Post Title" required><br><br>
    <textarea name="content" placeholder="Write your content here..." rows="5" required></textarea><br><br>
    <button type="submit">Publish Post</button>
</form>
```

### 2. Update the Post Model
Open `app/Models/Post.php` and add the `create()` method. You must use **Prepared Statements** here to keep the app secure.

```php
public function create($title, $content) {
    $stmt = $this->db->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    return $stmt->execute([$title, $content]);
}
```

### 3. Handle the Submission in the Controller
Open `app/Controllers/PostController.php`. Add the `store()` method to handle the incoming form data and redirect the user back home.

```php
public function store() {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (!empty($title) && !empty($content)) {
        $postModel = new Post();
        $postModel->create($title, $content);
    }

    // Redirect back to the home page after saving
    header('Location: /ite3/home');
    exit;
}
```

---

## 🧠 Key Concept: XSS Protection
**Never** display user-provided data directly using `<?= $post['title'] ?>`. 
**Always** wrap it in `htmlspecialchars()`. This prevents hackers from injecting `<script>` tags that could steal user cookies or deface your site.

---

## Phase 5: Cleaner Routing & Organization
As you add more pages, your `public/index.php` will get messy. You are going to move your "URL Map" into its own dedicated file.

### 1. Create the Route Switchboard
Create a new file at `app/routes.php`. This is where you will register all your URLs from now on.

```php
<?php
// app/routes.php
$router->get('home', 'PostController@index');
$router->get('post/create', 'PostController@create');
$router->post('post/store', 'PostController@store');
```

### 2. Clean up `public/index.php`
Open `public/index.php`. Remove the manual route definitions and replace them with a single `require` statement.

```php
// Find where you defined $router and replace the old routes with this:
$router = new Router();

// Load the routes from your new file
require __DIR__ . '/../app/routes.php';

$router->resolve($uri, $method);
```
