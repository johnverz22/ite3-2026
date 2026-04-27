# 🚀 Phase 10: The Service Layer

In this phase, we are taking our "MVC" architecture to a professional level by introducing a **Service Layer**. This is where the complex "Business Logic" lives.

---

## 1. What is a Service?
While the **Controller** handles the request and the **Model** handles the database, the **Service** handles the "Work." 

**Example: Slug Generation**
A blog post needs a URL-friendly name (e.g., `my-post-title`). Generating this involves:
1. Converting to lowercase.
2. Replacing spaces with hyphens.
3. Removing special characters.

Instead of putting this logic in the Controller, we put it in `app/Services/PostService.php`.

---

## 2. Database Update
You need to add a `slug` column to your `posts` table.

**Run this SQL:**
```sql
ALTER TABLE posts ADD COLUMN slug VARCHAR(255) NOT NULL UNIQUE AFTER title;
```

---

## 3. Implementing the Service (`app/Services/PostService.php`)
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

## 🛠️ Student Checklist
*   [ ] Run the SQL to add the `slug` column.
*   [ ] Create the `app/Services/PostService.php` file.
*   [ ] Update `app/Models/Post.php` to save the `slug` in the database.
*   [ ] Refactor `PostController.php` to use the `PostService` before calling the model.
*   [ ] Display the slug on the `home.php` page next to the title.

---

## 🧠 Key Concept: Thin Controllers, Fat Services
We want our **Controllers** to be "Thin"—they should only coordinate between the view, the service, and the model. The **Services** can be "Fat"—they handle the heavy lifting and complex calculations. This makes your code easier to test and maintain!

---

## 🎯 Challenge
Can you update the `PostService` to ensure that slugs are unique? (e.g., if `my-post` already exists, name the new one `my-post-1`).
