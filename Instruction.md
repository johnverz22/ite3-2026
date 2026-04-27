# 🚀 Phase 8: Authentication (Step-by-Step)

In this phase, we secure our CMS by adding a Login system. This ensures that only authorized users can create, edit, or delete posts.

---

## 🛠️ Step 1: Database Update
You need a table to store your administrators. Run this SQL command in your database tool:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Default Admin User (Password: admin123)
INSERT INTO users (username, password) VALUES 
('admin', '$2y$10$8.UnVuG9HHgffUDAlk8qfOuVGkqRzgVymGe07xd00DMp99VvD73XG');
```

---

## 🛠️ Step 2: The User Model (`app/Models/User.php`)
Create a model to handle fetching user data. This is where we verify if a username exists in the database.

```php
public function findByUsername($username) {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    return $stmt->fetch();
}
```

---

## 🛠️ Step 3: Session Initialization
HTTP is "stateless," meaning it doesn't remember who you are. We use **Sessions** to bridge this gap. Add this to the very top of your `public/index.php`:

```php
session_start();
```

---

## 🛠️ Step 4: The Login Logic (`app/Controllers/AuthController.php`)
This controller handles the "Gatekeeping." It checks the password hash and sets the session.

```php
if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    header('Location: /ite3/home');
    exit;
}
```

---

## 🛠️ Step 5: The Auth Guard (`PostController.php`)
Now, we protect our administrative actions. Add a helper method to your controller and call it at the start of `create`, `edit`, and `delete`.

```php
protected function checkAuth() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /ite3/login');
        exit;
    }
}
```

---

## 🧠 Key Concept: Stateful Apps
By storing a `user_id` in the `$_SESSION` array, we make our app "Stateful." The server now "remembers" that you are logged in as you move from page to page.

---

## 🎯 Challenge
Can you update your navigation bar in `main.php` to show a "Logout" link *only* when the user is logged in? 
*Hint: Use `<?php if (isset($_SESSION['user_id'])): ?>`*
