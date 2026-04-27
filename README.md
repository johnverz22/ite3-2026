# 🔐 Phase 8: Authentication & Security

In this phase, we move from a public-access system to a secure CMS where administrative actions are protected by a Login/Logout system.

## 1. The users Table
We've added a dedicated table to store our "Admin" credentials. 
- **Unique Username:** Prevents duplicate accounts.
- **Hashed Passwords:** We store a "fingerprint" of the password, not the password itself, using `PASSWORD_DEFAULT`.

## 2. PHP Sessions
Sessions are the bridge between a stateless browser and a stateful server.
- **Login:** We store the user's ID in `$_SESSION`.
- **Validation:** Every time a user tries to `edit` or `delete`, we check if that session variable exists.
- **Logout:** We destroy the session, "forgetting" the user.

## 3. Auth Guards
Instead of creating a complex firewall, we add a simple check at the start of our Controller methods:
```php
if (!isset($_SESSION['user_id'])) {
    header('Location: /ite3/login');
    exit;
}
```

---

## 🛠️ Student Checklist: Security Implementation
1.  **DB Check:** Ensure your `users` table exists.
2.  **Model:** Implement `User::findByUsername()`.
3.  **Controller:** The `AuthController` handles the logic of comparing passwords.
4.  **Protection:** Apply session checks to all `PostController` methods EXCEPT the home page.
5.  **UX:** Update your `main.php` to show a "Logout" link only when the user is logged in.
