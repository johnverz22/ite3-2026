Now that our **Autoloader** is finding our classes and our **Front Controller** knows the "Path," we need a **Router Class**. 

Currently, our `index.php` just echos the URI. A real Router takes that URI and "dispatches" it—meaning it calls the correct **Controller** and **Method**.

---

## Handout 2: The Router Class
**Goal:** Build a system that maps URLs to Controller Actions (e.g., `GET /posts` → `PostController@index`).

### Step 1: Create the Router Class
Create `app/Core/Router.php`. This class will store our "Map" of routes.

```php
<?php
namespace App\Core;

class Router {
    protected $routes = [];

    // 1. Register a GET route
    public function get($uri, $controller) {
        $this->routes['GET'][$uri] = $controller;
    }

    // 2. Register a POST route (for forms)
    public function post($uri, $controller) {
        $this->routes['POST'][$uri] = $controller;
    }

    // 3. The Dispatcher: This finds and runs the controller
    public function resolve($uri, $method) {
        $controllerAction = $this->routes[$method][$uri] ?? null;

        if (!$controllerAction) {
            http_response_code(404);
            echo "404 - Page Not Found";
            return;
        }

        // Split "PostController@index" into Class and Method
        [$controller, $action] = explode('@', $controllerAction);
        $controller = "App\\Controllers\\" . $controller;

        // Instantiate the controller and call the method
        if (class_exists($controller)) {
            $controllerInstance = new $controller();
            if (method_exists($controllerInstance, $action)) {
                $controllerInstance->$action();
            } else {
                echo "Method $action not found in $controller";
            }
        } else {
            echo "Controller $controller not found";
        }
    }
}
```



---

### Step 2: Update the Controller
Update your `app/Controllers/PostController.php` to include actual methods (actions).

```php
<?php
namespace App\Controllers;

class PostController {
    public function index() {
        echo "<h1>All Blog Posts</h1><p>Listing all content from the database...</p>";
    }

    public function create() {
        echo "<h1>Create New Post</h1><p>Show a form here.</p>";
    }
}
```

---

### Step 3: Connect everything in `public/index.php`
Now we replace our "Warmer" echo with the actual Router logic.

```php
<?php
// ... keep the autoloader code from Handout 1 ...

use App\Core\Router;

// 1. Initialize the Router
$router = new Router();

// 2. Define our Routes (The Map)
$router->get('home', 'PostController@index');
$router->get('post/create', 'PostController@create');

// 3. Capture the current request
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$uri = str_replace('ite3/', '', $uri);
if ($uri === '' || $uri === 'index.php') { $uri = 'home'; }

$method = $_SERVER['REQUEST_METHOD'];

// 4. Resolve the route!
$router->resolve($uri, $method);
```

---

## 🛠️ Class Activity: Testing the Map
1.  Visit `localhost/ite3/`. It should call `PostController@index`.
2.  Visit `localhost/ite3/post/create`. It should call `PostController@create`.
3.  Visit `localhost/ite3/contact`. It should trigger the **404 Page Not Found**.

### 🧠 Why this is a "Warmer" for Frameworks
In Laravel, you write `Route::get('/home', [PostController::class, 'index']);`. By building this manually, students see that a Router is just an **array** that stores strings and a **dispatcher** that uses `class_exists()` and `method_exists()` to call them.

**Next Step:** Our controllers are currently just echoing strings. We will build the **View Engine** so they can render actual HTML templates.