# 🚀 Phase 8: Authentication (Login/Logout)

In this phase, we are securing our CMS. Only logged-in users should be able to create, edit, or delete posts.

---

## 1. Database Update
You need a `users` table to store credentials.

**Run this in your SQL tool:**
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## 2. Secure Password Hashing
NEVER store plain-text passwords. We use PHP's built-in functions:
- `password_hash($password, PASSWORD_DEFAULT)` -> For saving.
- `password_verify($password, $hashedPassword)` -> For checking.

---

## 3. Session Management
We use `session_start()` at the very beginning of our app (usually in `public/index.php`) to keep track of logged-in users across pages.

**Logic flow:**
1. User submits login form.
2. If credentials match, we set `$_SESSION['user_id'] = $id`.
3. In protected routes, we check: `if (!isset($_SESSION['user_id'])) { redirect to login; }`.

---

## 🛠️ Student Checklist
*   [ ] Run the SQL to create the `users` table.
*   [ ] Implement the `User` model to fetch users by username.
*   [ ] Create the `AuthController` with `login` and `logout` actions.
*   [ ] Create the `login.php` view.
*   [ ] Add `session_start()` to your `public/index.php`.
*   [ ] Add "Auth Guards" (session checks) to your `PostController` methods.

---

## 🧠 Key Concept: Stateful Apps
HTTP is "stateless" (it forgets who you are after every request). **Sessions** allow us to make our app "stateful" by storing a unique ID in a cookie that matches a file on the server. This is how the server "remembers" you are logged in!

---

## 🎯 Challenge
Can you display the logged-in username in the navigation bar? 
*Hint: Use `$_SESSION['username']` if you store it during login.*
