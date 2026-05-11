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
Show the generated slug next to your post titles so you can verify it's working!

```html
<strong><?= $post['title'] ?></strong>
<small>/<?= $post['slug'] ?></small>
```

---

## 🧠 Key Concept: Thin Controllers, Fat Services
We want our **Controllers** to be "Thin"—they should only coordinate between the view, the service, and the model. The **Services** handle the heavy lifting. This makes your code cleaner and easier to test.

---

## 🎯 Challenge
Can you update the `PostService` to handle "Double Hyphens"? (e.g., if a title is "Hello @ World", it might generate `hello---world`. Use regex to turn multiple hyphens into one: `hello-world`).
