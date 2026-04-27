# 🚀 Phase 9: Input Validation (Step-by-Step)

In this phase, we ensure our data is clean and safe. We will build a reusable **Helper Class** to act as a "Bouncer" for our database.

---

## 🛠️ Step 1: The Validator Helper (`app/Helpers/Validator.php`)
Instead of writing the same `empty()` checks everywhere, we centralize our logic in a static helper class.

```php
public static function required($value, $fieldName) {
    if (empty(trim($value))) {
        self::$errors[$fieldName] = ucfirst($fieldName) . " is required!";
        return false;
    }
    return true;
}
```

---

## 🛠️ Step 2: Controller Integration (`PostController.php`)
Before you call the Model to save data, run the Validator. If there are errors, stop the process and go back to the form.

```php
Validator::required($title, 'title');
Validator::required($content, 'content');

if (Validator::hasErrors()) {
    return $this->render('post-create', [
        'errors' => Validator::getErrors(),
        'old' => $_POST // Pass the typed data back!
    ]);
}
```

---

## 🛠️ Step 3: Preserving Input (UX)
It's frustrating for users to lose their data when they make a mistake. In your **View** (`post-create.php`), use the `$old` data we passed from the controller:

```html
<input type="text" name="title" value="<?= htmlspecialchars($old['title'] ?? '') ?>">
```

---

## 🛠️ Step 4: Displaying Errors
Add a small snippet under each input field to show the specific error message to the user.

```php
<?php if (isset($errors['title'])): ?>
    <span style="color: red; font-size: 0.8rem;"><?= $errors['title'] ?></span>
<?php endif; ?>
```

---

## 🧠 Key Concept: Data Integrity
Validation is about more than just "empty fields." It ensures that your database only contains "Good Data." This prevents crashes, broken layouts, and future bugs.

---

## 🎯 Challenge
Can you add a `numeric()` check to your Validator? This would be useful if you had a "Price" or "Stock" field in a future project!
