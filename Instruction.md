## Phase 3.1: The Database Connection (The "Singleton" Pattern)

### Step 1: Create the Configuration
We don't want to hardcode our password in every file. Create `app/Config/database.php`.

```php
<?php
namespace App\Config;

class Database {
    private static $instance = null;

    public static function getConnection() {
        if (!self::$instance) {
            $host = 'localhost';
            $db   = 'devblog_db';
            $user = 'root';
            $pass = ''; // Default for XAMPP
            $charset = 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            
            $options = [
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                self::$instance = new \PDO($dsn, $user, $pass, $options);
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
        }
        return self::$instance;
    }
}
```

---

## Phase 3.2: The Base Model
Instead of writing the same connection code in every model, we create a **Base Model** that all other models will inherit from. Create `app/Models/Model.php`.

```php
<?php
namespace App\Models;

use App\Config\Database;

abstract class Model {
    protected $db;

    public function __construct() {
        // Automatically get the shared database connection
        $this->db = Database::getConnection();
    }
}
```

---

## Phase 3.3: The Post Model (The "Librarian")
Now we create the specific model for our blog posts. Create `app/Models/Post.php`.

```php
<?php
namespace App\Models;

class Post extends Model {
    
    // Fetch all posts from the database
    public function all() {
        $stmt = $this->db->query("SELECT * FROM posts ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    // Fetch a single post by its ID
    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
```



---

## Step 4: Wiring it to the Controller
Now, our `PostController` asks the `Post` model for data instead of making it up.

```php
<?php
namespace App\Controllers;

use App\Models\Post;

class PostController extends Controller { // Assuming you moved render() to a base Controller

    public function index() {
        $postModel = new Post();
        $posts = $postModel->all();

        $this->render('home', [
            'posts' => $posts
        ]);
    }
}
```

---

## 🛠️ Individual Task: Database Setup
Before this code works, students must create the database in **phpMyAdmin**:

1.  Create a database named `devblog_db`.
2.  Run this SQL:
```sql
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO posts (title, content) VALUES 
('My First MVC Post', 'This is coming from the database!'),
('Why PDO is Awesome', 'It protects us from hackers.');
```

---

## 🧠 Key Concept: Prepared Statements
Explain to the students: Never use variables directly in a query (e.g., `WHERE id = $id`). Always use **`?`** placeholders. This is the #1 security rule for their Capstone project.