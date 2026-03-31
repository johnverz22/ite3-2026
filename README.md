# 🗄️ Phase 3: The Data Layer (Database & PDO)

In this phase, we connect our application to **MySQL**. We are moving away from "Hardcoded Data" and into "Dynamic Content."

## 1. Why PDO (PHP Data Objects)?
For your Capstone, you must use **PDO** instead of the older `mysqli` functions.
* **Security:** PDO makes it easy to use **Prepared Statements**.
* **Flexibility:** It can work with MySQL, PostgreSQL, or SQLite with minimal code changes.
* **Error Handling:** It uses "Exceptions," which are easier to debug than standard PHP errors.



## 2. The Singleton Connection (`app/Config/Database.php`)
We implemented the **Singleton Pattern** for our database connection. 
* **The Problem:** Opening a new connection to MySQL on every page is slow and uses too much server memory.
* **The Solution:** The `getConnection()` method checks if a connection already exists. If it does, it reuses it. If not, it creates one. This ensures we only ever have **one** connection per request.

## 3. The Model-Base Inheritance
We created a "Parent" Model (`app/Models/Model.php`) that handles the database connection automatically.
* When you create a `Post` model, you don't need to write connection code. 
* By using `class Post extends Model`, the `$this->db` variable is automatically available to you.

## 4. Prepared Statements: Protecting the App
**Never** put variables directly into your SQL strings.
* **❌ BAD:** `"SELECT * FROM posts WHERE id = " . $id` (Vulnerable to hackers!)
* **✅ GOOD:** `"SELECT * FROM posts WHERE id = ?"` (Uses a placeholder).

The database "prepares" the query first, then "fills in" the data safely. This is the industry standard for preventing **SQL Injection**.

---

## 🛠️ Student Checklist: Database Setup
Your code will not work until your local database is configured.

1.  **Open phpMyAdmin:** Create a new database named `devblog_db`.
2.  **Create the Table:**
    ```sql
    CREATE TABLE posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        content TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ```
3.  **Add Seed Data:** Insert at least 2 rows manually so you have something to display.
4.  **Verify Connection:** If you see a `PDOException`, check your `username` and `password` in `app/Config/Database.php`.

---

## ⚠️ Common Troubleshooting
* **Database Not Found:** Ensure the name in your PHP code (`devblog_db`) matches the name you created in phpMyAdmin exactly.
* **Access Denied:** In XAMPP, the default user is `root` and the password is an **empty string** (`''`).
* **Fetch Mode:** We set `PDO::FETCH_ASSOC`. This means `$post['title']` will work, but `$post->title` will not. If you prefer objects, change the fetch mode in the Config.