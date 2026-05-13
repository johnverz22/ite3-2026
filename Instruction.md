# 🚀 Phase 10: The Service Layer (Step-by-Step)

In this phase, we move beyond simple CRUD and introduce a **Service Layer**. This is where we handle complex logic that doesn't belong in a Controller or a Model.

---

## 🛠️ Step 1: Database Update
We need to store a URL-friendly "Slug" for each post. Run this SQL in your database tool:

```sql
ALTER TABLE posts ADD COLUMN slug VARCHAR(255) NOT NULL UNIQUE AFTER title;
```
**Note:** If this will generate error, make sure to truncate or empty your post table first then re-run again.
---

## 🛠️ Step 2: Creating the Service (`app/Services/PostService.php`)
This class will be responsible for "Business Logic"—in this case, transforming a messy title into a clean URL slug.

```php
namespace App\Services;

class PostService {
    public static function generateSlug($title) {
        $slug = strtolower(trim($title));
        $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
        return trim($slug, '-');
    }
}
```

---

## 🛠️ Step 3: Model Update (`app/Models/Post.php`)
Update your `create()` and `update()` methods to include the new `slug` parameter in the SQL queries.

```php
public function create($title, $slug, $content) {
    $stmt = $this->db->prepare("INSERT INTO posts (title, slug, content) VALUES (?, ?, ?)");
    return $stmt->execute([$title, $slug, $content]);
}
```

---

## 🛠️ Step 4: Controller Refactoring (`PostController.php`)
This is the most important part! The Controller now asks the Service to generate the slug *before* it sends everything to the Model.

```php
// 1. Generate the slug using the Service
$slug = PostService::generateSlug($title);

// 2. Pass it to the Model
$postModel->create($title, $slug, $content);
```

---

## 🛠️ Step 5: View Update (`app/Views/home.php`)
Make the post title and slug clickable links that point to the single post view using the slug!

```html
<strong>
    <a href="/ite3/post/<?= htmlspecialchars($post['slug']) ?>">
        <?= htmlspecialchars($post['title']) ?>
    </a>
</strong>
<small>
    <a href="/ite3/post/<?= htmlspecialchars($post['slug']) ?>">
        /<?= htmlspecialchars($post['slug']) ?>
    </a>
</small>
```

---

## 🛠️ Step 6: Core Router Update (`app/Core/Router.php`)
To allow the router to accept slugs with hyphens (`-`), update the regular expression in the `resolve` method of the `Router` class.

```php
// Convert route pattern {id} to regex
$pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $route);
```

---

## 🛠️ Step 7: Adding the Route and Controller Method (`routes.php` & `PostController.php`)
Add a new route to handle the slug and a new method in your controller to fetch the post by its slug.

**In `routes.php`:**
```php
$router->get('post/{slug}', 'PostController@show');
```

**In `PostController.php`:**
```php
public function show($slug) {
    $postModel = new Post();
    $post = $postModel->findBySlug($slug);

    if (!$post) {
        echo "Post not found!";
        return;
    }

    $this->render('post-show', [
        'post' => $post
    ]);
}
```

---

## 🛠️ Step 8: Update Model (`app/Models/Post.php`)
Add a method to your model to fetch a post by its slug.

```php
public function findBySlug($slug) {
    $stmt = $this->db->prepare("SELECT * FROM posts WHERE slug = ?");
    $stmt->execute([$slug]);
    return $stmt->fetch();
}
```

---

## 🛠️ Step 9: Create Single Post View (`app/Views/post-show.php`)
Create a new view file to display the single post data.

```php
<h1><?= htmlspecialchars($post['title']) ?></h1>
<p style="color: var(--primary);">Slug: <?= htmlspecialchars($post['slug']) ?></p>

<div style="margin-top: 2rem; margin-bottom: 2rem;">
    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
</div>

<small>Posted on: <?= $post['created_at'] ?></small>

<hr>
<a href="/ite3/home">Back to Home</a>
```

---

## 🧠 Key Concept: Thin Controllers, Fat Services
We want our **Controllers** to be "Thin"—they should only coordinate between the view, the service, and the model. The **Services** handle the heavy lifting. This makes your code cleaner and easier to test.

---

## 🎯 Challenge
Can you update the `PostService` to handle "Double Hyphens"? (e.g., if a title is "Hello @ World", it might generate `hello---world`. Use regex to turn multiple hyphens into one: `hello-world`).
