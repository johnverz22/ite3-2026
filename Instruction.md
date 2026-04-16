# 🚀 Phase 4.1: Completing CRUD (Update & Delete)

In this phase, you are completing the "Admin" side of your blog by adding functionality to edit and remove existing posts.

---

## 1. The Model Methods
You need to add `update()` and `delete()` capabilities to your `Post` model.

**File:** `app/Models/Post.php`
```php
// Update an existing post
public function update($id, $title, $content) {
    $stmt = $this->db->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    return $stmt->execute([$title, $content, $id]);
}

// Delete a post
public function delete($id) {
    $stmt = $this->db->prepare("DELETE FROM posts WHERE id = ?");
    return $stmt->execute([$id]);
}
```

---

## 2. Controller Actions
You need three new methods in `PostController.php`:
*   `edit()`: Fetches the post by ID and shows the edit form.
*   `update()`: Processes the POST request from the edit form.
*   `delete()`: Deletes the post via ID and redirects.

---

## 3. The Edit View (`app/Views/post-edit.php`)
This form is special! It needs to "pre-fill" the current title and content.

```html
<form action="/ite3/post/update" method="POST">
    <input type="hidden" name="id" value="<?= $post['id'] ?>">
    <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required>
    <textarea name="content" required><?= htmlspecialchars($post['content']) ?></textarea>
    <button type="submit">Update Post</button>
</form>
```

---

## 🛠️ Student Checklist
*   [ ] Add `update()` and `delete()` to your `Post` model.
*   [ ] Implement `edit()`, `update()`, and `delete()` in your `PostController`.
*   [ ] Create `post-edit.php` with the pre-filled form.
*   [ ] Register the new routes in `app/routes.php`.
*   [ ] Add "Edit" and "Delete" links to your `home.php` list.

---

## 🧠 Key Concept: URL Parameters
We are using query strings like `/post/edit?id=5` to tell our controller exactly which post to work on. Your `edit()` method should use `$_GET['id']` to find that record before displaying the form.
