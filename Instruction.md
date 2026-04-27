# 🚀 Phase 9: Input Validation

In this phase, we ensure that the data entered by users is valid and safe. We will build a reusable **Helper Class** to handle these checks.

---

## 1. The Helper Pattern
Instead of writing the same `if (empty($field))` checks in every controller, we create a `Validator` class. This follows the **DRY (Don't Repeat Yourself)** principle.

**File:** `app/Helpers/Validator.php`
```php
class Validator {
    public static function required($value) {
        return !empty(trim($value));
    }
}
```

---

## 2. Handling Errors
When validation fails, we need to:
1. Stop the process (don't save to DB).
2. Store the error messages.
3. Pass those messages back to the view.

**In the Controller:**
```php
if (!Validator::required($_POST['title'])) {
    $errors['title'] = "Title is required!";
}
```

---

## 3. Displaying Errors in the View
We check if any errors exist and display them in a user-friendly way (usually in red text below the input field).

```php
<?php if (isset($errors['title'])): ?>
    <span style="color: red;"><?= $errors['title'] ?></span>
<?php endif; ?>
```

---

## 🛠️ Student Checklist
*   [ ] Create the `app/Helpers/Validator.php` file.
*   [ ] Use the `Validator` in `PostController` for both **creating** and **updating** posts.
*   [ ] Use the `Validator` in `AuthController` to ensure usernames/passwords aren't blank.
*   [ ] Update your views (`login.php`, `post-create.php`, `post-edit.php`) to show error messages.
*   [ ] Test: Try to save a post without a title. Does it show the error?

---

## 🧠 Key Concept: Data Integrity
Validation is the "Bouncer" at the door of your database. It ensures that only "good" data gets in. This prevents your app from crashing due to empty rows or invalid formats (like a fake email address).

---

## 🎯 Challenge
Can you add a `min()` method to your `Validator` that checks if a post's content is at least 10 characters long?
